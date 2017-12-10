<?php

namespace App\Utils;

class DaySevenService
{

    /**
     * @var array
     */
    protected $graph;

    /**
     * @param array $input
     * @return string
     */
    public function execute(string $input) : string
    {
        $array = explode(PHP_EOL, $input);
        $this->graph = [];
        foreach ($array as $line) {
            [$parent, $children] = array_pad(explode(' -> ', $line), 2, null);
            preg_match('/(?<name>\w+)[\s\(].(?<weight>\d+)[\s\)]/', $parent, $parent);
            if (!isset($parent['name'])) {
                continue;
            }
            $children = explode(', ', $children);
            if (empty($children[0])) {
                unset($children[0]);
            }
            $this->graph[$parent['name']] = [
                'name' => $parent['name'],
                'weight' => $parent['weight'],
                'children' => !empty($children) ? array_combine($children, $children) : [],
            ];
        }
        $with_children = array_filter($this->graph, function ($element) { return !empty($element['children']); });
        $skip = false;
        foreach ($with_children as $element) {
            foreach ($with_children as $tmp) {
                if (in_array($element['name'], $tmp['children'])) {
                    $skip = true;
                    break;
                }
            }
            if (!$skip) {
                return $element['name'];
            }
            $skip = false;
        }
        throw new \RuntimeException('No results found');
    }

    /**
     * @param string $input
     * @return int
     */
    public function executeExtra(string $input) : int
    {
        $parent = $this->execute($input);
        $weights = [];
        $key = $this->findUnbalanced($parent);
        // @todo: find parent for this one.
        $weights = $this->calculateWeights(array_intersect_key($this->graph, $this->graph[$this->findParent($key)]['children']));
        $diff = array_shift($weights) - array_shift($weights);
        return $this->graph[$key]['weight'] - $diff;
    }

    /**
     * @param array $program
     * @param int $sum
     */
    public function programWeight(array $program, &$sum = 0)
    {
        $sum += $program['weight'];
        if (!empty($program['children'])) {
            foreach (array_intersect_key($this->graph, $program['children']) as $child) {
                $this->programWeight($this->graph[$child['name']], $sum);
            }
        }
    }

    public function findUnbalanced(string $parent)
    {
        $weights = $this->calculateWeights(array_intersect_key($this->graph, $this->graph[$parent]['children']));
        $key = key($weights);
        if (array_shift($weights) - array_shift($weights)) {
            return $this->findUnbalanced($key);
        }
        return $parent;
    }

    public function calculateWeights(array $list)
    {
        $weights = [];
        foreach ($list as $program) {
            $weights[$program['name']] = 0;
            $this->programWeight($program, $weights[$program['name']]);
        }
        arsort($weights);
        return $weights;
    }

    public function findParent(string $child)
    {
        foreach ($this->graph as $parent) {
            if (isset($parent['children'][$child])) {
                return $parent['name'];
            }
        }
        throw new \RuntimeException('Unable to find parent');
    }
}
