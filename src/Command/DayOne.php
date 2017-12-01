<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DayOne
 * @package App\Command
 */
class DayOne extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
          ->setName('app:day:one')
          ->setDescription('Runs first task')
          ->addArgument('input', InputArgument::REQUIRED);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write($this->calculate($input->getArgument('input')));
    }

    /**
     * @param string $input
     * @return int[]
     */
    protected function calculate(string $input) : int
    {
        $array = array_map('intval', str_split($input));
        $sum = 0;
        for ($i = 0; $i < count($array); $i++)
        {
            if ($i === 0) {
                $previous = $array[count($array) - 1];
            } else {
                $previous = $array[$i - 1];
            }
            if ($previous === $array[$i]) {
                $sum += $array[$i];
            }
        }
        return $sum;
    }
}
