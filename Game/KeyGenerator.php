<?php

namespace Game;

include_once('./Contracts/IKeyGenerator.php');

use Contracts\IKeyGenerator;

class KeyGenerator implements IKeyGenerator{

    public static function generate(int $bite) : string{
        $key = bin2hex(random_bytes($bite/8));
        return $key;
    }

}