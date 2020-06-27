<?php

$arrayTo = 100;

$numbers = range(1, $arrayTo);
$missing = rand(1, $arrayTo); // Set a random missing value

unset($numbers[$missing-1]); // remove this random number

$numbers2 = range(1, $arrayTo); // Create a similar array to the original one

$res = array_diff_key($numbers2, $numbers);

echo ($missing) . " is the missing number (chosen randomly) and should be the result \n";

$theDiffKeys = array_keys($res);
$theFirstMissingNumberPosition = $theDiffKeys[0];
$theFirstMissingNumber = $res[$theFirstMissingNumberPosition];

echo "\nThe result of searching the missing number: $theFirstMissingNumber";