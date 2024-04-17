<?php
// function definitionOfVictory($comp,$player,$col) : string{
// 	$result = ($comp - $player + $col + (int)($col/2))% $col - (int)($col/2);
// 	return $result;
// }

// include ('vendor/phplucidframe/console-table/src/LucidFrame/Console/ConsoleTable.php');

// $table = new LucidFrame\Console\ConsoleTable();
// $table
//     ->setHeaders(array('Language', 'Year'))
//     ->addRow(array('PHP', 1994))
//     ->addRow(array('C++', 1983))
//     ->addRow(array('C', 1970))
//     ->showAllBorders()
//     ->display()
// ;

// $hod = 0;
// while (true){
// 	// print(str_repeat('-',36).++$hod.str_repeat('-',36)."\n"); 
// 	$arr = array_slice($argv,1);
// 	// $key = bin2hex(random_bytes(32));
// 	$printMenu = function () use ($arr){
// 		print("Make your move:\n");
// 		foreach ($arr as $k=>$v)
// 		{
// 			print(($k+1).": ".$v."\n");
// 		}
// 		print ("0: Exit.\n");
// 		print ("?: Help\n");
// 	};
// 	$compStep = function () use ($arr,$key){
// 		$rand = random_int(0,count($arr)-1);
// 		$compStep = $arr[$rand];
// 		$hmac = hash_hmac('sha3-256', $key, $compStep);
// 		print("HMAC:".strtoupper($hmac)."\n");
// 		return $rand;
// 	};
// 	if (count($arr) < 3){
// 		print("Enter an odd number of arguments, 3 or more!\nFor example: rock paper scissors.");
// 		return;
// 	}
// 	if (count($arr)%2 === 0){
// 		print("Enter an odd number of arguments!\nFor example: rock paper scissors.");
// 		return;
// 	}
// 	$cHod = $compStep();
// 	$printMenu();

// 	$playerInput = readline("Make your choice: ")-1;
// 	print("Your move: ".$arr[$playerInput]."\n");
// 	print("Computer move: ".$arr[$cHod]."\n");
// 	print("HMAC key:".strtoupper($key)."\n");
// 	$result = definitionOfVictory($cHod,$playerInput,count($arr));
// 	if($result < 0)
// 		print("You lose!\n");
// 	else if($result > 0)
// 		print("You win!\n");
// 	else 
// 		print("Draw\n");
// }

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

$game = new Core($arrMoves, $hmacGenerator, $keyGenerator, $tableGenerator , $winRules);

print($game->step());
$playerChoice = "-1";

while (!((int)$playerChoice>0 && (int)$playerChoice<count($arrMoves))){
	print($game->menu());
	$playerChoice = $game->readPlayerChoice();
	if($playerChoice === "0")
		return;
	if($playerChoice === "?"){
		print($game->rulesTable());
		continue;
	}
	print($game->resultGame());
}

