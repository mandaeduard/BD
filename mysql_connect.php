

<?php 
  //fisier pentru conectarea la baza de date pentru administrare conturi
  define('DB_HOST','localhost');
  define('DB_USERNAME','root');
  define('DB_PASSWORD','my_password');
  define('DB_LOGIN','login');

  if(!$GLOBALS['dblogin']=mysql_connect(DB_HOST,DB_USERNAME,DB_PASSWORD)){
  	die("Unable to connect to login database!");
  }
  if(!mysql_select_db(DB_LOGIN,$GLOBALS['dblogin'])){
  	mysql_close($GLOBALS['dblogin']);
  	die("Unable to select database!");
  }
  
 ?>