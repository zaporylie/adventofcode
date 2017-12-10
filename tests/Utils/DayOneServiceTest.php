<?php

namespace App\Tests\Utils;

use App\Utils\DayOneService;
use PHPUnit\Framework\TestCase;

/**
 * Class DayOneServiceTest
 * @package App\Tests\Utils
 */
class DayOneServiceTest extends TestCase
{
    /**
     * Tests day 1 task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validData
     */
    public function testExecute(string $input, int $expected)
    {
        $service = new DayOneService();
        $this->assertEquals($expected, $service->execute($input));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield ['1122', 3];
        yield ['1111', 4];
        yield ['1234', 0];
        yield ['91212129', 9];
    }

    /**
     * Tests day 1 extra task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validExtraData
     */
    public function testExecuteExtra(string $input, int $expected)
    {
        $service = new DayOneService();
        $this->assertEquals($expected, $service->executeExtra($input));
    }

    /**
     * Extra test data.
     *
     * @return \Generator
     */
    public function validExtraData()
    {

        yield ['1212', 6];
        yield ['1221', 0];
        yield ['123425', 4];
        yield ['123123', 12];
        yield ['12131415', 4];
    }

}
