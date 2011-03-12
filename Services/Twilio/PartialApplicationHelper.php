<?php

class Services_Twilio_PartialApplicationHelper {
  private $callbacks;
  public function __construct() {
    $this->callbacks = array();
  }
  public function set($method, $callback, array $args) {
    if (!is_callable($callback)) return FALSE;
    $this->callbacks[$method] = array($callback, $args);
  }
  public function __call($method, $args) {
    if (!isset($this->callbacks[$method])) {
      throw new Exception("Method not found: $method");
    }
    list($callback, $cb_args) = $this->callbacks[$method];
    return call_user_func_array(
      $callback,
      array_merge($cb_args, $args)
    );
  }
}
