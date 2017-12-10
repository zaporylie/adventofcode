<?php

namespace App\Utils;

class DaySixService
{

    /**
     * @var int[]
     */
    protected $input = [];

    /**
     * @var array
     */
    protected $hashes = [];

    /**
     * @param array $input
     * @return int
     */
    public function execute(array $input) : int
    {
        $this->input = $input;
        $i = 0;
        while (array_search($this->getHash($this->input), $this->hashes) === false) {
            $this->pushInputHash($this->getHash($this->input));
            $this->redistributeToNextOnes();
            $i++;
        }
        return $i;
    }

    /**
     * @param array $input
     * @return int
     */
    public function executeExtra(array $input) : int
    {
        $this->input = $input;
        $i = 0;
        while (($index = array_search($this->getHash($this->input), $this->hashes)) === false) {
            $this->pushInputHash($this->getHash($this->input), $i);
            $this->redistributeToNextOnes();
            $i++;
        }
        return $i - $index;
    }

    /**
     * @return int
     */
    protected function findIndexOfHighestValue() : int
    {
        return array_keys($this->input, max($this->input))[0];
    }

    /**
     * @param mixed
     * @return string
     */
    protected function getHash($input) : string
    {
        return md5(serialize($input));
    }

    /**
     * @param string $hash
     * @return DaySixService
     */
    protected function pushInputHash(string $hash, int $index = null) : self
    {
        if ($index) {
            $this->hashes[$index] = $hash;
        }
        else {
            $this->hashes[] = $hash;
        }
        return $this;
    }

    protected function redistributeToNextOnes() : self
    {
        $index = $this->findIndexOfHighestValue();
        $value = $this->input[$index];
        for ($this->input[$index] = 0; $value; $value--) {
            $index++;
            if (!isset($this->input[$index])) {
                $index = 0;
            }
            $this->input[$index]++;
        }
        return $this;
    }
}
