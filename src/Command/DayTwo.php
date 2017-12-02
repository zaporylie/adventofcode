<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;

/**
 * Class DayTwo
 * @package App\Command
 */
class DayTwo extends Command
{
    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
          ->setName('app:day:two')
          ->setDescription('Runs second task')
          ->addArgument('filepath')
          ->addOption('input', null, InputOption::VALUE_OPTIONAL, 'Provide data directly');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if ($filepath = $input->getArgument('filepath')) {
            $fh = fopen($filepath, 'r');
            $data = [];
            while ($line = fgetcsv($fh, 0, "\t")) {
                $data[] = $line;
            }
        } elseif ($data = $input->getOption('input')) {
            // Use data directly.
        } else {
            throw new \InvalidArgumentException('Missing input');
        }
        $output->write($this->checksum($data));
    }

    /**
     * @param int[][] $input
     * @return int
     */
    protected function checksum(array $input) : int
    {
        $checksum = 0;
        for ($i = 0; $i < count($input); $i++) {
            $checksum += $this->getLineChecksum($input[$i]);
        }
        return $checksum;
    }

    /**
     * @param array $line
     * @return int
     */
    protected function getLineChecksum(array $line) : int
    {
        return max($line) - min($line);
    }

}
