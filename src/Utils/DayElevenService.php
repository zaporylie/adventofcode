<?php

namespace App\Utils;

class DayElevenService
{

    protected $nulls = [
        'n' => 's',
        's' => 'n',
        'ne' =>'sw',
        'sw' => 'ne',
        'nw' => 'se',
        'se' => 'nw',
    ];

    protected $combines = [
        'n' => ['ne', 'nw'],
        's' => ['se', 'sw'],
        'se' => ['s', 'ne'],
        'ne' => ['n', 'se'],
        'nw' => ['n', 'sw'],
        'sw' => ['s', 'nw'],
    ];

    /**
     * @param string $input
     * @return int
     */
    public function execute(string $input) : int
    {
        // Normalize input.
        $input = str_replace(PHP_EOL, '', $input);
        $path = explode(',', $input);
        return $this->calculateDistance($path);
    }

    /**
     * @param string $input
     * @return int
     */
    public function executeExtra(string $input) : int
    {
        // Normalize input.
        $input = str_replace(PHP_EOL, '', $input);
        $path = explode(',', $input);
        $max = 0;
        for ($i = 1; $i <= count($path); $i++) {
            $max = max($max, $this->calculateDistance(array_slice($path, 0, $i)));
        }
        return $max;
    }

    /**
     * @param $path
     * @return int
     */
    protected function calculateDistance($path) : int
    {
        $path = array_count_values($path);
        // Remove back&theres.
        foreach (array_keys($path) as $direction) {
            if (!isset($this->nulls[$direction]) || !isset($path[$this->nulls[$direction]])) {
                continue;
            }
            $common = min($path[$direction], $path[$this->nulls[$direction]]);
            $path[$direction] -= $common;
            $path[$this->nulls[$direction]] -= $common;
        }
        // Combine uncombined.
        foreach ($this->combines as $direction => $combine) {
            if (empty($path[$combine[0]]) || empty($path[$combine[1]])) {
                continue;
            }
            $common = min($path[$combine[0]], $path[$combine[1]]);
            $path[$direction] = ($path[$direction] ?? 0) + $common;
            $path[$combine[0]] -= $common;
            $path[$combine[1]] -= $common;
        }
        return array_sum($path);
    }
}
