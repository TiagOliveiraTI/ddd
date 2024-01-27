<?php

namespace Otaodev\Ddd\Service;

use Otaodev\Ddd\Entities\Order;

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
}
