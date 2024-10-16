@extends('layouts.app')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">Assign Subunit to Truck: <strong>{{ $mainTruck->unit_number }}</strong></h1>

        <form id="assignSubunitForm" class="border p-4 rounded shadow">
            @csrf

            <input type="hidden" name="main_truck" value="{{ $mainTruck->id }}">

            <!-- Error Message -->
            <div id="error-message" class="text-danger" style="display: none;"></div>

            <div class="mb-3">
                <label for="subunit" class="form-label">Subunit Truck:</label>
                <select name="subunit" id="subunit" class="form-select" required>
                    <option value="" disabled selected>Select a subunit truck</option>
                    @foreach($subunits as $truck)
                        <option value="{{ $truck->id }}">{{ $truck->unit_number }}</option>
                    @endforeach
                </select>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="start_date" class="form-label">Start Date:</label>
                    <input type="date" name="start_date" id="start_date" class="form-control" required>
                </div>
                <div class="col-md-6">
                    <label for="end_date" class="form-label">End Date:</label>
                    <input type="date" name="end_date" id="end_date" class="form-control" required>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Assign Subunit</button>
        </form>

        <a href="{{ route('trucks.index') }}" class="btn btn-secondary mt-3">Back to Truck List</a>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#assignSubunitForm').on('submit', function(e) {
                e.preventDefault(); // Prevent the form from submitting normally

                // Clear previous error messages
                $('#error-message').hide().html('');

                $.ajax({
                    url: "{{ route('trucks.assignSubunit', $mainTruck->id) }}", // URL for your assignSubunit route
                    type: "POST",
                    data: $(this).serialize(),
                    success: function(response) {
                        // On success, redirect to the trucks index page
                        window.location.href = "{{ route('trucks.index') }}";
                    },
                    error: function(xhr) {
                        // On error, display the message in the error-message div
                        var errors = xhr.responseJSON.errors;
                        var errorMessage = "";
                        for (var key in errors) {
                            errorMessage += errors[key] + "<br>"; // Get the first error message
                        }
                        $('#error-message').html(errorMessage).show(); // Show the error messages
                    }
                });
            });
        });
    </script>
@endsection
