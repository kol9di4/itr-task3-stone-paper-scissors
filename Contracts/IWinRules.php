<?php

namespace Contracts;

interface IWinRules {

    public static function difinitionOfVictory(int $computer, int $player, $numberOfOptions) : string;

}