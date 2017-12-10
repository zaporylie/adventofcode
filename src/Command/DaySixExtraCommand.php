<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Utils\DaySixService;

class DaySixExtraCommand extends Command
{
    protected static $defaultName = 'app:day:six:extra';

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
            ->setDescription('Runs sixth extra task.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $answer = $this->service->executeExtra($input->getArgument('input'));
        $io->success($answer);
    }
}
