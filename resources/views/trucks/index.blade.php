@extends('layouts.app')

@section('content')
    <h1>Truck List</h1>

    <table>
        <thead>
        <tr>
            <th>Unit Number</th>
            <th>Year</th>
            <th>Notes</th>
            <th>Subunit</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($trucks as $truck)
            <tr>
                <td>{{ $truck->unit_number }}</td>
                <td>{{ $truck->year }}</td>
                <td>{{ $truck->notes }}</td>
                <td>
                    @if($truck->subunits->isNotEmpty())
                        <ul>
                            @foreach($truck->subunits as $subunit)
                                <li>{{ $subunit->unit_number }} ({{ $subunit->pivot->start_date }} - {{ $subunit->pivot->end_date }})</li>
                            @endforeach
                        </ul>
                    @else
                        No subunits
                    @endif
                </td>
                <td>
                    <a href="{{ route('trucks.show', $truck->id) }}">View</a>
                    <a href="{{ route('trucks.edit', $truck->id) }}">Edit</a>
                    <a href="{{ route('trucks.createSubunit', $truck->id) }}">Assign Subunit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('trucks.create') }}">Add New Truck</a>
@endsection
