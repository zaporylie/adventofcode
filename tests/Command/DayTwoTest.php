<?php

namespace App\Tests\Command;

use App\Command\DayTwo;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class DayTwoTest
 * @package App\Tests\Command
 */
class DayTwoTest extends KernelTestCase
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

        $application->add(new DayTwo());

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
        yield [[
            [5, 1, 9, 5],
            [7, 5, 3],
            [2, 4, 6, 8],
        ], 18];
    }
}
