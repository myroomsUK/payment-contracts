<?php


class CreatePaymentResponseDTO implements JsonSerializable
{
    private $url;
    private $ulid;

    private function __construct($url, $ulid){
        \Assert\Assert::lazy()->that($url)->url()
            ->that($ulid)->notNull();

        $this->url = $url;
        $this->ulid = $ulid;
    }



    public function jsonSerialize()
    {
        return [
            'url'=>$this->url,
            'ulid'=>$this->ulid
            ];
    }
}