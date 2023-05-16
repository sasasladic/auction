<?php

namespace App\Auction\Entity;

class Auction
{
    private array $buyers;
    public function __construct(
        private int $reservedPrice,
    )
    {
        $this->buyers = [];
    }

    public function addBuyers($buyers): void
    {
        $this->buyers = $buyers;
    }

    /**
     * @return int
     */
    public function getReservedPrice(): int
    {
        return $this->reservedPrice;
    }

    /**
     * @return array
     */
    public function getBuyers(): array
    {
        return $this->buyers;
    }
}
