<div>
    <div class="h-96 overflow-x-auto">
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th class="bold">
                        Channel name
                    </th>
                    <th>
                        No. of viewers
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($followed as $follow)
                    <tr>
                        <td>
                            {{ $follow->channel_name }}
                        </td>
                        <td>
                            {{ $follow->viewers }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
