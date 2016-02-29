<?php 
	//fisier pentru conectarea la baza de date petshop
	define('DB_HOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', 'my_password');
	define('DB_NAME', 'petshop');

	if(!$GLOBALS['link']=mysql_connect(DB_HOST, DB_USERNAME, DB_PASSWORD)){
	  die("Unable to connect to database!");
	}	
	if(!mysql_select_db(DB_NAME,$GLOBALS['link'])){
	  mysql_close($GLOBALS['link']);
	  die("Unable to select database!");
	}
	
 ?>