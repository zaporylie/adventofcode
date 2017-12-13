<?php

namespace App\Utils;

class DayTwelveService
{

    protected $programs = [];
    protected $groups = [];

    /**
     * @param string $input
     * @return int
     */
    public function execute(string $input) : int
    {
        $list = explode(PHP_EOL, $input);
        $list = array_filter($list);
        foreach ($list as $line) {
            [$id, $connections] = explode(' <-> ', $line);
            $this->programs[$id] = explode(', ', $connections);
        }
        $this->processProgram(0);
        return count($this->groups[0]);
    }

    protected function processProgram(int $id, int $group_id = null)
    {
        $group_id = $group_id ?? $id;
        $this->groups[$group_id] = array_merge([$id], $this->groups[$group_id] ?? []);
        foreach ($this->programs[$id] as $connection) {
            if (in_array($connection, $this->groups[$group_id])) {
                continue;
            }
            $this->processProgram($connection, $group_id);
        }
    }

    /**
     * @param string $input
     * @return int
     */
    public function executeExtra(string $input) : int
    {
        $list = explode(PHP_EOL, $input);
        $list = array_filter($list);
        foreach ($list as $line) {
            [$id, $connections] = explode(' <-> ', $line);
            $this->programs[$id] = explode(', ', $connections);
        }
        while ((empty($this->groups) ? $list = array_keys($this->programs) : null) || count($list = array_diff(array_keys($this->programs), call_user_func_array('array_merge', $this->groups))) >= 1) {
            $index = array_shift($list);
            $this->processProgram($index);
        }
        return count($this->groups);
    }
}
