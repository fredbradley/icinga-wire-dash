<?php

namespace FredBradley\IcingaWireDash\Maps;

use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use FredBradley\IcingaWireDash\Enums\IcingaState;

class Service
{
    public string $name;
    public string $type;
    public string $host_name;
    public array $attrs;
    public bool $host_has_problem;
    public IcingaState $host_state;
    public array $hostGroups;

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
    public mixed $last_check_ok;
    public array $host;

    public function __construct($properties)
    {
        $this->name = $properties['name'];
        $this->type = $properties['type'];
        $this->host = $properties['joins']['host'];

        $this->last_check_ok = $properties['attrs']['last_state_ok'];
        $this->attrs = $properties['attrs'];
        //dd($this->host);
        $this->host_name = $properties['joins']['host']['name']; //$properties['attrs']['host_name'];
        $this->host_has_problem = $properties['joins']['host']['problem'];
        $this->hostGroups = $this->host['groups'];
        $this->host_state = IcingaState::fromApi($this->host['state']);
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
