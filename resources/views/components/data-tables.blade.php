@props(['tableId', 'columns'])

<table id="{{ $tableId }}" class="datatables-users table border-top">
    <thead>
    <tr class="text-nowrap">
        @foreach($columns as $column)
            <th>{{ $column['title'] }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    </tbody>
</table>
