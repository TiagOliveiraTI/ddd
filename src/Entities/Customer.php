<?php

namespace Otaodev\Ddd\Entities;

class Customer
{
    public function __construct(
        private string $id,
        private string $name,
        private string $address,
        private bool $active = true
    )
    { }

    public function changeName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function activate(): self
    {
        $this->active = true;
        return $this;
    }

    public function deactivate(): self
    {
        $this->active = false;
        return $this;
    }
}