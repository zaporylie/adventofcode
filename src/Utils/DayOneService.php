<?php

namespace App\Utils;

class DayOneService
{
    public function execute(string $input) : int
    {
        return $this->calculate(array_map('intval', str_split($input)), [self::class, 'findIndex']);
    }

    public function executeExtra(string $input) : int
    {
        return $this->calculate(array_map('intval', str_split($input)), [self::class, 'findIndexExtra']);
    }

    public static function calculate(array $array, callable $findIndex) : int
    {
        $sum = $i = 0;
        do {
            $new_last = array_shift($array);
            $array[] = $new_last;
            $array = array_values($array);
            if ($array[0] === $array[$findIndex($array)]) {
                $sum += $array[0];
            }
            $i++;
        } while ($i < count($array));
        return $sum;
    }

    /**
     * @param array $array
     * @return int
     */
    public static function findIndex(array $array) : int
    {
        return 1;
    }

    /**
     * @param array $array
     * @return int
     */
    public static function findIndexExtra(array $array) : int
    {
        return (int) round(count($array)/2);
    }

}
