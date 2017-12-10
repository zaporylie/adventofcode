<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DayOneExtra
 * @package App\Command
 */
class DayOneExtraCommand extends DayOneCommand
{

    protected static $defaultName = 'app:day:one:extra';
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setDescription('Runs first extra task')
            ->addArgument('input', InputArgument::REQUIRED);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write($this->service->executeExtra($input->getArgument('input')));
    }
}
