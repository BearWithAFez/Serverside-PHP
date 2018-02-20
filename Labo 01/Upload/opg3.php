<?php
/**
 * Labo 1 -- Opgave 3
 * Created by PhpStorm.
 * User: dwight.vandervelpen
 * Date: 13/11/2017
 * Time: 16:10
 */

// Input handling
$input = strtotime($argv[1]);

// Input Checking
if(strtotime($argv[1]) === false){
    echo 'Invalid input...' . PHP_EOL;
    return;
}

// Timestamp
echo $input . PHP_EOL;

// Day of the week
echo date("l", $input) . PHP_EOL;

// As "10111996"
echo  date("dmY", $input) . PHP_EOL;

// As “11:45 AM”
echo  date("h:i A", $input) . PHP_EOL;

// As “26 december, 1983”
echo  date("d F, Y", $input) . PHP_EOL;