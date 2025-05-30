<?php

namespace zaengle\conventions\events;

use craft\base\Event;

class PatternModelEvent extends Event
{
    public ?array $context = null;
    public $sender;
    public ?string $output = '';

}
