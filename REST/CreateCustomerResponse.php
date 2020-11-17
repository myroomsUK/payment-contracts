<?php


namespace Myrooms\Payment\Contracts\REST;


class CreateCustomerResponse implements CreateCustomerResponseContract
{

    private const EMAIL = "email";
    private const CUSTOMER_ID = "customerId";
    private const OFFLINE_PAYMENT_SETUP_URL = "offlinePaymentSetupUrl";

    /**
     * @var string
     */
    private $customerId;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $offlinePaymentSetupUrl;

    public function __construct(string $customerId, string $email, string $offlinePaymentSetupUrl){
        \Assert\Assert::lazy()
            ->that($email)->notNull()->email()
            ->that($customerId)->notNull()
            ->that($offlinePaymentSetupUrl)->notNull()->url()
            ->verifyNow();

        $this->email = $email;
        $this->customerId = $customerId;
        $this->offlinePaymentSetupUrl = $offlinePaymentSetupUrl;
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
        return new self($data[self::CUSTOMER_ID], $data[self::EMAIL], $data[self::OFFLINE_PAYMENT_SETUP_URL]);
    }

    public function toArray(): array
    {
        return [
            self::CUSTOMER_ID => $this->customerId,
            self::EMAIL => $this->email,
            self::OFFLINE_PAYMENT_SETUP_URL => $this->offlinePaymentSetupUrl
        ];
    }


}