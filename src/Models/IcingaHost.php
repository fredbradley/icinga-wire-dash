<?php

namespace FredBradley\IcingaWireDash\Models;

use FredBradley\IcingaWireDash\Saloon\IcingaConnector;
use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemHosts;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
        $connector = new IcingaConnector;

        $request = new GetProblemHosts;
        $response = $connector->send($request);
        $results = $response->dto()->data;
        $output = [];
        foreach ($results as $result) {
            $output[] = [
                'name' => $result->name,
                'type' => $result->type,
                'attrs' => json_encode($result->attrs),
            ];
        }

        return $output;
    }

    protected $fillable = [
        'name',
        'type',
        'attrs',
    ];

    protected $casts = [
        'attrs' => 'array',
    ];

    protected $hidden = [
        'attrs',
    ];

    protected $appends = [
        'test',
        'ip_address',
    ];

    public function services(): HasMany
    {
        return $this->hasMany(IcingaService::class, 'host_name', 'name');
    }

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
