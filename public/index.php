<?php


use Domain\Entities\Order;
use Domain\Entities\Customer;
use Domain\Entities\OrderItem;
use Domain\ValueObjects\Address;

require_once dirname(__DIR__) . '/vendor/autoload.php';

const ADDRESS_TIAGO = new Address(
    'Avenida Condessa de Vimieiros',
    '684',
    '11740-000',
    'Itanhaém'
);

$customer = new Customer('123', 'Tiago Oliveira');
$customer->setAddress(ADDRESS_TIAGO);
$customer->activate();

$item1 = new OrderItem('1', 'Item 1', 10.5, '1', 1);
$item2 = new OrderItem('2', 'Item21', 105.49, '1', 2);

$order = new Order('1', '123', [$item1, $item2]);

echo '<pre>';
print_r($customer);
print_r($order);
print_r($order->total());
