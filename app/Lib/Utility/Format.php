<?php

declare (strict_types = 1);

namespace App\Lib\Utility;

class Format {

    public function romanNumerals(int $num): string
    {
        $n = intval($num);
        $res = '';

        /*** roman_numerals array  ***/
        $roman_numerals = array(
            'M'  => 1000,
            'CM' => 900,
            'D'  => 500,
            'CD' => 400,
            'C'  => 100,
            'XC' => 90,
            'L'  => 50,
            'XL' => 40,
            'X'  => 10,
            'IX' => 9,
            'V'  => 5,
            'IV' => 4,
            'I'  => 1);

        foreach ($roman_numerals as $roman => $number)
        {
            /*** divide to get  matches ***/
            $matches = intval($n / $number);

            /*** assign the roman char * $matches ***/
            $res .= str_repeat($roman, $matches);

            /*** substract from the number ***/
            $n = $n % $number;
        }

        /*** return the res ***/
        return $res;
    }

    public function dateDiffInWeeks(string $date1, string $date2): int
    {
        if($date1 > $date2) return $this->dateDiffInWeeks($date2, $date1);
        $datetime1 = date_create($date1);
        $datetime2 = date_create($date2);
        $interval = date_diff($datetime1, $datetime2);
        return intval($interval->days/7);
    }

    public function percentage(float $val1, float $val2, float $precision): float {
        $res = 0;
        if(!empty($val1) && !empty($val2)) {
            $res = round( ($val1 / $val2) * 100, $precision );
        }
        return $res;
    }
}
