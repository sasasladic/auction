<?php

namespace App\Auction\Creational;

use App\Auction\Entity\Bid;
use App\Auction\Entity\Buyer;
use DateTime;
use Faker\Factory;

class BuyerBuilder
{
    private Buyer $buyer;

    public function __construct()
    {
        $this->buyer = new Buyer();
    }

    public function withIdentifier(string $identifier): static
    {
        $this->buyer->setIdentifier($identifier);
        return $this;
    }

    public function withName(string $name): static
    {
        $this->buyer->setName($name);
        return $this;
    }

    public function withBids(array $bids): static
    {
        $bidObjects = [];
        foreach ($bids as $bid) {
            $bidObjects[] = new Bid(
                $bid,
                $this->fakeTime()
            );
        }
        $this->buyer->setBids($bidObjects);
        return $this;
    }

    public function build(): Buyer
    {
        return $this->buyer;
    }

    private function fakeTime(): DateTime
    {
        $generator = Factory::create();

        return $generator->dateTime;
    }
}