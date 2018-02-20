<?php

/**
 * Lab 03, Exercise 1 — Start file
 * @author Bramus Van Damme &amp; Joris Maervoet <joris.maervoet@odisee.be> 
 */

	// Set timezone to Brussels
	date_default_timezone_set('Europe/Brussels');

	// Set language to Dutch
	setlocale(LC_ALL, 'Dutch_Netherlands');

	// Create a timestamp for the date
	$timestamp = strtotime('1983-12-26 11:45:00');

	// Output
	if ($timestamp !== false) { 
		echo $timestamp . '<br />';					// timestamp
		echo date('F', $timestamp) . '<br />';		// Month (in words)
		echo date('l', $timestamp) . '<br />';		// Day of week (in words)
		echo date('D', $timestamp) . '<br />';		// Day of week (short, in words)
		echo date('dmY', $timestamp) . '<br />';	// Date as "26121983"
		echo date('ymd', $timestamp) . '<br />';	// Date as "831226"
		echo date('g:i A', $timestamp) . '<br />';	// Date as "11:45 AM"
		echo date('t', $timestamp) . '<br />';		// Number of days in given month
		echo date('j F Y', $timestamp) . '<br />';	// Date as "26 december 1983" (*)
		echo date('W', $timestamp) . '<br />';		// Weeknumber of date
	} else {
		echo ('The time of this script could not be interpreted as a date.');
	}
// EOF