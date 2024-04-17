<?php

namespace Contracts;

interface IKeyGenerator {

    public static function generate(int $bit) : string;

}