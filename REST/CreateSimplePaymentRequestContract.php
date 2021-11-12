<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


interface CreateSimplePaymentRequestContract
{
    public function getAmount(): int;

    public function getCurrency(): string;

    public static function fromArray(array $data);

    public function toArray(): array;
}
