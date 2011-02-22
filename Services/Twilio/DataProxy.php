<?php

interface Services_Twilio_DataProxy {
  function receive($key, array $params = array());
  function send($key, array $params = array());
}

