<?php

// Set the database access information as constants:
DEFINE('DB_USER', 'developer');
DEFINE('DB_PASSWORD', 'abc123');
DEFINE('DB_HOST', '172.31.52.213');
DEFINE('DB_NAME', '1300');

// Make the connection:
$link = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) or die("Couldn't make connection.");
$dbc = mysqli_select_db($link, DB_NAME) or die("Couldn't select database.");

session_start();
// Set the character set:
//mysql_set_charset($dbc, 'utf8');

function escape_data($data, $dbc) {
    // Strip the slashes if Magic Quotes is on:
    if (get_magic_quotes_gpc())
        $data = stripslashes($data);

    // Apply trim() and mysqli_real_escape_string():
    //return mysql_real_escape_string($dbc, trim($data));
    return trim($data);
}

// End of the escape_data() function.

