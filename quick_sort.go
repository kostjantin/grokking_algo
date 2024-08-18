package main

import (
	"fmt"
	"math/rand"
)

func quicksort(a []int) []int {
	aLen := len(a)
	if aLen < 2 {
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
	a := []int{1, 5, 2, 8, 7, 13, 23, 4, 9}

	fmt.Println("Sorted array:", quicksort(a))
}
