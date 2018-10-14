<?php
/**
 * Created by PhpStorm.
 * User: vasco
 * Date: 11-10-2018
 * Time: 8:57
 */

namespace App\Services;


abstract class LotteryService
{
    /**
     * @param int $limit
     * @return int
     * @throws \Exception
     */
    public function number(int $limit = 49)
    {
        return random_int(1, $limit);
    }

    protected function generateNumbers(int $betSize = 6, int $limit = 49): array
    {
        if ($betSize < 5 || $betSize > 11) {
            throw new \InvalidArgumentException(
                "A bet can only have numbers between 5 and 11."
            );
        }

        $bet = [];
        for ($i = 0; $i < $betSize; $i++) {

            do {
                $number = $this->number($limit);
            } while (in_array($number, $bet));

            array_push($bet, $number);
        }
        sort($bet);
        return $bet;
    }
}