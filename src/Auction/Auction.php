<?php

namespace App\Auction;

class Auction
{
    public function __construct(
        private float $reservePrice,
        private array $bids = []
    )
    {
    }

    public function placeBid($buyer, $bidAmount)
    {
        $this->bids[$buyer][] = $bidAmount;
    }

    public function determineWinner(): array
    {
        $arrHighestValues = $this->extractHighestValues();
        arsort($arrHighestValues);

        $twoHighest = array_slice($arrHighestValues,0,2,true);

        $winner = null;
        $winningPrice = null;
        foreach($twoHighest as $key => $value) {
            if ($value >= $this->reservePrice) {
                if ($winner === null) {
                    $winner = $key;
                    continue;
                }
                $winningPrice = $value;
            }
        }

        $winningPrice = $winningPrice !== null ? $winningPrice : $this->reservePrice;

        return [
            'winner' => $winner,
            'winningPrice' => $winningPrice,
        ];
    }

    private function extractHighestValues(): array
    {
        return array_map(function ($subarray) {
            return !empty($subarray) ? max($subarray) : 0;
        }, $this->bids);
    }
}
