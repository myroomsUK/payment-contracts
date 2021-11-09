<?php


namespace Myrooms\Payment\Contracts\REST;


interface CreateCustomerRequestContract
{
    public function getEmail(): string;

    public static function fromArray(array $data);

    public function toArray(): array;
}
