<?php

namespace App\Utils;

class DayTwoService
{

    /**
     * @param string $input
     * @return int
     */
    public function execute(string $input) : int
    {
        $data = [];
        foreach (explode(PHP_EOL, $input) as $line) {
            $data[] = str_getcsv($line, "\t");
        }
        return $this->checksum($data, [$this, 'getLineChecksum']);
    }

    /**
     * @param string $input
     * @return int
     */
    public function executeExtra(string $input) : int
    {

        $data = [];
        foreach (explode(PHP_EOL, $input) as $line) {
            $data[] = str_getcsv($line, "\t");
        }
        return $this->checksum($data, [$this, 'getLineChecksumExtra']);
    }

    /**
     * @param int[][] $input
     * @return int
     */
    protected function checksum(array $input, callable $callback) : int
    {
        $checksum = 0;
        for ($i = 0; $i < count($input); $i++) {
            $checksum += $callback($input[$i]);
        }
        return $checksum;
    }

    /**
     * @param array $line
     * @return int
     */
    protected function getLineChecksum(array $line) : int
    {
        return max($line) - min($line);
    }



    /**
     * @param array $line
     * @return int
     */
    protected function getLineChecksumExtra(array $line) : int
    {
        for ($i = 0; $i < count($line); $i++) {
            for ($j = 0; $j < count($line); $j++) {
                if ($i === $j) {
                    continue;
                }
                if (!($line[$i] % $line[$j])) {
                    return $line[$i] / $line[$j];
                }
            }
        }
        throw new \LogicException('Unable to find evenly divisible values.');
    }
}
