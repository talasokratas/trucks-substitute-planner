@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Welcome to Truck Substitute Planner</h1>
        <p>This application allows you to manage trucks and their subunits effectively.</p>

        <h2>Navigation</h2>
        <ul>
            <li><a href="{{ route('trucks.index') }}">View Trucks</a></li>
            <li><a href="{{ route('subunits.index') }}">View Subunits</a></li>
        </ul>
    </div>
@endsection
