<?php

namespace FredBradley\IcingaWireDash\Livewire\Tiles;

use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemServices;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class ProblemServices extends Component
{
    public string $position;

    public array $data = [];
    public ?string $lastAttemptedAt = null;

    public function mount(string $position): void
    {
        $this->position = $position;
        $this->refreshData();
    }

    private function getData(): array
    {
        try {
            $response = (new GetProblemServices)->send();
        } catch (\Exception $e) {
            return [
                'error' => $e->getMessage(),
            ];
        }

        return $response->dto()->data;
    }

    public function refreshData(): void
    {
        $this->data = $this->getData();
        $this->lastAttemptedAt = now()->toIso8601String();
    }

    public function render(): Renderable
    {
        return view('icinga-wire-dash::tiles.problem-services', [
            'data' => $this->data,
            'lastAttemptedAt' => $this->lastAttemptedAt ?? 'Never',
            'refreshIntervalInSeconds' => config('dashboard.tiles.skeleton.refresh_interval_in_seconds') ?? 10,
        ]);
    }
}
