<!-- resources/views/random-numbers-result.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Random Numbers Result</h1>
    <p>Random Numbers: {{ implode(', ', $randomNumbers) }}</p>
    <p>Row 1 Matches: {{ $matches['row1'] }}</p>
    <p>Row 2 Matches: {{ $matches['row2'] }}</p>
    <p>Row 3 Matches: {{ $matches['row3'] }}</p>
    <p>Row with the most matches: {{ $maxRow }}</p>
</div>
@endsection
