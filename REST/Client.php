<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


class Client
{
    public const MYROOMS       = 'Myrooms';
    public const WEROOMS       = 'Werooms';

    private const CLIENTS = [
        self::MYROOMS,
        self::WEROOMS,
    ];

    public static function isValid(string $value): bool
    {
        return in_array($value, self::CLIENTS);
    }

}