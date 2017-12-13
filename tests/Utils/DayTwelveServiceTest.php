<?php

namespace App\Tests\Utils;

use App\Utils\DayTwelveService;
use PHPUnit\Framework\TestCase;

/**
 * Class DayTwelveServiceTest * @package App\Tests\Utils
 */
class DayTwelveServiceTest extends TestCase
{
    /**
     * Tests day 12 task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validData
     */
    public function testExecute(string $input, int $expected)
    {
        $service = new DayTwelveService();
        $this->assertEquals($expected, $service->execute($input));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield ['0 <-> 2
1 <-> 1
2 <-> 0, 3, 4
3 <-> 2, 4
4 <-> 2, 3, 6
5 <-> 6
6 <-> 4, 5', 6];
    }

    /**
     * Tests day 12 extra task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validExtraData
     */
    public function testExecuteExtra(string $input, int $expected)
    {
        $service = new DayTwelveService();
        $this->assertEquals($expected, $service->executeExtra($input));
    }

    /**
     * Extra test data.
     *
     * @return \Generator
     */
    public function validExtraData()
    {
        yield ['0 <-> 2
1 <-> 1
2 <-> 0, 3, 4
3 <-> 2, 4
4 <-> 2, 3, 6
5 <-> 6
6 <-> 4, 5', 2];
    }

}
