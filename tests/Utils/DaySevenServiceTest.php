<?php

namespace App\Tests\Utils;

use App\Utils\DaySevenService;
use PHPUnit\Framework\TestCase;

/**
 * Class DaySevenServiceTest * @package App\Tests\Utils
 */
class DaySevenServiceTest extends TestCase
{
    /**
     * Tests day 7 task.
     *
     * @param string $input
     * @param string $expected
     *
     * @dataProvider validData
     */
    public function testExecute(string $input, string $expected)
    {
        $service = new DaySevenService();
        $this->assertEquals($expected, $service->execute($input));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function validData()
    {
        yield ['pbga (66)
xhth (57)
ebii (61)
havc (66)
ktlj (57)
fwft (72) -> ktlj, cntj, xhth
qoyq (66)
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
jptl (61)
ugml (68) -> gyxo, ebii, jptl
gyxo (61)
cntj (57)', 'tknk'];
    }

    /**
     * Tests day 7 extra task.
     *
     * @param string $input
     * @param int $expected
     *
     * @dataProvider validExtraData
     */
    public function testExecuteExtra(string $input, int $expected)
    {
        $service = new DaySevenService();
        $this->assertEquals($expected, $service->executeExtra($input));
    }

    /**
     * Extra test data.
     *
     * @return \Generator
     */
    public function validExtraData()
    {
        yield ['pbga (66)
xhth (57)
ebii (61)
havc (66)
ktlj (57)
fwft (72) -> ktlj, cntj, xhth
qoyq (66)
padx (45) -> pbga, havc, qoyq
tknk (41) -> ugml, padx, fwft
jptl (61)
ugml (68) -> gyxo, ebii, jptl
gyxo (61)
cntj (57)', 60];
    }

}
