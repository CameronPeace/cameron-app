<?php

namespace App\Services;


class PinCodes
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
   public function generatePinCodes($total = 20, $minLength = 4, $maxLength = 7)
   {
        $batch = [];

        $numbers = range($minLength, $maxLength);

        $index = array_rand($numbers, 1);
        $code = $this->generateSingleCode($numbers[$index]);

        for($i = 0; $i < $total; $i++) {

            $index = array_rand($numbers, 1);

            // create a new pincode until its unique. 
            while (in_array($code, $batch)) {
                $code = $this->generateSingleCode($numbers[$index]);
            }

            $batch[] = $code;
        }

        \Log::info($batch);
        return $batch;
   }

   /**
    * Generate a pin code.
    *
    * @param int $maxLength
    *
    * @return string $pinCode
    */
   public function generateSingleCode(int $maxLength)
   {
        $code = [];
        
        // Create each int individually so we can have zeros.
        for($k = 0; $k < $maxLength; $k++) {
            $code[] = rand(0, 9);
        } 

        return implode('', $code);
   }
}
