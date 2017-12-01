<?php

namespace App\Tests\Command;

use App\Command\DayOne;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Console\Tester\CommandTester;

/**
 * Class DayOneTest
 * @package App\Tests\Command
 */
class DayOneTest extends KernelTestCase
{
    /**
     * Tests command execution.
     */
    public function testExecute()
    {
        $kernel = self::bootKernel();
        $application = new Application($kernel);

        $application->add(new DayOne());

        $command = $application->find('app:day:one');
        $commandTester = new CommandTester($command);

        // Test example 1.
        $commandTester->execute(['input' => 1122]);
        $output = $commandTester->getDisplay();
        $this->assertEquals('3', $output);

        // Test example 2.
        $commandTester->execute(['input' => 1111]);
        $output = $commandTester->getDisplay();
        $this->assertEquals('4', $output);

        // Test example 3.
        $commandTester->execute(['input' => 1234]);
        $output = $commandTester->getDisplay();
        $this->assertEquals('0', $output);

        // Test example 4.
        $commandTester->execute(['input' => 91212129]);
        $output = $commandTester->getDisplay();
        $this->assertEquals('9', $output);
    }
}
