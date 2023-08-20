<?php

namespace FredBradley\IcingaWireDash\Maps;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;

class Service
{
    public string $name;
    public string $type;
    public string $host_name;
    public array $attrs;

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
        'last_state_ok'
    ];

    public function __construct($properties)
    {
        $this->name = $properties['name'];
        $this->type = $properties['type'];
        $this->host_name = $properties['attrs']['host_name'];
        $this->last_check_ok = $properties['attrs']['last_state_ok'];
        $this->attrs = $properties['attrs'];

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
        try {
            return Carbon::parse($value);
        } catch (InvalidFormatException $exception) {
            return Carbon::now()->subYears(10);
        }

    }
}
