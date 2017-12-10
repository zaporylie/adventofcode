<?php

namespace App\Utils;

class DayFourService
{
    /**
     * @param string $input
     * @return bool
     */
    public function hasDuplicates(string $input) : bool
    {
        return count(array_unique(explode(' ', $input))) !== count(explode(' ', $input));
    }

    /**
     * @param string $input
     * @return bool
     */
    public function hasAnagrams(string $input) : bool
    {
        return $this->hasDuplicates(implode(' ', array_map([$this, 'sortLetters'], explode(' ', $input))));
    }

    /**
     * @param string $input
     * @return string
     */
    protected function sortLetters(string $input) : string
    {
        $input = str_split($input);
        asort($input);
        return implode('', $input);
    }
}
