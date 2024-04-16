<?php
function definitionOfVictory($comp,$player) : string{
	return "You win!";
}
$hod = 0;
while (true){
	print(str_repeat('-',36).++$hod.str_repeat('-',36)."\n"); 
	$arr = array_slice($argv,1);
	$key = bin2hex(random_bytes(32));
	// $key = random_bytes(32);
	// Победа определяется так — половина следующих по кругу выигрывает,
	//  половина предыдущих по кругу проигрывает
	$printMenu = function () use ($arr){
		print("Make your move:\n");
		foreach ($arr as $k=>$v)
		{
			print(($k+1).": ".$v."\n");
		}
		print ("?: Help\n");
		print ("0: Exit.\n");
	};
	$compStep = function () use ($arr,$key){
		$compStep = $arr[random_int(0,count($arr)-1)];
		$hmac = hash_hmac('sha3-256', $key, $compStep);
		print("HMAC:".strtoupper($hmac)."\n");
		return $compStep;
	};
	if (count($arr) < 3){
		print("Enter an odd number of arguments, 3 or more!\nFor example: rock paper scissors.");
		return;
	}
	if (count($arr)%2 === 0){
		print("Enter an odd number of arguments!\nFor example: rock paper scissors.");
		return;
	}
	$cHod = $compStep();
	$printMenu();

	$playerInput = readline("Make your choice: ");
	print("Your move: ".$arr[$playerInput]."\n");
	print("Computer move: ".$cHod."\n");
	print("HMAC key:".strtoupper($key)."\n");
	print("You win!\n");
}
