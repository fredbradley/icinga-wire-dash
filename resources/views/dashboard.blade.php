<div>
    <div class="row">
        <div class="col-6">
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Host</th>
            <th>Time</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody wire:poll.visible.10s>

        @foreach($hosts as $host)
            <tr class="{{ FredBradley\IcingaWireDash\Enums\IcingaState::fromApi($host->attrs['last_check_result']['state'])->cssClass() }}">

                <td>{{ $host->name }}</td>
                <td>{{ $host->last_check_ok->diffForHumans() }}</td>
                <td>{{ \FredBradley\IcingaWireDash\Enums\IcingaState::fromApi($host->attrs['last_check_result']['state'])->asText() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
        </div>
    <div class="col-6">

    <table class="table table-striped">
        <thead>
        <th>Host</th>
        <th>Result</th>
        <th>Last OK</th>
        </thead>
        <tbody wire:poll.visible.10s>

        @foreach(collect($services)->sortByDesc('last_check_ok') as $service)
            <tr class="{{ FredBradley\IcingaWireDash\Enums\IcingaState::fromApi($service->attrs['last_check_result']['state'])->cssClass() }}">
                <td>{{ $service->host_name }}</td>
                <td>{{ $service->last_check_result['output'] }}</td>
                <td>{{ $service->last_state_ok->diffForHumans() }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    </div>
    </div>
</div>
