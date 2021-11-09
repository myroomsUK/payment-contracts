<?php


namespace Myrooms\Payment\Contracts\REST;


class CreateCustomerResponse implements CreateCustomerResponseContract
{

    private const EMAIL = "email";
    private const CUSTOMER_ID = "customerId";

    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $email;


    public function __construct(string $customerId, string $email){
        \Assert\Assert::lazy()
            ->that($email)->notNull()->email()
            ->that($customerId)->notNull()
            ->verifyNow();

        $this->email = $email;
        $this->customerId = $customerId;
    }

    public function getCustomerId(): string
    {
        return $this->customerId;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getOfflinePaymentSetupUrl(): string
    {
        return $this->offlinePaymentSetupUrl;
    }

    public static function fromArray(array $data)
    {
        return new self($data[self::CUSTOMER_ID], $data[self::EMAIL]);
    }

    public function toArray(): array
    {
        return [
            self::CUSTOMER_ID => $this->customerId,
            self::EMAIL => $this->email,
        ];
    }


}
