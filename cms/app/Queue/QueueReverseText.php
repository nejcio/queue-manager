<?php

namespace App\Queue;

use App\Models\ReverseText;

class QueueReverseText
{
    /**
     * Adds string to DB - Queue
     * @param string $input Input
     * @param object $dbconn DB connection PDO
     */
    public static function addToQueue($input, $dbconn)
    {
        $reverseText = new ReverseText;
        $availableWorker = $reverseText->getAvailableWorker($dbconn);
        $reverseText->add($input, $availableWorker, $dbconn);
    }
}