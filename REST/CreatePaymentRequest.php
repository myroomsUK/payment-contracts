<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;

use Myrooms\Payment\Contracts\REST\CreatePaymentRequestContract;

class CreatePaymentRequest implements CreatePaymentRequestContract
{
    private const dateFormat = 'Y-m-d';

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

    public function __construct(int $amount, \DateTimeImmutable $checkIn, \DateTimeImmutable $checkOut, int $total, string $roomName, string $roomDescription, string $roomImageUrl, int $weeklyPrice, int $monthlyPrice)
    {

        \Assert\Assert::lazy()->that($amount)->notNull()->integer()
            ->that($total)->integer()
            ->that($checkIn)->date( self::dateFormat)
            ->that($checkOut)->date(self::dateFormat)->greaterThan($checkIn)
            ->that($roomImageUrl)->url()
            ->that($roomName)->notNull()->verifyNow();

        $this->amount = $amount;
        $this->checkIn = $checkIn;
        $this->checkOut = $checkOut;
        $this->total = $total;
        $this->roomName = $roomName;
        $this->roomDescription = $roomDescription;
        $this->roomImageUrl = $roomImageUrl;
        $this->weeklyPrice = $weeklyPrice;
        $this->monthlyPrice = $monthlyPrice;
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

    public static function fromArray(array $data): self
    {
        return new self(
          $data['amount'],
          $data['checkin'],
          $data['checkout'],
          $data['total'],
          $data['roomName'],
          $data['roomDescription'],
          $data['roomImageURl'],
          $data['weeklyPrice'],
          $data['monthlyPrice']
        );
    }

    public function toArray(): array
    {
        return [
            'amount' => $this->amount,
            'checkin' => $this->checkIn->format(self::dateFormat),
            'checkout' => $this->checkOut->format(self::dateFormat),
            'total' => $this->total,
            'roomName' => $this->roomName,
            'roomDescription' => $this->roomDescription,
            'roomImageUrl' => $this->roomImageUrl,
            'weeklyPrice' => $this->weeklyPrice,
            'monthlyPrice' => $this->monthlyPrice
        ];
    }



}