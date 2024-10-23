<?php

// App/Http/Controllers/RandomNumbersController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RandomNumbersController extends Controller
{
    public function compareRows()
    {
        $randomNumbers = $this->generateRandomNumbers(20);
        $row1 = [1, 4, 7, 10, 13, 16, 19, 22, 25, 28, 31, 34];
        $row2 = [2, 5, 8, 11, 14, 17, 20, 23, 26, 29, 32, 35];
        $row3 = [3, 6, 9, 12, 15, 18, 21, 24, 27, 30, 33, 36];

        $matches = [
            'row1' => $this->countMatches($randomNumbers, $row1),
            'row2' => $this->countMatches($randomNumbers, $row2),
            'row3' => $this->countMatches($randomNumbers, $row3),
        ];

        // Determine which row has the most matches
        $maxRow = array_keys($matches, max($matches))[0];

        return view('random-numbers-result', compact('matches', 'maxRow', 'randomNumbers'));
    }

    private function generateRandomNumbers($count)
    {
        return array_map(function () {
            return rand(0, 36);
        }, range(1, $count));
    }

    private function countMatches($randomNumbers, $row)
    {
        return count(array_intersect($randomNumbers, $row));
    }
}
