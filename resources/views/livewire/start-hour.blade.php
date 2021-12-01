<div>
    <div class="h-96 overflow-x-auto">
        <table class="table table-hover mt-5">
            <thead>
                <tr>
                    <th class="bold">
                        Start Hour
                    </th>
                    <th>
                        No. of streams
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach ($hours as $hour=>$streams)
                    <tr>
                        <td>
                            {{$hour}}
                        </td>
                        <td>
                            {{ count($streams) }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
