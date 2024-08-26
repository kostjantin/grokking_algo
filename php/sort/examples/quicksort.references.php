<?php

function sort_depth_message(int $depth, string $message): void
{
    echo str_repeat("\t", $depth) . $message . PHP_EOL;
}

/**
 * @param array<int> $array
 * @return array<int>
 */
function quicksort(array $array): array
{
    $d = 0;
    /**
     * @param array<int> $a
     * @param int $start
     * @param int $end
     * @return int
     */
    $f_pivot = function (array &$a, int $start, int $end, $d) {
        $p_index = rand($start, $end);
        $pivot = $a[$p_index];
        sort_depth_message($d, "Pivot real: a[$p_index] = $pivot}");

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
    $f_sort = function (array &$a, int $start, int $end, $d) use (&$f_sort, $f_pivot): void {
        $a_len = $end - $start + 1;
        if ($a_len < 2) {
            return;
        } elseif ($a_len === 2) {
            if ($a[$start] > $a[$end]) {
                [$a[$start], $a[$end]] = [$a[$end], $a[$start]];
            }
            return;
        }

        $p_index = $f_pivot($a, $start, $end, $d);
        sort_depth_message($d, "Pivot: a[$p_index] = {$a[$p_index]}}");
        sort_depth_message(
            $d,
            "Start left f_sort($start - $p_index): ["
            . implode(', ', array_slice($a, $start, $p_index - $start)) . ']'
        );
        $f_sort($a, $start, $p_index - 1, $d + 1);

        sort_depth_message(
            $d,
            "Start right f_sort($p_index - $end): ["
            . implode(', ', array_slice($a, $p_index, $end - $p_index)) . ']'
        );
        $f_sort($a, $p_index + 1, $end, $d + 1);
    };


    $f_sort($array, 0, count($array) - 1, $d);

    return $array;
}

echo 'Quicksort: ' .
    implode(
        ', ',
        quicksort([1, 5, 2, 8, 1, 7, 13, 23, 4, 9, 45, 100, 5, 1, 23, 54, 42, 42])
    )
    . PHP_EOL;
