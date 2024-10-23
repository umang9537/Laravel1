<!-- resources/views/saturdays-result.blade.php -->
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Second and Fourth Saturdays</h1>
    
    @if(!empty($saturdays))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Month</th>
                    <th>Second Saturday</th>
                    <th>Fourth Saturday</th>
                </tr>
            </thead>
            <tbody>
                @foreach($saturdays as $month => $saturdayDates)
                    <tr>
                        <td>{{ $month }}</td>
                        <td>{{ $saturdayDates['second'] ?? 'N/A' }}</td> <!-- Display 'N/A' if no second Saturday -->
                        <td>{{ $saturdayDates['fourth'] ?? 'N/A' }}</td> <!-- Display 'N/A' if no fourth Saturday -->
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>No Saturdays found for the given date range.</p>
    @endif
</div>
@endsection
