<?php


namespace Myrooms\Payment\Contracts\REST;


interface CreateCustomerResponseContract
{
    public function getCustomerId(): string;

    public function getEmail(): string;

    public function getOfflinePaymentSetupUrl(): string;

    public static function fromArray(array $data);

    public function toArray(): array;
}