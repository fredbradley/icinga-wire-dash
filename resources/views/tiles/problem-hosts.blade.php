<x-dashboard-tile :position="$position">
    <div class="grid grid-rows-auto-1 gap-2 h-full">
        <div
            class="flex items-center justify-center rounded-full"
            style="background-color: rgba(255, 255, 255, .9)"
        >
            <div class="text-3xl leading-none -mt-1">
                {{ $title ?? 'Problem Hosts' }}
            </div>
        </div>
        <div wire:poll.{{ $refreshIntervalInSeconds }}s class="divide-y-2">
            <table class="table">
                <thead>
                <tr>
                    <th></th>
                    <th>Host</th>
                    <th>Problem</th>
                    <th>Status</th>
                </tr>
                </thead>
                <tbody>
                @foreach(collect($data)->sortByDesc('last_check_ok') as $host)
                    <tr class="{{ FredBradley\IcingaWireDash\Enums\IcingaState::fromApi($host->attrs['last_check_result']['state'])->cssClass() }}">

                        <td class="text-center">
                            <i class="fi fi-rr-{{ \FredBradley\IcingaWireDash\Enums\HostIcon::iconFromGroups($host->groups) }}"></i>
                        </td>
                        <td>
                            {{ $host->name }}
                        </td>
                        <td>{{ $host->last_check_ok->diffForHumans(now(), \Carbon\CarbonInterface::DIFF_ABSOLUTE) }}</td>
                        @if ($host->handled)
                            <td class="text-center">
                                @if ($host->downtime_depth)
                                    <i class="fi fi-rr-pause"></i>
                                    <i class="fi fi-rr-calendar-clock"></i>
                                @endif
                                @if ($host->acknowledgement)
                                    <i class="fi fi-rr-hexagon-check"></i> {{ $host->acknowledgement_expiry->diffForHumans() }}
                                @endif
                            </td>
                        @else
                            <td><i class="fi fi-rr-{{ \FredBradley\IcingaWireDash\Enums\IcingaState::fromApi($host->attrs['last_check_result']['state'])->asIcon() }}"></i></td>
                        @endif

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-tile>
