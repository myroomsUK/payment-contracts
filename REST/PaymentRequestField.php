<?php


namespace Myrooms\Payment\Contracts\REST;


class PaymentRequestField
{
    public const REFERENCE = 'referenceId';
    public const CLIENT = 'client';
    public const AMOUNT = 'amount';
    public const CHECKIN = 'checkin';
    public const CHECKOUT = 'checkout';
    public const TOTAL = 'total';
    public const ROOM_NAME = 'roomName';
    public const ROOM_DESC = 'roomDescription';
    public const ROOM_IMAGE = 'roomImageUrl';
    public const WEEKLY_PRICE = 'weeklyPrice';
    public const MONTHLY_PRICE = 'monthlyPrice';
    public const CURRENCY = 'currency';
}