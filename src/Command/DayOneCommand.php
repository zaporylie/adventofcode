<?php

namespace App\Command;

use App\Utils\DayOneService;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Class DayOne
 * @package App\Command
 */
class DayOneCommand extends Command
{

    protected static $defaultName = 'app:day:one';

    /**
     * @var DayOneService
     */
    protected $service;

    public function __construct(DayOneService $service)
    {
        parent::__construct();
        $this->service = $service;
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
          ->setDescription('Runs first task')
          ->addArgument('input', InputArgument::REQUIRED);
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->write($this->service->execute($input->getArgument('input')));
    }
}
