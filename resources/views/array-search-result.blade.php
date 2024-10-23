<!-- resources/views/array-search-result.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Array Search Result</h1>
    <p>Value Found: {{ $exists ? 'Yes' : 'No' }}</p>
</div>
@endsection
