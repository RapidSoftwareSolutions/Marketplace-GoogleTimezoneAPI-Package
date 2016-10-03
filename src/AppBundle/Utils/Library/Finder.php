<?php

namespace AppBundle\Utils\Library;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

/**
 * @author Dmitry Shumytskyi <d.shumytskyi@gmail.com>
 */
class Finder
{
    /**
     * needle: key of the array to find
     * array: multi-dimensional array to search through
     *
     * @param array $array
     * @param $needle
     * @return mixed
     */
    public function recursiveFindValueInMultiArray($array, $needle)
    {
        if ((array)$array !== $array || $needle === false) {

            return false;
        } else {
            $iterator = new RecursiveIteratorIterator(
                new RecursiveArrayIterator($array),
                RecursiveIteratorIterator::SELF_FIRST
            );

            foreach ($iterator as $key => $item) {
                $current_value = $item;
                if ($key === $needle) {
                    return $current_value;
                }
            }

            return false;
        }
    }

}