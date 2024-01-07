<?php

declare(strict_types=1);

namespace Otaodev\Ddd\Entities;

use Exception;

class Product
{
    public function __construct(
        private string $id,
        private string $name,
        private float $price
    ) {
        $this->validate();
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function changeName(string $name): self
    {
        $this->name = $name;
        $this->validate();
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function changePrice(float $price): self
    {
        $this->price = $price;
        $this->validate();
        return $this;
    }

    private function validate(): bool
    {
        if (empty($this->id)) {
            throw new Exception("Id is required");
        }

        if (empty($this->name)) {
            throw new Exception("Name is required");
        }

        if ($this->price < 0) {
            throw new Exception("Price must be greater than zero");
        }

        return true;
    }
}
