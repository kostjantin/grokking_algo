<?php

/**
 * @param array $array
 * @return void
 */
function quicksort(array &$array): void
{
    /**
     * @param array<int> $a
     * @param int $start
     * @param int $end
     * @return int
     */
    $f_pivot = function (array &$a, int $start, int $end) {
        $p_index = rand($start, $end);
        $pivot = $a[$p_index];

        [$a[$p_index], $a[$end]] = [$a[$end], $a[$p_index]];

        $j = $start;
        for ($i = $start; $i < $end; $i++) {
            if ($a[$i] < $pivot) {
                [$a[$i], $a[$j]] = [$a[$j], $a[$i]];
                $j++;
            }
        }

        [$a[$j], $a[$end]] = [$a[$end], $a[$j]];

        return $j;
    };

    /**
     * @param array<int> $a
     * @param int $start
     * @param int $end
     * @return void
     */
    $f_sort = function (array &$a, int $start, int $end) use (&$f_sort, $f_pivot): void {
        $a_len = $end - $start + 1;
        if ($a_len < 2) {
            return;
        } elseif ($a_len === 2) {
            if ($a[$start] > $a[$end]) {
                [$a[$start], $a[$end]] = [$a[$end], $a[$start]];
            }
            return;
        }

        $p_index = $f_pivot($a, $start, $end);
        $f_sort($a, $start, $p_index - 1);

        $f_sort($a, $p_index + 1, $end);
    };

    $f_sort($array, 0, count($array) - 1);
}
