<?php

namespace App\Tests\Command;

use App\Command\DayOneExtra;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class DayOneExtraTest
 * @package App\Tests\Command
 */
class DayOneExtraTest extends KernelTestCase
{
    /**
     * Tests command execution.
     */
    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $application->add(new DayOneExtra());

        $command = $application->find('app:day:one:extra');
        $commandTester = new CommandTester($command);

        // Test example 1.
        $commandTester->execute(['input' => 1212]);
        $output = $commandTester->getDisplay();
        $this->assertEquals('6', $output);

        // Test example 2.
        $commandTester->execute(['input' => 1221]);
        $output = $commandTester->getDisplay();
        $this->assertEquals('0', $output);

        // Test example 3.
        $commandTester->execute(['input' => 123425]);
        $output = $commandTester->getDisplay();
        $this->assertEquals('4', $output);

        // Test example 4.
        $commandTester->execute(['input' => 123123]);
        $output = $commandTester->getDisplay();
        $this->assertEquals('12', $output);

        // Test example 5.
        $commandTester->execute(['input' => 12131415]);
        $output = $commandTester->getDisplay();
        $this->assertEquals('4', $output);
    }
}
