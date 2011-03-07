<?php

interface Services_Twilio_DataProxy {
  function retrieveData($key, array $params = array());
  function createData($key, array $params = array());
}

