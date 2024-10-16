@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Truck List</h1>

        <table class="table table-striped">
            <thead class="thead-light">
            <tr>
                <th>Unit Number</th>
                <th>Year</th>
                <th>Notes</th>
                <th>Subunits</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($trucks as $truck)
                <tr>
                    <td>{{ $truck->unit_number }}</td>
                    <td>{{ $truck->year }}</td>
                    <td>{{ $truck->notes ?? 'No notes available' }}</td>
                    <td>
                        @if($truck->subunits->isNotEmpty())
                            <ul>
                                @foreach($truck->subunits as $subunit)
                                    <li>
                                        {{ $subunit->unit_number }}
                                        <br> From ({{ $subunit->pivot->start_date ?? 'N/A' }} To {{ $subunit->pivot->end_date ?? 'N/A' }})
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            No subunits
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('trucks.show', $truck->id) }}" class="btn btn-info btn-sm mt-2 mb-2">View</a>
                        <a href="{{ route('trucks.edit', $truck->id) }}" class="btn btn-warning btn-sm  mt-2 mb-2">Edit</a>
                        <a href="{{ route('trucks.createSubunit', $truck->id) }}" class="btn btn-primary btn-sm  mt-2 mb-2">Assign Subunit</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>

        <a href="{{ route('trucks.create') }}" class="btn btn-success">Add New Truck</a>
    </div>
@endsection
