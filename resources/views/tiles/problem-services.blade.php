<x-dashboard-tile :position="$position">
    <div class="grid grid-rows-auto-1 gap-2 h-full">
        <div
            class="flex items-center justify-center rounded-full"
            style="background-color: rgba(255, 255, 255, .9)"
        >
            <div class="text-3xl leading-none -mt-1">
                Problem Services
            </div>
        </div>
        <div wire:poll.{{ $refreshIntervalInSeconds }}s class="divide-y-2">
            {{-- tile content --}}
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Host</th>
                    <th>Problem</th>
                    <th>Duration</th>
                </tr>
                </thead>
                <tbody>
                @foreach(collect($data)->sortByDesc('last_check_ok') as $service)
                    <tr class="{{ FredBradley\IcingaWireDash\Enums\IcingaState::fromApi($service->attrs['last_check_result']['state'])->cssClass() }}">
                        <td class="text-center">
                            <i class="fi fi-rr-{{ \FredBradley\IcingaWireDash\Enums\HostIcon::iconFromGroups($service->hostGroups) }}"></i>
                        </td>
                        <td>{{ $service->host_name }}</td>
                        <td>{{ $service->last_check_result['output'] }}</td>
                        <td>{{ $service->last_state_ok->diffForHumans() }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-tile>
