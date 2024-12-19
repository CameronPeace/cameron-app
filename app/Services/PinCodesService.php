<?php

namespace App\Services;

class PinCodesService
{
    /**
     * Generate a batch of pincodes.
     *
     * @param int $total
     * @param int $minLength
     * @param int $maxLength
     *
     * @return array<string> $batch
     */
    public function generatePinCodes(int $total = 20, int $minLength = 4, int $maxLength = 7)
    {
        $batch = [];

        // create an array of integers between the desired min and max.
        $numbers = range($minLength, $maxLength);

        // iterate through our total until we have the desired amount of codes.
        for ($i = 0; $i < $total; $i++) {
            // select an random index for our code length.
            $index = array_rand($numbers, 1);
            $pinCode = null;
            $attempts = 0;
            // start populating our batch with unique values until total is met.
            while (in_array($pinCode, $batch) || $pinCode === null) {

                // if we cannot create a unique code in the set amount of tries exit the loop.
                if ($attempts === 10) {
                    break;
                }
                $pinCode = $this->generateSingleCode($numbers[$index]);
                $attempts++;
            }

            $batch[] = $pinCode;
        }

        return $batch;
    }

    /**
     * Generate a pin code at the desired length.
     *
     * @param int $codeLength The desired length of the code.
     *
     * @return string $pinCode
     */
    public function generateSingleCode(int $codeLength)
    {
        $code = [];

        // Create each int individually so we can have zeros.
        for ($k = 0; $k < $codeLength; $k++) {
            $code[] = rand(0, 9);
        }

        return implode('', $code);
    }
}
