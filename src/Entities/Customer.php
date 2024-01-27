<?php

declare(strict_types=1);

namespace Otaodev\Ddd\Entities;

use DomainException;
use LengthException;
use Otaodev\Ddd\ValueObjects\Address;

class Customer
{
    private Address $address;
    private bool $active = false;
    private float $rewardPoints = 0;

    public function __construct(
        private string $id,
        private string $name,
    )
    { 
        $this->validate();
    }

    
    public function changeName(string $name): self
    {
        $this->name = $name;
        $this->validate();
        return $this;
    }
    
    public function activate(): self
    {
        if (empty($this->address)) {
            throw new DomainException("Address is mandatory to activate a customer");
        }

        $this->active = true;
        return $this;
    }
    
    public function deactivate(): self
    {
        $this->active = false;
        return $this;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;
        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function isActive(): bool
    {
        return $this->active;
    }
        
    public function getName(): string
    {
        return $this->name;
    }
    
    public function addRewardPoints(float $points): void
    {
        $this->rewardPoints += $points;
    }

    public function getRewardPoints(): float
    {
        return $this->rewardPoints;
    }

    private function validate(): void
    {
        if (strlen($this->id) === 0) {
            throw new LengthException("Id is required");
        }

        if (strlen($this->name) === 0) {
            throw new LengthException("Name is required");
        }
    }
}
