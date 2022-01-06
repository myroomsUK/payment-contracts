<?php


namespace Myrooms\Payment\Contracts\REST;

use OpenApi\Annotations as OA;

class PaymentItem
{
    const AMOUNT = "amount";
    const TITLE = "title";
    const DESCRIPTION = "description";
    const VAT = "vat";

    /**
     * @var int
     * @OA\Property(type="int", description="Payment item net value in cents")
     */
    private int $amount;

    /**
     * @var string
     * @OA\Property(type="string", maxLength=255, description="Payment item title")
     */
    private string $title;

    /**
     * @var string
     * @OA\Property(type="string", maxLength=255, description="Payment item description")
     */
    private string  $description;

    /**
     * @var int
     * @OA\Property(type="int", description="Payment item VAT: integer value, e.g. 20")
     */
    private int $vat;


    public function __construct($amount, $title, $description, $vat = 0){
        \Assert\Assert::lazy()
            ->that($amount)->notNull()->integer()
            ->that($title)->notNull()->string()
            ->that($description)->string()
            ->that($vat)->notNull()->integer()
            ->verifyNow();
        $this->amount = $amount;
        $this->title = $title;
        $this->description = $description;
        $this->vat =$vat;
    }

    public function getAmount(): int
    {
        return $this->amount + ($this->amount*$this->vat)/100;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return int
     */
    public function getVat(): int
    {
        return $this->vat;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    public function toArray(){
        return [
            self::AMOUNT => $this->amount,
            self::TITLE => $this->title,
            self::DESCRIPTION => $this->description,
            self::VAT => $this->vat,
        ];
    }
}
