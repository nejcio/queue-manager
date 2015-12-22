<?php

namespace App\Queue;

use App\Models\Bcrypt;

class QueueBcrypt
{
    /**
     * Adds string to DB - Queue
     * @param string $input Input
     * @param object $dbconn DB connection PDO
     */
    public static function addToQueue($input, $dbconn)
    {
        $bcrypt = new Bcrypt;
        $availableWorker = $bcrypt->getAvailableWorker($dbconn);
        $bcrypt->add($input, $availableWorker, $dbconn);
    }
}