<?php

namespace App\Auction\Entity;

class Buyer
{
    private string $identifier;
    private string $name;
    private array $bids;
    /**
     * @var int|mixed
     */
    private mixed $highestBidValue;

    public function __construct(
    )
    {
        $this->bids = [];
    }

    /**
     * @param string $identifier
     */
    public function setIdentifier(string $identifier): void
    {
        $this->identifier = $identifier;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param array $bids
     */
    public function setBids(array $bids): void
    {
        $this->bids = $bids;
    }

    /**
     * @return string
     */
    public function getIdentifier(): string
    {
        return $this->identifier;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getBids(): array
    {
        return $this->bids;
    }

    public function getHighestBidValue()
    {
        if (!isset($this->highestBidValue)) {
            $this->highestBidValue = !empty($this->bids) ? max(array_map(function ($bid) {
                return $bid->getValue();
            }, $this->bids)) : 0;
        }

        return $this->highestBidValue;
    }

}