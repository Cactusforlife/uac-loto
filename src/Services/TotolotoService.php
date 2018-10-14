<?php

namespace App\Services;

use App\Domain\Bet;

class TotolotoService extends LotteryService
{

    const TOP_RANGE = 49;

    public function numbers(int $betSize = 6)
    {
        return $this->generateNumbers($betSize, 49);
    }

    public function bet(int $betSize = 6)
    {
        return new Bet(
            $this->generateNumbers(
                $betSize,
                self::TOP_RANGE),[]);
    }
}
