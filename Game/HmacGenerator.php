<?php

namespace Game;

include_once('./Contracts/IHmacGenerator.php');

use Contracts\IHmacGenerator;

class HmacGenerator implements IHmacGenerator{

    protected string $key;
    protected string $compMove;

    public function setKey($key) : HmacGenerator{
        $this->key = $key;
        return $this;
    }

    public function setCompMove($compMove) : HmacGenerator{
        $this->compMove = $compMove;
        return $this;
    }

    public function generate() : string{
        $hmac = hash_hmac('sha3-256', $this->key, $this->compMove);
        return $hmac;
    }

}