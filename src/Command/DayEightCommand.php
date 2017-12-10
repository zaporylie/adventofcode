<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Utils\DayEightService;

class DayEightCommand extends Command
{
    protected static $defaultName = 'app:day:eight';

    /**
     * @var \App\Utils\DayEightService
     */
    protected $service;

    /**
     * {@inheritdoc}
     */
    public function __construct(DayEightService $service)
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
            // ->addArgument('input', InputArgument::REQUIRED | InputArgument::IS_ARRAY)
            ->addArgument('filepath')
            ->addOption('input', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Provide data directly')
            ->setDescription('Runs eighth task.');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = null;
        if ($filepath = $input->getArgument('filepath')) {
            $data = file_get_contents($filepath);
        } elseif ($data = $input->getOption('input')) {
            // Use data directly.
        } else {
            throw new \InvalidArgumentException('Missing input');
        }
        $io = new SymfonyStyle($input, $output);
        $answer = $this->service->execute($data); // @todo: Provide input.
        $io->success($answer);
    }
}
