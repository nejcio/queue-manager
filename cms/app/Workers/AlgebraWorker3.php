<?php

namespace App\Workers;

use App\Models\Algebra;

class AlgebraWorker3
{
    /**
     *  Arithmetic Resolver
     * @param  string $input Input
     * @return string      Result
     */
    public static function arithmeticResolver($input)
    {
        return strrev($input);
    }
}