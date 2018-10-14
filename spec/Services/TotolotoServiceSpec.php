<?php

namespace spec\App\Services;

use App\Domain\Bet;
use App\Services\LotteryService;
use App\Services\TotolotoService;
use PhpSpec\Exception\Example\FailureException;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class TotolotoServiceSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(TotolotoService::class);
    }

    function it_a_lottery_service()
    {
        $this->shouldHaveType(LotteryService::class);
    }

    function it_can_select_a_number()
    {
        $this->number()->shouldBeInt();
        $this->number()->shouldNotBe(0);
    }

    function it_can_generate_a_full_bet()
    {
        $numbers = $this->numbers(7);
        $numbers->shouldBeArray();
        $numbers->shouldHaveCount(7);
        foreach ($numbers as $number) {
            $number->shouldBeInt();
            $number->shouldNotBe(0);
        }
    }

    function it_has_a_default_number_for_a_bet()
    {
        $this->numbers()->shouldHaveCount(6);
    }

    function it_throws_an_exception_when_requesting_4_numbers()
    {
        $this->shouldThrow(\InvalidArgumentException::class)
            ->during('numbers', [3]);
    }

    function it_cannot_return_repeated_numbers()
    {
        $numbers = $this->numbers(11);
        $list = [];
        foreach ($numbers->getWrappedObject() as $number) {
            if (in_array($number, $list)) {
                throw new FailureException("A repeated number was found..");
            }
            $list[] = $number;
        }
    }

    function it_has_its_bet_ordered()
    {
        $bet = $this->numbers();
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

    function it_throws_an_exception_for_best_over_11_numbers()
    {
        $this->shouldThrow(\InvalidArgumentException::class)
            -> during('numbers', [16]);
    }

    function it_can_generate_a_bet()
    {
        $bet = $this->bet();
        $bet->shouldBeAnInstanceOf(Bet::class);
        $bet->numbers()->shouldHaveCount(6);
        $bet->stars()->shouldHaveCount(0);
    }
}
