<?php

namespace Contracts;

interface ITableGenerator {

    public function setMoves($arrMoves) : ITableGenerator;
    public function createTable() : string;

}