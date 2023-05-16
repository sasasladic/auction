<?php

namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Auction\Auction;

class AuctionTest extends TestCase
{
    public function testGetWinnerWithMultipleBids()
    {
        $auction = new Auction(100);
        $auction->placeBid('A', 110);
        $auction->placeBid('A', 130);
        $auction->placeBid('C', 125);
        $auction->placeBid('D', 105);
        $auction->placeBid('D', 115);
        $auction->placeBid('D', 200);
        $auction->placeBid('E', 132);
        $auction->placeBid('E', 135);
        $auction->placeBid('E', 140);

        $winner = $auction->determineWinner();

        $this->assertEquals(['winner' => 'D', 'winningPrice' => 140], $winner);
    }

    public function testGetWinnerWithNoBids()
    {
        $auction = new Auction(100);

        $winner = $auction->determineWinner();

        $this->assertEquals(['winner' => null, 'winningPrice' => 100], $winner);
    }

    public function testGetWinnerWithNoValidBids()
    {
        $auction = new Auction(100);
        $auction->placeBid('A', 90);
        $auction->placeBid('B', 95);

        $winner = $auction->determineWinner();

        $this->assertEquals(['winner' => null, 'winningPrice' => 100], $winner);
    }

    public function testDeterminingWinnerWithOneBidder()
    {
        $auction = new Auction(150);
        $auction->placeBid('A', 200);

        $winner = $auction->determineWinner();

        $this->assertEquals(['winner' => 'A', 'winningPrice' => 150], $winner);
    }
}