<?php

namespace App\Tests\Utils;

use App\Utils\DayEightService;
use PHPUnit\Framework\TestCase;

/**
 * Class DayEightServiceTest * @package App\Tests\Utils
 */
class DayEightServiceTest extends TestCase
{
    /**
     * Tests day 8 task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validData
     */
    public function testExecute(string $input, int $expected)
    {
        $service = new DayEightService();
        $this->assertEquals($expected, $service->execute($input));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield ['b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10', 1];
    }

    /**
     * Tests day 8 extra task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validExtraData
     */
    public function testExecuteExtra(string $input, int $expected)
    {
        $service = new DayEightService();
        $this->assertEquals($expected, $service->executeExtra($input));
    }

    /**
     * Extra test data.
     *
     * @return \Generator
     */
    public function validExtraData()
    {
        yield ['b inc 5 if a > 1
a inc 1 if b < 5
c dec -10 if a >= 1
c inc -20 if c == 10', 10];
    }

}
