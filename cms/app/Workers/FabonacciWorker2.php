<?php

namespace App\Workers;

class FabonacciWorker2 extends FibonacciWorker
{
    /**
     * Resolves the function and saves to DB
     * @param  string $item      item from DB
     * @param  string $tableName table name
     * @param  obj $dbconn       PDO object
     */
    public function resolve($item, $tableName, $dbconn)
    {
        $id = $item["id"];
        if (is_string($item["data"])):
            $result = $this->reslove($item['data']);
            try {
                $sth = $dbconn->prepare("UPDATE $tableName SET result = :result, done=:done, extra=:extra WHERE id =:id ");
                $sth->bindParam(':result', $result2);
                $sth->bindParam(':done', $done);
                $sth->bindParam(':id', $itemid);
                $sth->bindParam(':extra', $extra);
                $result2 = (string)$result["result"];
                $extra = $result["fulltrace"];
                $done = 1;
                $itemid = $id;
                $sth->execute();
            } catch (\Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        endif;
    }
}