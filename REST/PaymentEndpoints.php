<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


class PaymentEndpoints
{
    static public function create(): Endpoint
    {
        return new Endpoint('api/create_payment', 'POST');
    }
}