<x-dashboard-tile :position="$position">
    <div class="grid grid-rows-auto-1 gap-2 h-full">
        <div
            class="flex items-center justify-center rounded-full"
            style="background-color: rgba(255, 255, 255, .9)"
        >
            <div class="text-3xl leading-none -mt-1">
                Problem Hosts
            </div>
        </div>
        <div wire:poll.{{ $refreshIntervalInSeconds }}s class="self-center | divide-y-2">
            {{-- tile content --}}
            <table class="table">
                <thead>
                <tr>
                    <th>Host</th>
                    <th>Problem</th>
                    <th>Duration</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($data as $host)
                    <tr>
                        <td>{{ $host->name }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-dashboard-tile>
