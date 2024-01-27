<?php

use Otaodev\Ddd\Entities\Order;
use Otaodev\Ddd\Entities\OrderItem;
use Otaodev\Ddd\Service\OrderService;

$sut = new OrderService;

describe("Order service unit tests", function() use ($sut) {
    it("should get total of all orders", function() use ($sut){
        $orderItem1 = new OrderItem("item_id_1", "Item 1", 100.0, 1, 1);
        $orderItem2 = new OrderItem("item_id_2", "Item 2", 200.0, 2, 2);

        $order1 = new Order("order_id_1", "Order 1", [$orderItem1]);
        $order2 = new Order("order_id_2", "Order 2", [$orderItem2]);

        $total = $sut->total([$order1, $order2]);

        expect($total)->toBe(500.0);
    });
});