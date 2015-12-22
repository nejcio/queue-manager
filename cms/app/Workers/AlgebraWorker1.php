<?php

namespace App\Workers;

class AlgebraWorker1 extends AlgebraWorker
{

    public function resolve($input, $id, $table)
    {
        $dbconn = $this->DBconnect()['dbconn'];
        $table = $this->DBconnect()['dbtable'];
        $result = $this->arithmeticResolver($input);
    }
}