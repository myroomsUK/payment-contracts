<?php
declare(strict_types=1);

namespace Myrooms\Payment\Contracts\REST;


interface CreatePaymentRequestContract
{
    public function getReferenceId(): string;

    public function getAmount(): int;

    public function getCheckIn(): \DateTimeImmutable;

    public function getCheckOut(): \DateTimeImmutable;

    public function getCurrency(): string;

    public function getRoomName(): string;

    public function getRoomDescription(): string;

    public function getRoomImageUrl(): ?string;

    public function getWeeklyPrice(): int;

    public function getMonthlyPrice(): int;

    public function isOffline(): bool;

    public static function fromArray(array $data);

    public function toArray(): array;
}
