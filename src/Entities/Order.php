<?php

declare(strict_types=1);

namespace Otaodev\Ddd\Entities;

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
        array $orderItems = []
    )
    {
        $this->orderItems = $orderItems;
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
}
