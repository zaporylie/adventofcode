<?php

namespace App\Utils;

class DayFive
{
    /**
     * @param array $line
     * @return int
     *   Number of steps required to process line.
     */
    public function processLine(array $line, callable $processor = null) : int
    {
        if (!isset($processor)) {
            $processor = [$this, 'increaseByOne'];
        }
        $pointer = $i = 0;
        while (isset($line[$pointer])) {
            $value = $line[$pointer];
            $line[$pointer] = $processor($line[$pointer], $value);
            $pointer += $value;
            $i++;
        }
        return $i;
    }

    /**
     * @param int $input
     * @param int $value
     * @return int
     */
    public static function increaseByOne(int $input, int $value) : int
    {
        return $input + 1;
    }

    /**
     * @param int $input
     * @param int $value
     * @return int
     */
    public static function decreaseByOneIfMoreEqualThanThree(int $input, int $value) : int
    {
        return ($value >= 3) ? $input - 1 : self::increaseByOne($input, $value);
    }
}
