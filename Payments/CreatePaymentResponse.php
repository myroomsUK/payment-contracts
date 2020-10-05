<?php


class CreatePaymentResponse
{
    private $createPaymentResponseDTO;

    public static function createFromDTO(CreatePaymentResponseDTO $createPaymentResponseDTO){
        return new self($createPaymentResponseDTO);
    }

    private function __construct(CreatePaymentResponseDTO $createPaymentResponseDTO)
    {
        $this->createPaymentResponseDTO = $createPaymentResponseDTO;
    }

    public function toJson(){
        return $this->createPaymentResponseDTO->jsonSerialize();
    }

}