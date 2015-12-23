<?php

namespace App\Workers;

use App\Models\Algebra;

class AlgebraWorker extends Worker
{
    /**
     *  Arithmetic Resolver
     * @param  string $input Input
     * @return string      Result
     */
    public function resolveIt($input)
    {
        eval( '$result = (' . $input . ');' );
        return $result;
    }
}