<?php


namespace Twilio;


use Twilio\Exceptions\TwilioException;

class Stream implements \Iterator {

    function __construct(Page $page, $limit, $pageLimit) {
        $this->page = $page;
        $this->limit = $limit;
        $this->currentRecord = 1;
        $this->pageLimit = $pageLimit;
        $this->currentPage = 1;
        $this->started = false;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the current element
     * @link http://php.net/manual/en/iterator.current.php
     * @return mixed Can return any type.
     */
    public function current() {
        return $this->page->current();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Move forward to next element
     * @link http://php.net/manual/en/iterator.next.php
     * @return void Any returned value is ignored.
     */
    public function next() {
        $this->page->next();
        $this->currentRecord++;

        if ($this->overLimit()) {
            return;
        }

        if (!$this->page->valid()) {
            if ($this->overPageLimit()) {
                return;
            }
            $this->page = $this->page->nextPage();
            $this->currentPage++;
        }
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Return the key of the current element
     * @link http://php.net/manual/en/iterator.key.php
     * @return mixed scalar on success, or null on failure.
     */
    public function key() {
        return $this->currentRecord;
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Checks if current position is valid
     * @link http://php.net/manual/en/iterator.valid.php
     * @return boolean The return value will be casted to boolean and then evaluated.
     * Returns true on success or false on failure.
     */
    public function valid() {
        return !$this->overLimit() && !$this->overPageLimit();
    }

    /**
     * (PHP 5 &gt;= 5.0.0)<br/>
     * Rewind the Iterator to the first element
     * @link http://php.net/manual/en/iterator.rewind.php
     * @return void Any returned value is ignored.
     * @throws TwilioException on restart
     */
    public function rewind() {
        if ($this->started) {
            throw new TwilioException('Streams can not be restarted');
        }
    }

    protected function overLimit() {
        return $this->limit !== null && $this->limit <= $this->currentRecord;
    }

    protected function overPageLimit() {
        return $this->pageLimit !== null && $this->pageLimit <= $this->currentPage;
    }

}