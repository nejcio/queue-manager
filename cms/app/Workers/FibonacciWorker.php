<?php

namespace App\Workers;

class FibonacciWorker extends Worker
{
    /**
     * Fibonacci Sequence Resolver
     * @param  int $input input number
     * @return array      Fibonacci Sequence
     */
    public static function reslove($input)
    {
        $int = (int)$input;
        $fibArray = array(0, 1);
        for ( $i=2; $i<=$int; ++$i ):
            $fibArray[$i] = $fibArray[$i-1] + $fibArray[$i-2];
        endfor;

        return ["result" => $fibArray[$input], "fulltrace" => json_encode($fibArray)];
    }
}