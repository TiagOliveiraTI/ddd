<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\Order;
use Domain\Entities\OrderItem;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class OrderTest extends TestCase
{
   #[Test]
   public function shouldThrowErrorWhenIdIsEmpty(): void
   {
      $this->expectException(Exception::class);
      $this->expectExceptionMessage("Id is required");

      new Order("", "any_customer_id", []);
   }

   #[Test]
   public function shouldThrowErrorWhenCustomerIdIsEmpty(): void
   {
      $this->expectException(Exception::class);
      $this->expectExceptionMessage("Customer id is required");
      
      new Order("any_id", "", []);
   }

   #[Test]
   public function shouldCalculateTotal(): void
   {
      $item1 = new OrderItem('1', 'item 1', 10.0, 'any_product_id', 2);
      $item2 = new OrderItem('2', 'item 2', 40.0, 'any_product_id', 2);

      $order = new Order('any_id', 'any_customer_id', [$item1]);
      $order->total();

      $this->assertSame($order->getTotal(), 20.0);

      $order2 = new Order('any_id', 'any_customer_id', [$item1, $item2]);
      $order2->total();

      $this->assertSame($order2->getTotal(), 100.0);
   }

   #[Test]
   public function shouldThrowAnErrorWhenOrderQuantityIsEqualZero(): void
   {
      $this->expectException(Exception::class);
      $this->expectExceptionMessage("Order must have at least one item");
      
      new Order('any_id', 'any_customer_id', []);
   }

   #[Test]
   public function shouldThrowErrorIfTheItemIsLessOrEqualZero(): void
   {
      $this->expectException(Exception::class);
      $this->expectExceptionMessage("Item quantity must be greater than zero");
      
      $item1 = new OrderItem('1', 'item 1', 10.0, 'any_product_id',0);

      $order = new Order('any_id', 'any_customer_id', [$item1]);

      $order->total();
   }
}