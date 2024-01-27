<?php

use Otaodev\Ddd\Entities\Customer;
use Otaodev\Ddd\ValueObjects\Address;

describe("Customer unit tests", function () {

   it('should throw error when id is empty', function () {
      $customer = new Customer("", "any_name");
   })->throws(Exception::class, "Id is required");

   it('should throw error when name is empty', function () {
      $customer = new Customer("any_id", "");
   })->throws(Exception::class, "Name is required");

   it('should change name', function () {
      $customer = new Customer("any_id", "any_name");

      $customer->changeName("new_name");

      expect($customer->getName())->toBe('new_name');
   });

   it('should throws when address is undefined', function () {
      $customer = new Customer("any_id", "any_name");

      $customer->activate();

   })->throws(Exception::class, "Address is mandatory to activate a customer");

   it('should activate a customer', function () {
      $customer = new Customer("any_id", "any_name");
      $address = new Address("any_street", "1", "any_zip", "any_city");

      $customer->setAddress($address);
      $customer->activate();

      expect($customer->isActive())->toBeTrue();

   });

   it('should deactivate a customer', function () {
      $customer = new Customer("any_id", "any_name");

      $customer->deactivate();

      expect($customer->isActive())->toBeFalse();

   });

   it("should add reward points", function () {
      $customer = new Customer("any_id", "any_name");

      expect($customer->getRewardPoints())->tobe(0.0);

      $customer->addRewardPoints(10.0);

      expect($customer->getRewardPoints())->tobe(10.0);

      $customer->addRewardPoints(10.0);

      expect($customer->getRewardPoints())->tobe(20.0);
   });
});
