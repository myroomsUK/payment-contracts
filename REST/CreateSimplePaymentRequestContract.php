<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


interface CreateSimplePaymentRequestContract
{
    public function getAmount(): int;

    public function getCurrency(): string;

    public function getCustomer(): string;

    public static function fromArray(array $data);

    public function toArray(): array;
}