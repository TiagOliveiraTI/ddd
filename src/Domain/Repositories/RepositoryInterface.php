<?php

declare(strict_types=1);

namespace Otaodev\Ddd\Domain\Repositories;

use Throwable;

interface RepositoryInterface
{
    /**
     * @param mixed $entity
     * 
     * @return void
     * 
     * @throws Throwable If an error occurs during entity creation.
     */
    public function create(mixed $entity): void;

    /**
     * @param mixed $entity
     * 
     * @return void
     * 
     * @throws Throwable If an error occurs during entity creation.
     */
    public function update(mixed $entity): void;

    /**
     * @param string $id
     * 
     * @return mixed
     */
    public function find(string $id): mixed;

    /**
     * @return array<mixed>
     */
    public function findAll(): array;

    /**
     * @param string $id
     * 
     * @return void
     */
    public function delete(string $id): void;
}
