<?php

namespace App\Queue;

use App\Queue\QueueReverseText;
use App\Queue\QueueAlgebra;
use App\Queue\QueueBcrypt;
use App\Queue\QueueFibonacci;

class QueueManager
{
    /*
    |--------------------------------------------------------------------------
    | QueueManager
    |--------------------------------------------------------------------------
    |
    | Manages the request and adds the queue to DB.
    |
    */

    /**
     * Adds the request to queue.
     * @param array $request Request
     * @param obj $dbconn  PDO object
     */
    public function addToQueue($request, $dbconn)
    {
        foreach ($request as $item => $data):
            switch ($item):
                case 'fibonacci':
                    QueueFibonacci::addToQueue(htmlspecialchars($data), $dbconn);
                    break;
                case 'algebra':
                    QueueAlgebra::addToQueue(htmlspecialchars($data), $dbconn);
                    break;
                case 'mirrored_text':
                    QueueReverseText::addToQueue(htmlspecialchars($data), $dbconn);
                    break;
                case 'bcrypt':
                    QueueBcrypt::addToQueue(htmlspecialchars($data), $dbconn);
                    break;
            endswitch;
        endforeach;

        return 'Added to queue!';
    }
}