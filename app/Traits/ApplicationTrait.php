<?php

namespace App\Traits;

trait ApplicationTrait
{

    /**
     * @param int $length
     * @return string
     */
    protected function generateRandomAnswers(int $length = 1): string
    {
        $string = ',';

        // Dodaj opcjonalną cyfrę od 1 do 3 na początku
        if (rand(0, 1)) {
            $string .= rand(1, 3);
        }

        if( $length > 1) {
            if( $length > 2 ) {
                // Dodaj opcjonalne powtórzenia przecinka i cyfry od 1 do 3
                for ($i = 0; $i < $length-1; $i++) {
                    $string .= ',';
                    if (rand(0, 1)) {
                        $string .= rand(1, 3);
                    }
                }
            }

            // Dodaj opcjonalną cyfrę od 1 do 3 na końcu
            if (rand(0, 1)) {
                $string .= ',' . rand(1, 3);
            }
        }


        return $string;
    }
}
