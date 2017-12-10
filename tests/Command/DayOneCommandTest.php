<?php

namespace App\Tests\Command;

use App\Command\DayOneCommand;
use App\Utils\DayOneService;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class DayOneTest
 * @package App\Tests\Command
 */
class DayOneCommandTest extends KernelTestCase
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

        $application->add(new DayOneCommand(new DayOneService()));

        $command = $application->find('app:day:one');
        $commandTester = new CommandTester($command);
        $commandTester->execute(['input' => $input]);
        $this->assertEquals($output, $commandTester->getDisplay());
    }

    /**
     * Valid test data.
     */
    public function getValidTestData()
    {
        yield ['1122', '3'];
        yield ['1111', '4'];
        yield ['1234', '0'];
        yield ['91212129', '9'];
    }
}
