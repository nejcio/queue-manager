<?php

namespace App\Models;

class Model
{
    /**
     * Gets the table name
     * @return string Table name
     */
    public function getTableName()
    {
        return $this->table;
    }

    /**
     * Gets type
     * @return string Table name
     */
    public function getTypeOfFunctionInt()
    {
        return $this->type;
    }

    /**
     * Gets type
     * @return string Table name
     */
    public function getNumberOfWorkers()
    {
        return $this->numberOfWorkers;
    }
    /**
     * Input Bcrypter
     * @param  string $input Input - string
     * @return string      bcrypted input
     */
    public function getAvailableWorker($dbconn)
    {
        $functionType = $this->getTypeOfFunctionInt();
        $tableName = $this->getTableName();
        $numberOfWorkers = $this->getNumberOfWorkers();
        $limit = ++$numberOfWorkers;
        $SQLstatement = null;

        for ($i=1; $i < $limit ; $i++) :
             $SQLstatement .= '(SELECT COUNT(*) FROM '. $tableName .' WHERE type = '. $functionType
                                .' AND worker= '. $i .' AND done IS NULL) count'. $i .',';
        endfor;
        $SQLstatement = trim($SQLstatement, ",");

        $sth = $dbconn->prepare("SELECT worker,type, $SQLstatement FROM $tableName GROUP BY worker");

        try {
            $sth->execute();
            $fetchAllWorkers = $sth->fetchAll();
        } catch (\Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }

        if (empty($fetchAllWorkers)):
            $worker = (rand (  1 , --$numberOfWorkers ));
        else:
            $worker = $this->getAWorkerWithLeastWotk($fetchAllWorkers, $limit);
        endif;

        return $worker;
    }

    public function getAWorkerWithLeastWotk($array, $numberOfWorkers)
    {
        foreach ($array as $row) :
            $worker = 'count' . $row['worker'];
            $workersWithWorkLoad[$row['worker']]= $row[$worker];
        endforeach;
        for ($i=1; $i < $numberOfWorkers; $i++):
            if (!array_key_exists($i, $workersWithWorkLoad)):
                $workersWithWorkLoad[$i] = "0";
            endif;
        endfor;

        asort($workersWithWorkLoad);
        reset($workersWithWorkLoad);
        $worker = key($workersWithWorkLoad);

        return $worker;
    }

    public function add($input, $worker, $dbconn)
    {
        $functionType = $this->getTypeOfFunctionInt();
        $tableName = $this->getTableName();

        $sth = $dbconn->prepare("INSERT INTO $tableName(data, worker, type)
        VALUES(:input, :worker, :type)");

        try {
            $sth->execute(['input' => $input, 'worker' => $worker, 'type' => $functionType]);
        } catch (\Exception $e) {
            echo 'Caught exception: ',  $e->getMessage(), "\n";
        }
    }
}