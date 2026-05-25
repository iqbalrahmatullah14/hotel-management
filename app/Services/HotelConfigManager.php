<?php

namespace App\Services;

class HotelConfigManager
{
    private static ?HotelConfigManager $instance = null;
    private float $taxRate;
    private int $cancellationHours;
    private float $cancellationFee;
    private string $hotelName;
    private string $hotelAddress;

    private function __construct()
    {
        $this->loadConfig();
    }

    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    private function loadConfig(): void
    {
        $this->taxRate = config('hotel.tax_rate', 0.11);
        $this->cancellationHours = config('hotel.cancellation_hours', 24);
        $this->cancellationFee = config('hotel.cancellation_fee', 0.5);
        $this->hotelName = config('hotel.name', 'Hotel');
        $this->hotelAddress = config('hotel.address', 'Jl. Contoh No. 1');
    }

    // Getters
    public function getTaxRate(): float
    {
        return $this->taxRate;
    }
    public function getHotelName(): string
    {
        return $this->hotelName;
    }
    public function getHotelAddress(): string
    {
        return $this->hotelAddress;
    }
    public function getCancellationHours(): int
    {
        return $this->cancellationHours;
    }
    public function getCancellationFee(): float
    {
        return $this->cancellationFee;
    }

    // Hitung pajak dari amount
    public function calculateTax(float $amount): float
    {
        return $amount * $this->taxRate;
    }

    // Cek apakah booking masih bisa dibatalkan
    public function isCancellable(\DateTime $checkInDate): bool
    {
        $hoursUntilCheckIn = now()->diffInHours($checkInDate, false);
        return $hoursUntilCheckIn >= $this->cancellationHours;
    }
}
