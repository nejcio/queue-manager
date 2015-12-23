<?php

namespace App\Workers;

class ReverseTextWorker extends Worker
{
    /**
     * Text Reverser
     * @param  string $input Input - string
     * @return string      Reverse string
     */
    public function reverseIt($input)
    {
        return strrev($input);
    }
}