<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Class DayOneExtra
 * @package App\Command
 */
class DayOneExtra extends DayOne
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('app:day:one:extra')
            ->setDescription('Runs first extra task')
            ->addArgument('input', InputArgument::REQUIRED);
    }

    /**
     * @param string $input
     * @return int
     */
    protected function calculate(string $input) : int
    {
        $array = array_map('intval', str_split($input));
        $sum = $i = 0;
        do {
            $new_last = array_shift($array);
            $array[] = $new_last;
            $array = array_values($array);
            if ($array[0] === $array[(int) round(count($array)/2)]) {
                $sum += $array[0];
            }
            $i++;
        } while ($i < count($array));
        return $sum;
    }
}
