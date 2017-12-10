<?php

namespace App\Tests\Utils;

use App\Utils\DayFourService;
use PHPUnit\Framework\TestCase;

/**
 * Class DayFourTest
 * @package App\Tests\Utils
 */
class DayFourTest extends TestCase
{
    /**
     * Tests duplicates in string.
     *
     * @param string $passphrase
     * @param bool $has_duplicates
     *
     * @dataProvider duplicatesData
     */
    public function testDuplicates(string $passphrase, bool $has_duplicates)
    {
        $service = new DayFourService();
        $this->assertEquals($has_duplicates, $service->hasDuplicates($passphrase));
    }

    /**
     * Tests anagrams in string.
     *
     * @param string $passphrase
     * @param bool $has_anagrams
     *
     * @dataProvider duplicatesData
     */
    public function testAnagrams(string $passphrase, bool $has_anagrams)
    {
        $service = new DayFourService();
        $this->assertEquals($has_anagrams, $service->hasAnagrams($passphrase));
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function duplicatesData()
    {
        yield ['aa bb cc dd ee', false];
        yield ['aa bb cc dd aa', true];
        yield ['aa bb cc dd aaa', false];
    }

    /**
     * Test data.
     *
     * @return \Generator
     */
    public function anagramsData()
    {
        yield ['abcde fghij', false];
        yield ['abcde xyz ecdab', true];
        yield ['a ab abc abd abf abj', false];
        yield ['iiii oiii ooii oooi oooo', false];
        yield ['oiii ioii iioi iiio', true];
    }

}
