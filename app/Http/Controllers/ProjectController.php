<?php

// App/Http/Controllers/ProjectController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

class ProjectController extends Controller
{
    public function projectdate()
    {
        return view('delivery-date-form');
    }

    public function calculateDeliveryDate(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date_format:d-m-Y',
            'effort_days' => 'required|integer|min:1',
        ], [
            'start_date.required' => 'The start date field is required.',
            'start_date.date_format' => 'The start date must be in the format DD-MM-YYYY.',
            'effort_days.required' => 'The effort days field is required.',
            'effort_days.integer' => 'The effort days must be a valid number.',
            'effort_days.min' => 'Effort days must be at least 1 day.',
        ]);

        // Parse start date from form
        $startDate = Carbon::createFromFormat('d-m-Y', $request->start_date);
        $effortDays = $request->effort_days;

        // Calculate delivery date
        $deliveryDate = $this->calculateWorkDays($startDate, $effortDays);

        // Return result to view
        return view('delivery-date', compact('deliveryDate'));
    }

    private function calculateWorkDays($startDate, $days)
    {
        while ($days > 0) {
            $startDate->addDay();

            // Check if the day is not a weekend or holiday
            if (!$this->isWeekendOrHoliday($startDate)) {
                $days--;
            }
        }

        return $startDate->format('d-M-Y');
    }

    private function isWeekendOrHoliday($date)
    {
        $dayOfWeek = $date->format('N'); // N = 1 (Monday) to 7 (Sunday)

        // Exclude Sundays and first/third Saturdays
        if ($dayOfWeek == 7 || ($dayOfWeek == 6 && ($date->weekOfMonth == 1 || $date->weekOfMonth == 3))) {
            return true;
        }

        return false;
    }
}
