<?php

namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Finder\Finder;
use App\Utils\DayFour as DayFourService;

/**
 * Class DayFour
 * @package App\Command
 */
class DayFourCommand extends Command
{
    /**
     * @var \App\Utils\DayFour
     */
    protected $dayFour;

    public function __construct(DayFourService $dayFour)
    {
        $this->dayFour = $dayFour;
        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
          ->setName('app:day:four')
          ->setDescription('Runs fourth task')
            ->addArgument('filepath')
            ->addOption('input', null, InputOption::VALUE_OPTIONAL, 'Provide data directly');
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
        $sum = 0;
        foreach (explode(PHP_EOL, $data) as $string) {
            if (empty($string)) {
                continue;
            }
            $sum += (int) !$this->dayFour->hasDuplicates($string);
        };
        $output->write($sum);
    }

}
