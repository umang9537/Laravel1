@extends('layouts.app')

@section('content')

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item"><a class="nav-link" href="{{ route('highestMarks') }}">Highest Marks</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('passedSubjects') }}">Passed Subjects</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('topStudents') }}">Top Students</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('passedMathsScience') }}">Passed in Maths & Science</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('failedEnglishHindi') }}">Failed in English & Hindi</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('mixedPassFail') }}">Mixed Pass/Fail</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('studentGrades') }}">Student Grades</a></li>
            </ul>
        </div>
    </div>
</nav>

    <h1>Highest Marks - Class Wise</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Class Name</th>
                <th>Subject Name</th>
                <th>Highest Marks</th>
            </tr>
        </thead>
        <tbody>
            @foreach($marks as $mark)
                <tr>
                    <td>{{ $mark->class_name }}</td>
                    <td>{{ $mark->subject_name }}</td>
                    <td>{{ $mark->highest_marks }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
