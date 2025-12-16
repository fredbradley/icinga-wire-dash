<?php

namespace FredBradley\IcingaWireDash\Livewire\Tiles;

use FredBradley\IcingaWireDash\Maps\Host;
use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemHosts;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class ProblemHosts extends Component
{
    public string $position;

    public string $title;

    public ?bool $handled = null;

    public function mount(string $position, ?bool $handled = null, string $title = 'Problem Hosts'): void
    {
        $this->position = $position;
        $this->title = $title;
        $this->handled = $handled;
    }

    private function getData(): array
    {
        $response = (new GetProblemHosts)->send();

        $collection = collect($response->dto()->data);
        /*
                $collection = $collection->filter(function($host) {
                    return !in_array('access-points', $host->groups);
                });
        */
        if ($this->handled) {
            $collection = $collection->filter(function (Host $host) {
                return $host->handled === true;
            });
        }
        if ($this->handled === false) {
            $collection = $collection->filter(function (Host $host) {
                return $host->handled === false;
            });
        }

        return $collection->toArray();
    }

    public function render(): Renderable
    {
        return view('icinga-wire-dash::tiles.problem-hosts', [
            'data' => $this->getData(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.skeleton.refresh_interval_in_seconds') ?? 10,
        ]);
    }
}
