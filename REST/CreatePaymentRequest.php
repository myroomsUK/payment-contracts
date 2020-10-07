<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;

use Myrooms\Payment\Contracts\REST\CreatePaymentRequestContract;

class CreatePaymentRequest implements CreatePaymentRequestContract
{
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


    public function __construct(string $referenceId, string $client, $amount, \DateTimeImmutable $checkIn, \DateTimeImmutable $checkOut, int $total, string $roomName, string $roomDescription, string $roomImageUrl, int $weeklyPrice, int $monthlyPrice, string $currency)
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

    public static function fromArray(array $data): self
    {
        return new self(
            $data[RequestField::REFENRECE],
            $data[RequestField::CLIENT],
            $data[RequestField::AMOUNT],
            $data[RequestField::CHECKIN],
            $data[RequestField::CHECKOUT],
            $data[RequestField::TOTAL],
            $data[RequestField::ROOM_NAME],
            $data[RequestField::ROOM_DESC],
            $data[RequestField::ROOM_IMAGE],
            $data[RequestField::WEEKLY_PRICE],
            $data[RequestField::MONTHLY_PRICE],
            $data[RequestField::CURRENCY]
        );
    }

    public function toArray(): array
    {
        return [
            RequestField::REFENRECE => $this->referenceId,
            RequestField::CLIENT => $this->client,
            RequestField::AMOUNT => $this->amount,
            RequestField::CHECKIN => $this->checkIn->format(self::dateFormat),
            RequestField::CHECKOUT => $this->checkOut->format(self::dateFormat),
            RequestField::TOTAL => $this->total,
            RequestField::ROOM_NAME => $this->roomName,
            RequestField::ROOM_DESC => $this->roomDescription,
            RequestField::ROOM_IMAGE => $this->roomImageUrl,
            RequestField::WEEKLY_PRICE => $this->weeklyPrice,
            RequestField::MONTHLY_PRICE => $this->monthlyPrice,
            RequestField::CURRENCY => $this->currency
        ];
    }



}