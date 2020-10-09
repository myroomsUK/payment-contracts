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
            $data[PaymentRequestField::REFERENCE],
            $data[PaymentRequestField::CLIENT],
            $data[PaymentRequestField::AMOUNT],
            $data[PaymentRequestField::CHECKIN],
            $data[PaymentRequestField::CHECKOUT],
            $data[PaymentRequestField::TOTAL],
            $data[PaymentRequestField::ROOM_NAME],
            $data[PaymentRequestField::ROOM_DESC],
            $data[PaymentRequestField::ROOM_IMAGE],
            $data[PaymentRequestField::WEEKLY_PRICE],
            $data[PaymentRequestField::MONTHLY_PRICE],
            $data[PaymentRequestField::CURRENCY]
        );
    }

    public function toArray(): array
    {
        return [
            PaymentRequestField::REFERENCE => $this->referenceId,
            PaymentRequestField::CLIENT => $this->client,
            PaymentRequestField::AMOUNT => $this->amount,
            PaymentRequestField::CHECKIN => $this->checkIn->format(self::dateFormat),
            PaymentRequestField::CHECKOUT => $this->checkOut->format(self::dateFormat),
            PaymentRequestField::TOTAL => $this->total,
            PaymentRequestField::ROOM_NAME => $this->roomName,
            PaymentRequestField::ROOM_DESC => $this->roomDescription,
            PaymentRequestField::ROOM_IMAGE => $this->roomImageUrl,
            PaymentRequestField::WEEKLY_PRICE => $this->weeklyPrice,
            PaymentRequestField::MONTHLY_PRICE => $this->monthlyPrice,
            PaymentRequestField::CURRENCY => $this->currency
        ];
    }



}