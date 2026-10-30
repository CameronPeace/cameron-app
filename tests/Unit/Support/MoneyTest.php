<?php

namespace Tests\Unit\Support;

use App\Support\Money;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    #[DataProvider('amounts')]
    public function test_it_converts_amounts_to_minor_units(
        string $amount,
        int $decimalPlaces,
        int $expected,
    ): void {
        $this->assertSame(
            $expected,
            Money::toMinorUnits($amount, $decimalPlaces)
        );
    }

    public static function amounts(): array
    {
        return [
            'USD with cents' => ['25.50', 2, 2550],
            'KWD with three decimals' => ['25.125', 3, 25125],
            'JPY with no decimals' => ['25', 0, 25],
            'one decimal place padded for USD' => ['25.5', 2, 2550],
            'whole amount with three decimals' => ['25', 3, 25000],
        ];
    }
}
