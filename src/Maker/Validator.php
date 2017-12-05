<?php

namespace App\Maker;

/**
 * @author Javier Eguiluz <javier.eguiluz@gmail.com>
 * @author Ryan Weaver <weaverryan@gmail.com>
 */
final class Validator
{
    public static function numeric(string $value = null): string
    {
        if (!is_numeric($value)) {
            throw new \RuntimeException('This value should not numeric');
        }

        return $value;
    }
}
