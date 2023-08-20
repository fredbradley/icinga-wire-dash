<?php

namespace FredBradley\IcingaWireDash\Models;

use FredBradley\IcingaWireDash\Saloon\IcingaConnector;
use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemHosts;
use FredBradley\IcingaWireDash\Saloon\Requests\GetProblemServices;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Saloon\Exceptions\InvalidResponseClassException;
use Saloon\Exceptions\PendingRequestException;
use Sushi\Sushi;

class IcingaService extends Model
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

        $request = new GetProblemServices();
        $response = $connector->send($request);
        $results = $response->dto()->data;
        $output = [];
        foreach ($results as $result) {
            $output[] = [
                'name' => $result->name,
                'type' => $result->type,
                'host_name' => $result->host_name,
                'attrs' => json_encode($result->attrs)
            ];
        }
        return $output;
    }

    protected $fillable = [
        'name',
        'host_name',
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
        'host_name'
    ];


    protected function hostName(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                return $this->attrs['host_name'];
            }
        );
    }
    public function host(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(IcingaHost::class, 'host_name', 'name');
    }

    protected function getTestAttribute(): string
    {
        return 'I am a test';
    }
}
