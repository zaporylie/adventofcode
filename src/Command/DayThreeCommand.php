<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use App\Utils\DayThree as DayThreeService;

/**
 * Class DayThree
 * @package App\Command
 */
class DayThreeCommand extends Command
{
    /**
     * @var \App\Utils\DayThree
     */
    protected $service;

    public function __construct(DayThreeService $dayThree)
    {
        $this->service = $dayThree;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
          ->setName('app:day:three')
          ->setDescription('Runs third task')
          ->addArgument('number', InputArgument::REQUIRED, 'Max number to be located in matrix');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->service->fillMatrix($input->getArgument('number'));
        if ($output->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE) {
            $this->printMatrix($output);
        }
        $output->write($this->service->getDistance($input->getArgument('number')));
    }

    /**
     * Helper method which prints matrix to output.
     *
     * @param OutputInterface $output
     */
    protected function printMatrix(OutputInterface $output) : void
    {
        $matrix = $this->service->getMatrix();
        $leftpad = strlen((string) pow(count($matrix), 2));
        for ($i = min(array_keys($matrix)); $i <= max(array_keys($matrix)); $i++) {
            for ($j = min(array_keys($matrix[$i])); $j < max(array_keys($matrix[$i])); $j++) {
                $output->write(str_pad(isset($matrix[$i][$j]) ? $matrix[$i][$j] : null, $leftpad, '_'));
            }
            $output->writeln('');
        }
    }
}
