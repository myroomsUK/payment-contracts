<?php


namespace Myrooms\Payment\Contracts\REST;


class CreateSimplePaymentRequest implements CreateSimplePaymentRequestContract
{
    private const CURRENCY = "currency";
    private const PAYMENT_ITEMS = 'paymentItems';
    const AMOUNT = "amount";


    /**
     * @var int
     */
    private $amount;

    /**
     * @var string
     */
    private $currency;


    private $paymentItems;

    public function __construct(string $currency, $paymentItems)
    {
        \Assert\Assert::lazy()
            ->that($currency)->notNull()
            ->that($paymentItems)->isArray()->notEmpty();

        $this->currency = $currency;

        $this->paymentItems = array_map(function($pI){
            return new PaymentItem($pI["amount"],$pI["title"],$pI["description"], $pI["vat"] ?? 0);
        }, $paymentItems);

        $this->amount = array_sum(array_map(function($pI){
            return $pI->getAmount();
        },$this->paymentItems));
    }



    public static function fromArray(array $data)
    {
        return new self(
            $data[self::CURRENCY],
            $data[self::PAYMENT_ITEMS]
        );
    }

    public function toArray(): array
    {
        return [
            self::AMOUNT => $this->amount,
            self::CURRENCY => $this->currency,
            self::PAYMENT_ITEMS => array_map(function($paymentItem){
                return $paymentItem->toArray();
            }, $this->paymentItems)
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

    public function getPaymentItems(): array
    {
        return $this->paymentItems;
    }
}
