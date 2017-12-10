<?php

namespace App\Tests\Command;

use App\Command\DayOneExtraCommand;
use App\Utils\DayOneService;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class DayOneExtraTest
 * @package App\Tests\Command
 */
class DayOneExtraCommandTest extends KernelTestCase
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

        $application->add(new DayOneExtraCommand(new DayOneService()));

        $command = $application->find('app:day:one:extra');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['input' => $input]);
        $this->assertEquals($output, $commandTester->getDisplay());
    }

    /**
     * Valid test data.
     */
    public function getValidTestData()
    {
        yield ['1212', '6'];
        yield ['1221', '0'];
        yield ['123425', '4'];
        yield ['123123', '12'];
        yield ['12131415', '4'];
    }
}
