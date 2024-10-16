@extends('layouts.app')

@section('content')
    <h1>Truck List</h1>

    <table>
        <thead>
        <tr>
            <th>Unit Number</th>
            <th>Year</th>
            <th>Notes</th>
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
                    <a href="{{ route('trucks.show', $truck->id) }}">View</a>
                    <a href="{{ route('trucks.edit', $truck->id) }}">Edit</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <a href="{{ route('trucks.create') }}">Add New Truck</a>
@endsection
