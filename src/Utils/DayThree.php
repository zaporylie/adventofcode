<?php

namespace App\Utils;

class DayThree
{
    /**
     * @var array
     */
    protected $matrix;

    /**
     * @return array
     */
    public function getMatrix() : array
    {
        return $this->matrix;
    }

    public function fillMatrix(int $max) : void
    {
        $edge = 1;
        $size = 1;
        $current_coordinates = new MatrixAddress(0, 0);
        $current_value = 1;
        $this->setMatrixValue($current_coordinates, $current_value);
        $directions = (array) $this->directions();
        while ($size <= $max) {
            $edge += 2;
            $iterations = ($edge - 1) * 4;
            $start_value = pow($edge, 2) - $iterations;
            $current_coordinates = $current_coordinates->byOffset(1, 0);
            for ($i = 1; $i <= $iterations; $i++) {
                $current_value = $start_value + $i;
                $this->setMatrixValue($current_coordinates, $current_value);
                if ($current_value == $max) {
                    return;
                }
                if ($i == $iterations) {
                    break;
                }
                if ($i % ($edge - 1) === 0) {
                    next($directions);
                }
                $current_coordinates = $current_coordinates->byOffset(
                    current($directions)[0],
                    current($directions)[1]
                );
            }

            // Reset and go to next circle.
            reset($directions);
            $size = pow($edge, 2);
        }
    }

    public function fillMatrixExtra(int $max) : int
    {
        $edge = 1;
        $size = 1;
        $current_coordinates = new MatrixAddress(0, 0);
        $current_value = 1;
        $this->setMatrixValue($current_coordinates, $current_value);
        $directions = (array) $this->directions();
        while (true) {
            $edge += 2;
            $iterations = ($edge - 1) * 4;
            $current_coordinates = $current_coordinates->byOffset(1, 0);
            for ($i = 1; $i <= $iterations; $i++) {
                $current_value = $this->sumAllNeighbours($current_coordinates);
                $this->setMatrixValue($current_coordinates, $current_value);
                if ($current_value > $max) {
                    return $current_value;
                }
                if ($i == $iterations) {
                    break;
                }
                if ($i % ($edge - 1) === 0) {
                    next($directions);
                }
                $current_coordinates = $current_coordinates->byOffset(
                    current($directions)[0],
                    current($directions)[1]
                );
            }

            // Reset and go to next circle.
            reset($directions);
        }
    }

    protected function sumAllNeighbours(MatrixAddress $address) : int
    {
        $sum = 0;
        foreach ([[0, 1], [1, 1], [1, 0], [1, -1], [0, -1], [-1, -1], [-1, 0], [-1, 1]] as $offset) {
            if (isset($this->matrix[$address->getX() + $offset[0]][$address->getY() + $offset[1]])) {
                $sum += $this->matrix[$address->getX() + $offset[0]][$address->getY() + $offset[1]];
            }
        }
        return $sum;
    }

    /**
     * @return array[][]
     */
    protected function directions()
    {
        return [
            [0, 1],
            [-1, 0],
            [0, -1],
            [1, 0],
        ];
    }

    /**
     * @param MatrixAddress $coordinates
     * @param int $value
     * @return DayThree
     */
    protected function setMatrixValue(MatrixAddress $coordinates, int $value) : self
    {
        $this->matrix[$coordinates->getX()][$coordinates->getY()] = $value;
        return $this;
    }

    /**
     * @param int $number
     * @return int
     */
    public function getDistance(int $number) : int
    {
        foreach ($this->matrix as $x => $t) {
            foreach ($this->matrix[$x] as $y => $r) {
                if ($this->matrix[$x][$y] == $number) {
                    return abs($x) + abs($y);
                }
            }
        }
        throw new \LogicException('Number not found');
    }
}
