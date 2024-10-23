<?php

// App/Http/Controllers/SequenceController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SequenceController extends Controller
{
    public function findNextInSequence()
    {
        $sequence1 = $this->sequenceOneNext(25, 49, 97); // Calculate next in Sequence 1
        $sequence2 = $this->sequenceTwoNext([45, 97, 177, 291]); // Calculate next in Sequence 2

        return view('sequence-result', compact('sequence1', 'sequence2'));
    }

    // Calculate Sequence 1
    private function sequenceOneNext($a, $b, $c)
    {
        $difference = ($c - $b) * 2; // Difference is doubling
        return $c + $difference; // Find next number
    }

    // Calculate Sequence 2
    private function sequenceTwoNext($sequence)
    {
        $lastDiff = $sequence[3] - $sequence[2]; // Difference between last two numbers
        $newDiff = $lastDiff + 120; // It seems to increase by 120
        return $sequence[3] + $newDiff;
    }
}
