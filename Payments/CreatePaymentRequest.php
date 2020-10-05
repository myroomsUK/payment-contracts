<?php


class CreatePaymentRequest
{
    const dateFormat = "";
    private static $instance;

    public static function createFromJson($json){

        $parameters = json_decode($json, true);
        return self::$instance = new CreatePaymentRequest($parameters);
    }

    private function __construct($parameters)
    {

        \Assert\Assert::that($parameters["amount"])->notNull()->integer();
        \Assert\Assertion::date($parameters["check_in"], CreatePaymentRequest::dateFormat);
        \Assert\Assert::that($parameters["check_out"])->date(CreatePaymentRequest::dateFormat)->greaterThan($parameters["check_out"]);
        \Assert\Assert::that($parameters["room_image_url"])->url();
        \Assert\Assert::that($parameters["room_name"])->notNull();

        $this->amount = $parameters["amount"];
        $this->checkIn = $parameters["check_in"];
        $this->checkOut = $parameters["check_out"];
        $this->roomName = $parameters["room_name"];
        $this->roomDescription = $parameters["room_description"];
        $this->roomImageUrl = $parameters["room_image_url"];
        $this->weeklyPrice = $parameters["weekly_price"];
        $this->monthlyPrice = $parameters["monthly_price"];

        return $this;
    }



    private $amount;

    private $checkIn;

    private $checkOut;

    private $roomName;

    private $roomDescription;

    private $roomImageUrl;

    private $weeklyPrice;

    private $monthlyPrice;


    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    /**
     * @return mixed
     */
    public function getCheckIn()
    {
        return $this->checkIn;
    }

    /**
     * @param mixed $checkIn
     */
    public function setCheckIn($checkIn)
    {
        $this->checkIn = $checkIn;
    }

    /**
     * @return mixed
     */
    public function getCheckOut()
    {
        return $this->checkOut;
    }

    /**
     * @param mixed $checkOut
     */
    public function setCheckOut($checkOut)
    {
        $this->checkOut = $checkOut;
    }

    /**
     * @return mixed
     */
    public function getRoomName()
    {
        return $this->roomName;
    }

    /**
     * @param mixed $roomName
     */
    public function setRoomName($roomName)
    {
        $this->roomName = $roomName;
    }

    /**
     * @return mixed
     */
    public function getRoomDescription()
    {
        return $this->roomDescription;
    }

    /**
     * @param mixed $roomDescription
     */
    public function setRoomDescription($roomDescription)
    {
        $this->roomDescription = $roomDescription;
    }

    /**
     * @return mixed
     */
    public function getRoomImageUrl()
    {
        return $this->roomImageUrl;
    }

    /**
     * @param mixed $roomImageUrl
     */
    public function setRoomImageUrl($roomImageUrl)
    {
        $this->roomImageUrl = $roomImageUrl;
    }



    /**
     * @return mixed
     */
    public function getWeeklyPrice()
    {
        return $this->weeklyPrice;
    }

    /**
     * @param mixed $weeklyPrice
     */
    public function setWeeklyPrice($weeklyPrice)
    {
        $this->weeklyPrice = $weeklyPrice;
    }

    /**
     * @return mixed
     */
    public function getMonthlyPrice()
    {
        return $this->monthlyPrice;
    }

    /**
     * @param mixed $monthlyPrice
     */
    public function setMonthlyPrice($monthlyPrice)
    {
        $this->monthlyPrice = $monthlyPrice;
    }


}