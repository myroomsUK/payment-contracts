<?php


class CreatePaymentRequest
{

    private $paymentRequestDTO;

    public static function createFromDTO(PaymentRequestDTO $paymentRequestDTO){
        return new self($paymentRequestDTO);
    }


    private function __construct(PaymentRequestDTO $paymentRequestDTO)
    {
        $this->paymentRequestDTO = $paymentRequestDTO;
    }

    public function toJson(){
        return $this->paymentRequestDTO->jsonSerialize();
    }



}