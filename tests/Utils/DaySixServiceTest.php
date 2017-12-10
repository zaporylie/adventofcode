<?php

namespace App\Tests\Utils;

use App\Utils\DaySixService;
use PHPUnit\Framework\TestCase;

/**
 * Class DaySixServiceTest * @package App\Tests\Utils
 */
class DaySixServiceTest extends TestCase
{
    /**
     * Tests day 6 task.
     *
     * @param array $input
     * @param int $expected
     *
     * @dataProvider validData
     */
    public function testExecute(array $input, int $expected)
    {
        $service = new DaySixService();
        $this->assertEquals($expected, $service->execute($input));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield [[0, 2, 7, 0], 5];
    }

    /**
     * Tests day 6 extra task.
     *
     * @param array $input
     * @param int $expected
     *
     * @dataProvider validExtraData
     */
    public function testExecuteExtra(array $input, int $expected)
    {
        $service = new DaySixService();
        $this->assertEquals($expected, $service->executeExtra($input));
    }

    /**
     * Extra test data.
     *
     * @return \Generator
     */
    public function validExtraData()
    {
        yield [[0, 2, 7, 0], 4];
    }

}
