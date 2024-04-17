<?php

namespace Game;

include_once('./Contracts/IWinRules.php');

use Contracts\IWinRules;

class WinRules implements IWinRules{

    public static function difinitionOfVictory(int $computer, int $player, $numberOfOptions) : string{
        $n = $numberOfOptions;
        $p = (int)($numberOfOptions/2);
        $result = ($computer - $player + $n + $p)% $n - $p;

        if($result < 0)
            return "You lose!";
        if($result > 0)
            return "You win!";
        return "Draw";
    }

}