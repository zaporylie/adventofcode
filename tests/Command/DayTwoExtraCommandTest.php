<?php

namespace App\Tests\Command;

use App\Command\DayTwoExtraCommand;
use App\Utils\DayTwoService;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class DayTwoExtraTest
 * @package App\Tests\Command
 */
class DayTwoExtraCommandTest extends KernelTestCase
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

        $application->add(new DayTwoExtraCommand(new DayTwoService()));

        $command = $application->find('app:day:two:extra');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['--input' => $input]);
        $this->assertEquals($output, $commandTester->getDisplay());
    }

    /**
     * Valid test data.
     */
    public function getValidTestData()
    {
        yield ["5\t9\t2\t8
9\t4\t7\t3
3\t8\t6\t5", 9];
    }
}
