
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
    $denumire=$_POST['denumire'];
    $update="UPDATE ingredient SET Denumire='$denumire' WHERE IDIngredient='$id'";
    if(mysql_query($update,$GLOBALS['link']))
      alert ("Update reusit!");
    else
      alert("Ingredientul se afla deja in baza de date!");
  }
  
  $query="SELECT Denumire FROM ingredient WHERE IDIngredient='$id'";
  $result=mysql_query($query,$GLOBALS['link']);
  $record=mysql_fetch_assoc($result);
  echo '
  <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="Edit">Edit</a></h2>
        <form action=updateingredient.php method=POST>
          <div class="form-group">
            <label for="attribute8">Denumire</label>
            <input type="text" class="form-control" id="attribute8" name=denumire value='.$record['Denumire'].'>
          </div>
          <button type="submit" name=save class="btn btn-info">Save</button>
        </form>
      </div>
      <div class="col-sm-3"></div>

  </body>
</html>';
 ?>