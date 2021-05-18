<?php
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=coronelsystem;charset=utf8', 'root', '12345');
}
catch(Exception $e)
{
        die('Error : '.$e->getMessage());
}

?>
