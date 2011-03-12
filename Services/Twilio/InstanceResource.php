<?php

abstract class Services_Twilio_InstanceResource
  extends Services_Twilio_Resource
{
  public function update($params, $value = NULL) {
    if (!is_array($params)) {
      $params = array($params => $value);
    }
    $this->proxy->updateData($params);
  }
  public function setProxy($proxy) {
    $this->proxy = $proxy;
  }
  public function __get($key) {
    return $this->proxy->$key;
  }
}
