<?php
/**
 * TinyHttp from https://gist.github.com/618157.
 * Copyright 2011, Neuman Vong. BSD License.
 */

class Services_Twilio_TinyHttpException extends ErrorException {}

class Services_Twilio_TinyHttp {
  var $user, $pass, $scheme, $host, $port, $debug;

  public function __construct($url, $kwargs = array()) {
    $parts = parse_url($url);
    foreach (get_object_vars($this) as $name => $_) {
      $this->$name = isset($parts[$name]) ? $parts[$name]: NULL;
    }
    $this->debug = isset($kwargs['debug']) ? !!$kwargs['debug'] : NULL;
  }

  public function __call($name, $args) {
    list($res, $req_headers, $req_body) = $args + array(0, array(), '');

	// Add the Twilio User-Agent String
	$req_headers["User-Agent"] = "twilio-php/3.0.0";

    $opts = array(
      CURLOPT_URL => "$this->scheme://$this->host$res",
      CURLOPT_HEADER => TRUE,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_INFILESIZE => -1,
      CURLOPT_POSTFIELDS => NULL,
      CURLOPT_TIMEOUT => 60,
    );

    foreach ($req_headers as $k => $v) $opts[CURLOPT_HTTPHEADER][] = "$k: $v";
    if ($this->port) $opts[CURLOPT_PORT] = $this->port;
    if ($this->debug) $opts[CURLINFO_HEADER_OUT] = TRUE;
    if ($this->user && $this->pass) $opts[CURLOPT_USERPWD] = "$this->user:$this->pass";
    switch ($name) {
    case 'get':
      $opts[CURLOPT_HTTPGET] = TRUE;
      break;
    case 'post':
      $opts[CURLOPT_POST] = TRUE;
      $opts[CURLOPT_POSTFIELDS] = $req_body;
      break;
    case 'put':
      $opts[CURLOPT_PUT] = TRUE;
      if (strlen($req_body)) {
        if ($buf = fopen('php://memory', 'w+')) {
          fwrite($buf, $req_body);
          fseek($buf, 0);
          $opts[CURLOPT_INFILE] = $buf;
          $opts[CURLOPT_INFILESIZE] = strlen($req_body);
        } else throw new Services_Twilio_TinyHttpException('unable to open temporary file');
      }
      break;
    case 'head':
      $opts[CURLOPT_NOBODY] = TRUE;
      break;
    default:
      $opts[CURLOPT_CUSTOMREQUEST] = strtoupper($name);
      break;
    }
    try {
      if ($curl = curl_init()) {
        if (curl_setopt_array($curl, $opts)) {
          if ($response = curl_exec($curl)) {
            $parts = explode("\r\n\r\n", $response, 3);
            list($head, $body) = ($parts[0] == 'HTTP/1.1 100 Continue')
              ? array($parts[1], $parts[2])
              : array($parts[0], $parts[1]);
            $status = curl_getinfo($curl, CURLINFO_HTTP_CODE);
            if ($this->debug) {
              error_log(
                curl_getinfo($curl, CURLINFO_HEADER_OUT) .
                $req_body
              );
            }
            $header_lines = explode("\r\n", $head);
            array_shift($header_lines);
            foreach ($header_lines as $line) {
              list($key, $value) = explode(":", $line, 2);
              $headers[$key] = trim($value);
            }
            curl_close($curl);
            if (isset($buf) && is_resource($buf)) fclose($buf);
            return array($status, $headers, $body);
          } else throw new Services_Twilio_TinyHttpException(curl_error($curl));
        } else throw new Services_Twilio_TinyHttpException(curl_error($curl));
      } else throw new Services_Twilio_TinyHttpException('unable to initialize cURL');
    } catch (ErrorException $e) {
      if (is_resource($curl)) curl_close($curl);
      if (isset($buf) && is_resource($buf)) fclose($buf);
      throw $e;
    }
  }
}
