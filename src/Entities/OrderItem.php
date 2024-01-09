<?php

declare(strict_types=1);

namespace Otaodev\Ddd\Entities;

class OrderItem
{
    public function __construct(
        private string $id,
        private string $name,
        private float $price,
        private string $productId,
        private int $quantity
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getProductId(): string
    {
        return $this->productId;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    public function orderItemTotal(): float
    {
        return $this->getPrice() * $this->getQuantity();
    }

}