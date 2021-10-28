<?php


namespace Myrooms\Payment\Contracts\REST;


class PaymentItem
{
    const AMOUNT = "amount";
    const TITLE = "title";
    const DESCRIPTION = "description";
    const VAT = "vat";

    private int $amount;

    private string $title;

    private string  $description;

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

    public function toArray(){
        return [
            self::AMOUNT => $this->amount,
            self::TITLE => $this->title,
            self::DESCRIPTION => $this->description,
            self::VAT => $this->vat,
        ];
    }
}
