<?php

namespace FredBradley\IcingaWireDash\Maps;

use Carbon\Carbon;

class Host
{
    public string $name;
    public string $type;
    public array $attrs;
    public array $groups;

    protected array $dates = [
        'last_check',
        'execution_end',
        'execution_start',
        'schedule_end',
        'schedule_start',
        'last_hard_state_change',
        'last_state_change',
        'last_state_down',
        'next_check',
        'next_update',
        'previous_state_change',
        'last_state_up',
    ];

    public function __construct($properties)
    {
        $this->name = $properties['name'];
        $this->type = $properties['type'];
        $this->attrs = $properties['attrs'];
        $this->groups = $properties['attrs']['groups'];

        $this->last_check_ok = Carbon::parse($properties['attrs']['last_state_up']);

    }

    public function __get(string $value): mixed
    {
        if (in_array($value, $this->dates)) {
            return $this->parseAsTime($this->attrs[$value]);
        }
        return $this->attrs[$value];
    }

    private function parseAsTime(string $value): Carbon
    {
        return Carbon::parse($value);
    }
}
