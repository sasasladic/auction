<?php

namespace App\Auction\Creational;

use Faker\Factory;

class BuyersListFactory
{
    public static function generateBuyers(array $list): array
    {
        $generator = Factory::create();

        $buyerObjects = [];
        foreach ($list as $identifier => $bids) {
            $buyer = (new BuyerBuilder())
                ->withIdentifier($identifier)
                ->withName($generator->name)
                ->withBids($bids)
                ->build();
            $buyerObjects[] = $buyer;
        }

        return $buyerObjects;
    }
}