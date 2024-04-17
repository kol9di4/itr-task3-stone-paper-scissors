<?php

namespace Game;

include ('vendor/phplucidframe/console-table/src/LucidFrame/Console/ConsoleTable.php');

use LucidFrame\Console\ConsoleTable;
use Contracts\ITableGenerator;


class TableGenerator implements ITableGenerator{

    protected array $arrMoves;

    public function setMoves($arrMoves) : TableGenerator{
        $this->arrMoves = $arrMoves;
        return $this;
    }

    public function createTable() : string{
        return str_repeat("-", 100)."\n";
    }


}