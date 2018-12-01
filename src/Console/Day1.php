<?php

namespace zaporylie\adventofcode\Console;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Day1 extends Command
{

  protected $dayService;

  public function __construct($name = NULL, \zaporylie\adventofcode\Services\Day1 $dayService) {
    parent::__construct($name);
    $this->dayService = $dayService;
  }

  public function execute(InputInterface $input, OutputInterface $output) {
    $output->writeln("Works!");
  }
}
