<?php
/**
 * Labo 1 -- Opgave 2
 * Created by PhpStorm.
 * User: dwight.vandervelpen
 * Date: 13/11/2017
 * Time: 15:32
 */

// Punt 1
$alphabet = array();
echo chr(97);

for ($x = 97; $x <= 122; $x++) {
    $alphabet[] = chr($x);
}

print_r($alphabet);

// Punt 2
foreach($alphabet as $key => $value){
 echo ($key + 1) . $value;
}
echo PHP_EOL;

// Punt 3
echo implode(',',$alphabet) . PHP_EOL;

// Punt 4
echo count($alphabet) .PHP_EOL;
echo array_shift($alphabet) . PHP_EOL;
echo count($alphabet) .PHP_EOL;

// Punt 5
$cities = array(
    9000 => 'Gent',
    1000 => 'Brussel',
    2000 => 'Antwerpen',
    8500 => 'Kortrijk',
    3000 => 'Leuven',
    3500 => 'Hasselt'
);

print_r($cities);

// Punt 6
$zip = array_keys($cities);
print_r($zip);
echo array_sum($zip) .PHP_EOL;

// Punt 7
asort($cities);
print_r($cities);

// Punt 8
krsort($cities);
print_r($cities);

// Punt 9
for($i = 0; $i < 10000; $i += 1000){
    echo (array_key_exists($i,$cities)? strtoupper($cities[$i]): $i) . PHP_EOL;
}