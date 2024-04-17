<?php

include_once ('ini.php');

use Game\Core;
use Game\HmacGenerator;
use Game\KeyGenerator;
use Game\TableGenerator;
use Game\WinRules;

$hmacGenerator = new HmacGenerator();
$keyGenerator = new KeyGenerator();
$tableGenerator = new TableGenerator();
$winRules = new WinRules();

$arrMoves = array_slice($argv,1);

$game = new Core($hmacGenerator, $keyGenerator, $tableGenerator , $winRules);
$resultPushArray = $game->setArrMoves($arrMoves);

if ($resultPushArray !== "OK"){
	print($resultPushArray."\n");
	return;
}

print($game->step());
$playerChoice = "-1";

while (true){
	print($game->menu());
	$playerChoice = $game->readPlayerChoice();
	if($playerChoice === "0")
		return;
	if($playerChoice === "?"){
		print($game->rulesTable());
		continue;
	}
	if(!((int)$playerChoice>0 && (int)$playerChoice<=count($arrMoves))){
		print("Invalid input\n");
		continue;
	}
	$game->setPlayerChoice($playerChoice);
	break;
}
print($game->resultGame());


