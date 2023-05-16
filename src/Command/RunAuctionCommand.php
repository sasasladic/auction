<?php

namespace App\Command;

use App\Auction\Auction;
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

        $auction->placeBid('A', 110);
        $auction->placeBid('A', 130);
        $auction->placeBid('C', 125);
        $auction->placeBid('D', 105);
        $auction->placeBid('D', 115);
        $auction->placeBid('D', 90);
        $auction->placeBid('E', 132);
        $auction->placeBid('E', 135);
        $auction->placeBid('E', 140);

        $result = $auction->determineWinner();

        if ($result['winner']) {
            $output->writeln("The buyer " . $result['winner'] . " wins the auction at the price of " . $result['winningPrice'] . " euros");
        } else {
            $output->writeln("There is no winner, reserved price was " . $result['winningPrice'] . " euros");
        }

        return Command::SUCCESS;
    }
}