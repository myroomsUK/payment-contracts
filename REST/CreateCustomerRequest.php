<?php


namespace Myrooms\Payment\Contracts\REST;


class CreateCustomerRequest implements CreateCustomerRequestContract
{
    private const EMAIL = "email";
    private const CLIENT = "client";

    /**
     * @var string
     */
    private $email;

    public function __construct(string $email){
        \Assert\Assert::lazy()
            ->that($email)->notNull()->email()
            ->verifyNow();

        $this->email = $email;
    }

    public function getEmail(): string
    {
        return $this->email;
    }


    public static function fromArray(array $data)
    {
        return new self($data[self::EMAIL]);
    }

    public function toArray(): array
    {
        return [
            self::EMAIL => $this->email
        ];
    }
}
