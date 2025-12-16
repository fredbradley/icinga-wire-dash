<?php

namespace FredBradley\IcingaWireDash\Livewire\Tiles;

use FredBradley\IcingaWireDash\Enums\IcingaState;
use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemServices;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class ProblemServices extends Component
{
    public string $position;

    public function mount(string $position): void
    {
        $this->position = $position;
    }

    private function getData(): array
    {
        $response = (new GetProblemServices)->send();

        return $response->dto()->data;
    }

    public function render(): Renderable
    {
        return view('icinga-wire-dash::tiles.problem-services', [
            'data' => collect($this->getData())->filter(function ($service) {
                return $service->host_state === IcingaState::fromApi(0);
            }),
            'refreshIntervalInSeconds' => config('dashboard.tiles.skeleton.refresh_interval_in_seconds') ?? 10,
        ]);
    }
}
