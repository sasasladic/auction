<?php

namespace App\Auction\Manager;

use App\Auction\Entity\Auction;

class AuctionManager
{

    public function __construct(private Auction $auction)
    {
    }

    public function addBuyers(array $buyers): void
    {
        $this->auction->addBuyers($buyers);
    }

    public function determineWinner(): array
    {
        $buyers = $this->auction->getBuyers();

        if (empty($buyers)) {
            return [
                'winner' => null,
                'winningPrice' => null,
            ];
        }

        usort($buyers, function ($a, $b) {
            return $b->getHighestBidValue() - $a->getHighestBidValue();
        });

        $twoHighest = array_slice($buyers, 0, 2);

        $winner = null;
        $secondPlace = null;
        foreach ($twoHighest as $buyer) {
            if ($buyer->getHighestBidValue() >= $this->auction->getReservedPrice()) {
                if ($winner === null) {
                    $winner = $buyer;
                    continue;
                }
                $secondPlace = $buyer;
            }
        }
        $winningPrice = $secondPlace ? $secondPlace->getHighestBidValue() : $this->auction->getReservedPrice();

        return [
            'winner' => $winner?->getIdentifier(),
            'winningPrice' => $winningPrice,
        ];
    }
}