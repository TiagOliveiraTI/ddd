<?php

namespace Otaodev\Ddd\Entities;

use DomainException;
use LengthException;

class Customer
{
    public function __construct(
        private string $id,
        private string $name,
        private string $address,
        private bool $active = false
    )
    { 
        $this->validate();
    }

    public function validate(): void
    {
        if (strlen($this->name) === 0) {
            throw new LengthException("Name is required");
        }
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
}