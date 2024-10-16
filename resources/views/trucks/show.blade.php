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
                @if($truck->subunits->isNotEmpty())
                    <h6>Subunits:</h6>
                    <ul class="list-group">
                        @foreach($truck->subunits as $subunit)
                            <li class="list-group-item">
                                <strong>Subunit:</strong> {{ $subunit->unit_number}}
                                <br>
                                <strong>Start Date:</strong> {{ $subunit->pivot->start_date}}
                                <br>
                                <strong>End Date:</strong> {{ $subunit->pivot->end_date}}
                            </li>
                        @endforeach
                    </ul>
               @else
                    <p>This truck has no assigned subunits.</p>
                @endif

                @if($truck->mainTrucks->isNotEmpty())
                    <h6>Truck Assigned To:</h6>
                    <ul class="list-group">
                        @foreach($truck->mainTrucks as $mainTruck)
                            <li class="list-group-item">
                                <strong>Main truck:</strong> {{ $mainTruck->unit_number }}
                                <br>
                                <strong>Start Date:</strong> {{ $mainTruck->pivot->start_date}}
                                <br>
                                <strong>End Date:</strong> {{ $mainTruck->pivot->end_date}}
                            </li>
                        @endforeach
                    </ul>
                @else
                    <p>This truck is not assigned as subunit</p>
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
