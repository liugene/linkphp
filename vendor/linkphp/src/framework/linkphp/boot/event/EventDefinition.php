<?php

namespace linkphp\boot\event;

use SplObjectStorage;

class EventDefinition
{

    private $server;

    /**
     * @var SplObjectStorage
     */
    private $observers = NULL;

    public function __construct()
    {
        if(is_null($this->observers)) $this->observers = new SplObjectStorage();
    }

    public function setServer($server)
    {
        $this->server = $server;
        return $this;
    }

    public function getObservers()
    {
        return $this->observers;
    }

    public function getCount()
    {
        return $this->observers->count();
    }

    public function getServer()
    {
        return $this->server;
    }

    public function current()
    {
        return $this->observers->current();
    }

    public function valid()
    {
        return $this->observers->valid();
    }

    public function rewind()
    {
        $this->observers->rewind();
    }

    public function key()
    {
        return $this->observers->key();
    }

    public function next()
    {
        $this->observers->next();
    }

    public function getCurrent()
    {
        return $this->observers->current();
    }

    public function register(EventServerProvider $eventServerProvider)
    {
        // TODO: Implement register() method.
        $this->observers->attach($eventServerProvider);
        return $this;
    }

    public function has($server){}

}
