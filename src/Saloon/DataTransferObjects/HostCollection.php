<?php

namespace FredBradley\IcingaWireDash\Saloon\DataTransferObjects;

use Illuminate\Support\Collection;
use Saloon\Contracts\Response;

class HostCollection
{
    public array $data;
    public function __construct(Collection $dataIn)
    {
        $this->data = $dataIn->mapInto(\FredBradley\IcingaWireDash\Maps\Host::class)->toArray();
    }

    public static function fromResponse(Response $response): self
    {
        $data = $response->json()['results'];

        return new static(collect($data));
    }
}
