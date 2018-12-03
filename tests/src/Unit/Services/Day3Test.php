<?php

namespace zaporylie\adventofcode\Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use zaporylie\adventofcode\Services\Day3;

class Day3Test extends TestCase
{

  /**
   * @var \zaporylie\adventofcode\Services\Day3
   */
  protected $service;

  protected function setUp() {
    parent::setUp();
    $this->service = new Day3();
  }

  /**
   * Tests first task.
   *
   * @dataProvider firstData
   */
  public function testFirst(array $steps, $expected) {
    $this->assertEquals($expected, $this->service->first($steps));
  }

    /**
     * Tests second task.
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
            [['#1 @ 1,3: 4x4', '#2 @ 3,1: 4x4', '#3 @ 5,5: 2x2'], 4],
            [array_map(function ($val) { return str_replace("\n", "", $val); }, file(__DIR__.'/../../../../input/day3.txt', FILE_SKIP_EMPTY_LINES)), 104712],
        ];
    }

    /**
     * @return array
     */
    public function secondData()
    {
        return [
            [['#1 @ 1,3: 4x4', '#2 @ 3,1: 4x4', '#3 @ 5,5: 2x2'], 3],
            [array_map(function ($val) { return str_replace("\n", "", $val); }, file(__DIR__.'/../../../../input/day3.txt', FILE_SKIP_EMPTY_LINES)), 840],
        ];
  }
}
