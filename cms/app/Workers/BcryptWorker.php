<?php

namespace App\Workers;

class BcryptWorker extends Worker
{
    /**
     * Input Bcrypter
     * @param  string $input Input - string
     * @return string      bcrypted input
     */
    public static function bcryptIt($input)
    {
        $options = array('cost' => 11);
        $output = password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options);
        return $output;
    }
}