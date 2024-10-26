<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\Customer;
use Domain\ValueObjects\Address;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class CustomerTest extends TestCase
{
   #[Test]
   public function shouldThrowErrorWhenIdIsEmpty(): void
   {
      $this->expectException(Exception::class);
      $this->expectExceptionMessage("Id is required");
      new Customer("", "any_name");
   }

   #[Test]
   public function shouldThrowErrorWhenNameIsEmpty() {
      $this->expectException(Exception::class);
      $this->expectExceptionMessage("Name is required");
      new Customer("any_id", "");
   }

   #[Test]
   public function shouldChangeName() {
      $customer = new Customer("any_id", "any_name");

      $customer->changeName("new_name");

      $this->assertSame($customer->getName(), 'new_name');
   }

   #[Test]
   public function shouldThrowsWhenAddressIsUndefined() {
      $this->expectException(Exception::class);
      $this->expectExceptionMessage("Address is mandatory to activate a customer");

      $customer = new Customer("any_id", "any_name");
      $customer->activate();
   }


   #[Test]
   public function shouldActivateACustomer() {
      $customer = new Customer("any_id", "any_name");
      $address = new Address("any_street", "1", "any_zip", "any_city");

      $customer->setAddress($address);
      $customer->activate();

      $this->assertTrue($customer->isActive());

   }

   #[Test]
   public function shouldDeactivateACustomer() {
      $customer = new Customer("any_id", "any_name");

      $customer->deactivate();

      $this->assertFalse($customer->isActive());
   }

   #[Test]
   public function shouldAddRewardPoints() {
      $customer = new Customer("any_id", "any_name");

      $this->assertSame($customer->getRewardPoints(), 0.0);

      $customer->addRewardPoints(10.0);

      $this->assertSame($customer->getRewardPoints(), 10.0);

      $customer->addRewardPoints(10.0);

      $this->assertSame($customer->getRewardPoints(), 20.0);
   }
}
