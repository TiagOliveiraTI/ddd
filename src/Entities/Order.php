<?php

declare(strict_types=1);

namespace Otaodev\Ddd\Entities;

use LengthException;
use Otaodev\Ddd\Entities\OrderItem;


class Order
{
    /** @var array<OrderItem> $orderItems */
    private array $orderItems = [];

    /**
     * @param string $id
     * @param string $customerId
     * @param array<OrderItem> $orderItems
     */
    public function __construct(
        private string $id,
        private string $customerId,
        array $orderItems,
        private float $total = 0
    )
    {
        $this->orderItems = $orderItems;

        $this->validate();
    }

    public function addOrderItem(OrderItem $orderItem): void
    {
        $this->orderItems[] = $orderItem;
    }

    /**
     * Get the value of orderItems
     *
     * @return array<OrderItem>
     */
    public function getOrderItems()
    {
        return $this->orderItems;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function total(): float
    {
        return $this->total = array_reduce(
            $this->orderItems,
            fn(float $acc, OrderItem $item): float => $acc + $item->getPrice(),  // Use getPrice() if it's a method
            0.0
        );
    }

    public function getTotal(): float
    {
        return $this->total;
    }

    private function validate(): bool
    {
        if (strlen($this->id) === 0) {
            throw new LengthException("Id is required");
        }

        if (strlen($this->customerId) === 0) {
            throw new LengthException("Customer id is required");
        }

        if (count($this->orderItems) === 0) {
            throw new LengthException("Item quantity must be greater than zero");
        }



        return true;
    }
}
