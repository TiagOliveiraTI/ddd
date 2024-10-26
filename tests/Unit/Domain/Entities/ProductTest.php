<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Entities;

use Domain\Entities\Product;
use Exception;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ProductTest extends TestCase
{
    #[Test]
    public function shouldThrowErrorWhenIdIsEmpty(): void
    {
       $this->expectException(Exception::class);
       $this->expectExceptionMessage("Id is required");
 
       new Product('', 'Product 1', 100.0);
    }

    #[Test]
    public function shouldThrowErrorWhenNameIsEmpty(): void
    {
       $this->expectException(Exception::class);
       $this->expectExceptionMessage("Name is required");
 
       new Product('any_id', '', 100.0);
    }

    #[Test]
    public function shouldThrowErrorWhenPriceIsLessThanZero(): void
    {
       $this->expectException(Exception::class);
       $this->expectExceptionMessage("Price must be greater than zero");
 
       new Product('any_id', 'any_name', -1);
    }

    #[Test]
    public function shouldCalculateTotal(): void
    {
        $product = new Product('any_id', 'any_name', 1.0);

        $product->changeName('new_name');

        $this->assertSame($product->getName(), 'new_name');
    }

    #[Test]
    public function shouldChangePrice(): void
    {
        $product = new Product('any_id', 'any_name', 1.0);

        $product->changePrice(20.50);

        $this->assertSame($product->getPrice(), 20.50);
    }
}
