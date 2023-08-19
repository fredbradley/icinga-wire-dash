<?php

namespace FredBradley\IcingaWireDash\Models;

use FredBradley\IcingaWireDash\Saloon\IcingaConnector;
use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemHosts;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Sushi\Sushi;

class IcingaHost extends Model
{
    use Sushi;

    public $timestamps = false;

    /**
     * @throws \ReflectionException
     * @throws InvalidResponseClassException
     * @throws PendingRequestException
     */
    public function getRows(): array
    {
        $connector = new IcingaConnector(
            config('icinga-wire-dash.username'),
            config('icinga-wire-dash.password')
        );

        $request = new GetProblemHosts();
        $response = $connector->send($request);

        return collect($response->collect()['results'])->map(function ($item) {
            return [
                'name' => $item['name'],
                'type' => $item['type'],
                'attrs' => json_encode($item['attrs']),
            ];
        })->toArray();

    }

    protected $fillable = [
        'name',
        'type',
        'attrs',
    ];

    protected $casts = [
        'attrs' => 'json',
    ];
    protected $primaryKey = 'name';
    protected $appends = [
        'test',
        'ip_address'
    ];

    protected function ipAddress(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->attrs['address'];
            }
        );
    }

    protected function getTestAttribute(): string
    {
        return 'I am a test';
    }
}
