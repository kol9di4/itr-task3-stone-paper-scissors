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

    public function createTable() : void{
        $table = new ConsoleTable();
        $table->setHeaders($this->headerArray());
        for ($i=0; $i < count($this->arrMoves); $i++){
            $table->addRow($this->rowArray($i));
        }
        $table->showAllBorders()
            ->display();
    }

    private function headerArray() : array{
        $arr = ['v PC \\ User >'];
        foreach ($this->arrMoves as $move)
            $arr[] = $move;

        return $arr;
    }

    private function rowArray($numberString) : array{
        $arr = [$this->arrMoves[$numberString]];
        $cM = count($this->arrMoves);
        for($i=0; $i < $cM; $i++){
            if ($numberString < (int)($cM/2)){
                if($i === $numberString)
                    $arr[] = "Draw";
                else if($i > $numberString && $i <= $numberString+(int)($cM/2))
                    $arr[] = "Win";
                else
                    $arr[] = "Lose";
            }
            if ($numberString === (int)($cM/2)){
                if($i < $numberString)
                    $arr[] = "Lose";
                else if ($i === $numberString)
                    $arr[] = "Draw";
                else
                    $arr[] = "Win";
            }
            if ($numberString > (int)($cM/2)){
                if($i === $numberString)
                    $arr[] = "Draw";
                // else if ($i === 0)
                //     $arr[] = "Win";
                else if($i > ($numberString-(int)($cM/2))-1 && $i < $numberString)
                    $arr[] = "Lose";
                else
                    $arr[] = "Win";
            }
        }

        return $arr;
    }

}