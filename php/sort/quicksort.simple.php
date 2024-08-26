<?php

/**
 * @param array<int> $a
 * @return array<int>
 */
function quicksort(array $a)
{
    $a_len = count($a);
    if ($a_len < 2) {
        return $a;
    } elseif ($a_len === 2) {
        return ($a[0] > $a[1]) ? [$a[1], $a[0]] : $a;
    }

    $pivot = $a[rand(0, $a_len - 1)];

    $first_part = $equal_part = $second_part = [];
    for ($i = 0; $i < $a_len; $i++) {
        if ($a[$i] < $pivot) {
            $first_part[] = $a[$i];
        } elseif ($a[$i] === $pivot) {
            $equal_part[] = $a[$i];
        } else {
            $second_part[] = $a[$i];
        }
    }

    return array_merge(
        quicksort($first_part),
        quicksort($equal_part),
        quicksort($second_part),
    );
}
