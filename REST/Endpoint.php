<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


class Endpoint
{
    /**
     * @var string
     */
    private $relativePath;

    /**
     * @var string
     */
    private $method;

    public function __construct(string $relativePath, string $method)
    {
        $this->relativePath = $relativePath;
        $this->method = $method;
    }

    public function getRelativePath(): string
    {
        return $this->relativePath;
    }

    public function getUrl(string $baseUrl): string
    {
        return rtrim($baseUrl, '/') . '/' . $this->relativePath;
    }


    public function getMethod(): string
    {
        return $this->method;
    }



}