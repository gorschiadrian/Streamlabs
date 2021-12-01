<div>
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th class="bold">
                    Game Name
                </th>
                <th>
                    No. of streams
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($allStreams as $stream)
                <tr>
                    <td>
                        {{$stream->game_name}}
                    </td>
                    <td>
                        {{$stream->game_streams}}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="mt-5">
        {{ $allStreams->onEachSide(1)->links() }}
    </div>
</div>
