<?php

class Services_Twilio_ArrayDataProxy
  implements Services_Twilio_DataProxy
{
  protected $array;
  public function __construct($array) {
    $this->array = $array;
  }
  function retrieveData($key, array $params = array()) {
    return (object) $this->array;
  }
  function createData($key, array $params = array()) {
    return (object) $this->array;
  }
  function updateData(array $params) {
    return $this->array;
  }
  function __get($prop) {
    return is_array($this->array)
      ? $this->array['prop']
      : $this->array->$prop;
  }
}
