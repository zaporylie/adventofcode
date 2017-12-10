<?php

namespace App\Tests\Command;

use App\Command\DayTwoExtraCommand;
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

        $application->add(new DayTwoExtraCommand());

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
        yield [[
            [5, 9, 2, 8],
            [9, 4, 7, 3],
            [3, 8, 6, 5],
        ], 9];
    }
}
