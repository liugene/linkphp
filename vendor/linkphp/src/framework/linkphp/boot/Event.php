<?php

namespace linkphp\boot;

use linkphp\boot\event\EventDefinition;
use linkphp\boot\event\EventSubject;

class Event  implements EventSubject
{

    /**
     * @var EventDefinition
     */
    private $event_map = [];

    static private $_instance;

    /**
     * 获得所有绑定的实例结果
     */
    public function getEventMap()
    {
        return $this->event_map;
    }

    static public function getInstance()
    {
        if(is_null(self::$_instance)){
            self::$_instance = new self();
            return self::$_instance;
        }
        return self::$_instance;
    }

    public function provider(EventDefinition $eventDefinition)
    {
        $this->event_map[$eventDefinition->getServer()] = $eventDefinition;
    }

    public function target($server)
    {
        $observers = $this->event_map[$server];
        foreach($observers->getObservers() as $observer){
            call_user_func([$observer,'update'],$observers);
        }
    }

    public function remove($server){}

}
