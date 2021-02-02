<?php
class Manager
{
    protected function dbConnect()
    {
	$db = new PDO("mysql:host=localhost;
 	dbname=alaska_jf;charset=utf8", 'root', '');
        return $db;
    }
}
