<?php

namespace FredBradley\IcingaWireDash\Saloon\DataTransferObjects;

use Illuminate\Support\Collection;
use Saloon\Contracts\Response;

class Host
{
    public function __construct(public Collection $data)
    {
        $this->data = $data->mapInto(\FredBradley\IcingaWireDash\Maps\Host::class);
    }

    public static function fromResponse(Response $response): self
    {
        $data = $response->json()['results'];

        return new static(collect($data));
    }
}
