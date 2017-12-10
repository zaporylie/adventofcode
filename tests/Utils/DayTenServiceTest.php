<?php

namespace App\Tests\Utils;

use App\Utils\CircularList;
use App\Utils\DayTenService;
use PHPUnit\Framework\TestCase;

/**
 * Class DayTenServiceTest
 * @package App\Tests\Utils
 */
class DayTenServiceTest extends TestCase
{
    /**
     * Tests day 10 task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validData
     */
    public function testExecute(string $input, int $expected)
    {
        $list = CircularList::createFrom([0, 1, 2, 3, 4]);
        $service = new DayTenService($list);
        $this->assertEquals($expected, $service->execute($input));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield ['3,4,1,5', 12];
    }

    /**
     * Tests day 10 extra task.
     *
     * @param string $input
     * @param string $expected
     *
     * @dataProvider validExtraData
     */
    public function testExecuteExtra(string $input, string $expected)
    {
        $service = new DayTenService(new CircularList());
        $this->assertEquals($expected, $service->executeExtra($input));
    }

    /**
     * Extra test data.
     *
     * @return \Generator
     */
    public function validExtraData()
    {
        yield ['', 'a2582a3a0e66e6e86e3812dcb672a272'];
        yield ['AoC 2017', '33efeb34ea91902bb2f59c9920caa6cd'];
        yield ['1,2,3', '3efbe78a8d82f29979031a4aa0b16a9d'];
        yield ['1,2,4', '63960835bcdc130f0b66d7ff4f6a5a8e'];
    }

    public function testArrayXor()
    {
        $this->assertEquals(DayTenService::arrayXor([65, 27, 9, 1, 4, 3, 40, 50, 91, 7, 6, 0, 2, 5, 68, 22]), 64);
    }

}
