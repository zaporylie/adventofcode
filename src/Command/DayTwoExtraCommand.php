<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputOption;

/**
 * Class DayTwoExtra
 * @package App\Command
 */
class DayTwoExtraCommand extends DayTwoCommand
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
          ->setName('app:day:two:extra')
          ->setDescription('Runs second extra task')
          ->addArgument('filepath')
          ->addOption('input', null, InputOption::VALUE_OPTIONAL, 'Provide data directly');
    }

    /**
     * @param array $line
     * @return int
     */
    protected function getLineChecksum(array $line) : int
    {
        for ($i = 0; $i < count($line); $i++) {
            for ($j = 0; $j < count($line); $j++) {
                if ($i === $j) {
                    continue;
                }
                if (!($line[$i] % $line[$j])) {
                    return $line[$i] / $line[$j];
                }
            }
        }
        throw new \LogicException('Unable to find evenly divisible values.');
    }

}
