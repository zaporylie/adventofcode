<?php

namespace App\Utils;

class DayNineService
{

    /**
     * @param string $input
     * @return int
     */
    public function execute(string $input) : int
    {
        // Remove negations.
        $input = preg_replace('/\!./', '', $input);
        // Remove garbage.
        $input = preg_replace('/\<.*?\>/', '', $input);
        // Remove commas.
        $input = str_replace(',', '', $input);
        // Count groups in levels.
        $level = 0;
        $groups = [];
        foreach (str_split($input) as $char) {
            switch ($char) {
                case '{':
                    $level++;
                    $groups[$level]['open'] = true;
                    break;
                case '}':
                    if (!$groups[$level]['open']) {
                        throw new \RuntimeException('Something went wrong. You were trying to close the group which has not been open');
                    }
                    $groups[$level]['count'] = isset($groups[$level]['count']) ? $groups[$level]['count'] + 1 : 1;
                    $groups[$level]['open'] = false;
                    $level--;
            }
        }
        // Sum up groups.
        $sum = 0;
        foreach ($groups as $value => $group) {
            $sum += $value * $group['count'];
        }
        return $sum;
    }

    /**
     * @param string $input
     * @return int
     */
    public function executeExtra(string $input) : int
    {
        // Remove negations.
        $input = preg_replace('/\!./', '', $input);
        // Remove garbage.
        $matches = [];
        preg_match_all('/\<.*?\>/', $input, $matches);
        $matches = reset($matches);
        $sum = 0;
        if (is_array($matches)) {
            foreach ($matches as $match) {
                $sum += strlen($match) - 2;
            }
        } else {
          $sum = strlen($matches) - 2;
        }
        return $sum;
    }
}
