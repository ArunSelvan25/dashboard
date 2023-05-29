<table class="table @foreach($tableStyles as $tableStyle){{ $tableStyle }} @endforeach">
    <thead>
        <tr>
            @foreach($columns[$i] as $column)
                <th>{{ ucfirst($column) }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach($modelDatas[$i] as $modelData)
        <tr> 
            @foreach($columns[$i] as $column)
                <td>{{ $modelData->$column }}</td>
            @endforeach
        </tr>
        @endforeach
    </tbody>
</table>