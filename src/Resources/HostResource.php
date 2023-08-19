<?php

namespace FredBradley\IcingaWireDash\Resources;

use FredBradley\IcingaWireDash\Maps\Host;
use Illuminate\Http\Resources\Json\JsonResource;

class HostResource extends JsonResource
{
    public function toArray($request)
    {
        return [new Host($this)];
    }
}
