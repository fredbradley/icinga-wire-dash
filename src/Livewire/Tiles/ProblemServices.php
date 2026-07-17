<?php

namespace FredBradley\IcingaWireDash\Livewire\Tiles;

use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemServices;
use Illuminate\Contracts\Support\Renderable;
use Livewire\Component;

class ProblemServices extends Component
{
    public string $position;

    public ?string $lastAttemptedAt = null;

    public function mount(string $position): void
    {
        $this->position = $position;
        $this->recordPollAttempt();
    }

    private function getData(): array
    {
        try {
            $response = (new GetProblemServices)->send();
        } catch (\Throwable $th) {
            return [
                'error' => $th->getMessage(),
            ];
        }

        return $response->dto()->data;
    }

    public function recordPollAttempt(): void
    {
        $this->lastAttemptedAt = now()->toIso8601String();
    }

    public function render(): Renderable
    {
        return view('icinga-wire-dash::tiles.problem-services', [
            'data' => $this->getData(),
            'lastAttemptedAt' => $this->lastAttemptedAt,
            'refreshIntervalInSeconds' => config('dashboard.tiles.skeleton.refresh_interval_in_seconds') ?? 10,
        ]);
    }
}
