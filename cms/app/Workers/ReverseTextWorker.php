<?php

namespace App\Workers;

use App\Models\ReverseText;

class ReverseTextWorker
 {
    /**
     * Text Reverser
     * @param  string $input Input - string
     * @return string      Reverse string
     */
    public static function reverseIt($input)
    {
        return strrev($input);
    }
}