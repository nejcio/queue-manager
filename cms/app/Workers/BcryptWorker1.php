<?php

namespace App\Workers;

class BcryptWorker1 extends BcryptWorker
{
    /**
     * Bcrypts the string and to DB
     * @param  string $item      item from DB
     * @param  string $tableName table name
     * @param  obj $dbconn       PDO object
     */
    public function resolve($item, $tableName, $dbconn)
    {
        $id = $item["id"];
        if (is_string($item["data"])):
            $result = $this->bcryptIt($item['data']);
            try {
                $sth = $dbconn->prepare("UPDATE $tableName SET result = :result, done=:done WHERE id =:id ");
                $sth->bindParam(':result', $result2);
                $sth->bindParam(':done', $done);
                $sth->bindParam(':id', $itemid);
                $result2 =$result;
                $done = 1;
                $itemid = $id;
                $sth->execute();
            } catch (\Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        endif;
    }
}