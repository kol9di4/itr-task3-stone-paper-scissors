<?php

namespace Game;

use Contracts\IHmacGenerator;
use Contracts\IKeyGenerator;
use Contracts\ITableGenerator;
use Contracts\IWinRules;

class Core {

    protected array $arrMoves;
    protected int $compChoice;
    protected int $playerChoice;
    protected string $key;

    public function __construct(

        protected IHmacGenerator $hmacGenerator,
        protected IKeyGenerator $keyGenerator,
        protected ITableGenerator $tableGenerator,
        protected IWinRules $iWinRules

    ){}    

    public function setArrMoves($arrMoves) : string{
        $this->arrMoves = $arrMoves;

        return $this->validateArray();
    }

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
        $this->playerChoice = $playerChoice-1;
    }

    public function rulesTable() : void{
        $this->tableGenerator
            ->setMoves($this->arrMoves)
            ->createTable();
    }

    public function resultGame() : string{
        $resultGame = $this->iWinRules
                ->difinitionOfVictory($this->compChoice, $this->playerChoice, count($this->arrMoves));
        $result = ("Your move: ".$this->arrMoves[$this->playerChoice]."\n");
        $result .= ("Computer move: ".$this->arrMoves[$this->compChoice]."\n");
        $result .= ($resultGame."\n");
        $result .= ("HMAC key:".strtoupper($this->key)."\n");
        
        return $result;
    }

    private function compСhooses() : int{
        $rand = random_int(0,count($this->arrMoves)-1);
        return $rand;
    }

    private function validateArray() : string{
        if (count($this->arrMoves) < 3)
            return ("Enter an odd number of arguments, 3 or more!\nFor example: rock paper scissors.");
        if (count($this->arrMoves)%2 === 0)
            return ("Enter an odd number of arguments!\nFor example: rock paper scissors.");
        for($i = 0;$i<count($this->arrMoves)-1;$i++){
            for($j = $i+1;$j<count($this->arrMoves);$j++){
                if($this->arrMoves[$i] === $this->arrMoves[$j])
                    return "You can't specify the same ";
            }
        }

        return "OK";

    }

}