<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SequenceController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\ArrayController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\RandomNumbersController;
use App\Http\Controllers\StudentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [SequenceController::class, 'findNextInSequence']);
Route::get('/project-date', [ProjectController::class, 'projectdate']);
Route::post('/delivery-date', [ProjectController::class, 'calculateDeliveryDate']);
Route::get('/array-search', [ArrayController::class, 'searchArray']);
Route::get('/find-second-fourth-saturday', [DateController::class, 'findsaturdays']);
Route::post('/find-saturdays', [DateController::class, 'findSecondFourthSaturdays']);
Route::get('/random-numbers', [RandomNumbersController::class, 'compareRows']);


Route::get('/highest-marks', [StudentController::class, 'highestMarks'])->name('highestMarks');
Route::get('/passed-subjects', [StudentController::class, 'passedSubjects'])->name('passedSubjects');
Route::get('/top-students', [StudentController::class, 'topStudents'])->name('topStudents');
Route::get('/passed-maths-science', [StudentController::class, 'passedMathsScience'])->name('passedMathsScience');
Route::get('/failed-english-hindi', [StudentController::class, 'failedEnglishHindi'])->name('failedEnglishHindi');
Route::get('/mixed-pass-fail', [StudentController::class, 'mixedPassFail'])->name('mixedPassFail');
Route::get('/student-grades', [StudentController::class, 'studentGrades'])->name('studentGrades');
