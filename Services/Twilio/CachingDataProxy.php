<?php

class Services_Twilio_CachingDataProxy
  implements Services_Twilio_DataProxy
{
  protected $proxy;
  protected $principal;
  protected $cache;
  public function __construct($principal, Services_Twilio_DataProxy $proxy,
    $cache = NULL
  ) {
    if (is_scalar($principal)) {
      $principal = array('sid' => $principal, 'params' => array());
    }
    $this->principal = $principal;
    $this->proxy = $proxy;
    $this->cache = $cache;
  }
  public function setCache($object) {
    $this->cache = $object;
  }
  public function __get($prop) {
    if ($prop == 'sid') {
      return $this->principal['sid'];
    }
    if (empty($this->cache)) {
      $this->_load();
    }
    return isset($this->cache->$prop)
      ? $this->cache->$prop
      : NULL;
  }
  public function retrieveData($path, array $params = array()) {
    return $this->proxy->retrieveData(
      $this->principal['sid'] . "/$path", $params);
  }
  public function createData($path, array $params = array()) {
    return $this->proxy->createData(
      $this->principal['sid'] . "/$path", $params);
  }
  public function updateData($params) {
    $this->cache = $this->proxy->createData(
      $this->principal['sid'], $params);
    return $this;
  }
  private function _load($object = NULL) {
    $this->cache = $object !== NULL
      ? $object
      : $this->proxy->retrieveData($this->principal['sid']);
    if (empty($this->cache->subresource_uris)) return;
    foreach ($this->cache->subresource_uris as $res => $uri) {
      $type = Services_Twilio_Resource::camelize($res);
      $this->cache->$res = new $type($this);
    }
  }
}
