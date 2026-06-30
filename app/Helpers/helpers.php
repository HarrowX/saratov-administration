<?php

/**
 * Склонение существительных после числительных.
 *
 * from https://snipp.ru/php/word-declination
 *
 * @param  string  $value  Значение
 * @param  array  $words  Массив вариантов, например: array('товар', 'товара', 'товаров')
 * @param  bool  $show  Включает значение $value в результирующею строку
 * @return string
 */
function num_word($value, $words, $show = true)
{
    $num = $value % 100;
    if ($num > 19) {
        $num = $num % 10;
    }

    $out = ($show) ? $value.' ' : '';

    switch ($num) {
        case 1:  $out .= $words[0];
            break;
        case 2:
        case 3:
        case 4:  $out .= $words[1];
            break;
        default: $out .= $words[2];
            break;
    }

    return $out;
}
