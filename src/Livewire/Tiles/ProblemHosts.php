<?php

namespace FredBradley\IcingaWireDash\Livewire\Tiles;

use FredBradley\IcingaWireDash\Saloon\IcingaConnector;
use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemHosts;
use Livewire\Component;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;

class ProblemHosts extends Component
{
    public string $position;

    public function mount(string $position): void
    {
        $this->position = $position;
    }

    /**
     * @throws \ReflectionException
     * @throws InvalidResponseClassException
     * @throws PendingRequestException
     */
    private function getData()
    {
        $connector = new IcingaConnector();

        $request = new GetProblemHosts();
        $response = $connector->send($request);

        return $response->dto()->data;
    }

    public function render()
    {
        return view('icinga-wire-dash::tiles.problem-hosts', [
            'data' => $this->getData(),
            'refreshIntervalInSeconds' => config('dashboard.tiles.skeleton.refresh_interval_in_seconds') ?? 60,
        ]);
    }
}
