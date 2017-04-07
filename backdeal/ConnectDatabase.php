<?php

include_once "Config.php";

function connect($db_name)
{
    global $DB_ADDRESS;
    global $DB_USERNAME;
    global $DB_PASSWD;
    $link = mysql_connect($DB_ADDRESS, $DB_USERNAME, $DB_PASSWD);
    mysql_select_db($db_name);
    mysql_query('set names utf8');
    return $link;
}
    
