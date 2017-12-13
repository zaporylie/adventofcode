<?php

namespace App\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DayTwoExtra
 * @package App\Command
 */
class DayTwoExtraCommand extends DayTwoCommand
{
    protected static $defaultName = 'app:day:two:extra';

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
          ->setDescription('Runs second extra task')
          ->addArgument('filepath')
          ->addOption('input', null, InputOption::VALUE_OPTIONAL, 'Provide data directly');
    }


    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($filepath = $input->getArgument('filepath')) {
            $data = file_get_contents($filepath);
        } elseif ($data = $input->getOption('input')) {
            // Use data directly.
        } else {
            throw new \InvalidArgumentException('Missing input');
        }
        $output->write($this->service->executeExtra($data));
    }

}
