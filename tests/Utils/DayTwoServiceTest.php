<?php

namespace App\Tests\Utils;

use App\Utils\DayTwoService;
use PHPUnit\Framework\TestCase;

/**
 * Class DayTwoServiceTest
 * @package App\Tests\Utils
 */
class DayTwoServiceTest extends TestCase
{
    /**
     * Tests day 2 task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validData
     */
    public function testExecute(string $input, int $expected)
    {
        $service = new DayTwoService();
        $this->assertEquals($expected, $service->execute($input));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield ["5\t1\t9\t5
7\t5\t3
2\t4\t6\t8", 18];
    }

    /**
     * Tests day 2 extra task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validExtraData
     */
    public function testExecuteExtra(string $input, int $expected)
    {
        $service = new DayTwoService();
        $this->assertEquals($expected, $service->executeExtra($input));
    }

    /**
     * Extra test data.
     *
     * @return \Generator
     */
    public function validExtraData()
    {
        yield ["5\t9\t2\t8
9\t4\t7\t3
3\t8\t6\t5", 9];
    }

}
