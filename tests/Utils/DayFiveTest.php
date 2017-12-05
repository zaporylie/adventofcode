<?php

namespace App\Tests\Utils;

use App\Utils\DayFive;
use PHPUnit\Framework\TestCase;

/**
 * Class DayFiveTest
 * @package App\Tests\Utils
 */
class DayFiveTest extends TestCase
{
    /**
     * Tests number of steps in incremental line.
     *
     * @param int[] $line
     * @param int $number_of_steps
     * @param callable $processor
     *
     * @dataProvider validData
     */
    public function testLine(array $line, int $number_of_steps, callable $processor = null)
    {
        $service = new DayFive();
        $this->assertEquals($number_of_steps, $service->processLine($line, $processor));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield [[0, 3,  0, 1, -3], 5];
        yield [[0, 3,  0, 1, -3], 5, [DayFive::class, 'increaseByOne']];
        yield [[0, 3,  0, 1, -3], 10, [DayFive::class, 'decreaseByOneIfMoreEqualThanThree']];
    }

}
