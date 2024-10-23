<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class StudentController extends Controller
{

    public function highestMarks()
    {
        $highestMarksClassWise = DB::table('marks_master')
            ->select('class_master.class_name', 'subject_master.subject_name', DB::raw('MAX(marks_master.marks) as highest_marks'))
            ->join('student_master', 'marks_master.student_id', '=', 'student_master.id')
            ->join('class_master', 'student_master.class_id', '=', 'class_master.id')
            ->join('subject_master', 'marks_master.subject_id', '=', 'subject_master.id')
            ->groupBy('class_master.class_name', 'subject_master.subject_name')
            ->get();

        return view('student.highest-marks', ['marks' => $highestMarksClassWise]);
    }

    public function passedSubjects()
    {
        $passedCount = DB::table('marks_master')
            ->select('student_master.student_name', 'class_master.class_name', 'section_master.section_name', 'city_master.city_name', DB::raw('COUNT(CASE WHEN marks_master.marks >= 35 THEN 1 END) as passed_subjects'))
            ->join('student_master', 'marks_master.student_id', '=', 'student_master.id')
            ->join('class_master', 'student_master.class_id', '=', 'class_master.id')
            ->join('section_master', 'student_master.section_id', '=', 'section_master.id')
            ->join('city_master', 'student_master.city_id', '=', 'city_master.id')
            ->groupBy('student_master.student_name', 'class_master.class_name', 'section_master.section_name', 'city_master.city_name')
            ->get();

        return view('student.passed-subjects', ['students' => $passedCount]);
    }

    public function topStudents()
    {
        $topStudents = DB::table('marks_master')
            ->select('student_master.student_name', 'city_master.city_name', 'subject_master.subject_name', 'marks_master.marks')
            ->join('student_master', 'marks_master.student_id', '=', 'student_master.id')
            ->join('city_master', 'student_master.city_id', '=', 'city_master.id')
            ->join('subject_master', 'marks_master.subject_id', '=', 'subject_master.id')
            ->joinSub(function ($query) {
                $query->select('student_id', 'subject_id', DB::raw('MAX(marks) as highest_marks'))
                    ->from('marks_master')
                    ->groupBy('student_id', 'subject_id');
            }, 'highest_marks', function ($join) {
                $join->on('marks_master.student_id', '=', 'highest_marks.student_id')
                    ->on('marks_master.subject_id', '=', 'highest_marks.subject_id')
                    ->on('marks_master.marks', '=', 'highest_marks.highest_marks');
            })
            ->get();

        return view('student.top-students', ['students' => $topStudents]);
    }

    public function passedMathsScience()
    {
        $students = DB::table('marks_master')
            ->select('student_master.student_name', 'class_master.class_name', 'section_master.section_name', 'city_master.city_name')
            ->join('student_master', 'marks_master.student_id', '=', 'student_master.id')
            ->join('class_master', 'student_master.class_id', '=', 'class_master.id')
            ->join('section_master', 'student_master.section_id', '=', 'section_master.id')
            ->join('city_master', 'student_master.city_id', '=', 'city_master.id')
            ->whereIn('marks_master.subject_id', [1, 2]) // Maths and Science
            ->where('marks_master.marks', '>=', 35)
            ->whereIn('student_master.class_id', [1, 2]) // Class 1st and 2nd
            ->groupBy('student_master.student_name', 'class_master.class_name', 'section_master.section_name', 'city_master.city_name')
            ->get();

        return view('student.passed-maths-science', ['students' => $students]);
    }

    public function failedEnglishHindi()
    {
        $students = DB::table('marks_master')
            ->select('student_master.student_name', 'class_master.class_name', 'section_master.section_name', 'city_master.city_name')
            ->join('student_master', 'marks_master.student_id', '=', 'student_master.id')
            ->join('class_master', 'student_master.class_id', '=', 'class_master.id')
            ->join('section_master', 'student_master.section_id', '=', 'section_master.id')
            ->join('city_master', 'student_master.city_id', '=', 'city_master.id')
            ->whereIn('marks_master.subject_id', [1, 2]) // English and Hindi
            ->where('marks_master.marks', '<', 35)
            ->whereIn('student_master.class_id', [3, 4]) // Class 3rd and 4th
            ->groupBy('student_master.student_name', 'class_master.class_name', 'section_master.section_name', 'city_master.city_name')
            ->get();

        return view('student.failed-english-hindi', ['students' => $students]);
    }

    public function mixedPassFail()
    {
        $students = DB::table('marks_master')
            ->select('student_master.student_name', 'class_master.class_name', 'section_master.section_name', 'city_master.city_name')
            ->join('student_master', 'marks_master.student_id', '=', 'student_master.id')
            ->join('class_master', 'student_master.class_id', '=', 'class_master.id')
            ->join('section_master', 'student_master.section_id', '=', 'section_master.id')
            ->join('city_master', 'student_master.city_id', '=', 'city_master.id')
            ->where('marks_master.subject_id', 1) // Maths
            ->where('marks_master.marks', '>=', 35)
            ->orWhere(function ($query) {
                $query->where('marks_master.subject_id', 4) // Hindi
                    ->where('marks_master.marks', '>=', 35);
            })
            ->where('marks_master.subject_id', 3) // Science
            ->where('marks_master.marks', '<', 35)
            ->groupBy('student_master.student_name', 'class_master.class_name', 'section_master.section_name', 'city_master.city_name')
            ->get();

        return view('student.mixed-pass-fail', ['students' => $students]);
    }

    public function studentGrades()
    {
        $students = DB::table('marks_master')
            ->select('student_master.student_name', 'class_master.class_name', 'section_master.section_name', 'city_master.city_name', DB::raw('AVG(marks_master.marks) as average_marks'))
            ->join('student_master', 'marks_master.student_id', '=', 'student_master.id')
            ->join('class_master', 'student_master.class_id', '=', 'class_master.id')
            ->join('section_master', 'student_master.section_id', '=', 'section_master.id')
            ->join('city_master', 'student_master.city_id', '=', 'city_master.id')
            ->groupBy('student_master.student_name', 'class_master.class_name', 'section_master.section_name', 'city_master.city_name')
            ->get();

        return view('student.student-grades', ['students' => $students]);
    }
}
