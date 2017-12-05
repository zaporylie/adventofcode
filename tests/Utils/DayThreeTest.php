<?php

namespace App\Tests\Utils;

use App\Utils\DayThree;
use PHPUnit\Framework\TestCase;

class DayThreeTest extends TestCase
{
    /**
     * Tests shortest distance between two digits in matrix.
     *
     * @param int $number
     * @param $distance
     *
     * @dataProvider validData
     */
    public function testDistance(int $number, $distance)
    {
        $service = new DayThree();
        $service->fillMatrix($number);
        $this->assertEquals($distance, $service->getDistance($number));
    }

    /**
     * @param int $provided
     * @param $written
     *
     * @dataProvider extraValidData
     */
    public function testExtra(int $provided, $written)
    {
        $service = new DayThree();
        $this->assertEquals($written, $service->fillMatrixExtra($provided));
    }

    public function validData()
    {
        yield [1, 0];
        yield [12, 3];
        yield [23, 2];
        yield [1024, 31];
    }

    public function extraValidData()
    {
        yield [1, 2];
        yield [6, 10];
        yield [347991, 349975];
    }
}
