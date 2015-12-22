<?php

namespace App\Workers;

use App\Models\Bcrypt;

class BcryptWorker1
{
    /**
     * Input Bcrypter
     * @param  string $input Input - string
     * @return string      bcrypted input
     */
    public static function inputBcrypter($input)
    {
        return bcrypt($input);
    }

}