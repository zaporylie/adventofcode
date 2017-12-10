<?php

namespace App\Utils;

class CircularList
{

    /**
     * @var array
     */
    protected $list = [];

    /**
     * @param array $list
     * @return CircularList
     */
    public static function createFrom(array $list) : self
    {
        return (new CircularList())->setList($list);
    }

    /**
     * @param array $list
     * @return CircularList
     */
    public function setList(array $list) : self
    {
        $this->list = $list;
        return $this;
    }

    /**
     * @return array
     */
    public function getList() : array
    {
        return $this->list;
    }

    /**
     * @param int $index
     * @return mixed
     */
    public function getValue(int $index)
    {
        if (!isset($this->list[$index])) {
            throw new \InvalidArgumentException('Missing element with index ' . $index);
        }
        return $this->list[$index];
    }

    /**
     * @param int $index
     * @param $value
     * @return $this
     */
    public function setValue(int $index, $value)
    {
        $this->list[$index] = $value;
        return $this;
    }

    /**
     * @param int $steps
     * @return CircularList
     */
    public function forward(int $steps) : self
    {
        $steps = $steps % count($this->list);
        for ($i = 0; $i < $steps; $i++) {
            $element = array_shift($this->list);
            array_push($this->list, $element);
            $this->list = array_values($this->list);
        }
        return $this;
    }

    /**
     * @param int $steps
     * @return CircularList
     */
    public function rewind(int $steps) : self
    {
        $steps = $steps % count($this->list);
        for ($i = 0; $i < $steps; $i++) {
            $element = array_pop($this->list);
            array_unshift($this->list, $element);
        }
        return $this;
    }
}
