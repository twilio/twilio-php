<?php

class Services_Twilio_AutoPagingIterator
    implements Iterator
{
    protected $resource;
    protected $page;
    protected $size;
    protected $filters;
    protected $items;

    private $_args;

    public function __construct(
        Services_Twilio_ListResource $resource,
        array $filters = array(),
        $page = 0, 
        $size = 50)
    {
        $this->resource = $resource;
        $this->page = $page;
        $this->size = $size;
        $this->filters = $filters;
        $this->items = array();

        // Save a backup for rewind()
        $this->_args = array($page, $size);
    }

    public function current()
    {
        return current($this->items);
    }

    public function key()
    {
        return key($this->items);
    }

    public function next()
    {
        try {
            $this->loadIfNecessary();
            return next($this->items);
        }
        catch (Services_Twilio_RestException $e) {
            // Swallow the out-of-range error
        }
    }

    public function rewind()
    {
        list($page, $size) = $this->_args;
        $this->page = $page;
        $this->size = $size;
        $this->items = array();
    }

    public function count()
    {
        throw new BadMethodCallException('Not allowed');
    }

    public function valid()
    {
        try {
            $this->loadIfNecessary();
            return key($this->items) !== null;
        }
        catch (Services_Twilio_RestException $e) {
            // Swallow the out-of-range error
        }
        return false;
    }

    protected function loadIfNecessary()
    {
        if (// Empty because it's the first time or last page was empty
            empty($this->items)
            // null key when the items list is iterated over completely
            || key($this->items) === null
        ) {
            $this->page = $this->page + 1;
            $this->items = $this->resource->getList(
                $this->filters,
                $this->page,
                $this->size
            );
        }
    }
}
