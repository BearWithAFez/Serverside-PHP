<?php

/**
 * Lab 03, Exercise 1 — Start file
 * @author Bramus Van Damme &amp; Joris Maervoet <joris.maervoet@odisee.be> 
 */

    // Set language to Dutch
    setlocale(LC_ALL, 'Dutch_Netherlands');

    try
    {
        // Make obj.
        $date = new DateTime('1983-12-26 11:45:00', new DateTimeZone('Europe/Brussels'));

        echo ($date->getTimestamp()) . '<br />';            // timestamp
        echo $date->format('F') . '<br />';		    // Month (in words)
        echo $date->format('l') . '<br />';		    // Day of week (in words)
        echo $date->format('D') . '<br />';		    // Day of week (short, in words)
        echo $date->format('dmY') . '<br />';	    // Date as "26121983"
        echo $date->format('ymd') . '<br />';	    // Date as "831226"
        echo $date->format('g:i A') . '<br />';	    // Date as "11:45 AM"
        echo $date->format('t') . '<br />';		    // Number of days in given month
        echo $date->format('j F Y') . '<br />';      // Date as "26 december 1983" (*)
        echo $date->format('W') . '<br />';
    } catch (Exception $e) {
        echo ('The time of this script could not be interpreted as a date.');
    }
// EOF