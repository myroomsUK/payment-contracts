<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


class Client
{
    public const MYROOMS       = 'Myrooms';
    public const WEROOMS       = 'Werooms';
    public const L2L           = 'London2let';

    public const CLIENTS = [
        self::MYROOMS,
        self::WEROOMS,
        self::L2L
    ];

    public static function isValid(string $value): bool
    {
        return in_array($value, self::CLIENTS);
    }

}