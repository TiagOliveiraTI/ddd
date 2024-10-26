<?php

declare(strict_types=1);

namespace Tests\Unit\Domain\Service;

use Domain\Entities\Product;
use Domain\Service\ProductService;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class ProductServiceTest extends TestCase
{
    #[Test]
    public function shouldChangeThePricesOfAllProducts(): void
    {
        $product1 = new Product('any_id_1', 'product1', 10.0);
        $product2 = new Product('any_id_2', 'product2', 20.0);

        $products = [$product1, $product2];

        ProductService::increasePrice($products, 100);

        $this->assertSame($product1->getPrice(), 20.0);
        $this->assertSame($product2->getPrice(), 40.0);
    }
}
