<?php

abstract class Services_Twilio_ListResource
  extends Services_Twilio_Resource
{
  public function get($sid) {
    $type = $this->getInstanceName();
    return new $type($sid, $this);
  }

  public function _create(array $params) {
    $obj = $this->proxy->send($this->name, $params);
    $inst = $this->get($obj->sid);
    $inst->setObject($obj);
    return $inst;
  }

  public function receive($sid, array $params = array()) {
    $schema = $this->getSchema();
    $basename = $schema['basename'];
    return $this->proxy->receive("$basename/$sid", $params);
  }

  public function send($sid, array $params = array()) {
    $schema = $this->getSchema();
    $basename = $schema['basename'];
    return $this->proxy->send("$basename/$sid", $params);
  }

  public function getPage($page = 0, $size = 10, array $filters = array()) {
    $schema = $this->getSchema();
    $page = $this->proxy->receive($schema['basename'], array(
      'Page' => $page,
      'PageSize' => $size,
    ) + $filters);
    $page->{$schema['list']} = array_map(
      array($this, 'get'),
      $page->{$schema['list']}
    );
    return new Page($page, $schema['list']);
  }

  public function getInstanceName() {
    return substr($this->name, 0, -1);
  }

  public function getSchema() {
    $name = get_class($this);
    return array(
      'name' => $name,
      'basename' => $name,
      'instance' => substr($name, 0, -1),
      'list' => self::decamelize($name),
    );
  }
}
