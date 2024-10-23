<?php

// App/Http/Controllers/DateController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class DateController extends Controller
{
    public function findsaturdays()
    {
        return view('find-saturdays');
    }

    public function findSecondFourthSaturdays(Request $request)
    {
        // Validate the input date
        $request->validate([
            'input_date' => 'required|date_format:d-m-Y',
        ], [
            'input_date.required' => 'The input date field is required.',
            'input_date.date_format' => 'The input date must be in the format DD-MM-YYYY.',
        ]);

        // Logic for calculating second and fourth Saturdays
        $startDate = Carbon::createFromFormat('d-m-Y', $request->input_date)->startOfMonth();
        $cycleStart = Carbon::create($startDate->year, 10, 1); // Start of October
        $cycleEnd = Carbon::create($startDate->year + 1, 9, 30); // End of September next year

        $saturdays = $this->getSecondAndFourthSaturdays($cycleStart, $cycleEnd);

        return view('saturdays-result', compact('saturdays'));
    }


    private function getSecondAndFourthSaturdays($start, $end)
    {
        $saturdays = [];

        for ($date = $start; $date->lessThanOrEqualTo($end); $date->addDay()) {
            if ($date->isSaturday()) {
                $month = $date->format('F Y'); // Get month in "Month Year" format
                $weekOfMonth = $date->weekOfMonth;

                if ($weekOfMonth == 2) {
                    $saturdays[$month]['second'] = $date->format('d-M-Y');
                } elseif ($weekOfMonth == 4) {
                    $saturdays[$month]['fourth'] = $date->format('d-M-Y');
                }
            }
        }

        return $saturdays;
    }
}
