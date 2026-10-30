<?php

namespace App\Support;

use InvalidArgumentException;

class Money
{
    /**
     * Convert a decimal amount string to integer minor units.
     *
     * @param string $amount The amount in major currency units.
     * @param int $decimalPlaces The currency's number of decimal places.
     */
    public static function toMinorUnits(
        string $amount,
        int $decimalPlaces = 2,
    ): int {
        if ($decimalPlaces < 0 || $decimalPlaces > 3) {
            throw new InvalidArgumentException(
                'Decimal places must be between 0 and 3.'
            );
        }

        if (! preg_match('/^\d+(?:\.\d+)?$/', $amount)) {
            throw new InvalidArgumentException(
                'Amount must be a non-negative decimal number.'
            );
        }

        [$whole, $fraction] = array_pad(
            explode('.', $amount, 2),
            2,
            ''
        );

        if (strlen($fraction) > $decimalPlaces) {
            throw new InvalidArgumentException(
                'Amount has more decimal places than the currency allows.'
            );
        }

        $fraction = str_pad($fraction, $decimalPlaces, '0');

        return ((int) $whole * (10 ** $decimalPlaces)) + (int) ($fraction === '' ? '0' : $fraction);
    }
}
