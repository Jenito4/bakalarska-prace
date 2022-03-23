<?php
// This file contains the database access information. This file also establishes a connection to MySQL and selects the database.

// Set the database access information as constants.
DEFINE ('DB_USER', '');
DEFINE ('DB_PASSWORD', '');
DEFINE ('DB_HOST', '');
DEFINE ('DB_NAME', '');

$dbc = @mysql_connect (DB_HOST, DB_USER, DB_PASSWORD) OR die ('Nelze se připojit k MySQL: ' . mysql_error() );
mysql_select_db (DB_NAME) OR die ('Nelze vybrat databázi: ' . mysql_error() );
mysql_query('SET NAMES utf8');
?>
