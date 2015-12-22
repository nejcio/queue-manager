<?php

namespace App\Queue;

use App\Models\Fibonacci;

class QueueFibonacci
{
    /**
     * Adds string to DB - Queue
     * @param string $input Input
     * @param object $dbconn DB connection PDO
     */
    public static function addToQueue($input, $dbconn)
    {
        $fibonacci = new Fibonacci;
        $availableWorker = $fibonacci->getAvailableWorker($dbconn);
        $fibonacci->add($input, $availableWorker, $dbconn);
    }
}