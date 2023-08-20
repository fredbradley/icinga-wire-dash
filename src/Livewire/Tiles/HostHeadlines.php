<?php

namespace FredBradley\IcingaWireDash\Livewire\Tiles;

use Livewire\Component;

class HostHeadlines extends Component
{
    public string $position;
    public function mount(string $position): void
    {
        $this->position = $position;
    }
    public function render()
    {
        return view('icinga-wire-dash::tiles.host-headlines', [
            //'myData' => MyStore::make()->getData(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.skeleton.refresh_interval_in_seconds') ?? 60,

        ]);
    }
}
