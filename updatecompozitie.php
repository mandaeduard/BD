
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
    $numeing=$_POST['numeing'];
    $procent=$_POST['procent'];
    $query="SELECT IDHrana FROM hrana WHERE Denumire LIKE '$nume'";
    $rezultat=mysql_query($query,$GLOBALS['link']);
    $record1=mysql_fetch_assoc($rezultat);
    
    $query="SELECT IDIngredient FROM ingredient WHERE Denumire LIKE '$numeing'";
    $rezultat=mysql_query($query,$GLOBALS['link']);
    $record2=mysql_fetch_assoc($rezultat);
    $idh=$record1['IDHrana'];
    $idi=$record2['IDIngredient'];
    $update="UPDATE compozitie SET IDHrana='$idh',IDIngredient='$idi',Procent='$procent' WHERE IDCompozitie='$id'";
    if(mysql_query($update,$GLOBALS['link']))
      alert ("Update reusit!");
    else
      alert("Update nereusit!");
  }
  
  $query="SELECT IDHrana,IDIngredient,Procent FROM compozitie WHERE IDCompozitie='$id'";
  $result=mysql_query($query,$GLOBALS['link']);
  $record=mysql_fetch_assoc($result);
  
  $query="SELECT Denumire FROM hrana WHERE IDHrana=".$record['IDHrana'];
  $rezultat=mysql_query($query,$GLOBALS['link']);
  $record1=mysql_fetch_assoc($rezultat);

  $query="SELECT Denumire FROM ingredient WHERE IDIngredient=".$record['IDIngredient'];
  $rezultat=mysql_query($query,$GLOBALS['link']);
  $record2=mysql_fetch_assoc($rezultat);
  echo '
  <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="Edit">Edit</a></h2>
        <form action=updatecompozitie.php method=POST>
          <div class="form-group">
            <label for="attribute8">Nume produs</label>
            <input type="text" class="form-control" id="attribute8" name=nume value='.$record1['Denumire'].'>
          </div>
          <div class="form-group">
            <label for="attribute8">Ingredient</label>
            <input type="text" class="form-control" id="attribute8" name=numeing value='.$record2['Denumire'].'>
          </div>
          <div class="form-group">
            <label for="attribute8">Procent</label>
            <input type="text" class="form-control" id="attribute8" name=procent value='.$record['Procent'].'>
          </div>
          <button type="submit" name=save class="btn btn-info">Save</button>
        </form>
      </div>
      <div class="col-sm-3"></div>

  </body>
</html>';
 ?>