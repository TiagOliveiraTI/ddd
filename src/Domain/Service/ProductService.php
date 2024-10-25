<?php

declare(strict_types=1);

namespace Domain\Service;

use Domain\Entities\Product;

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
