<?php

namespace FredBradley\IcingaWireDash\Livewire;

use FredBradley\IcingaWireDash\Saloon\IcingaConnector;
use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemHosts;
use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemServices;
use Livewire\Component;

class Dashboard extends Component
{
    public function mount() {}

    private function problemHosts()
    {
        $connector = new IcingaConnector;

        $request = new GetProblemHosts;
        $response = $connector->send($request);

        return $response->dto()->data;
    }

    private function problemServices()
    {
        $connector = new IcingaConnector;

        $request = new GetProblemServices;
        $response = $connector->send($request);

        return $response->dto()->data;
    }

    public function render()
    {
        $hosts = collect($this->problemHosts());
        $services = collect($this->problemServices())->filter(function ($service) use ($hosts) {
            return ! in_array($service->host_name, $hosts->pluck('name')->toArray());
        })->toArray();

        return view('icinga-wire-dash::dashboard', compact('hosts', 'services'));
    }
}
