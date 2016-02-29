<!DOCTYPE html>
<html lang=''>
   <head>
    <link rel="stylesheet" href="cssmenu/styles.css">
    <link rel="stylesheet" media="all" href="cssmenu/bootstrap.min.css">
    <link rel="stylesheet" media="all" href="cssmenu/custom.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type=text/javascript></script>
    <script src="cssmenu/script.js"></script>
    <title>PetShop</title>
  </head>
  <body>
    <div id='cssmenu'>
    <ul>
      <li><a href='home.php'>Home</a></li>
      <li><a href='informatii.php'>Informatii</a></li>
      <li><a href='statistici.php'>Statistici</a></li>
      <li><a href='index.php'>LOGOUT</a></li>
    </ul>
    </div>
    <hr />

  </body>
</html>
<?php 
  require_once('mysql_connect.php');
 //functie pentru pop-up
  function alert($s){
     echo '<script type="text/javascript">alert("'.$s.'")</script>';
   }
   //buton pentru activarea unui cont
  if(isset($_POST['setactive'])){
    $id=$_POST['hidden'];
    $query="UPDATE users SET active=1 WHERE userID='$id'";
    if(mysql_query($query,$GLOBALS['dblogin']))
      alert("Activat");
    else
      alert("Activare nereusita");
   }
   //buton pentru dezactivarea unui cont
  if(isset($_POST['setinactive'])){
    $id=$_POST['hidden'];
    $query="UPDATE users SET active=0 WHERE userID='$id'";
    if(mysql_query($query,$GLOBALS['dblogin']))
      alert("Cont dezactivat!");
    else
      alert("Dezactivare nereusita");
  } 
  //buton pentru stergerea unui cont
  if(isset($_POST['remove'])){
    $id=$_POST['hidden'];
    $query="DELETE FROM users WHERE userID='$id'";
    if(mysql_query($query,$GLOBALS['dblogin']))
      alert("Stergere reusita");
    else
      alert("Stergere nereusita");
  }
 
  echo '<div class="container">
        <h1>Useri</h1>
        <table class="table table-bordered table-hover">
        <tr>
          <th>FirstName</th>
          <th>LastName</th>
          <th>E-mail</th>
          <th>username</th>
          <th>Activ</th>
          <th>Actiune</th>
        </tr>';
   //selectarea si afisarea tuturor conturilor
  $query="SELECT userID,firstName,lastName,email,username,password,active FROM users ";
  $result=mysql_query($query, $GLOBALS['dblogin']);
  while($record=mysql_fetch_assoc($result)){
    if($record['username']!='mandaeduard'){
      echo '<tr><td>'.$record['firstName'].'</td><td>'
                     .$record['lastName'].'</td><td>'
                     .$record['email'].'</td><td>'
                     .$record['username'].'</td><td>'
                     .$record['active'].'</td><td>'
                     .'<form action=admin.php method=POST>'
                     .'<input type=submit name=setactive value=SetActive />'
                     .'<input type=submit name=setinactive value=SetInactive />'
                     .'<input type=submit name=remove value=Remove />'
                     .'<input type=hidden name=hidden value='.$record['userID'].'/></form>';
      echo '</td></tr>';
    }
  }
  echo '</table>';
  
?>