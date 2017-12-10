<?php

namespace App\Utils;

class DayTenService
{

    /**
     * @var \App\Utils\CircularList
     */
    protected $list;

    public function __construct(CircularList $circularList)
    {
        if (empty($circularList->getList())) {
            $list = [];
            for ($i = 0; $i < 256; $i++) {
                $list[] = $i;
            }
            $circularList = CircularList::createFrom($list);
        }
        $this->list = $circularList;
    }

    /**
     * @param string $input
     * @return int
     */
    public function execute(string $input) : int
    {
        $skip = $moves = 0;
        foreach (explode(',', $input) as $step) {
            $moves += $this->knotHash($step, $skip);
        }
        $this->list->rewind($moves);
        return $this->list->getValue(0) * $this->list->getValue(1);
    }

    /**
     * @param string $input
     * @return string
     */
    public function executeExtra(string $input) : string
    {
        $sequence = [];
        foreach (str_split($input) as $step) {
            if ($step == '') {
                continue;
            }
            $sequence[] = ord($step);
        }
        $sequence = array_merge($sequence, [17, 31, 73, 47, 23]);
        $skip = $moves = 0;
        for ($i = 0; $i < 64; $i++) {
            foreach ($sequence as $step) {
                $moves += $this->knotHash($step, $skip);
            }
        }
        $this->list->rewind($moves);
        $list = self::sparseToDense($this->list->getList());
        return self::arrayToHex($list);
    }

    /**
     * @param $step
     * @param $skip
     * @return int
     */
    protected function knotHash($step, &$skip): int
    {
        $list = array_reverse(array_slice($this->list->getList(), 0, $step));
        $this->list->setList(array_replace($this->list->getList(), $list));
        $this->list->forward($move = $skip + $step);
        $skip++;
        return $move;
    }

    public static function sparseToDense(array $sparse, int $chunk_size = 16) : array
    {
        $chunks = array_chunk($sparse, $chunk_size);
        $dense = [];
        foreach ($chunks as $chunk) {
            $dense[] = self::arrayXor($chunk);
        }
        return $dense;
    }

    public static function arrayToHex(array $array) : string
    {
        $string = '';
        foreach ($array as $num) {
            $string .= str_pad(dechex($num), 2, 0, STR_PAD_LEFT);
        }
        return $string;
    }

    /**
     * @param $chunks
     * @param int $i
     * @return null
     */
    public static function arrayXor(array $array) : int
    {
        $xor = null;
        foreach ($array as $chunk) {
            if (!isset($xor)) {
                $xor = $chunk;
                continue;
            }
            $xor ^= $chunk;
        }
        return $xor;
    }
}
