@extends('layouts.app')

@section('title', 'Truck Details')

@section('content')
    <div class="container">
        <h1>Truck Details</h1>

        <div class="card">
            <div class="card-header">
                Truck #{{ $truck->unit_number }}
            </div>
            <div class="card-body">
                <h5 class="card-title">Unit Number: {{ $truck->unit_number }}</h5>
                <p class="card-text"><strong>Year:</strong> {{ $truck->year }}</p>
                <p class="card-text"><strong>Notes:</strong> {{ $truck->notes ?? 'No additional notes' }}</p>

                <!-- Subunits -->
                @if($truck->subunits->isNotEmpty())
                    <h6>Subunits:</h6>
                    <ul class="list-group">
                        @foreach($truck->subunits as $subunit)
                            <li class="list-group-item">
                                <strong>Subunit:</strong> {{ $subunit->subunit->unit_number }}
                                <br>
                                <strong>Start Date:</strong> {{ $subunit->start_date->format('Y-m-d') }}
                                <br>
                                <strong>End Date:</strong> {{ $subunit->end_date->format('Y-m-d') }}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>This truck has no assigned subunits.</p>
                @endif

                <div class="mt-3">
                    <a href="{{ route('trucks.edit', $truck->id) }}" class="btn btn-warning">Edit Truck</a>

                    <form action="{{ route('trucks.destroy', $truck->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this truck?');">Delete Truck</button>
                    </form>

                    <a href="{{ route('trucks.index') }}" class="btn btn-secondary">Back to Trucks List</a>
                </div>
            </div>
        </div>
    </div>
@endsection
