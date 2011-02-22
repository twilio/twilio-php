<?php

require_once dirname(__FILE__) . '/' . 'Twilio/TinyHttp.php';
require_once dirname(__FILE__) . '/' . 'Twilio/Page.php';
require_once dirname(__FILE__) . '/' . 'Twilio/DataProxy.php';
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
  public function receive($path, array $params = array()) {
    list($status, $headers, $body) = empty($params)
      ? $this->http->get("/$this->version/$path.json")
      : $this->http->get("/$this->version/$path.json?"
        . http_build_query($params, '', '&'));
    if (200 <= $status && $status < 300) {
      if ($headers['Content-Type'] == 'application/json') {
        $object = json_decode($body);
        return $object;
      } else throw new ErrorException('not json');
    } else throw new ErrorException("$status: $body");
  }
  public function send($path, array $params = array()) {
    $path = "$path.json";
    list($status, $headers, $body) = empty($params)
      ? $this->http->post(
        "/$this->version/$path",
        array('Content-Type' => 'application/x-www-form-urlencoded')
      ) : $this->http->post(
        "/$this->version/$path",
        array('Content-Type' => 'application/x-www-form-urlencoded'),
        http_build_query($params, '', '&')
      );
    if (200 <= $status && $status < 300) {
      if ($headers['Content-Type'] == 'application/json') {
        $object = json_decode($body);
        return $object;
      } else throw new ErrorException('not json');
    } else throw new ErrorException("$status: $body");
  }
}
// vim: ai ts=2 sw=2 noet sta
