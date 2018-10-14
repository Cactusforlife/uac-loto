<?php

namespace spec\App\Services;

use App\Services\EuromillionsService;
use App\Services\LotteryService;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;

class EuromillionsServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(EuromillionsService::class);
    }

    function its_a_lottery_service()
    {
        $this->shouldHaveType(LotteryService::class);
    }

    /**
     *
     */
    function it_can_have_a_list_of_stars()
    {
        $stars = $this->stars();
        $stars->shouldBeArray();
        $stars->shouldHaveCount(2);
    }

    function it_can_return_all_stars()
    {
        $this->stars(12)->shouldHaveCount(12);
    }

    /**
     * @throws FailureException
     */
    function it_returns_an_ordered_list_of_integers()
    {
        $bet = $this->stars(5);
        $bet->shouldBeArray();

        $lastNumber = 0;
        foreach ($bet->getWrappedObject() as $number) {
            if ($number < $lastNumber) {
                throw new FailureException(
                    "The list is not ordered."
                );
            }
            $lastNumber = $number;
        }
    }
}
