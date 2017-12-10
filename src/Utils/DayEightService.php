<?php

namespace App\Utils;

class DayEightService
{

    const INC = 1;
    const DEC = -1;

    /**
     * @var int[]
     */
    protected $registry;

    /**
     * @param string $input
     * @return int
     */
    public function execute(string $input) : int
    {
        foreach (array_filter(explode(PHP_EOL, $input)) as $line) {
            $line = explode(' ', $line);
            $this->runInstruction(
                $line[0],
                $line[1] == 'inc' ? self::INC : self::DEC,
                $line[2],
                $line[4],
                $line[5],
                $line[6]
            );
        }
        return max($this->registry);
    }

    public function runInstruction(string $register, int $direction, int $value, string $compare_to, string $comparator, string $compare_value) : self
    {
        $this->registry[$register] = $this->registry[$register] ?? 0;
        if (self::compare($this->registry[$compare_to] ?? 0, $compare_value, $comparator)) {
            $this->registry[$register] += $direction * $value;
        }
        return $this;
    }

    public static function compare($value1, $value2, $operator) : bool
    {
        switch ($operator) {
            case '>':
                return $value1 > $value2;
            case '==':
                return $value1 == $value2;
            case '>=':
                return $value1 >= $value2;
            case '<':
                return $value1 < $value2;
            case '<=':
                return $value1 <= $value2;
            case '!=':
                return $value1 != $value2;
            default:
                throw new \InvalidArgumentException('Unknown operator ' . $operator);
        }
    }

    /**
     * @param string $input
     * @return int
     */
    public function executeExtra(string $input) : int
    {
        $max = 0;
        foreach (array_filter(explode(PHP_EOL, $input)) as $line) {
            $line = explode(' ', $line);
            $this->runInstruction(
                $line[0],
                $line[1] == 'inc' ? self::INC : self::DEC,
                $line[2],
                $line[4],
                $line[5],
                $line[6]
            );
            $max = max($this->registry) > $max ? max($this->registry) : $max;
        }
        return $max;
    }
}
