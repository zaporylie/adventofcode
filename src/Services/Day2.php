<?php

namespace zaporylie\adventofcode\Services;

class Day2 extends DayBase
{

    /**
    * Solves first puzzle.
    */
    public function first($input) : int
    {
        $counts = array_map(function($box) { return array_unique(array_filter(array_count_values(str_split($box)), function ($stat) { return in_array($stat, [2, 3]); }));}, $input);
        $tmp = [];
        foreach (array_filter($counts) as $count) {
            $tmp = array_merge($tmp, array_values($count));
        }
        $tmp = array_count_values($tmp);
        return array_product($tmp);
    }

    /**
     * Solves second puzzle.
     */
    public function second($input) : string
    {
        $common = '';
        do {
            $comparable = array_shift($input);
            foreach ($input as $value) {
                $tmp = $this->compare($comparable, $value);
                if (strlen($tmp) > strlen($common)) {
                    $common = $tmp;
                }
            }
        } while (count($input));
        return $common;
    }

    /**
     * Find common part of two strings.
     */
    protected function compare(string $a, string $b) : string
    {
        return implode(array_intersect_assoc(str_split($a), str_split($b)));
    }

}
