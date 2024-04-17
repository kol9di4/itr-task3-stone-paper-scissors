<?php

namespace Contracts;

interface IHmacGenerator {
    
    public function setKey($key) : IHmacGenerator;
    public function setCompMove($compMove) : IHmacGenerator;
    public function generate() : string;

}