<?php

namespace App\Utils;

class MatrixAddress
{
    /**
     * @var int
     */
    protected $x;

    /**
     * @var int
     */
    protected $y;

    /**
     * MatrixAddress constructor.
     * @param int $x
     * @param int $y
     */
    public function __construct(int $x, int $y)
    {
        $this->x = $x;
        $this->y = $y;
    }

    /**
     * Gets x value.
     *
     * @return int
     */
    public function getX()
    {
        return $this->x;
    }

    /**
     * Gets y value.
     *
     * @return int
     */
    public function getY()
    {
        return $this->y;
    }

    public function byOffset(int $x, int $y) : MatrixAddress
    {
        return new self($this->x + $x, $this->y + $y);
    }

}
