<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputArgument;

/**
 * Class DayOneExtra
 * @package App\Command
 */
class DayOneExtraCommand extends DayOneCommand
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
     * @param array $array
     * @return int
     */
    protected function findIndex(array $array) : int
    {
        return (int) round(count($array)/2);
    }
}
