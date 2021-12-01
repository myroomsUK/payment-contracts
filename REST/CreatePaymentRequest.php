<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;

use Myrooms\Payment\Contracts\REST\CreatePaymentRequestContract;

class CreatePaymentRequest implements CreatePaymentRequestContract
{
    private const REFERENCE = 'referenceId';
    private const CLIENT = 'client';
    private const AMOUNT = 'amount';
    private const CHECKIN = 'checkin';
    private const CHECKOUT = 'checkout';
    private const TOTAL = 'total';
    private const ROOM_NAME = 'roomName';
    private const ROOM_DESC = 'roomDescription';
    private const ROOM_IMAGE = 'roomImageUrl';
    private const WEEKLY_PRICE = 'weeklyPrice';
    private const MONTHLY_PRICE = 'monthlyPrice';
    private const CURRENCY = 'currency';
    private const OFFLINE = 'offline';

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
     * @var int
     */
    private $total;

    /**
     * @var string
     */
    private $roomName;

    /**
     * @var string
     */
    private $roomDescription;

    /**
     * @var string|null
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


    public function __construct(string $referenceId, string $client, $amount, \DateTimeImmutable $checkIn, \DateTimeImmutable $checkOut, int $total, string $roomName, string $roomDescription, ?string $roomImageUrl, int $weeklyPrice, int $monthlyPrice, string $currency, bool $offline)
    {

        \Assert\Assert::lazy()
            ->that($referenceId)->notNull()->string()
            ->that($client)->notNull()->string()
            ->that($amount)->notNull()->integer()
            ->that($total)->integer()
            ->that($checkIn->format(self::dateFormat))->date( self::dateFormat)
            ->that($checkOut->format(self::dateFormat))->date(self::dateFormat)->greaterThan($checkIn->format(self::dateFormat))
            ->that($roomImageUrl)->url()
            ->that($roomName)->notNull()
            ->that($currency)->notNull()
            ->that($offline)->notNull()
            ->verifyNow();

        $this->referenceId = $referenceId;
        $this->client = $client;
        $this->amount = $amount;
        $this->checkIn = $checkIn;
        $this->checkOut = $checkOut;
        $this->total = $total;
        $this->roomName = $roomName;
        $this->roomDescription = $roomDescription;
        $this->roomImageUrl = $roomImageUrl;
        $this->weeklyPrice = $weeklyPrice;
        $this->monthlyPrice = $monthlyPrice;
        $this->currency = $currency;
        $this->offline = $offline;
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

    public function getTotal(): int
    {
        return $this->total;
    }

    public function getRoomName(): string
    {
        return $this->roomName;
    }

    public function getRoomDescription(): string
    {
        return $this->roomDescription;
    }

    public function getRoomImageUrl(): ?string
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
            $data[self::AMOUNT],
            $data[self::CHECKIN],
            $data[self::CHECKOUT],
            $data[self::TOTAL],
            $data[self::ROOM_NAME],
            $data[self::ROOM_DESC],
            $data[self::ROOM_IMAGE],
            $data[self::WEEKLY_PRICE],
            $data[self::MONTHLY_PRICE],
            $data[self::CURRENCY],
            $data[self::OFFLINE]
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
            self::TOTAL => $this->total,
            self::ROOM_NAME => $this->roomName,
            self::ROOM_DESC => $this->roomDescription,
            self::ROOM_IMAGE => $this->roomImageUrl,
            self::WEEKLY_PRICE => $this->weeklyPrice,
            self::MONTHLY_PRICE => $this->monthlyPrice,
            self::CURRENCY => $this->currency,
            self::OFFLINE => $this->offline
        ];
    }



}
