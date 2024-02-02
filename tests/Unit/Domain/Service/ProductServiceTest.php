<?php

use Otaodev\Ddd\Domain\Service\ProductService;
use Otaodev\Ddd\Domain\Entities\Product;

describe("Order Service unit tests", function() {

    it("should change the prices of all products", function() {
        $product1 = new Product('any_id_1', 'product1', 10.0);
        $product2 = new Product('any_id_2', 'product2', 20.0);

        $products = [$product1, $product2];

        ProductService::increasePrice($products, 100);

        expect($product1->getPrice())->toBe(20.0);
        expect($product2->getPrice())->toBe(40.0);
    });

});