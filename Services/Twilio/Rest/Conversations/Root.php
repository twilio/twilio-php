<?php

class Services_Twilio_Rest_Conversations_Root {
    public function __construct($client, $uri) {
        $this->_conversations = new Services_Twilio_Rest_Conversations_Conversations($client, $uri);
        $this->inProgress = new Services_Twilio_Rest_Conversations_Conversations($client, "$uri/InProgress");
        $this->completed = new Services_Twilio_Rest_Conversations_Conversations($client, "$uri/Completed");
    }

    public function get($sid) {
        return $this->_conversations->get($sid);
    }

    public function delete($sid, $params = array()) {
        return $this->_conversations->delete($sid, $params);
    }

    public function getPage(
        $page = 0, $size = 50, $filters = array(), $deep_paging_uri = null
    ) {
        return $this->_conversations->getPage($page, $size, $filters, $deep_paging_uri);
    }

    public function getIterator(
        $page = 0, $size = 50, $filters = array()
    ) {
        return $this->_conversations->getIterator($page, $size, $filters);
    }

    public function getPageGenerator(
        $page = 0, $size = 50, $filters = array(), $deep_paging_uri = null
    ) {
        return $this->_conversations->getIterator($page, $size, $filters, $deep_paging_uri);
    }

}
