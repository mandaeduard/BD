
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
    $codprodus=$_POST['codprodus'];
    $denumire=$_POST['denumire'];
    $pret=$_POST['pret'];
    $animal=$_POST['animal'];
    $stoc=$_POST['stoc'];
    $categorie=$_POST['categorie'];
    $producator=$_POST['producator'];
    $query="SELECT IDProducator FROM producator WHERE Nume LIKE '$producator'";
    $result=mysql_query($query,$GLOBALS['link']);
    if($prod=mysql_fetch_assoc($result)){
      $idprod=$prod['IDProducator'];
      $update="UPDATE hrana SET CodProdus='$codprodus',Denumire='$denumire',Pret='$pret',Animal='$animal',
      		   Stoc='$stoc',Categorie='$categorie',IDProducator='$idprod' WHERE IDHrana='$id'";
      if(mysql_query($update,$GLOBALS['link']))
      	alert ("Update reusit!");
      else
      	alert ("Update nereusit");
    }
    else{
      $update="UPDATE hrana SET CodProdus='$codprodus',Denumire='$denumire',Pret='$pret',Animal='$animal',
      		   Stoc='$stoc',Categorie='$categorie',IDProducator=NULL WHERE IDHrana='$id'";
      if(mysql_query($update,$GLOBALS['link']))
      	alert ("Update reusit!");
      else
      	alert ("Update nereusit");
    }
      

  }
  
  $query="SELECT CodProdus,Denumire,Pret,Animal,Stoc,Categorie,IDProducator FROM hrana WHERE IDHrana='$id'";
  $result=mysql_query($query, $GLOBALS['link']);
  $record=mysql_fetch_assoc($result);
  $idprod=$record['IDProducator'];
  $query="SELECT Nume FROM producator WHERE IDProducator='$idprod'";
  $rezultat=mysql_query($query,$GLOBALS['link']);
  $row=mysql_fetch_assoc($rezultat);
  echo '
  <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="Edit">Edit</a></h2>
        <form action=updatehrana.php method=POST>
          <div class="form-group">
            <label for="attribute1">CodProdus</label>
            <input type="text" class="form-control" id="attribute1" name=codprodus value='.$record['CodProdus'].'>
          </div>
          <div class="form-group">
            <label for="attribute2">Denumire</label>
            <input type="text" class="form-control" id="attribute2" name=denumire value='.$record['Denumire'].'>
          </div>
          <div class="form-group">
            <label for="attribute3">Pret</label>
            <input type="text" class="form-control" id="attribute3" name=pret value='.$record['Pret'].'>
          </div>
          <div class="form-group">
            <label for="attribute4">Animal</label>
            <input type="text" class="form-control" id="attribute4" name=animal value='.$record['Animal'].'>
          </div>
          <div class="form-group">
            <label for="attribute5">Stoc</label>
            <input type="text" class="form-control" id="attribute5" name=stoc value='.$record['Stoc'].'>
          </div>
          <div class="form-group">
            <label for="attribute6">Categorie</label>
            <input type="text" class="form-control" id="attribute6" name=categorie value='.$record['Categorie'].'>
          </div>
          <div class="form-group">
            <label for="attribute7">Producator</label>
            <input type="text" class="form-control" id="attribute7" name=producator value='.$row['Nume'].'>
          </div>
          <button type="submit" name=save class="btn btn-info">Save</button>
        </form>
      </div>
      <div class="col-sm-3"></div>

  </body>
</html>';
 ?>