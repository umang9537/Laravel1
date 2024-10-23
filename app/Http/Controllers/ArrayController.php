<?php

// App/Http/Controllers/ArrayController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArrayController extends Controller
{
    public function searchArray()
    {
        $array = [
            ['id' => 5, 'language' => 'PHP'],
            ['id' => 6, 'language' => 'JAVA'],
            ['id' => 7, 'language' => 'PYTHON']
        ];

        $exists = $this->searchValue($array, 'JAVA', 'language');

        return view('array-search-result', compact('exists'));
    }

    private function searchValue($array, $value, $key)
    {
        return collect($array)->pluck($key)->contains($value);
    }
}
