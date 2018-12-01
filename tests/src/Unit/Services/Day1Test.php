<?php

namespace zaporylie\adventofcode\Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use zaporylie\adventofcode\Services\Day1;

class Day1Test extends TestCase
{

  /**
   * @var \zaporylie\adventofcode\Services\Day1
   */
  protected $service;

  protected function setUp() {
    parent::setUp();
    $this->service = new Day1();
  }

  /**
   * Tests silver task.
   *
   * @dataProvider firstData
   */
  public function testFirst(array $steps, $expected) {
    $this->assertEquals($expected, $this->service->first($steps));
  }

    /**
     * Tests gold task.
     *
     * @dataProvider secondData
     */
    public function testSecond(array $steps, $expected) {
        $this->assertEquals($expected, $this->service->second($steps));
    }

  /**
   * @return array
   */
  public function firstData()
  {
      return [
          [[+1, -2, +3, +1], 3],
          [[+1, +1, +1], 3],
          [[+1, +1, -2], 0],
          [[-1, -2, -3], -6],
          [array_map(function ($val) { return (int) $val; }, file(__DIR__.'/../../../../input/day1.txt', FILE_SKIP_EMPTY_LINES)), 599],
      ];
  }

    /**
     * @return array
     */
    public function secondData()
    {
      return [
          [[+1, -2, +3, +1], 2],
          [[+1, -1], 0],
          [[+3, +3, +4, -2, -4], 10],
          [[-6, +3, +8, +5, -6], 5],
          [[+7, +7, -2, -7, -4], 14],
          [array_map(function ($val) { return (int) $val; }, file(__DIR__.'/../../../../input/day1.txt', FILE_SKIP_EMPTY_LINES)), 81204],
      ];
  }
}
