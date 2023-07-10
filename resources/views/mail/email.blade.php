<h1>Sikeres foglalás!</h1>

<table>
    <thead>
        <tr>
            <th>Terem szám</th>
            <th>Szék szám</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($seats as $seat)
            <tr>
                <td>{{ $seat->room_id }}</td>
                <td>{{ $seat->id }}</td>
            </tr>
        @endforeach
    </tbody>
</table>