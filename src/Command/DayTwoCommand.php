<?php

namespace App\Command;

use App\Utils\DayTwoService;
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
class DayTwoCommand extends Command
{

    protected static $defaultName = 'app:day:two';

    protected $service;

    public function __construct(DayTwoService $service)
    {
        $this->service = $service;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
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
            $data = file_get_contents($filepath);
        } elseif ($data = $input->getOption('input')) {
            // Use data directly.
        } else {
            throw new \InvalidArgumentException('Missing input');
        }
        $output->write($this->service->execute($data));
    }

}
