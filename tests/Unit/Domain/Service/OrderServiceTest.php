<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Service;

use Domain\Entities\Customer;
use Domain\Entities\Order;
use Domain\Entities\OrderItem;
use Domain\Service\OrderService;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class OrderServiceTest extends TestCase
{
    private OrderService $sut;

    protected function setUp(): void
    {
        $this->sut = new OrderService;
    }

    #[Test]
    public function shouldPlaceAnOrder(): void
    {
        $customer = new Customer("any_id_1", "Customer 1");
        $item1 = new OrderItem("item_id_1", "Item 1", 10.0, '1', 1);
        
        $order = $this->sut->placeOrder($customer, [$item1]);
        
        $this->assertSame($customer->getRewardPoints(), 5.0);
        $this->assertSame($order->total([$item1]), 10.0);
    }

    #[Test]
    public function shouldGetTotalOfAllOrders(): void
    {
        $orderItem1 = new OrderItem("item_id_1", "Item 1", 100.0, '1', 1);
        $orderItem2 = new OrderItem("item_id_2", "Item 2", 200.0, '2', 2);

        $order1 = new Order("order_id_1", "Order 1", [$orderItem1]);
        $order2 = new Order("order_id_2", "Order 2", [$orderItem2]);

        $total = $this->sut->total([$order1, $order2]);

        $this->assertSame($total, 500.0);
    }
}
