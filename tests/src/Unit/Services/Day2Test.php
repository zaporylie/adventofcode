<?php

namespace zaporylie\adventofcode\Tests\Unit\Services;

use PHPUnit\Framework\TestCase;
use zaporylie\adventofcode\Services\Day2;

class Day2Test extends TestCase
{

  /**
   * @var \zaporylie\adventofcode\Services\Day2
   */
  protected $service;

  protected function setUp() {
    parent::setUp();
    $this->service = new Day2();
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
            [['abcdef', 'bababc', 'abbcde', 'abcccd', 'aabcdd', 'abcdee', 'ababab'], 12],
            [array_map(function ($val) { return str_replace("\n", "", $val); }, file(__DIR__.'/../../../../input/day2.txt', FILE_SKIP_EMPTY_LINES)), 5928],
        ];
    }

    /**
     * @return array
     */
    public function secondData()
    {
        return [
            [['abcde', 'fghij', 'klmno', 'pqrst', 'fguij', 'axcye', 'wvxyz'], 'fgij'],
            [array_map(function ($val) { return str_replace("\n", "", $val); }, file(__DIR__.'/../../../../input/day2.txt', FILE_SKIP_EMPTY_LINES)), 'bqlporuexkwzyabnmgjqctvfs'],
        ];
  }
}
