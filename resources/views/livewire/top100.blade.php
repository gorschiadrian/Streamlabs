<div>
    <div class="h-96 overflow-x-auto">
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th class="bold">
                        Stream
                    </th>
                    <th>
                        Viewers
                        @if ($order == 'DESC')
                            <button type="button" wire:click="sort('ASC')" class="btn btn-primary">
                                ASC
                            </button>
                        @else
                            <button type="button" wire:click="sort('DESC')" class="btn btn-primary">
                                DESC
                            </button>
                        @endif
                        
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($top100 as $stream)
                    <tr>
                        <td>
                            {{ $stream->stream_title }} </br>
                            {{ $stream->channel_name }} </br>
                            {{ $stream->game_name }} </br>
                        </td>
                        <td>
                            {{ $stream->viewers }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
