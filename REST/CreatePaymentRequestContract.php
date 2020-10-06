<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


interface CreatePaymentRequestContract
{
    public function getAmount(): int;

    public function getCheckIn(): \DateTimeImmutable;

    public function getCheckOut(): \DateTimeImmutable;

    public function getTotal(): int;

    public function getRoomName(): string;

    public function getRoomDescription(): string;

    public function getRoomImageUrl(): string;

    public function getWeeklyPrice(): int;

    public function getMonthlyPrice(): int;

    public static function fromArray(array $data);

    public function toArray(): array;
}