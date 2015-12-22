<?php

namespace App\Queue;

use App\Models\Algebra;

class QueueAlgebra
{
    /**
     * Adds algebra func to DB - Queue
     * @param string $input Input
     * @param object $dbconn DB connection PDO
     */
    public static function addToQueue($input, $dbconn)
    {
        $algebra = new Algebra;
        $availableWorker = $algebra->getAvailableWorker($dbconn);
        $algebra->add($input, $availableWorker, $dbconn);
    }
}