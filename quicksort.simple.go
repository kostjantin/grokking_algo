package main

import (
	"fmt"
	"math/rand"
)

func quicksort(a []int) []int {
	aLen := len(a)
	if aLen < 2 {
		return a
	} else if aLen == 2 {
		if a[0] > a[1] {
			a[0], a[1] = a[1], a[0]
		}

		return a
	}

	pivot := a[rand.Intn(aLen)]

	var firstPart, equalPart, secondPart []int
	for i := 0; i < aLen; i++ {
		if a[i] < pivot {
			firstPart = append(firstPart, a[i])
		} else if a[i] == pivot {
			equalPart = append(equalPart, a[i])
		} else {
			secondPart = append(secondPart, a[i])
		}
	}

	sortedFirstPart := quicksort(firstPart)
	sortedSecondPart := quicksort(secondPart)

	return append(append(sortedFirstPart, equalPart...), sortedSecondPart...)
}

func main() {
	a := []int{1, 5, 2, 8, 7, 13, 23, 4, 9, 45, 100, 5, 1, 23, 54, 42, 42}

	fmt.Println("Sorted array:", quicksort(a))
}
