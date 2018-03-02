<?php

namespace linkphp\boot\event;

interface EventServerProvider
{
    public function update(EventDefinition $eventDefinition);
}
