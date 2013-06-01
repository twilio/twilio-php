<?php

require_once 'google/appengine/api/urlfetch_service_pb.php';
require_once 'google/appengine/runtime/ApiProxy.php';
require_once 'google/appengine/runtime/ApplicationError.php';

use \google\appengine\runtime\ApiProxy;
use \google\appengine\runtime\ApplicationError;
use \google\appengine\URLFetchRequest\RequestMethod;

class Services_Twilio_UrlFetchHttpException extends ErrorException {}

class Services_Twilio_UrlFetchHttp {

  private $user = null;
  private $pass = null;
  
  private $uri = null;
  private $debug = false;
  private $headers = [];

  private static $request_map = [
      "GET" => RequestMethod::GET,
      "POST" => RequestMethod::POST,
      "HEAD" => RequestMethod::HEAD,
      "PUT" => RequestMethod::PUT,
      "DELETE" => RequestMethod::DELETE,
      "PATCH" => RequestMethod::PATCH
  ];
  
  public function __construct($uri = '', $kwargs = []) {
    $this->uri = $uri;
    if (isset($kwargs['debug'])) {
      $this->debug = $kwargs['debug'];
    }
    if (isset($kwargs['headers'])) {
      $this->headers = $kwargs['headers'];
    }
  }
  
  public function __call($name, $args) {
    list($res, $req_headers, $req_body) = $args + [0, [], ''];

    $req = new \google\appengine\URLFetchRequest();
    $req->setUrl($this->uri . $res);
    $req->setMethod(self::$request_map[strtoupper($name)]);
    
    if (isset($req_body)) {
      $req->setPayload($req_body);
    }    
    $headers = array_merge($this->headers, $req_headers);
    
    foreach($headers as $key => $value) {
      $h = $req->addHeader();
      $h->setKey($key);
      $h->setValue($value);
    }    
    if ($this->user && $this->pass) {
      $user_pass = sprintf("%s:%s", $this->user, $this->pass);
      $h = $req->addHeader();
      $h->setKey("Authorization");
      $h->setValue(sprintf("Basic %s", base64_encode($user_pass)));
    }

    $resp = new \google\appengine\URLFetchResponse();

    try {
      ApiProxy::makeSyncCall('urlfetch', 'Fetch', $req, $resp);
    } catch (ApplicationError $e) {
      throw new Services_Twilio_UrlFetchHttpException(
             sprintf("Call to URLFetch failed with application error %d.",
                     $e->getApplicationError()));
    }
    
    $response_headers = [];
    foreach($resp->getHeaderList() as $header) {
      // TODO: Do we need to support multiple headers with the same key?
      $response_headers[trim($header->getKey())] = trim($header->getValue());
    }
    
    return [$resp->getStatusCode(), $response_headers, $resp->getContent()];
  }
  
  public function authenticate($user, $pass) {
    $this->user = $user;
    $this->pass = $pass;
  }
    
}