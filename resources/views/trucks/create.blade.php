@extends('layouts.app')

@section('title', isset($truck) ? 'Edit Truck' : 'Add Truck')

@section('content')
    <div class="container">
        <h1>{{ isset($truck) ? 'Edit Truck' : 'Add Truck' }}</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ isset($truck) ? route('trucks.update', $truck->id) : route('trucks.store') }}" method="POST">
            @csrf
            @if(isset($truck))
                @method('PUT')
            @endif

            <div class="form-group">
                <label for="unit_number">Unit Number</label>
                <input type="text" class="form-control" id="unit_number" name="unit_number"
                       value="{{ old('unit_number', isset($truck) ? $truck->unit_number : '') }}"
                       required maxlength="255">
            </div>

            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" class="form-control" id="year" name="year"
                       value="{{ old('year', isset($truck) ? $truck->year : '') }}"
                       required min="1900" max="{{ date('Y') + 5 }}">
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control" id="notes" name="notes"
                          rows="3">{{ old('notes', isset($truck) ? $truck->notes : '') }}</textarea>
            </div>

            <button type="submit" class="btn btn-primary">{{ isset($truck) ? 'Update Truck' : 'Add Truck' }}</button>
            <a href="{{ route('trucks.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
