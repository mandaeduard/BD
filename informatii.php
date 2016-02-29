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
<br />
<br />
<div class="container">
    <nav class="navbar navbar-default">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="">Tabele</a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
          <ul class="nav navbar-nav">
            <li><a href="#Hrana">Hrana</a></li>
            <li><a href="#Producator">Producator</a></li>
            <li><a href="#Manager">Manager</a></li>
            <li><a href="#Recomandare">Recomandare</a></li>
            <li><a href="#HranaRecomandare">HranaRecomandare</a></li>
            <li><a href="#Ingredient">Ingredient</a></li>
            <li><a href="#Compozitie">Compozitie</a></li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
  <hr />
  <script src="js/jquery-1.11.3.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/angular.min.js"></script>
  <script src="js/app.js"></script>


<?php 
 
  require_once('database_connect.php');
  session_start();
  $username=$_SESSION['u'];
  if($username=='mandaeduard'){
    echo '<center><strong>Apasati <a href="admin.php">aici</a> pentru pagina de administrare.</strong></center>';
  }
 
  function alert($s){
     echo '<script type="text/javascript">alert("'.$s.'")</script>';
  }
//operatii pe tabela hrana
  //delete hrana
  if(isset($_POST['removehrana'])){
    $id=$_POST['hidden'];
    $query="DELETE FROM hrana WHERE IDHrana='$id'";
    if(mysql_query($query,$GLOBALS['link'])){
      $contor=$_SESSION['ctr']-1;
      $alter="ALTER TABLE hrana AUTO_INCREMENT=".$contor;
      mysql_query($alter,$GLOBALS['link']);
      alert("Stergere reusita");
    }
    else
      alert("Stergere nereusita");
  }
  //insert hrana
  if(isset($_POST['savehrana'])&&$_POST['codprodus']!=""&&$_POST['denumire']!=""&&$_POST['pret']!=""&&$_POST['animal']!=""){
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
      $insert="INSERT INTO hrana(CodProdus,Denumire,Pret,Animal,Stoc,Categorie,IDProducator) VALUES
            ('$codprodus','$denumire','$pret','$animal','$stoc','$categorie','$idprod')";
      if(mysql_query($insert,$GLOBALS['link']))
        alert ("Adaugare reusita!");
      else
        alert ("Adaugare nereusita!");
    }
    else{
      $insert="INSERT INTO hrana(CodProdus,Denumire,Pret,Animal,Stoc,Categorie,IDProducator) VALUES
            ('$codprodus','$denumire','$pret','$animal','$stoc','$categorie',NULL)";
      if(mysql_query($insert,$GLOBALS['link']))
        alert ("Adaugare reusita!");
      else
        alert ("Adaugare nereusita!");
    }
  }
  
//operatii pe tabela producator
  //delete producator
  if(isset($_POST['removeproducator'])){
    $id=$_POST['hidden'];
    $query="DELETE FROM producator WHERE IDProducator='$id'";
    if(mysql_query($query,$GLOBALS['link'])){
      $contor1=$_SESSION['ctr1']-1;
      $alter="ALTER TABLE producator AUTO_INCREMENT=".$contor1;
      mysql_query($alter,$GLOBALS['link']);
      alert("Stergere reusita!");
    }
    else{
      alert("Stergere nereusita!");
    }
  }

  //insert producator
  if(isset($_POST['saveproducator'])&&$_POST['nume']!=""&&$_POST['cui']!=""){
    $nume=$_POST['nume'];
    $cnp=$_POST['cnp'];
    $oras=$_POST['oras'];
    $strada=$_POST['strada'];
    $nr=$_POST['nr'];
    $cui=$_POST['cui'];
    $query="SELECT IDManager FROM manager WHERE CNP LIKE '$cnp'";
    $result=mysql_query($query,$GLOBALS['link']);
    if($prod=mysql_fetch_assoc($result)){
      $id=$prod['IDManager'];
      $insert="INSERT INTO producator(Nume,Manager,Oras,Strada,Numar,CUI) VALUES
               ('$nume','$id','$oras','$strada','$nr','$cui')";
      if(mysql_query($insert,$GLOBALS['link']))
        alert ("Adaugare reusita!");
      else
        alert("CUI-ul este deja in baza de date!");
    }
    else{
      $insert="INSERT INTO producator(Nume,Manager,Oras,Strada,Numar,CUI) VALUES
               ('$nume',NULL,'$oras','$strada','$nr','$cui')";
      if(mysql_query($insert,$GLOBALS['link']))
        alert ("Adaugare reusita!");
      else
        alert("CUI-ul este deja in baza de date!");
    }
  }
 

  //operatii pe tabela manager
  //delete manager
  if(isset($_POST['removemanager'])){
    $id=$_POST['hidden'];
    $query="DELETE FROM manager WHERE IDManager='$id'";
    if(mysql_query($query,$GLOBALS['link'])){
      $contor2=$_SESSION['ctr2']-1;
      $alter="ALTER TABLE manager AUTO_INCREMENT=".$contor2;
      mysql_query($alter,$GLOBALS['link']);
      alert("Stergere reusita!");
    }
    else{
      alert("Stergere nereusita!");
    }
  }

  //insert manager
  if(isset($_POST['savemanager'])&&$_POST['nume']!=""&&$_POST['prenume']!=""&&$_POST['cnp']!=""){
    $nume=$_POST['nume'];
    $prenume=$_POST['prenume'];
    $cnp=$_POST['cnp'];
    $telefon=$_POST['telefon'];
    $email=$_POST['email'];
    $insert="INSERT INTO manager(Nume,Prenume,CNP,Telefon,Email) VALUES
               ('$nume','$prenume','$cnp','$telefon','$email')";
    if(mysql_query($insert,$GLOBALS['link']))
      alert ("Adaugare reusita!");
    else
      alert("CNP-ul este deja in baza de date!");
  }


//operatii pe tabela recomandare
  //delete recomandare
  if(isset($_POST['removerecomandare'])){
    $id=$_POST['hidden'];
    $query="DELETE FROM recomandare WHERE IDRecomandare='$id'";
    if(mysql_query($query,$GLOBALS['link'])){
      $contor3=$_SESSION['ctr3']-1;
      $alter="ALTER TABLE recomandare AUTO_INCREMENT=".$contor3;
      mysql_query($alter,$GLOBALS['link']);
      alert("Stergere reusita!");
    }
    else{
      alert("Stergere nereusita!");
    }
  }

  //insert recomandare
  if(isset($_POST['saverecomandare'])&&$_POST['denumire']!=""){
    $denumire=$_POST['denumire'];
    $insert="INSERT INTO recomandare(denumire) VALUES('$denumire')";
    if(mysql_query($insert,$GLOBALS['link']))
      alert ("Adaugare reusita!");
    else
      alert("Recomandarea se afla in baza de date!");
  }


//operatii pe tabela hrana-recomandare
  //delete hrana_recomandare
  if(isset($_POST['removehr'])){
    $id=$_POST['hidden'];
    $query="DELETE FROM hrana_recomandare WHERE IDHR='$id'";
    if(mysql_query($query,$GLOBALS['link'])){
      $contor4=$_SESSION['ctr4']-1;
      $alter="ALTER TABLE hrana_recomandare AUTO_INCREMENT=".$contor4;
      mysql_query($alter,$GLOBALS['link']);
      alert("Stergere reusita!");
    }
    else{
      alert("Stergere nereusita!");
    }
  }

  //insert hrana recomandare
   if(isset($_POST['savehr'])){
    $nume=$_POST['hrana'];
    $rec=$_POST['recomandare'];
    $query="SELECT IDHrana FROM Hrana WHERE Denumire LIKE '$nume'";
    $result1=mysql_query($query,$GLOBALS['link']);
    $record1=mysql_fetch_assoc($result1);
    $query="SELECT IDRecomandare FROM Recomandare WHERE Denumire LIKE '$rec'";
    $result2=mysql_query($query,$GLOBALS['link']);
    $record2=mysql_fetch_assoc($result2);
    $insert="INSERT INTO hrana_recomandare(IDHrana,IDRecomandare) VALUES(".$record1['IDHrana'].",".$record2['IDRecomandare'].")";
    if(mysql_query($insert,$GLOBALS['link']))
      alert ("Adaugare reusita!");
    else
      alert("Produsul sau recomandarea nu se afla in baza de date!");
  }

//operatii pe tabela ingredient
//delete ingredient
  if(isset($_POST['removeingredient'])){
    $id=$_POST['hidden'];
    $query="DELETE FROM ingredient WHERE IDIngredient='$id'";
    if(mysql_query($query,$GLOBALS['link'])){
      $contor3=$_SESSION['ctr5']-1;
      $alter="ALTER TABLE ingredient AUTO_INCREMENT=".$contor3;
      mysql_query($alter,$GLOBALS['link']);
      alert("Stergere reusita!");
    }
    else{
      alert("Stergere nereusita!");
    }
  }

//insert ingredient
  if(isset($_POST['saveingredient'])&&$_POST['denumire']!=""){
    $nume=$_POST['denumire'];
    $insert="INSERT INTO ingredient(Denumire) VALUES('$nume')";
    if(mysql_query($insert,$GLOBALS['link']))
      alert ("Adaugare reusita!");
    else
      alert("Ingredientul se afla deja in baza de date!");
  }


//operatii pe tabela compozitie
//delete compozitie
 if(isset($_POST['removecompozitie'])){
    $id=$_POST['hidden'];
    $query="DELETE FROM compozitie WHERE IDCompozitie='$id'";
    if(mysql_query($query,$GLOBALS['link'])){
      $contor6=$_SESSION['ctr6']-1;
      $alter="ALTER TABLE compozitie AUTO_INCREMENT=".$contor6;
      mysql_query($alter,$GLOBALS['link']);
      alert("Stergere reusita!");
    }
    else{
      alert("Stergere nereusita!");
    }
  }
//insert compozitie
   if(isset($_POST['savecompozitie'])){
    $nume=$_POST['hrana'];
    $ing=$_POST['ingredient'];
    $proc=$_POST['procent'];
    $query="SELECT IDHrana FROM Hrana WHERE Denumire LIKE '$nume'";
    $result1=mysql_query($query,$GLOBALS['link']);
    $record1=mysql_fetch_assoc($result1);
    $query="SELECT IDIngredient FROM ingredient WHERE Denumire LIKE '$ing'";
    $result2=mysql_query($query,$GLOBALS['link']);
    $record2=mysql_fetch_assoc($result2);
    $insert="INSERT INTO compozitie(IDHrana,IDIngredient,Procent) VALUES(".$record1['IDHrana'].",".$record2['IDIngredient'].",'$proc')";
    if(mysql_query($insert,$GLOBALS['link']))
      alert ("Adaugare reusita!");
    else
      alert("Produsul sau recomandarea nu se afla in baza de date!");
  }


//pentru primul tabel=>hrana
  echo '<div class="container">
          <h1><a name="Hrana">Hrana</a>-<a href="#Inserthrana">Add</a></h1>';
//filtru
  echo '
  <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2>Filtru</h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="a1">NumeProdus</label>
            <input type="text" class="form-control" id="a1" name=numeprodusfiltru>
          </div>
          <button type="submit" name=filtruprodus class="btn btn-success">Cauta</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div><br />';
  if(isset($_POST['filtruprodus'])&&$_POST['numeprodusfiltru']!=""){
	  $nume=$_POST['numeprodusfiltru'];
	  echo   '<table class="table table-bordered table-hover">
            <tr>
              <th>CodProdus</th>
              <th>Denumire</th>
              <th>Pret</th>
              <th>Animal</th>
              <th>Stoc</th>
              <th>Categorie</th>
              <th>Producator</th>
              <th>Actiune</th>
            </tr>';
  $query="SELECT IDHrana,CodProdus,Denumire,Pret,Animal,Stoc,Categorie,IDProducator FROM hrana WHERE Denumire LIKE '$nume'";
  $result=mysql_query($query, $GLOBALS['link']);
  while($record=mysql_fetch_assoc($result)){
    $id=$record['IDProducator'];
    $query="SELECT Nume FROM producator WHERE IDProducator='$id'";
    $rezultat=mysql_query($query,$GLOBALS['link']);
    $row=mysql_fetch_assoc($rezultat);
    echo '<tr>
            <td>'.$record['CodProdus'].'</td>
            <td>'.$record['Denumire'].'</td>
            <td>'.$record['Pret'].'</td>
            <td>'.$record['Animal'].'</td>
	 	        <td>'.$record['Stoc'].'</td>
            <td>'.$record['Categorie'].'</td>
            <td>'.$row['Nume'].'</td>
            <td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removehrana value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDHrana'].'></form><form action=updatehrana.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDHrana'].'></form>';
    echo '</tr>';
    echo "</form>";
  }}	
  else {
  echo   '<table class="table table-bordered table-hover">
            <tr>
              <th>CodProdus</th>
              <th>Denumire</th>
              <th>Pret</th>
              <th>Animal</th>
              <th>Stoc</th>
              <th>Categorie</th>
              <th>Producator</th>
              <th>Actiune</th>
            </tr>';
  $query="SELECT IDHrana,CodProdus,Denumire,Pret,Animal,Stoc,Categorie,IDProducator FROM hrana ";
  $result=mysql_query($query, $GLOBALS['link']);
  $contor=0;
  while($record=mysql_fetch_assoc($result)){
    $contor++;
    $_SESSION['ctr']=$contor;
    $id=$record['IDProducator'];
    $query="SELECT Nume FROM producator WHERE IDProducator='$id'";
    $rezultat=mysql_query($query,$GLOBALS['link']);
    $row=mysql_fetch_assoc($rezultat);
    echo '<tr>
            <td>'.$record['CodProdus'].'</td>
            <td>'.$record['Denumire'].'</td>
            <td>'.$record['Pret'].'</td>
            <td>'.$record['Animal'].'</td>
	 	        <td>'.$record['Stoc'].'</td>
            <td>'.$record['Categorie'].'</td>
            <td>'.$row['Nume'].'</td>
            <td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removehrana value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDHrana'].'></form><form action=updatehrana.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDHrana'].'></form>';
    echo '</tr>';
    echo "</form>";
  }}
  echo "</table>"; 
 //formular pentru adaugare hrana
  echo '
  <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="Inserthrana">Add</a></h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="attribute1">CodProdus</label>
            <input type="text" class="form-control" id="attribute1" name=codprodus>
          </div>
          <div class="form-group">
            <label for="attribute2">Denumire</label>
            <input type="text" class="form-control" id="attribute2" name=denumire>
          </div>
          <div class="form-group">
            <label for="attribute3">Pret</label>
            <input type="text" class="form-control" id="attribute3" name=pret>
          </div>
          <div class="form-group">
            <label for="attribute4">Animal</label>
            <input type="text" class="form-control" id="attribute4" name=animal>
          </div>
          <div class="form-group">
            <label for="attribute5">Stoc</label>
            <input type="text" class="form-control" id="attribute5" name=stoc>
          </div>
          <div class="form-group">
            <label for="attribute6">Categorie</label>
            <input type="text" class="form-control" id="attribute6" name=categorie>
          </div>
          <div class="form-group">
            <label for="attribute7">Producator</label>
            <input type="text" class="form-control" id="attribute7" name=producator>
          </div>
          <button type="submit" name=savehrana class="btn btn-success">Add</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div>';

  //pentru tabela producator
   echo ' <hr />
          <div class="container">
          <h1><a name="Producator">Producator</a>-<a href="#InsertProducator">Add</a></h1>';
   //filtru
   echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2>Filtru</h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="a2">NumeProducator</label>
            <input type="text" class="form-control" id="a2" name=numeproducatorfiltru>
          </div>
          <button type="submit" name=filtruproducator class="btn btn-success">Cauta</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div><br />';
  if(isset($_POST['filtruproducator'])&&$_POST['numeproducatorfiltru']!=""){
	echo ' <table class="table table-bordered table-hover">
            <tr>
              <th>Nume</th>
              <th>Manager</th>
              <th>Adresa</th>
              <th>CUI</th>
              <th>Actiune</th>
            </tr>';
	$nume=$_POST['numeproducatorfiltru'];
    $query="SELECT IDProducator,Nume,Manager,Oras,Strada,Numar,CUI FROM producator WHERE Nume LIKE '$nume'";
    $result=mysql_query($query,$GLOBALS['link']);
    while($record=mysql_fetch_assoc($result)){
      $id=$record['Manager'];
      $query="SELECT Nume,Prenume FROM manager WHERE IDManager='$id'";
      $rezultat=mysql_query($query,$GLOBALS['link']);
      $row=mysql_fetch_assoc($rezultat);
      echo '<tr>
              <td>'.$record['Nume'].'</td>
              <td>'.$row['Nume'].' '.$row['Prenume'].'</td>
              <td>'.$record['Oras'].', '.$record['Strada'].', NR.'.$record['Numar'].'</td>
              <td>'.$record['CUI'].'</td>
              <td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removeproducator value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDProducator'].'></form><form action=updateproducator.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDProducator'].'></form>';
      echo '</tr>';
      echo "</form>";  
  }}
  else {
   echo ' <table class="table table-bordered table-hover">
            <tr>
              <th>Nume</th>
              <th>Manager</th>
              <th>Adresa</th>
              <th>CUI</th>
              <th>Actiune</th>
            </tr>'; 
    $query="SELECT IDProducator,Nume,Manager,Oras,Strada,Numar,CUI FROM producator";
    $result=mysql_query($query,$GLOBALS['link']);
    $contor1=0;
    while($record=mysql_fetch_assoc($result)){
      $contor1++;
      $_SESSION['ctr1']=$contor1;
      $id=$record['Manager'];
      $query="SELECT Nume,Prenume FROM manager WHERE IDManager='$id'";
      $rezultat=mysql_query($query,$GLOBALS['link']);
      $row=mysql_fetch_assoc($rezultat);
      echo '<tr>
              <td>'.$record['Nume'].'</td>
              <td>'.$row['Nume'].' '.$row['Prenume'].'</td>
              <td>'.$record['Oras'].', '.$record['Strada'].', NR.'.$record['Numar'].'</td>
              <td>'.$record['CUI'].'</td>
              <td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removeproducator value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDProducator'].'></form><form action=updateproducator.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDProducator'].'></form>';
      echo '</tr>';
      echo "</form>";           
   }}
    echo "</table>";
    //formular pentru adaugare producator
    echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="InsertProducator">Add</a></h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="attribute8">Nume</label>
            <input type="text" class="form-control" id="attribute8" name=nume>
          </div>
          <div class="form-group">
            <label for="attribute9">CNP Manager</label>
            <input type="text" class="form-control" id="attribute9" name=cnp>
          </div>
          <div class="form-group">
            <label for="attribute10">Oras</label>
            <input type="text" class="form-control" id="attribute10" name=oras>
          </div>
          <div class="form-group">
            <label for="attribute11">Strada</label>
            <input type="text" class="form-control" id="attribute11" name=strada>
          </div>
          <div class="form-group">
            <label for="attribute12">NR</label>
            <input type="text" class="form-control" id="attribute12" name=nr>
          </div>
          <div class="form-group">
            <label for="attribute13">CUI</label>
            <input type="text" class="form-control" id="attribute13" name=cui>
          </div>
          <button type="submit" name=saveproducator class="btn btn-success">Add</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div>';

    //pentru tabela manager
    echo '  <hr />
          <div class="container">
          <h1><a name="Manager">Manager</a>-<a href="#InsertManager">Add</a></h1>';
    //filtru
	echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2>Filtru</h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="a3">NumeManager</label>
            <input type="text" class="form-control" id="a3" name=numemanagerfiltru>
          </div>
          <button type="submit" name=filtrumanager class="btn btn-success">Cauta</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div><br />';
	if(isset($_POST['filtrumanager'])&&$_POST['numemanagerfiltru']!=""){
	  $nume=$_POST['numemanagerfiltru'];
	  echo' <table class="table table-bordered table-hover">
            <tr>
              <th>Nume</th>
              <th>CNP</th>
              <th>Telefon</th>
              <th>E-mail</th>
              <th>Actiune</th>
            </tr>';
    $query="SELECT IDManager,Nume,Prenume,CNP,Telefon,Email FROM manager WHERE Nume LIKE '$nume'";
    $result=mysql_query($query,$GLOBALS['link']);
    while($record=mysql_fetch_assoc($result)){
      echo '<tr>
              <td>'.$record['Nume']." ".$record['Prenume'].'</td>
              <td>'.$record['CNP'].'</td>
              <td>'.$record['Telefon'].'</td>
              <td>'.$record['Email'].'</td>
              <td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removemanager value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDManager'].'></form><form action=updatemanager.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDManager'].'></form>';
      echo '</tr>';
      echo "</form>";           
    }}
    //fara filtru
	else{
	echo' <table class="table table-bordered table-hover">
            <tr>
              <th>Nume</th>
              <th>CNP</th>
              <th>Telefon</th>
              <th>E-mail</th>
              <th>Actiune</th>
            </tr>';
    $query="SELECT IDManager,Nume,Prenume,CNP,Telefon,Email FROM manager";
    $result=mysql_query($query,$GLOBALS['link']);
    $contor2=0;
    while($record=mysql_fetch_assoc($result)){
      $contor2++;
      $_SESSION['ctr2']=$contor2;
      echo '<tr>
              <td>'.$record['Nume']." ".$record['Prenume'].'</td>
              <td>'.$record['CNP'].'</td>
              <td>'.$record['Telefon'].'</td>
              <td>'.$record['Email'].'</td>
              <td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removemanager value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDManager'].'></form><form action=updatemanager.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDManager'].'></form>';
      echo '</tr>';
      echo "</form>";           
    }}  
    echo "</table>";
    //formular pentru adaugare manager
    echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="InsertManager">Add</a></h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="attribute14">Nume</label>
            <input type="text" class="form-control" id="attribute14" name=nume>
          </div>
          <div class="form-group">
            <label for="attribute15">Prenume</label>
            <input type="text" class="form-control" id="attribute15" name=prenume>
          </div>
          <div class="form-group">
            <label for="attribute16">CNP</label>
            <input type="text" class="form-control" id="attribute16" name=cnp>
          </div>
          <div class="form-group">
            <label for="attribute17">Telefon</label>
            <input type="text" class="form-control" id="attribute17" name=telefon>
          </div>
          <div class="form-group">
            <label for="attribute18">E-mail</label>
            <input type="text" class="form-control" id="attribute18" name=email>
          </div>
          <button type="submit" name=savemanager class="btn btn-success">Add</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div>';
    //pentru tabela recomandare
    echo '<hr />
          <div class="container">
          <h1><a name="Recomandare">Recomandare</a>-<a href="#InsertRecomandare">Add</a></h1>';
    //filtru
    echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2>Filtru</h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="a4">NumeRecomandare</label>
            <input type="text" class="form-control" id="a4" name=numerecomandarefiltru>
          </div>
          <button type="submit" name=filtrurecomandare class="btn btn-success">Cauta</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div><br />';      
    if(isset($_POST['filtrurecomandare'])&&$_POST['numerecomandarefiltru']!=""){
      $nume=$_POST['numerecomandarefiltru'];
      echo '
          <table class="table table-bordered table-hover">
            <tr>
              <th>Denumire</th>
              <th>Actiune</th>
            </tr>';
    $query="SELECT IDRecomandare,Denumire FROM recomandare WHERE Denumire LIKE '$nume'";
    $result=mysql_query($query,$GLOBALS['link']);
    while($record=mysql_fetch_assoc($result)){
      echo '<tr>
              <td>'.$record['Denumire'].'</td>
              <td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removerecomandare value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDRecomandare'].'></form><form action=updaterecomandare.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDRecomandare'].'></form>';
      echo '</tr>';
      echo "</form>";   
    }}
    //terminare filtru
    else {   
    echo '
          <table class="table table-bordered table-hover">
            <tr>
              <th>Denumire</th>
              <th>Actiune</th>
            </tr>';
    $query="SELECT IDRecomandare,Denumire FROM recomandare";
    $result=mysql_query($query,$GLOBALS['link']);
    $contor3=0;
    while($record=mysql_fetch_assoc($result)){
      $contor3++;
      $_SESSION['ctr3']=$contor3;
      echo '<tr>
              <td>'.$record['Denumire'].'</td>
              <td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removerecomandare value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDRecomandare'].'></form><form action=updaterecomandare.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDRecomandare'].'></form>';
      echo '</tr>';
      echo "</form>";           
    }}  
    echo "</table>";

    //formular pentru adaugare recomandare
    echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="InsertRecomandare">Add</a></h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="attribute19">Denumire</label>
            <input type="text" class="form-control" id="attribute19" name=denumire>
          </div>
          <button type="submit" name=saverecomandare class="btn btn-success">Add</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div>';
    
    //tabela hrana recomandare
    echo   '<hr />
          <div class="container">
          <h1><a name="HranaRecomandare">HranaRecomandare</a>-<a href="#InsertHR">Add</a></h1>';
    //filtru dupa recomandare sau hrana
    echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2>Filtru</h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="a5">NumeProdus</label>
            <input type="text" class="form-control" id="a5" name=numeprodusfiltru>
          </div>
          <div class="form-group">
            <label for="a6">NumeRecomandare</label>
            <input type="text" class="form-control" id="a6" name=numerecomandarefiltru>
          </div>
          <button type="submit" name=filtruprodrec class="btn btn-success">Cauta</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div><br />'; 
    if(isset($_POST['filtruprodrec'])&&($_POST['numeprodusfiltru']!=""||$_POST['numerecomandarefiltru']!="")){
      echo  '
          <table class="table table-bordered table-hover">
            <tr>
              <th>Nume Produs</th>
              <th>Recomandare</th>
              <th>Actiune</th>
            </tr>';
      if($_POST['numeprodusfiltru']!="" && $_POST['numerecomandarefiltru']==""){
        $nume=$_POST['numeprodusfiltru'];
        $query="SELECT IDHrana FROM hrana WHERE Denumire LIKE '$nume'";
        $result=mysql_query($query,$GLOBALS['link']);
        $record=mysql_fetch_assoc($result);
        $idh=$record['IDHrana'];
        $query="SELECT IDHR,IDHrana,IDRecomandare FROM hrana_recomandare WHERE IDHrana='$idh'";
        $result=mysql_query($query,$GLOBALS['link']);
        while($record=mysql_fetch_assoc($result)){
          $idh=$record['IDHrana'];
          $query="SELECT Denumire FROM hrana WHERE IDHrana='$idh'";
          $rezultat=mysql_query($query,$GLOBALS['link']);
          $record1=mysql_fetch_assoc($rezultat);
          echo '<tr>
                  <td>'.$record1['Denumire'].'</td>';
          $query="SELECT Denumire FROM recomandare WHERE IDRecomandare=".$record['IDRecomandare'];
          $rezultat1=mysql_query($query,$GLOBALS['link']);
          $record2=mysql_fetch_assoc($rezultat1);
          echo '<td>'.$record2['Denumire'].'</td>';
          echo '<td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removehr value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDHR'].'></form><form action=updatehr.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDHR'].'></form></td>';      
          echo '</tr>';
      }}
      elseif($_POST['numeprodusfiltru']=="" && $_POST['numerecomandarefiltru']!=""){
        $nume=$_POST['numerecomandarefiltru'];
        $query="SELECT IDRecomandare FROM recomandare WHERE Denumire LIKE '$nume'";
        $result=mysql_query($query,$GLOBALS['link']);
        $record=mysql_fetch_assoc($result);
        $idr=$record['IDRecomandare'];
        $query="SELECT IDHR,IDHrana,IDRecomandare FROM hrana_recomandare WHERE IDRecomandare='$idr'";
        $result=mysql_query($query,$GLOBALS['link']);
        while($record=mysql_fetch_assoc($result)){
          $idr=$record['IDRecomandare'];
          $query="SELECT Denumire FROM hrana WHERE IDHrana=".$record['IDHrana'];
          $rezultat=mysql_query($query,$GLOBALS['link']);
          $record1=mysql_fetch_assoc($rezultat);
          echo '<tr>
                  <td>'.$record1['Denumire'].'</td>';
          $query="SELECT Denumire FROM recomandare WHERE IDRecomandare='$idr' AND Denumire LIKE '$nume'";
          $rezultat1=mysql_query($query,$GLOBALS['link']);
          $record2=mysql_fetch_assoc($rezultat1);
          echo '<td>'.$record2['Denumire'].'</td>';
          echo '<td>'.'<form action=informatii.php method=POST>'
                   .'<input type=submit class="btn btn-danger" name=removehr value=Remove />'
                   .'<input type=hidden name=hidden value='.$record['IDHR'].'></form><form action=updatehr.php method=POST>'
                   .'<input type=submit class="btn btn-warning" name=update value=Update />'
                   .'<input type=hidden name=hidden value='.$record['IDHR'].'></form></td>';      
          echo '</tr>';
      }}
      elseif($_POST['numeprodusfiltru']!="" && $_POST['numerecomandarefiltru']!=""){
        $nume=$_POST['numerecomandarefiltru'];
        $numeh=$_POST['numeprodusfiltru'];
        $query="SELECT IDHrana FROM hrana WHERE Denumire LIKE '$numeh'";
        $result=mysql_query($query,$GLOBALS['link']);
        $record=mysql_fetch_assoc($result);
        $idh=$record['IDHrana'];
        $query="SELECT IDRecomandare FROM recomandare WHERE Denumire LIKE '$nume'";
        $result=mysql_query($query,$GLOBALS['link']);
        $record=mysql_fetch_assoc($result);
        $idr=$record['IDRecomandare'];
        $query="SELECT IDHR,IDHrana,IDRecomandare FROM hrana_recomandare WHERE IDHrana='$idh' AND IDRecomandare='$idr'";
        $result=mysql_query($query,$GLOBALS['link']);
        while($record=mysql_fetch_assoc($result)){
          $idr=$record['IDRecomandare'];
          $idh=$record['IDHrana'];
          $query="SELECT Denumire FROM hrana WHERE IDHrana='$idh' AND Denumire LIKE '$numeh'";
          $rezultat=mysql_query($query,$GLOBALS['link']);
          $record1=mysql_fetch_assoc($rezultat);
          echo '<tr>
                  <td>'.$record1['Denumire'].'</td>';
          $query="SELECT Denumire FROM recomandare WHERE IDRecomandare='$idr' AND Denumire LIKE '$nume'";
          $rezultat1=mysql_query($query,$GLOBALS['link']);
          $record2=mysql_fetch_assoc($rezultat1);
          echo '<td>'.$record2['Denumire'].'</td>';
          echo '<td>'.'<form action=informatii.php method=POST>'
                   .'<input type=submit class="btn btn-danger" name=removehr value=Remove />'
                   .'<input type=hidden name=hidden value='.$record['IDHR'].'></form><form action=updatehr.php method=POST>'
                   .'<input type=submit class="btn btn-warning" name=update value=Update />'
                   .'<input type=hidden name=hidden value='.$record['IDHR'].'></form></td>';      
          echo '</tr>';
      }}}
    else {     
    echo  '
          <table class="table table-bordered table-hover">
            <tr>
              <th>Nume Produs</th>
              <th>Recomandare</th>
              <th>Actiune</th>
            </tr>';
    $query="SELECT IDHR,IDHrana,IDRecomandare FROM hrana_recomandare";
    $result=mysql_query($query,$GLOBALS['link']);
    $contor4=0;
    while($record=mysql_fetch_assoc($result)){
      $contor4++;
      $_SESSION['ctr4']=$contor4;
      $query="SELECT Denumire FROM hrana WHERE IDHrana=".$record['IDHrana'];
      $rezultat=mysql_query($query,$GLOBALS['link']);
      $record1=mysql_fetch_assoc($rezultat);
      echo '<tr>
              <td>'.$record1['Denumire'].'</td>';
      $query="SELECT Denumire FROM recomandare WHERE IDRecomandare=".$record['IDRecomandare'];
      $rezultat1=mysql_query($query,$GLOBALS['link']);
      $record2=mysql_fetch_assoc($rezultat1);
      echo '<td>'.$record2['Denumire'].'</td>';
      echo '<td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removehr value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDHR'].'></form><form action=updatehr.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDHR'].'></form></td>';      
      echo '</tr>';
    }}  
    echo '</div>';
    echo "</table>";
   
    //formular pentru adaugare hrana_recomandare
    echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="InsertHR">Add</a></h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="attribute20">Nume Produs</label>
            <input type="text" class="form-control" id="attribute20" name=hrana>
          </div>
          <div class="form-group">
            <label for="attribute21">Recomandare</label>
            <input type="text" class="form-control" id="attribute21" name=recomandare>
          </div>
          <button type="submit" name=savehr class="btn btn-success">Add</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div>';
  
    //pentru tabela ingredient
    echo '<hr />
          <div class="container">
          <h1><a name="Ingredient">Ingredient</a>-<a href="#InsertIngredient">Add</a></h1>';
    //filtru ingredient
    echo '
        <div class="row">
          <div class="col-sm-3"></div>
          <div class="col-sm-6">
            <h2>Filtru</h2>
            <form action=informatii.php method=POST>
              <div class="form-group">
                <label for="a7">NumeIngredient</label>
                <input type="text" class="form-control" id="a7" name=numeingredientfiltru>
              </div>
              <button type="submit" name=filtruingredient class="btn btn-success">Cauta</button>
            </form>
          </div>
        <div class="col-sm-3"></div></div><br />';  
    echo '
          <table class="table table-bordered table-hover">
            <tr>
              <th>Denumire</th>
              <th>Actiune</th>
            </tr>';
    if(isset($_POST['filtruingredient']) && $_POST['numeingredientfiltru']!=""){
      $nume=$_POST['numeingredientfiltru'];
      $query="SELECT IDIngredient,Denumire FROM ingredient WHERE Denumire LIKE '$nume'";
      $result=mysql_query($query,$GLOBALS['link']);
      while($record=mysql_fetch_assoc($result)){
        echo '<tr>
                <td>'.$record['Denumire'].'</td>
                <td>'.'<form action=informatii.php method=POST>'
                   .'<input type=submit class="btn btn-danger" name=removeingredient value=Remove />'
                   .'<input type=hidden name=hidden value='.$record['IDIngredient'].'></form><form action=updateingredient.php method=POST>'
                   .'<input type=submit class="btn btn-warning" name=update value=Update />'
                   .'<input type=hidden name=hidden value='.$record['IDIngredient'].'></form>';
        echo '</tr>';
        echo "</form>";
    }}
    else{
    $query="SELECT IDIngredient,Denumire FROM ingredient";
    $result=mysql_query($query,$GLOBALS['link']);
    $contor5=0;
    while($record=mysql_fetch_assoc($result)){
      $contor5++;
      $_SESSION['ctr5']=$contor5;
      echo '<tr>
              <td>'.$record['Denumire'].'</td>
              <td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removeingredient value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDIngredient'].'></form><form action=updateingredient.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDIngredient'].'></form>';
      echo '</tr>';
      echo "</form>";           
    }}  
    echo "</table>";
    //formular pentru adaugare ingredient
    echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="InsertIngredient">Add</a></h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="attribute22">Denumire</label>
            <input type="text" class="form-control" id="attribute22" name=denumire>
          </div>
          <button type="submit" name=saveingredient class="btn btn-success">Add</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div>';
    //pentru tabela compozitie
      echo '<hr />
          <div class="container">
          <h1><a name="Compozitie">Compozitie</a>-<a href="#InsertCompozitie">Add</a></h1>';
      echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2>Filtru</h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="a8">NumeProdus</label>
            <input type="text" class="form-control" id="a8" name=numeprodusfiltru>
          </div>
          <div class="form-group">
            <label for="a9">NumeIngredient</label>
            <input type="text" class="form-control" id="a9" name=numeingredientfiltru>
          </div>
          <button type="submit" name=filtrucompozitie class="btn btn-success">Cauta</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div><br />'; 
    echo '
          <table class="table table-bordered table-hover">
            <tr>
              <th>Nume Produs</th>
              <th>Ingredient</th>
              <th>Procent</th>
              <th>Actiune</th>
            </tr>';
    if(isset($_POST['filtrucompozitie'])  &&  ($_POST['numeprodusfiltru']!="" || $_POST['numeingredientfiltru']!="")){
      if($_POST['numeprodusfiltru']!="" && $_POST['numeingredientfiltru']==""){
        $numep=$_POST['numeprodusfiltru'];
        $query="SELECT IDHrana FROM hrana WHERE Denumire LIKE '$numep'";
        $result=mysql_query($query,$GLOBALS['link']);
        $record=mysql_fetch_assoc($result);
        $idp=$record['IDHrana'];
        $query="SELECT IDCompozitie,IDHrana,IDIngredient,Procent FROM compozitie WHERE IDHrana='$idp'";
        $result=mysql_query($query,$GLOBALS['link']);
        while($record=mysql_fetch_assoc($result)){
          $query="SELECT Denumire FROM hrana WHERE IDHrana=".$record['IDHrana'];
          $rezultat=mysql_query($query,$GLOBALS['link']);
          $record1=mysql_fetch_assoc($rezultat);
          echo '<tr>
                  <td>'.$record1['Denumire'].'</td>';
          $query="SELECT Denumire FROM Ingredient WHERE IDIngredient=".$record['IDIngredient'];
          $rezultat1=mysql_query($query,$GLOBALS['link']);
          $record2=mysql_fetch_assoc($rezultat1);
          echo '<td>'.$record2['Denumire'].'</td>';
          echo '<td>'.$record['Procent'].'</td>';
          echo '<td>'.'<form action=informatii.php method=POST>'
                     .'<input type=submit class="btn btn-danger" name=removecompozitie value=Remove />'
                     .'<input type=hidden name=hidden value='.$record['IDCompozitie'].'></form><form action=updatecompozitie.php method=POST>'
                     .'<input type=submit class="btn btn-warning" name=update value=Update />'
                     .'<input type=hidden name=hidden value='.$record['IDCompozitie'].'></form></td>';      
          echo '</tr>';
      }}
      elseif($_POST['numeprodusfiltru']=="" && $_POST['numeingredientfiltru']!=""){
        $numei=$_POST['numeingredientfiltru'];
        $query="SELECT IDIngredient FROM ingredient WHERE Denumire LIKE '$numei'";
        $result=mysql_query($query,$GLOBALS['link']);
        $record=mysql_fetch_assoc($result);
        $idi=$record['IDIngredient'];
        $query="SELECT IDCompozitie,IDHrana,IDIngredient,Procent FROM compozitie WHERE IDIngredient='$idi'";
        $result=mysql_query($query,$GLOBALS['link']);
        while($record=mysql_fetch_assoc($result)){
          $query="SELECT Denumire FROM hrana WHERE IDHrana=".$record['IDHrana'];
          $rezultat=mysql_query($query,$GLOBALS['link']);
          $record1=mysql_fetch_assoc($rezultat);
          echo '<tr>
                  <td>'.$record1['Denumire'].'</td>';
          $query="SELECT Denumire FROM Ingredient WHERE IDIngredient=".$record['IDIngredient'];
          $rezultat1=mysql_query($query,$GLOBALS['link']);
          $record2=mysql_fetch_assoc($rezultat1);
          echo '<td>'.$record2['Denumire'].'</td>';
          echo '<td>'.$record['Procent'].'</td>';
          echo '<td>'.'<form action=informatii.php method=POST>'
                     .'<input type=submit class="btn btn-danger" name=removecompozitie value=Remove />'
                     .'<input type=hidden name=hidden value='.$record['IDCompozitie'].'></form><form action=updatecompozitie.php method=POST>'
                     .'<input type=submit class="btn btn-warning" name=update value=Update />'
                     .'<input type=hidden name=hidden value='.$record['IDCompozitie'].'></form></td>';      
          echo '</tr>';
      }} 
      elseif($_POST['numeprodusfiltru']!="" && $_POST['numeingredientfiltru']!=""){
        $numep=$_POST['numeprodusfiltru'];
        $query="SELECT IDHrana FROM hrana WHERE Denumire LIKE '$numep'";
        $result=mysql_query($query,$GLOBALS['link']);
        $record=mysql_fetch_assoc($result);
        $idp=$record['IDHrana'];
        $numei=$_POST['numeingredientfiltru'];
        $query="SELECT IDIngredient FROM ingredient WHERE Denumire LIKE '$numei'";
        $result=mysql_query($query,$GLOBALS['link']);
        $record=mysql_fetch_assoc($result);
        $idi=$record['IDIngredient'];
        $query="SELECT IDCompozitie,IDHrana,IDIngredient,Procent FROM compozitie WHERE IDHrana='$idp' AND IDIngredient='$idi'";
        $result=mysql_query($query,$GLOBALS['link']);
        while($record=mysql_fetch_assoc($result)){
          $query="SELECT Denumire FROM hrana WHERE IDHrana=".$record['IDHrana'];
          $rezultat=mysql_query($query,$GLOBALS['link']);
          $record1=mysql_fetch_assoc($rezultat);
          echo '<tr>
                  <td>'.$record1['Denumire'].'</td>';
          $query="SELECT Denumire FROM Ingredient WHERE IDIngredient=".$record['IDIngredient'];
          $rezultat1=mysql_query($query,$GLOBALS['link']);
          $record2=mysql_fetch_assoc($rezultat1);
          echo '<td>'.$record2['Denumire'].'</td>';
          echo '<td>'.$record['Procent'].'</td>';
          echo '<td>'.'<form action=informatii.php method=POST>'
                     .'<input type=submit class="btn btn-danger" name=removecompozitie value=Remove />'
                     .'<input type=hidden name=hidden value='.$record['IDCompozitie'].'></form><form action=updatecompozitie.php method=POST>'
                     .'<input type=submit class="btn btn-warning" name=update value=Update />'
                     .'<input type=hidden name=hidden value='.$record['IDCompozitie'].'></form></td>';      
          echo '</tr>';
      }} 
    } 
    else{
    $query="SELECT IDCompozitie,IDHrana,IDIngredient,Procent FROM compozitie";
    $result=mysql_query($query,$GLOBALS['link']);
    $contor6=0;
    while($record=mysql_fetch_assoc($result)){
      $contor6++;
      $_SESSION['ctr6']=$contor6;
      $query="SELECT Denumire FROM hrana WHERE IDHrana=".$record['IDHrana'];
      $rezultat=mysql_query($query,$GLOBALS['link']);
      $record1=mysql_fetch_assoc($rezultat);
      echo '<tr>
              <td>'.$record1['Denumire'].'</td>';
      $query="SELECT Denumire FROM Ingredient WHERE IDIngredient=".$record['IDIngredient'];
      $rezultat1=mysql_query($query,$GLOBALS['link']);
      $record2=mysql_fetch_assoc($rezultat1);
      echo '<td>'.$record2['Denumire'].'</td>';
      echo '<td>'.$record['Procent'].'</td>';
      echo '<td>'.'<form action=informatii.php method=POST>'
                 .'<input type=submit class="btn btn-danger" name=removecompozitie value=Remove />'
                 .'<input type=hidden name=hidden value='.$record['IDCompozitie'].'></form><form action=updatecompozitie.php method=POST>'
                 .'<input type=submit class="btn btn-warning" name=update value=Update />'
                 .'<input type=hidden name=hidden value='.$record['IDCompozitie'].'></form></td>';      
      echo '</tr>';
    }}  
    echo '</div>';
    echo "</table>";
    // formular pentru adaugare compozitie
    echo '
    <div class="row">
      <div class="col-sm-3"></div>
      <div class="col-sm-6">
        <h2><a name="InsertCompozitie">Add</a></h2>
        <form action=informatii.php method=POST>
          <div class="form-group">
            <label for="attribute23">Nume Produs</label>
            <input type="text" class="form-control" id="attribute23" name=hrana>
          </div>
          <div class="form-group">
            <label for="attribute24">Ingredient</label>
            <input type="text" class="form-control" id="attribute24" name=ingredient>
          </div>
          <div class="form-group">
            <label for="attribute25">Procent</label>
            <input type="text" class="form-control" id="attribute25" name=procent>
          </div>
          <button type="submit" name=savecompozitie class="btn btn-success">Add</button>
        </form>
      </div>
      <div class="col-sm-3"></div></div>';
  echo "</body></html>";
    
 ?>