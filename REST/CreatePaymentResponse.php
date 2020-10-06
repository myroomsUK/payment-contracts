<?php
declare(strict_types=1);
namespace Myrooms\Payment\Contracts\REST;

class CreatePaymentResponse implements CreatePaymentResponseContract
{
    private const URL = 'url';
    private const ULID = 'ulid';

    /**
     * @var string
     */
    private $url;

    /**
     * @var string
     */
    private $ulid;


    public function __construct(string $url, string $ulid)
    {
        \Assert\Assert::lazy()->that($url)->url()
            ->that($ulid)->notNull()->verifyNow();;

        $this->url = $url;
        $this->ulid = $ulid;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getUlid(): string
    {
        return $this->ulid;
    }


    public function toArray(): array
    {
        return [
            self::URL => $this->url,
            self::ULID => $this->ulid
        ];
    }

    public static function fromArray(array $data): self
    {
        return new self($data[self::URL], $data[self::ULID]);
    }

}