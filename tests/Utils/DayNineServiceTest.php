<?php

namespace App\Tests\Utils;

use App\Utils\DayNineService;
use PHPUnit\Framework\TestCase;

/**
 * Class DayNineServiceTest * @package App\Tests\Utils
 */
class DayNineServiceTest extends TestCase
{
    /**
     * Tests day 9 task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validData
     */
    public function testExecute(string $input, int $expected)
    {
        $service = new DayNineService();
        $this->assertEquals($expected, $service->execute($input));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield ['{}', 1];
        yield ['{{{}}}',6];
        yield ['{{},{}}', 5];
        yield ['{{{},{},{{}}}}', 16];
        yield ['{<a>,<a>,<a>,<a>}', 1];
        yield ['{{<ab>},{<ab>},{<ab>},{<ab>}}', 9];
        yield ['{{<!!>},{<!!>},{<!!>},{<!!>}}', 9];
        yield ['{{<a!>},{<a!>},{<a!>},{<ab>}}', 3];
    }

    /**
     * Tests day 9 extra task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validExtraData
     */
    public function testExecuteExtra(string $input, int $expected)
    {
        $service = new DayNineService();
        $this->assertEquals($expected, $service->executeExtra($input));
    }

    /**
     * Extra test data.
     *
     * @return \Generator
     */
    public function validExtraData()
    {
        yield ['<>', 0];
        yield ['<random characters>', 17];
        yield ['<<<<>', 3];
        yield ['<{!>}>', 2];
        yield ['<!!>', 0];
        yield ['<!!!>>', 0];
        yield ['<{o"i!a,<{i<a>', 10];
    }

}
