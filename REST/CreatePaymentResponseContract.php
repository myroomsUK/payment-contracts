<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


interface CreatePaymentResponseContract
{
    public function getUrl(): string;

    public function getUlid(): string;

    public static function fromArray(array $data);

    public function toArray(): array;
}