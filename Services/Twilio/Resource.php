<?php

abstract class Services_Twilio_Resource
  implements Services_Twilio_DataProxy
{
  protected $name;
  protected $proxy;
  public function __construct(Services_Twilio_DataProxy $proxy) {
    $this->proxy = $proxy;
    $this->name = get_class($this);
  }
  public function retrieveData($path, array $params = array()) {
    return $this->proxy->retrieveData($path, $params);
  }
  public function createData($path, array $params = array()) {
    return $this->proxy->createData($path, $params);
  }
  public static function decamelize($word) {
    return preg_replace(
      '/(^|[a-z])([A-Z])/e',
      'strtolower(strlen("\\1") ? "\\1_\\2" : "\\2")',
      $word
    );
  }
  public static function camelize($word) {
    return preg_replace('/(^|_)([a-z])/e', 'strtoupper("\\2")', $word);
  }
}

