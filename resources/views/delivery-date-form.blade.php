<!-- resources/views/delivery-date-form.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Project Delivery Date Calculator</h1>
    
    <!-- Delivery Date Form -->
    <form action="{{ url('/delivery-date') }}" method="POST">
        @csrf

        <!-- Start Date Input -->
        <div class="form-group">
            <label for="start_date">Start Date (DD-MM-YYYY)</label>
            <input type="text" class="form-control date_picker @error('start_date') is-invalid @enderror" id="start_date" name="start_date" placeholder="Enter start date" value="{{ old('start_date') }}" required>
            
            <!-- Error message for start_date -->
            @error('start_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Effort Days Input -->
        <div class="form-group">
            <label for="effort_days">Effort Days</label>
            <input type="number" class="form-control  @error('effort_days') is-invalid @enderror" id="effort_days" name="effort_days" placeholder="Enter effort days" value="{{ old('effort_days') }}" required>

            <!-- Error message for effort_days -->
            @error('effort_days')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-3">Calculate Delivery Date</button>
    </form>
</div>
@endsection


