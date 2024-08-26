<?php

/**
 * @param array<int> $a
 * @return array<int>
 */
function quicksort(array $a): array
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
        match ($a[$i] <=> $pivot) {
            -1 => $first_part[] = $a[$i],
            0 => $equal_part[] = $a[$i],
            1 => $second_part[] = $a[$i],
        };
    }

    return array_merge(
        quicksort($first_part),
        $equal_part,
        quicksort($second_part),
    );
}
