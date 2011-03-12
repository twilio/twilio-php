<?php

require_once dirname(__FILE__) . '/' . 'Twilio/TinyHttp.php';
require_once dirname(__FILE__) . '/' . 'Twilio/Page.php';
require_once dirname(__FILE__) . '/' . 'Twilio/DataProxy.php';
require_once dirname(__FILE__) . '/' . 'Twilio/CachingDataProxy.php';
require_once dirname(__FILE__) . '/' . 'Twilio/ArrayDataProxy.php';
require_once dirname(__FILE__) . '/' . 'Twilio/Resource.php';
require_once dirname(__FILE__) . '/' . 'Twilio/ListResource.php';
require_once dirname(__FILE__) . '/' . 'Twilio/InstanceResource.php';
require_once dirname(__FILE__) . '/' . 'Twilio/Resources.php';

class Services_Twilio extends Services_Twilio_Resource {
  protected $http;
  protected $version;
  public function __construct(
    $sid,
    $token,
    $version = '2010-04-01',
    $_http = NULL
  ) {
    $this->version = $version;
    $this->http = (NULL === $_http)
      ? new Services_Twilio_TinyHttp(
        "https://$sid:$token@api.twilio.com", array('debug' => TRUE))
      : $_http;
    $this->accounts = new Accounts($this);
    $this->account = $this->accounts->get($sid);
  }
  public function retrieveData($path, array $params = array()) {
    $path = "/$this->version/$path.json";
    return empty($params)
      ? $this->_processResponse($this->http->get($path))
      : $this->_processResponse($this->http->get("$path?"
      . http_build_query($params, '', '&')));
  }
  public function createData($path, array $params = array()) {
    $path = "/$this->version/$path.json";
    $headers = array('Content-Type' => 'application/x-www-form-urlencoded');
    return empty($params)
      ? $this->_processResponse($this->http->post($path, $headers))
      : $this->_processResponse($this->http->post($path, $headers,
        http_build_query($params, '', '&')));
  }

  private function _processResponse($response) {
    list($status, $headers, $body) = $response;
    if (200 <= $status && $status < 300) {
      if ($headers['Content-Type'] == 'application/json') {
        $object = json_decode($body);
        return $object;
      } else throw new ErrorException('not json');
    } else throw new ErrorException("$status: $body");
  }
}
// vim: ai ts=2 sw=2 noet sta
