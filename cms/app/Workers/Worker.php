<?php

namespace App\Workers;

use App\Models\Algebra;
use App\Models\Bcrypt;
use App\Models\Fibonacci;
use App\Models\ReverseText;

class Worker
{
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

    public function work($workLoad, $dbconn, $table)
    {
        $algebra = new Algebra;
        $one = $algebra->getTypeOfFunctionInt();
        $bcrypt = new Bcrypt;
        $two = $bcrypt->getTypeOfFunctionInt();
        $fibonacii = new Fibonacci;
        $three = $fibonacii->getTypeOfFunctionInt();
        $reversetext = new ReverseText;
        $four = $reversetext->getTypeOfFunctionInt();

        foreach ($workLoad as $item):
            if($item['type'] == $one):
                $class = "\\App\\Workers\\AlgebraWorker". $item['worker'];
                $obj = new $class ;
                $obj->resolve($item['data'], $id, $table);
            endif;
            if($item['type'] == $two):
                $class = "\\App\\Workers\\BcryptWorker". $item['worker'];
                $obj = new $class;
                $obj->resolve($item['data'], $id, $table);
            endif;
            if($item['type'] == $three):
                $class = "\\App\\Workers\\FibonacciWorker". $item['worker'];
                $obj = new $class;
                $obj->resolve($item['data'], $id, $table);
            endif;
            if($item['type'] == $four):
                $class = "\\App\\Workers\\ReverseTextWorker". $item['worker'];
                $obj = new $class;
                $obj->resolve($item['data'], $id, $table);
            endif;
        endforeach;

        // $sth = $dbconn->prepare("INSERT INTO $tableName(data, worker, type)
        // VALUES(:input, :worker, :type)");
        // $sth->execute(['input' => '11', 'worker' => '1', 'type' => 1]);
    }
}