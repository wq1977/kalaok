<?php

$link = mysql_connect('localhost:/var/run/mysqld/mysqld.sock', 'kalaok', 'kalaok');
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
mysql_select_db('kalaok');
mysql_query("set names utf8;");

?>
