<?php

use Domain\Entities\Product;

describe("Product unit tests", function () {

    it('should throw error when id is empty', function() {
        $product = new Product('', 'Product 1', 100.0);
    })->throws(Exception::class, 'Id is required');

    it('should throw error when name is empty', function() {
        $product = new Product('any_id', '', 100.0);
    })->throws(Exception::class, 'Name is required');

    it('should throw error when price is less than zero', function() {
        $product = new Product('any_id', 'any_name', -1);
    })->throws(Exception::class, 'Price must be greater than zero');

    it('should change name', function() {
        $product = new Product('any_id', 'any_name', 1.0);

        $product->changeName('new_name');

        expect($product->getName())->toBe('new_name');
    });

    it('should change price', function() {
        $product = new Product('any_id', 'any_name', 1.0);

        $product->changePrice(20.50);

        expect($product->getPrice())->toBe(20.50);
    });

});