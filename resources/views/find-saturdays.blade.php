<!-- resources/views/find-saturdays.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Find Second and Fourth Saturdays</h1>
    
    <!-- Input Date Form -->
    <form action="{{ url('/find-saturdays') }}" method="POST">
        @csrf

        <!-- Input Date -->
        <div class="form-group">
            <label for="input_date">Input Date (DD-MM-YYYY)</label>
            <input type="text" class="form-control date_picker @error('input_date') is-invalid @enderror" id="input_date" name="input_date" placeholder="Enter input date" value="{{ old('input_date') }}" required>

            <!-- Error message for input_date -->
            @error('input_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Find Saturdays</button>
    </form>
</div>
@endsection
