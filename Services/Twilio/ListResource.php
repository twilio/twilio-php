<?php

abstract class Services_Twilio_ListResource
  extends Services_Twilio_Resource
{
  public function get($sid) {
    $schema = $this->getSchema();
    $type = $schema['instance']; 
    return new $type($sid, $this);
  }

  protected function _create(array $params) {
    $obj = $this->proxy->createData($this->name, $params);
    $inst = $this->get($obj->sid);
    $inst->setObject($obj);
    return $inst;
  }

  public function retrieveData($sid, array $params = array()) {
    $schema = $this->getSchema();
    $basename = $schema['basename'];
    return $this->proxy->retrieveData("$basename/$sid", $params);
  }

  public function createData($sid, array $params = array()) {
    $schema = $this->getSchema();
    $basename = $schema['basename'];
    return $this->proxy->createData("$basename/$sid", $params);
  }

  public function getPage($page = 0, $size = 10, array $filters = array()) {
    $schema = $this->getSchema();
    $page = $this->proxy->retrieveData($schema['basename'], array(
      'Page' => $page,
      'PageSize' => $size,
    ) + $filters);
    $page->{$schema['list']} = array_map(
      array($this, 'get'),
      $page->{$schema['list']}
    );
    return new Page($page, $schema['list']);
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
