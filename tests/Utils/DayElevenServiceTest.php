<?php

namespace App\Tests\Utils;

use App\Utils\DayElevenService;
use PHPUnit\Framework\TestCase;

/**
 * Class DayElevenServiceTest
 * @package App\Tests\Utils
 */
class DayElevenServiceTest extends TestCase
{
    /**
     * Tests day 11 task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validData
     */
    public function testExecute(string $input, int $expected)
    {
        $service = new DayElevenService();
        $this->assertEquals($expected, $service->execute($input));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield['ne,ne,ne', 3];
        yield['ne,ne,sw,sw', 0];
        yield['ne,ne,s,s', 2];
        yield['se,sw,se,sw,sw', 3];
    }

    /**
     * Tests day 11 extra task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validExtraData
     */
    public function testExecuteExtra(string $input, int $expected)
    {
        $service = new DayElevenService();
        $this->assertEquals($expected, $service->executeExtra($input));
    }

    /**
     * Extra test data.
     *
     * @return \Generator
     */
    public function validExtraData()
    {
        yield['ne,ne,ne', 3];
        yield['ne,ne,sw,sw', 2];
        yield['ne,ne,s,s', 2];
        yield['se,sw,se,sw,sw', 3];
    }

}
