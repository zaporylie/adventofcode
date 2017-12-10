<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use App\Utils\DayFiveService as DayFiveService;

/**
 * Class DayFive
 * @package App\Command
 */
class DayFiveCommand extends Command
{
    /**
     * @var \App\Utils\DayFiveService
     */
    protected $dayFive;

    public function __construct(DayFiveService $dayFive)
    {
        $this->dayFive = $dayFive;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
          ->setName('app:day:five')
          ->setDescription('Runs fifth task')
          ->addArgument('filepath')
          ->addOption('input', null, InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY, 'Provide data directly');
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $data = null;
        if ($filepath = $input->getArgument('filepath')) {
            $data = explode(PHP_EOL, file_get_contents($filepath));
            $data = array_filter($data, 'is_numeric');
        } elseif ($data = $input->getOption('input')) {
            // Use data directly.
        } else {
            throw new \InvalidArgumentException('Missing input');
        }
        $output->write($this->dayFive->processLine($data));
    }

}
