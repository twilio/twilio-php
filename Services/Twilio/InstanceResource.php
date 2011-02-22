<?php

abstract class Services_Twilio_InstanceResource
  extends Services_Twilio_Resource
{
  protected $sid;
  protected $object;
  public function __construct($sid, Services_Twilio_DataProxy $proxy) {
    $this->object = is_object($sid) ? $sid : (object)array('sid' => $sid);
    $this->sid = $this->object->sid;
    parent::__construct($proxy);
  }
  public function update($params, $value = NULL) {
    if (!is_array($params)) {
      $params = array($params => $value);
    }
    $this->proxy->send("$this->sid", $params);
  }
  public function setObject($object) {
    $this->load($object);
  }
  public function __get($key) {
    if (!isset($this->object->$key)) {
      $this->load();
    }
    return isset($this->$key)
      ? $this->$key
      : (
        isset($this->object->$key)
        ? $this->object->$key
        : NULL
      );
  }
  public function receive($path, array $params = array()) {
    return $this->proxy->receive("$this->sid/$path", $params);
  }
  public function send($path, array $params = array()) {
    return $this->proxy->send("$this->sid/$path", $params);
  }
  private function load($object = NULL) {
    $this->object = $object ? $object : $this->proxy->receive($this->sid);
    if (empty($this->object->subresource_uris)) return;
    foreach ($this->object->subresource_uris as $res => $uri) {
      $type = self::camelize($res);
      $this->$res = class_exists($type)
        ? new $type($this)
        : new Services_Twilio_ListResource($type, $this);
    }
  }
}
