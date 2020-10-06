<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


class Endpoint
{
    /**
     * @var string
     */
    private $uri;

    /**
     * @var string
     */
    private $method;

    public function __construct(string $uri, string $method)
    {
        $this->uri = $uri;
        $this->method = $method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }


    public function getMethod(): string
    {
        return $this->method;
    }



}