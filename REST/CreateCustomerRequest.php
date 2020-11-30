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

    /**
     * @var string
     */
    private $client;

    public function __construct(string $email, string $client){
        \Assert\Assert::lazy()
            ->that($email)->notNull()->email()
            ->that($client)->notNull()->inArray(Client::CLIENTS)
            ->verifyNow();

        $this->email = $email;
        $this->client = $client;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getClient(): string
    {
        return $this->client;
    }





    public static function fromArray(array $data)
    {
        return new self($data[self::EMAIL], $data[self::CLIENT]);
    }

    public function toArray(): array
    {
        return [
            self::EMAIL => $this->email,
            self::CLIENT => $this->client
        ];
    }
}