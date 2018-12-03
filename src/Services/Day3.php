<?php

namespace zaporylie\adventofcode\Services;

class Day3 extends DayBase
{
    /**
    * Solves first puzzle.
    */
    public function first($input) : int
    {
        $array = $this->fillMatrix($input);
        return array_sum(
            array_map(function($line) {
                return count(
                    array_filter(
                        $line,
                        function ($item) {
                            return count($item) > 1;
                        })
                );}, $array));
    }

    /**
     * Solves second puzzle.
     */
    public function second($input) : string
    {
        $array = $this->fillMatrix($input);
        // Flatten matrix.
        $claims = [];
        foreach ($array as $x => $lines) {
            foreach ($lines as $y => $claim) {
                $claims[] = $claim;
            }
        }
        // Remove all overlapping and add ids to backlog.
        $backlog = [];
        $claims = array_filter($claims, function ($tmp) use (&$backlog) { return count($tmp) == 1 ? true : !($backlog = array_merge($backlog, $tmp)); });
        $backlog = array_unique($backlog);
        $claims = array_filter(array_column($claims, 0), function ($tmp) use ($backlog) { return !in_array($tmp, $backlog); });
        return array_shift($claims);
    }

    public function readSteps($input) : array
    {
        $tmp = [];
        $input = implode("\n", $input);
        preg_match_all("/#(?<id>\d*)\s@\s(?<x_offset>\d*),(?<y_offset>\d*):\s(?<x>\d*)x(?<y>\d*)/im", $input, $tmp);
        $steps = [];
        foreach ($tmp['id'] as $key => $id) {
            $steps[$id] = [
                'x_offset' => $tmp['x_offset'][$key],
                'y_offset' => $tmp['y_offset'][$key],
                'x' => $tmp['x'][$key],
                'y' => $tmp['y'][$key],
            ];
        }
        return $steps;
    }

    /**
     * @param $input
     * @return mixed
     */
    protected function fillMatrix($input)
    {
        $array = [];
        $steps = $this->readSteps($input);
        foreach ($steps as $id => $step) {
            for ($x = $step['x_offset']; $x < $step['x_offset'] + $step['x']; $x++) {
                for ($y = $step['y_offset']; $y < $step['y_offset'] + $step['y']; $y++) {
                    if (!isset($array[$x][$y])) {
                        $array[$x][$y] = [$id];
                    } else {
                        $array[$x][$y][] = $id;
                    }
                }
            }
        }
        return $array;
    }

}
