<?php

use Domain\Service\OrderService;
use Domain\Entities\Order;
use Domain\Entities\Customer;
use Domain\Entities\OrderItem;


$sut = new OrderService;

describe("Order service unit tests", function() use ($sut) {
    
    it("should place an order", function() use ($sut) {
        $customer = new Customer("any_id_1", "Customer 1");
        $item1 = new OrderItem("item_id_1", "Item 1", 10.0, 1, 1);
        
        $order = $sut->placeOrder($customer, [$item1]);
        
        expect($customer->getRewardPoints())->toBe(5.0);
        expect($order->total([$item1]))->toBe(10.0);
    });
    
    it("should get total of all orders", function() use ($sut){
        $orderItem1 = new OrderItem("item_id_1", "Item 1", 100.0, 1, 1);
        $orderItem2 = new OrderItem("item_id_2", "Item 2", 200.0, 2, 2);

        $order1 = new Order("order_id_1", "Order 1", [$orderItem1]);
        $order2 = new Order("order_id_2", "Order 2", [$orderItem2]);

        $total = $sut->total([$order1, $order2]);

        expect($total)->toBe(500.0);
    });
});