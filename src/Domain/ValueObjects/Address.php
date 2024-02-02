<?php

declare(strict_types=1);

namespace Otaodev\Ddd\Domain\ValueObjects;

use LengthException;
use Stringable;

class Address implements Stringable
{
    public function __construct(
        private string $street,
        private string $number,
        private string $zip,
        private string $city
    )
    {
        $this->validate();
    }

    public function __toString(): string
    {
        return sprintf("%s %s %s %s", $this->street, $this->number, $this->zip, $this->city);
    }

    private function validate(): void
    {
        if (strlen($this->street) === 0) {
            throw new LengthException("Street is required");
        }

        if (strlen($this->number) === 0) {
            throw new LengthException("Number is required");
        }

        if (strlen($this->zip) === 0) {
            throw new LengthException("Zip is required");
        }

        if (strlen($this->city) === 0) {
            throw new LengthException("City is required");
        }
    }
}
