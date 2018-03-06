<?php

namespace linkphp\boot;

use linkphp\boot\event\EventDefinition;
use linkphp\boot\event\EventSubject;

class Event  implements EventSubject
{

    /**
     * @array EventDefinition
     */
    private $event_map = [];

    static private $_instance;

    /**
     * 获得所有绑定的实例结果
     * @param string $server
     * @return EventDefinition
     */
    public function getEventMap($server='')
    {
        if($server != '') return $this->event_map[$server];
        return $this->event_map;
    }

    static public function instance()
    {
        if(is_null(self::$_instance)) self::$_instance = new self();
        return self::$_instance;
    }

    public function import($events)
    {
        if(is_array($events)){
            foreach($events as $server => $handle){
                if($this->has($server)){
                    $this->event_map[$server]->register(new $handle());
                } else {
                    $this->event_map[$server] = $this->provider(
                        (new EventDefinition())
                            ->setServer($server)
                            ->register(new $handle())
                    );
                }
            }
        }
        return $this;
    }

    public function provider(EventDefinition $eventDefinition)
    {
        if($this->has($eventDefinition->getServer())){
            throw new Exception('已经存在相同的事件名称');
        } else {
            $this->event_map[$eventDefinition->getServer()] = $eventDefinition;
        }
        return $eventDefinition;
    }

    public function target($server)
    {
        /**
         * @var EventDefinition
         */
        $observers = $this->event_map[$server];
        $observers->rewind();
        while($observers->valid()) {
            $object = $observers->current();
            call_user_func([$object,'update'],$observers);
            $observers->next();
        }
    }

    public function remove($server){}

    public function has($server)
    {
        return isset($this->event_map[$server]);
    }

}
