<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;

class CreatePaymentRequest implements CreatePaymentRequestContract
{
    private const REFERENCE = 'referenceId';
    private const CLIENT = 'client';
    private const AMOUNT = 'amount';
    private const CHECKIN = 'checkin';
    private const CHECKOUT = 'checkout';
    private const ROOM_NAME = 'roomName';
    private const ROOM_DESC = 'roomDescription';
    private const ROOM_IMAGE = 'roomImageUrl';
    private const WEEKLY_PRICE = 'weeklyPrice';
    private const MONTHLY_PRICE = 'monthlyPrice';
    private const CURRENCY = 'currency';
    private const OFFLINE = 'offline';
    private const PAYMENT_ITEMS = 'paymentItems';

    private const dateFormat = 'Y-m-d';

    /**
     * @var string
     */
    private $referenceId;

    /**
     * @var string
     */
    private $client;

    /**
     * @var int
     */
    private $amount;

    /**
     * @var \DateTimeImmutable
     */
    private $checkIn;

    /**
     * @var \DateTimeImmutable
     */
    private $checkOut;

    /**
     * @var string
     */
    private $roomName;

    /**
     * @var string
     */
    private $roomDescription;

    /**
     * @var string
     */
    private $roomImageUrl;

    /**
     * @var int
     */
    private $weeklyPrice;

    /**
     * @var int
     */
    private $monthlyPrice;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var bool
     */
    private $offline;

    private $paymentItems;


    public function __construct(string $referenceId, string $client, \DateTimeImmutable $checkIn, \DateTimeImmutable $checkOut, string $roomName, string $roomDescription, string $roomImageUrl, int $weeklyPrice, int $monthlyPrice, string $currency, bool $offline, $paymentItems)
    {

        \Assert\Assert::lazy()
            ->that($referenceId)->notNull()->string()
            ->that($client)->notNull()->string()
            ->that($checkIn->format(self::dateFormat))->date( self::dateFormat)
            ->that($checkOut->format(self::dateFormat))->date(self::dateFormat)->greaterThan($checkIn->format(self::dateFormat))
            ->that($roomImageUrl)->url()
            ->that($roomName)->notNull()
            ->that($currency)->notNull()
            ->that($offline)->notNull()
            ->that($paymentItems)->isArray()->notEmpty()
            ->verifyNow();

        $this->referenceId = $referenceId;
        $this->client = $client;
        $this->checkIn = $checkIn;
        $this->checkOut = $checkOut;
        $this->roomName = $roomName;
        $this->roomDescription = $roomDescription;
        $this->roomImageUrl = $roomImageUrl;
        $this->weeklyPrice = $weeklyPrice;
        $this->monthlyPrice = $monthlyPrice;
        $this->currency = $currency;
        $this->offline = $offline;


        $this->paymentItems = array_map(function($pI){
            return new PaymentItem($pI["amount"],$pI["title"],$pI["description"], $pI["vat"] ?? 0);
        }, $paymentItems);

        $this->amount = array_sum(array_map(function($pI){
            return $pI->getAmount();
        },$this->paymentItems));
    }

    public function getReferenceId(): string
    {
        return $this->referenceId;
    }

    public function getClient(): string
    {
        return $this->client;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCheckIn(): \DateTimeImmutable
    {
        return $this->checkIn;
    }

    public function getCheckOut(): \DateTimeImmutable
    {
        return $this->checkOut;
    }

    public function getRoomName(): string
    {
        return $this->roomName;
    }

    public function getRoomDescription(): string
    {
        return $this->roomDescription;
    }

    public function getRoomImageUrl(): string
    {
        return $this->roomImageUrl;
    }

    public function getWeeklyPrice(): int
    {
        return $this->weeklyPrice;
    }

    public function getMonthlyPrice(): int
    {
        return $this->monthlyPrice;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function isOffline(): bool
    {
        return $this->offline;
    }



    public static function fromArray(array $data): self
    {
        return new self(
            $data[self::REFERENCE],
            $data[self::CLIENT],
            $data[self::CHECKIN],
            $data[self::CHECKOUT],
            $data[self::ROOM_NAME],
            $data[self::ROOM_DESC],
            $data[self::ROOM_IMAGE],
            $data[self::WEEKLY_PRICE],
            $data[self::MONTHLY_PRICE],
            $data[self::CURRENCY],
            $data[self::OFFLINE],
            $data[self::PAYMENT_ITEMS]
        );
    }

    public function toArray(): array
    {
        return [
            self::REFERENCE => $this->referenceId,
            self::CLIENT => $this->client,
            self::AMOUNT => $this->amount,
            self::CHECKIN => $this->checkIn->format(self::dateFormat),
            self::CHECKOUT => $this->checkOut->format(self::dateFormat),
            self::ROOM_NAME => $this->roomName,
            self::ROOM_DESC => $this->roomDescription,
            self::ROOM_IMAGE => $this->roomImageUrl,
            self::WEEKLY_PRICE => $this->weeklyPrice,
            self::MONTHLY_PRICE => $this->monthlyPrice,
            self::CURRENCY => $this->currency,
            self::OFFLINE => $this->offline,
            self::PAYMENT_ITEMS => array_map(function($paymentItem){
                return $paymentItem->toArray();
            }, $this->paymentItems)
        ];
    }

    public function getPaymentItems()
    {
        return $this->paymentItems;
    }

}
