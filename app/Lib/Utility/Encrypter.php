<?php

declare (strict_types = 1);

namespace App\Lib\Utility;

class Encrypter
{
    public function decryptText(string $encrypted, string $iv, string $key): string
    {
        $returnedText = '';
        if (!empty($encrypted) && !empty($iv) && !empty($key)) {
            $returnedText = rtrim(mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $encrypted, MCRYPT_MODE_CBC, $iv), "\t\0\r\n ");
        }

        return $returnedText;
    }
}
