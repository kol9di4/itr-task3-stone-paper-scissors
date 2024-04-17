<?php

namespace Game;

use Contracts\IHmacGenerator;
use Contracts\IKeyGenerator;
use Contracts\ITableGenerator;
use Contracts\IWinRules;

class Core {
    
    protected int $compChoice;
    protected int $playerChoice;
    protected string $key;

    public function __construct(

        protected array $arrMoves,
        protected IHmacGenerator $hmacGenerator,
        protected IKeyGenerator $keyGenerator,
        protected ITableGenerator $tableGenerator,
        protected IWinRules $iWinRules

    ){}    

    public function step() : string{
        $this->compChoice = $this->compСhooses();
        $this->key = $this->keyGenerator->generate(256);
        $hmac = $this->hmacGenerator
                        ->setKey($this->key)
                        ->setCompMove($this->compChoice)
                        ->generate();
        $outputString = ("HMAC:".strtoupper($hmac)."\n");   

        return $outputString;
    }

    public function menu(){
        $menu = ("Make your move:\n");
		foreach ($this->arrMoves as $k=>$v){
			$menu .= (($k+1).": ".$v."\n");
		}
		$menu .=  ("0: Exit.\n");
		$menu .=  ("?: Help\n");

        return $menu;
    }

    public function readPlayerChoice() : string{
       $plCh = readline("Make your choice: ");
       return $plCh;
    }

    public function setPlayerChoice($playerChoice) : void{
        $this->playerChoice = $playerChoice;
    }

    public function rulesTable() : string{
        $table = $this->tableGenerator
                    ->setMoves($this->arrMoves)
                    ->createTable();

        return $table;
    }

    public function resultGame() : string{
        $result = ("Your move: ".$this->arrMoves[$this->playerChoice]."\n");
        $result .= ("Computer move: ".$this->arrMoves[$this->compChoice]."\n");
        $result .= ("HMAC key:".strtoupper($this->key)."\n");
        $resultGame = $this->iWinRules
                ->difinitionOfVictory($this->compChoice, $this->playerChoice, count($this->arrMoves));
        $result .= ($resultGame."\n");

        return $result;
    }

    private function compСhooses() : int{
        $rand = random_int(0,count($this->arrMoves)-1);
        return $rand;
    }

}