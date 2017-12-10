<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Utils\DaySixService;

class DaySixCommand extends Command
{
    protected static $defaultName = 'app:day:six';

    /**
     * @var \App\Utils\DaySixService
     */
    protected $service;

    /**
     * {@inheritdoc}
     */
    public function __construct(DaySixService $service)
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
             ->addArgument('input', InputArgument::REQUIRED | InputArgument::IS_ARRAY)
            // ->addArgument('filepath')
            // ->addOption('input', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Provide data directly')
            ->setDescription('Runs sixth task.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write($this->service->execute($input->getArgument('input')));
    }
}
