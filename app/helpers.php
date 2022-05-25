<?php

/**
 * Generate a random number code.
 *
 * @param integer $min The lowest value to be returned
 * @param integer $max The highest value to be returned
 * @param integer $length Length of random number code
 * @param integer $pad_type 0 is STR_PAD_LEFT, 1 is STR_PAD_RIGHT, 2 is STR_PAD_BOTH
 * @return string
 */
function randomNumberCode(int $min, int $max, int $length, int $pad_type)
{
    $options = [
        STR_PAD_LEFT,
        STR_PAD_RIGHT, 
        STR_PAD_BOTH
    ];

    return str_pad(
        (string) random_int($min, $max),
        $length,
        random_int(0, 9),
        $options[$pad_type]
    );
}