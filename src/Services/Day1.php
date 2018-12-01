<?php

namespace zaporylie\adventofcode\Services;

class Day1 extends DayBase
{

  /**
   * Solve silver puzzle.
   */
  public function first($input) : int
  {
    return array_sum($input);
  }

  public function second($input)
  {
      $intermediate = [0];
      $array = $input;
      $tmp = $length = 0;
      while(true) {
          $tmp += array_shift($array);
          if (in_array($tmp, $intermediate, true)) {
              return $tmp;
          }
          $intermediate[] = $tmp;
          if (count($array) == 0) {
              $array = array_merge($array, $input);
          }
      }
  }

}
