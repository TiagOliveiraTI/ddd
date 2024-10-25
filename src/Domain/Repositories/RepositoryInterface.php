<?php

declare(strict_types=1);

namespace Otaodev\Ddd\Domain\Repositories;

use Throwable;

interface RepositoryInterface
{
    /**
     * @param object $entity
     * 
     * @return void
     * 
     * @throws Throwable If an error occurs during entity creation.
     */
    public function create(object $entity): void;

    /**
     * @param object $entity
     * 
     * @return void
     * 
     * @throws Throwable If an error occurs during entity creation.
     */
    public function update(object $entity): void;

    /**
     * @param string $id
     * 
     * @return object
     */
    public function find(string $id): object;

    /**
     * @return array<object>
     */
    public function findAll(): array;

    /**
     * @param string $id
     * 
     * @return void
     */
    public function delete(string $id): void;
}
