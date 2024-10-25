<?php

namespace Domain\Service;

use Exception;
use Ramsey\Uuid\Uuid;
use Domain\Entities\Order;
use Domain\Entities\Customer;
use Domain\Entities\OrderItem;


class OrderService
{
    /**
     * @param array<Order> $orders
     */
    public function total(array $orders): float
    {
        return array_sum(array_map(function ($order) {
            return $order->total();
        }, $orders));
    }


    /**
     * @param Customer $customer
     * @param array<OrderItem> $orderItems
     * 
     * @return Order
     */
    public function placeOrder(Customer $customer, array $orderItems): Order
    {
        if (count($orderItems) === 0) {
            throw new Exception("Order must have at least one item");
        }

        $uuid = Uuid::uuid4();

        $order = new Order($uuid, $customer->getId(), $orderItems);

        $customer->addRewardPoints($order->total() / 2);

        return $order;
    }
}
