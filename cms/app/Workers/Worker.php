<?php

namespace App\Workers;

use App\Models\Algebra;
use App\Models\Bcrypt;
use App\Models\Fibonacci;
use App\Models\ReverseText;

class Worker
{
    /*
    |--------------------------------------------------------------------------
    | Worker
    |--------------------------------------------------------------------------
    |
    | Distributes work among workers
    |
    */
    /**
     * Get the queue
     * @param  object $dbconn PDO Object
     * @param  string $table  table name
     * @return array         Array workload
     */
    public function getFromQueue($dbconn, $table)
    {
        $sth = $dbconn->prepare("SELECT * FROM $table WHERE done IS NULL ORDER BY created_at");
        try {
            $sth->execute();
            $fetchAllWorkers = $sth->fetchAll();
        } catch (\Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
        return $fetchAllWorkers;
    }

    /**
     * Destributes work among workers
     * @param  array $workLoad  All queues from DB
     * @param  obj $dbconn      PDO object
     * @param  string $table    DB table name
     */
    public function work($workLoad, $dbconn, $table)
    {
        $algebra = new Algebra;
        $algebraType = $algebra->getTypeOfFunctionInt();
        $bcrypt = new Bcrypt;
        $bcryptType = $bcrypt->getTypeOfFunctionInt();
        $fibonacci = new Fibonacci;
        $fibonacciType = $fibonacci->getTypeOfFunctionInt();
        $reversetext = new ReverseText;
        $reversetextType = $reversetext->getTypeOfFunctionInt();

        foreach ($workLoad as $item):
            switch ($item['type']):
                case $algebraType:
                    $class = "\\App\\Workers\\AlgebraWorker". $item['worker'];
                    $obj = new $class ;
                    $obj->resolve($item, $table, $dbconn);
                    break;
                case $bcryptType:
                    $class = "\\App\\Workers\\BcryptWorker". $item['worker'];
                    $obj = new $class;
                    $obj->resolve($item, $table, $dbconn);
                    break;
                case $fibonacciType:
                    $class = "\\App\\Workers\\FabonacciWorker". $item['worker'];
                    $obj = new $class;
                    $obj->resolve($item, $table, $dbconn);
                    break;
                case $reversetextType:
                    $class = "\\App\\Workers\\ReverseTextWorker". $item['worker'];
                    $obj = new $class;
                    $obj->resolve($item, $table, $dbconn);
                    break;
            endswitch;
        endforeach;
    }
}