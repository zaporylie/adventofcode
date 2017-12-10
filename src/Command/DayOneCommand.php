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
class DayOneCommand extends Command
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
        $sum = $i = 0;
        do {
            $new_last = array_shift($array);
            $array[] = $new_last;
            $array = array_values($array);
            if ($array[0] === $array[$this->findIndex($array)]) {
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
    protected function findIndex(array $array) : int
    {
        return 1;
    }
}
