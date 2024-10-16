@extends('layouts.app')

@section('title', 'Edit Truck')

@section('content')
    <div class="container">
        <h1>Edit Truck</h1>

        <form action="{{ route('trucks.update', $truck->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="unit_number">Unit Number</label>
                <input type="text" class="form-control @error('unit_number') is-invalid @enderror" id="unit_number" name="unit_number" value="{{ old('unit_number', $truck->unit_number) }}" required>
                @error('unit_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="year">Year</label>
                <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year', $truck->year) }}" required min="1900" max="{{ date('Y') + 5 }}">
                @error('year')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="notes">Notes</label>
                <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes', $truck->notes) }}</textarea>
                @error('notes')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Truck</button>
            <a href="{{ route('trucks.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
@endsection
