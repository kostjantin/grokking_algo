<?php

function quicksort(array $a) {
    $aLen = count($a);
    if ($aLen < 2) {
        return $a;
    } elseif($aLen === 2) {
	return ($a[0] > $a[1]) ? [$a[1], $a[0]] : $a;
    }

    $pivot = $a[rand(0, $aLen - 1)];
	
    $firstPart = $equalPart = $secondPart = [];
    for($i = 0; $i < $aLen; $i++) {
        if ($a[$i] < $pivot) {
            $firstPart[] = $a[$i];
        } elseif ($a[$i] === $pivot) {
            $equalPart[] = $a[$i];
        } else {
            $secondPart[] = $a[$i];
        }
    }

    return [
      ...quicksort($firstPart), 
      ...quicksort($equalPart), 
      ...quicksort($secondPart), 
    ];
}

var_dump(quicksort(
  [1, 5, 2, 8, 7, 13, 23, 4, 9, 45, 100, 5, 1, 23, 54, 42, 42]
));
