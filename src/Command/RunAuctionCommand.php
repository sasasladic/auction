<?php

namespace App\Command;

use App\Auction\Creational\BuyersListFactory;
use App\Auction\Entity\Auction;
use App\Auction\Entity\Bid;
use App\Auction\Creational\BidsFactory;
use App\Auction\Creational\BuyerBuilder;
use App\Auction\Creational\BuyersFactory;
use App\Auction\Manager\AuctionManager;
use App\Auction\Manager\AuctionOutput;
use Faker\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RunAuctionCommand extends Command
{
    protected static $defaultName = 'auction:run';

    protected function configure()
    {
        $this->setDescription('Runs the auction.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $auction = new Auction(100);
        $auctionManager = new AuctionManager($auction);
        $auctionOutput = new AuctionOutput($output);

        $auctionManager->addBuyers($this->biddingList());
        $results = $auctionManager->determineWinner();
        $auctionOutput->displayResult($results);

        return Command::SUCCESS;
    }

    private function biddingList(): array
    {
        $startArr = [
            'a'  => [110, 130],
            'b' => [],
            'c' => [125],
            'd' => [105, 115, 90],
            'e' => [132, 135, 140]
        ];

        return BuyersListFactory::generateBuyers($startArr);
    }
}