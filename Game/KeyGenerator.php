<?php

namespace Game;

include_once('./Contracts/IKeyGenerator.php');

use Contracts\IKeyGenerator;

class KeyGenerator implements IKeyGenerator{

    public static function generate(int $bit) : string{
        $key = bin2hex(random_bytes($bit/8));
        return $key;
    }

}
