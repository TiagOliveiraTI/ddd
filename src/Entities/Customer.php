<?php

declare(strict_types=1);

namespace Otaodev\Ddd\Entities;

use DomainException;
use LengthException;
use Otaodev\Ddd\ValueObjects\Address;

class Customer
{
    public function __construct(
        private string $id,
        private string $name,
        private Address $address,
        private bool $active = false
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

    public function setAdress(Address $address): self
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
        
    private function validate(): void
    {
        if (strlen($this->name) === 0) {
            throw new LengthException("Name is required");
        }
    }
}
