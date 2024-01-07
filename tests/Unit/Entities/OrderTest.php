<?php

use Otaodev\Ddd\Entities\Order;
use Otaodev\Ddd\Entities\OrderItem;

describe("Order unit tests", function () {

   it("should throw an error when id is empty", function() {
      $order = new Order('', 'any_customer_id', []);
   })->throws(Exception::class, "Id is required");

   it("should throw an error when customer_id is empty", function() {
      $order = new Order('any_id', '', []);
   })->throws(Exception::class, "Customer id is required");

   it("should calculate total", function() {
      $item1 = new OrderItem('1', 'item 1', 10.0, 'any_product_id', 2);
      $item2 = new OrderItem('2', 'item 2', 40.0, 'any_product_id', 2);

      $order = new Order('any_id', 'any_customer_id', [$item1]);
      $order->total();

      expect($order->getTotal())->toBe(20.0);

      $order2 = new Order('any_id', 'any_customer_id', [$item1, $item2]);
      $order2->total();

      expect($order2->getTotal())->toBe(100.0);
   });

   it("should throw an error when order quantity is equal zero", function() {
      $order = new Order('any_id', 'any_customer_id', []);
   })->throws(Exception::class, "Order must have at least one item");

   it("should throw error if the item is less or equal zero", function() {
      $item1 = new OrderItem('1', 'item 1', 10.0, 'any_product_id',0);

      $order = new Order('any_id', 'any_customer_id', [$item1]);

      $order->total();

   })->throws(Exception::class, "Item quantity must be greater than zero");

});
