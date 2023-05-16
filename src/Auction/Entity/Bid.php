<?php

namespace App\Auction\Entity;

use DateTime;

class Bid
{

    public function __construct(
        private int $value,
        private DateTime $createdAt
    )
    {
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * @return mixed
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }
}