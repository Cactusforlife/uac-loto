<?php

namespace App\Services;

use App\Domain\Bet;

class EuromillionsService extends LotteryService
{

    public function bet(int $size = 2, int $stars = 2)
    {
        return new Bet(
            $this->generateNumbers($size,50),
            $this->stars($stars));
    }

    protected function limit(): int
    {
        return 50;
    }

    public function stars(int $size = 2)
    {
       $deck = [];
       for($i = 1; $i<= 12; $i++){
           $deck[] = $i;
       }

       shuffle($deck);
       $selected = array_slice($deck, 0, $size);
       asort($selected);
       return $selected;

    }
}
