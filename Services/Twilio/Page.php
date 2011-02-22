<?php

class Page {
  protected $page;
  protected $items;
  public function __construct($page, $name) {
    $this->page = $page;
    $this->items = $page->{$name};
  }
  public function getItems() {
    return $this->items;
  }
  public function __get($prop) {
    return $this->page->$prop;
  }
}

