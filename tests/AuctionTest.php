<?php

namespace App\Tests;

use App\Auction\Creational\BuyersListFactory;
use App\Auction\Entity\Auction;
use App\Auction\Manager\AuctionManager;
use PHPUnit\Framework\TestCase;

class AuctionTest extends TestCase
{
    public function testGetWinnerWithMultipleBids()
    {
        $arr = [
            'a'  => [110, 130],
            'b' => [],
            'c' => [125],
            'd' => [105, 115, 200],
            'e' => [132, 135, 140]
        ];

        $auction = new Auction(100);
        $auctionManager = new AuctionManager($auction);

        $auctionManager->addBuyers(BuyersListFactory::generateBuyers($arr));
        $results = $auctionManager->determineWinner();

        $this->assertEquals(['winner' => 'd', 'winningPrice' => 140], $results);
    }

    public function testGetWinnerWithNoBids()
    {
        $arr = [];
        $auction = new Auction(100);
        $auctionManager = new AuctionManager($auction);

        $auctionManager->addBuyers($arr);
        $results = $auctionManager->determineWinner();

        $this->assertEquals(['winner' => null, 'winningPrice' => null], $results);
    }

    public function testGetWinnerWithNoValidBids()
    {
        $arr = [
            'a'  => [90],
            'b' => [95]
        ];

        $auction = new Auction(100);
        $auctionManager = new AuctionManager($auction);

        $auctionManager->addBuyers(BuyersListFactory::generateBuyers($arr));
        $results = $auctionManager->determineWinner();

        $this->assertEquals(['winner' => null, 'winningPrice' => 100], $results);
    }

    public function testDeterminingWinnerWithOneBidder()
    {
        $arr = [
            'a'  => [200],
        ];

        $auction = new Auction(100);
        $auctionManager = new AuctionManager($auction);

        $auctionManager->addBuyers(BuyersListFactory::generateBuyers($arr));
        $results = $auctionManager->determineWinner();

        $this->assertEquals(['winner' => 'a', 'winningPrice' => 100], $results);
    }
}