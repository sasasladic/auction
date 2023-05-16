<?php

namespace App\Auction\Manager;

use Symfony\Component\Console\Output\OutputInterface;

class AuctionOutput
{

    public function __construct(private OutputInterface $output)
    {
    }

    public function displayResult(array $result): void
    {
        if (!$result['winner']) {
            $this->output->writeln("There is no winner");
        }

        $this->output->writeln("The buyer " . $result['winner'] . " wins the auction at the price of " . $result['winningPrice'] . " euros");
    }

}