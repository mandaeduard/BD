
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
      <li class='active'><a href='informatii.php'>Informatii</a></li>
      <li><a href='statistici.php'>Statistici</a></li>
      <li><a href='index.php'>LOGOUT</a></li>
    </ul>
    </div>
    <hr />
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/angular.min.js"></script>
    <script src="js/app.js"></script>
<?php 
  require_once('database_connect.php');
  session_start();
  
  function alert($s){
    echo '<script type="text/javascript">alert("'.$s.'")</script>';
  }
  //necesar pentru update, daca se face o data update pentru un id sa se pastreze id-ul
  if(isset($_POST['update'])){
    $id=$_POST['hidden'];
 	  $_SESSION['a']=$_POST['hidden'];
  }
  else
  	$id=$_SESSION['a'];
  if(isset($_POST['save'])){
    $nume=$_POST['nume'];
    $oras=$_POST['oras'];
    $strada=$_POST['strada'];
    $nr=$_POST['nr'];
    $cnp=$_POST['cnp'];
    $cui=$_POST['cui'];
    $query="SELECT IDManager FROM manager WHERE CNP LIKE '$cnp'";
    $result=mysql_query($query,$GLOBALS['link']);
    if($prod=mysql_fetch_assoc($result)){
      $idmanager=$prod['IDManager'];
      $update="UPDATE producator SET Nume='$nume',Manager='$idmanager',Oras='$oras',Strada='$strada',Numar='$nr',CUI='$cui' WHERE IDProducator='$id'";
      if(mysql_query($update,$GLOBALS['link']))
        alert ("Update reusit!");
      else
        alert("Update nereusit!");
    }
    else{
      $update="UPDATE producator SET Nume='$nume',Manager=NULL,Oras='$oras',Strada='$strada',Numar='$nr',CUI='$cui' WHERE IDProducator='$id'";
      if(mysql_query($update,$GLOBALS['link']))
        alert ("Update reusit!");
      else
        alert("Update nereusit!");
    }     
  }
  
  $query="SELECT Nume,Manager,Oras,Strada,Numar,CUI FROM producator WHERE IDProducator='$id'";
  $result=mysql_query($query,$GLOBALS['link']);
  $record=mysql_fetch_assoc($result);
  $idm=$record['Manager'];
  $query="SELECT CNP FROM manager WHERE IDManager='$idm'";
  $rezultat=mysql_query($query,$GLOBALS['link']);
  $row=mysql_fetch_assoc($rezultat);
  echo '
  <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="Edit">Edit</a></h2>
        <form action=updateproducator.php method=POST>
          <div class="form-group">
            <label for="attribute8">Nume</label>
            <input type="text" class="form-control" id="attribute8" name=nume value='.$record['Nume'].'>
          </div>
          <div class="form-group">
            <label for="attribute9">CNP Manager</label>
            <input type="text" class="form-control" id="attribute9" name=cnp value='.$row['CNP'].'>
          </div>
          <div class="form-group">
            <label for="attribute10">Oras</label>
            <input type="text" class="form-control" id="attribute10" name=oras value='.$record['Oras'].'>
          </div>
          <div class="form-group">
            <label for="attribute11">Strada</label>
            <input type="text" class="form-control" id="attribute11" name=strada value='.$record['Strada'].'>
          </div>
          <div class="form-group">
            <label for="attribute12">NR</label>
            <input type="text" class="form-control" id="attribute12" name=nr value='.$record['Numar'].'>
          </div>
          <div class="form-group">
            <label for="attribute13">CUI</label>
            <input type="text" class="form-control" id="attribute13" name=cui value='.$record['CUI'].'>
          </div>

          <button type="submit" name=save class="btn btn-info">Save</button>
        </form>
      </div>
      <div class="col-sm-3"></div>

  </body>
</html>';
 ?>