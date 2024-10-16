@extends('layouts.app')

@section('content')
    <h1>Assign Subunit to Truck: {{ $mainTruck->unit_number }}</h1>

    <form id="assignSubunitForm">
        @csrf

        <input type="hidden" name="main_truck" value="{{ $mainTruck->id }}">

        <!-- Error Message -->
        <div id="error-message" style="color: red; display: none;"></div>

        <div>
            <label for="subunit">Subunit Truck:</label>
            <select name="subunit" id="subunit" required>
                <option value="" disabled selected>Select a subunit truck</option>
                @foreach($subunits as $truck)
                    <option value="{{ $truck->id }}">{{ $truck->unit_number }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" required>
        </div>

        <div>
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" required>
        </div>

        <button type="submit">Assign Subunit</button>
    </form>

    <a href="{{ route('trucks.index') }}">Back to Truck List</a>

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
                            errorMessage += errors[key][0] + "<br>"; // Get the first error message
                        }
                        $('#error-message').html(errorMessage).show(); // Show the error messages
                    }
                });
            });
        });
    </script>
@endsection
