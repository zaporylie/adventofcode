<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Utils\DayTenService;

class DayTenCommand extends Command
{
    protected static $defaultName = 'app:day:ten';

    /**
     * @var \App\Utils\DayTenService
     */
    protected $service;

    /**
     * {@inheritdoc}
     */
    public function __construct(DayTenService $service)
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
            ->addArgument('input', InputArgument::REQUIRED)
            // ->addArgument('filepath')
            // ->addOption('input', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Provide data directly')
            ->setDescription('Runs tenth task.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $answer = $this->service->execute($input->getArgument('input')); // @todo: Provide input.
        $io->success($answer);
    }
}
