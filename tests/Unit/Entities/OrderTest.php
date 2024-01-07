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

   it("should throw an error when item quantity is equal zero", function() {
      $order = new Order('any_id', 'any_customer_id', []);
   })->throws(Exception::class, "Item quantity must be greater than zero");

   it("should calculate total", function() {
      $item1 = new OrderItem('1', 'item 1', 10.0, 1);
      $item2 = new OrderItem('2', 'item 2', 40.0, 1);

      $order = new Order('any_id', 'any_customer_id', [$item1]);
      $order->total();

      expect($order->getTotal())->toBe(10.0);

      $order2 = new Order('any_id', 'any_customer_id', [$item1, $item2]);
      $order2->total();

      expect($order2->getTotal())->toBe(50.0);
   });

});
