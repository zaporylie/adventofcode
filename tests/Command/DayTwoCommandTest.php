<?php

namespace App\Tests\Command;

use App\Command\DayTwoCommand;
use App\Utils\DayTwoService;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class DayTwoTest
 * @package App\Tests\Command
 */
class DayTwoCommandTest extends KernelTestCase
{
    /**
     * Tests command execution.
     *
     * @dataProvider getValidTestData
     */
    public function testExecute($input, $output)
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $application->add(new DayTwoCommand(new DayTwoService()));

        $command = $application->find('app:day:two');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['--input' => $input]);
        $this->assertEquals($output, $commandTester->getDisplay());
    }

    /**
     * Valid test data.
     */
    public function getValidTestData()
    {
        yield ["5\t1\t9\t5
7\t5\t3
2\t4\t6\t8", 18];
    }
}
