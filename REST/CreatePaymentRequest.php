<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;

use OpenApi\Annotations as OA;

class CreatePaymentRequest implements CreatePaymentRequestContract
{
    private const REFERENCE = 'referenceId';
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
     * @OA\Property(type="string", maxLength=255, description="Parameter that might be used as an external parameter ")
     */
    private $referenceId;

    /**
     * @var int
     * @OA\Property(type="int", description="Total amount to be paid in cents, e.g. 200 $ = 20000")
     */
    private $amount;

    /**
     * @var \DateTimeImmutable
     * @OA\Property(type="date", description="Start date of the tenancy. Format: Y-m-d, e.g. 2021-12-30")
     */
    private $checkin;

    /**
     * @var \DateTimeImmutable
     * @OA\Property(type="date", description="End date of the tenancy. Format: Y-m-d, e.g. 2021-12-30")
     */
    private $checkout;

    /**
     * @var string
     * @OA\Property(type="string", maxLength=255, description="Room listing title")
     */
    private $roomName;

    /**
     * @var string
     * @OA\Property(type="string", maxLength=255, description="Room listing description")
     */
    private $roomDescription;

    /**
     * @var string|null
     * @OA\Property(type="string", maxLength=255, description="Room listing image url", nullable=true)
     */
    private $roomImageUrl;

    /**
     * @var int
     * @OA\Property(type="int", description="Weekly price of the room in cents, e.g. 200 $ = 20000")
     */
    private $weeklyPrice;

    /**
     * @var int
     * @OA\Property(type="int", description="Monthly price of the room in cents, e.g. 200 $ = 20000")
     */
    private $monthlyPrice;

    /**
     * @var string
     * @OA\Property(type="string", description="Currency, e.g. GBP")
     */
    private $currency;

    /**
     * @var bool
     * @OA\Property(type="bool", description="If offline is false, money is captured immediately. If offline is true, the user authorizes a payment that needs to be captured later on through the Accept endpoint or rejeceted")
     */
    private $offline;

    /**
     * @var PaymentItem[]
     */
    private $paymentItems;


    public function __construct(string $referenceId, \DateTimeImmutable $checkin, \DateTimeImmutable $checkout, string $roomName, string $roomDescription, ?string $roomImageUrl, int $weeklyPrice, int $monthlyPrice, string $currency, bool $offline, $paymentItems)
    {

        \Assert\Assert::lazy()
            ->that($referenceId)->notNull()->string()
            ->that($checkin->format(self::dateFormat))->date( self::dateFormat)
            ->that($checkout->format(self::dateFormat))->date(self::dateFormat)->greaterThan($checkin->format(self::dateFormat))
            ->that($roomImageUrl)->nullOr()->url()
            ->that($roomName)->notNull()
            ->that($currency)->notNull()
            ->that($offline)->notNull()
            ->that($paymentItems)->isArray()->notEmpty()
            ->verifyNow();

        $this->referenceId = $referenceId;
        $this->checkin = $checkin;
        $this->checkout = $checkout;
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

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCheckin(): \DateTimeImmutable
    {
        return $this->checkin;
    }

    public function getCheckout(): \DateTimeImmutable
    {
        return $this->checkout;
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
            self::AMOUNT => $this->amount,
            self::CHECKIN => $this->checkin->format(self::dateFormat),
            self::CHECKOUT => $this->checkout->format(self::dateFormat),
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
