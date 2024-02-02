<?php

declare(strict_types=1);

namespace Otaodev\Ddd\Domain\Service;

use Otaodev\Ddd\Domain\Entities\Product;

class ProductService
{
    /**
     * @param Product[] $products
     * 
     * @return Product[]
     */
    public static function increasePrice($products, int $percentage): array|Product
    {
        foreach ($products as $product) {
            $product->changePrice(
                $product->getPrice() + ($product->getPrice() * $percentage)/100
            );
        }

        return $products;
    }
}
