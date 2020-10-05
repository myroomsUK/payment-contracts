<?php


class CreatePaymentRequestDTO implements JsonSerializable
{
    const dateFormat = "";

    private $amount;

    private $checkIn;

    private $checkOut;

    private $total;

    private $roomName;

    private $roomDescription;

    private $roomImageUrl;

    private $weeklyPrice;

    private $monthlyPrice;

    private function __construct($amount, $total, $checkIn, $checkOut, $roomName, $roomDescription, $roomImageUrl, $weeklyPrice, $monthlyPrice )
    {
        \Assert\Assert::lazy()->that($amount)->notNull()->integer()
            ->that($total)->integer()
            ->that($checkIn)->date( CreatePaymentRequest::dateFormat)
            ->that($checkOut)->date(CreatePaymentRequest::dateFormat)->greaterThan($checkIn)
            ->that($roomImageUrl)->url()
            ->that($roomName)->notNull();

        $this->amount = $amount;
        $this->total = $total;
        $this->checkIn = $checkIn;
        $this->checkOut = $checkOut;
        $this->roomName = $roomName;
        $this->roomDescription = $roomDescription;
        $this->roomImageUrl = $roomImageUrl;
        $this->weeklyPrice = $weeklyPrice;
        $this->monthlyPrice = $monthlyPrice;

    }

    public static function createFromNotificationEvent(NotificationEventInterface $notificationEvent): self
    {
        return new self($notificationEvent->getName(), $notificationEvent->getData());
    }

    public function jsonSerialize()
    {
        return [
            'amount' => $this->amount,
            'total' => $this->total,
            'check_in' => $this->checkIn,
            'check_out' => $this->checkOut,
            'room_name' => $this->roomName,
            'room_description' => $this->roomDescription,
            'room_image_url' => $this->roomImageUrl,
            'weekly_price' => $this->weeklyPrice,
            'monthly_price' => $this->monthlyPrice,
        ];
    }
}