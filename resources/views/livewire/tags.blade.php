<div>
    <p>The following tags are in common:</p>
    
    <table class="table table-hover mt-5">
        <thead>
            <tr>
                <th class="bold">
                    Tag name
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tagList->unique('tag_id') as $tag)
                <tr>
                    <td>
                        {{ $tag->tag_name }}
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
