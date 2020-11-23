<?php


namespace Myrooms\Payment\Contracts\REST;


class CreateSimplePaymentRequest implements CreateSimplePaymentRequestContract
{

    private const AMOUNT = "amount";
    private const CURRENCY = "currency";
    private CONST CUSTOMER = "customer";

    /**
     * @var int
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;

    /**
     * @var string
     */
    private $customer;

    public function __construct(int $amount, string $currency, string $customer)
    {
        \Assert\Assert::lazy()->that($amount)->notNull()->integer()
            ->that($currency)->notNull()
            ->that($customer)->notNull()->verifyNow();;

        $this->amount = $amount;
        $this->currency = $currency;
        $this->customer = $customer;
    }



    public static function fromArray(array $data)
    {
        return new self(
            $data[self::AMOUNT],
            $data[self::CURRENCY],
            $data[self::CUSTOMER]
        );
    }

    public function toArray(): array
    {
        return [
            self::AMOUNT => $this->amount,
            self::CURRENCY => $this->currency,
            self::CUSTOMER => $this->customer
            ];
    }

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function getCustomer(): string
    {
        return $this->customer;
    }
}