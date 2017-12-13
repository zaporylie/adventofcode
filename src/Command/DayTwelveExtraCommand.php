<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Utils\DayTwelveService;

class DayTwelveExtraCommand extends Command
{
    protected static $defaultName = 'app:day:twelve:extra';

    /**
     * @var \App\Utils\DayTwelveService
     */
    protected $service;

    /**
     * {@inheritdoc}
     */
    public function __construct(DayTwelveService $service)
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
            // ->addArgument('input', InputArgument::REQUIRED)
            ->addArgument('filepath')
            ->addOption('input', null, InputOption::VALUE_OPTIONAL, 'Provide data directly')
            ->setDescription('Runs twelfth extra task.');
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
        $answer = $this->service->executeExtra($data); // @todo: Provide input.
        $io->success($answer);
    }
}
