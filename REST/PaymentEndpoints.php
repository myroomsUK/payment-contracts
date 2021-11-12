<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


class PaymentEndpoints
{
    static public function createCustomer(): Endpoint
    {
        return new Endpoint('api/customer/create-customer', 'POST');
    }

    static public function createDirectPayment(): Endpoint
    {
        return new Endpoint('api/payment/direct-payment', 'POST');
    }

    static public function acceptPayment(string $ulid): Endpoint
    {
        return new Endpoint(sprintf("api/payment/accept-offline-payment/%s",$ulid), 'GET');
    }

    static public function denyPayment(string $ulid): Endpoint
    {
        return new Endpoint(sprintf("api/payment/deny-offline-payment/%s",$ulid), 'GET');
    }

    static public function createBookingPayment(): Endpoint
    {
        return new Endpoint('api/payment/create/booking', 'POST');
    }

    static public function createHoldingDepositPayment(): Endpoint
    {
        return new Endpoint('api/payment/create/holding', 'POST');
    }
}
