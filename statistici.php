
<!DOCTYPE html>
<html lang=''>
<head>
  <link rel="stylesheet" href="cssmenu/styles.css">
  <link rel="stylesheet" media="all" href="cssmenu/bootstrap.min.css">
  <link rel="stylesheet" media="all" href="cssmenu/custom.css">
  <script src="http://code.jquery.com/jquery-latest.min.js" type=text/javascript></script>
  <script src="cssmenu/script.js"></script>
  <title>PetShop</title>
  <style>
    h3{color:red;}
  </style>
</head>
<body>

<div id='cssmenu'>
<ul>
   <li><a href='home.php'>Home</a></li>
   <li><a href='informatii.php'>Informatii</a></li>
   <li class='active'><a href='statistici.php'>Statistici</a></li>
   <li><a href='index.php'>LOGOUT</a></li>
</ul>
</div>
<br /><br /><br />
<center><h2>Interogari</h2></center>
<h3 align="left"><strong>Simple</strong></h3>
<?php 
  
  require_once('database_connect.php');

  function alert($s){
     echo '<script type="text/javascript">alert("'.$s.'")</script>';
  }
  /*
  query
  simple:
  1.Pentru fiecare produs afisati denumirea,pretul,stocul si numele producatorului.
  2.Afisati pentru toate produsele din categoria:"..." recomandarile.
  3.Pentru producatorii cu adresa in orasul: "..." afisati numele producatorului, CUI, numele si prenumele managerului.
  4.Selectati denumirea produselor care sunt produse de "...".
  5.Selectati denumirea produselor care contin "..." intr-o proportie mai mare de "..."%.
  6.Selectati denumirea tuturor produselor produse de "..." sau cele ale caror producator il au ca manager pe "...".
  7.Pentru fiecare producator afisati numarul de produse.
  */
  
  //1
  echo "<ol>";
  echo "<li><strong>Denumirea, pretul, stocul si numele producatorului pentru fiecare produs:</strong></li><br />";
  echo   '<table class="table table-bordered table-hover">
            <tr>
              <th>Denumire</th>
              <th>Pret</th>
              <th>Stoc</th>
              <th>NumeProducator</th>
            </tr>';
  $query="SELECT H.Denumire, H.Pret, H.Stoc, P.Nume
          FROM hrana H INNER JOIN producator P ON (H.IDProducator = P.IDProducator)";
  $result=mysql_query($query, $GLOBALS['link']);
  while($record=mysql_fetch_assoc($result)){
    echo '<tr>
            <td>'.$record['Denumire'].'</td>
            <td>'.$record['Pret'].'</td>
            <td>'.$record['Stoc'].'</td>
            <td>'.$record['Nume'].'</td>';
    echo '</tr>';
  }
  echo "</table><hr />";
  
  //2
  echo "<li><strong>Pentru toate produsele din categoria indicata se afiseaza recomandarile:</strong></li><br />";
  echo '<form action=statistici.php method=POST>
        <input type=text name=numecategorie />
        <input type=submit name=submit1 value=SELECT /></form><br />';
  if(isset($_POST['submit1']) && $_POST['numecategorie'] != ""){
    $categ=$_POST['numecategorie'];
    $query="SELECT H.Denumire AS NumeProdus,R.Denumire as Recomandare
            FROM hrana_recomandare HR INNER JOIN hrana H ON (HR.IDHrana = H.IDHrana)
                                      INNER JOIN recomandare R ON (HR.IDRecomandare=R.IDRecomandare)
            WHERE H.Categorie LIKE '$categ'";
    $result=mysql_query($query, $GLOBALS['link']);
    if(!mysql_num_rows($result))alert("Categoria nu exista!");
    else{
      echo '<table class="table table-bordered table-hover">
            <tr>
              <th>NumeProdus</th>
              <th>Recomandare</th>
            </tr>';
      while($record=mysql_fetch_assoc($result)){
        echo '<tr>
                <td>'.$record['NumeProdus'].'</td>
                <td>'.$record['Recomandare'].'</td>
              </tr>';
      }
    }
    echo "</table>";
  }
  echo "<hr />";
  
  //3
  echo "<li><strong>Pentru producatorii cu adresa in orasul indicat se precizeaza numele, CUI, numele si prenumele managerului.</strong></li><br />";
  echo '<form action=statistici.php method=POST>
        <input type=text name=numeoras />
        <input type=submit name=submit2 value=SELECT /></form><br />';
  if(isset($_POST['submit2']) && $_POST['numeoras'] != ""){
    $oras=$_POST['numeoras'];
    $query="SELECT P.Nume AS NumeProducator, P.CUI, M.Nume AS NumeManager, M.Prenume
			FROM producator P INNER JOIN manager M ON (P.Manager=M.IDManager)
			WHERE P.Oras LIKE '$oras'";
    $result=mysql_query($query, $GLOBALS['link']);
    if(!mysql_num_rows($result))alert("Nu exista nici un producator in orasul indicat!");
    else{
      echo '<table class="table table-bordered table-hover">
            <tr>
              <th>NumeProducator</th>
              <th>CUI</th>
              <th>NumeManager</th>
              <th>PrenumeManager</th>
            </tr>';
      while($record=mysql_fetch_assoc($result)){
        echo '<tr>
                <td>'.$record['NumeProducator'].'</td>
                <td>'.$record['CUI'].'</td>
                <td>'.$record['NumeManager'].'</td>
                <td>'.$record['Prenume'].'</td>
              </tr>';
      }
    }
    echo "</table>";
  }
  echo "<hr />";
  
  //4
  echo "<li><strong>Denumire produse realizate de producatorul indicat.</strong></li><br />";
  echo '<form action=statistici.php method=POST>
        <input type=text name=numeproducator />
        <input type=submit name=submit3 value=SELECT /></form><br />';
  if(isset($_POST['submit3']) && $_POST['numeproducator'] != ""){
    $prod=$_POST['numeproducator'];
    $query="SELECT H.Denumire
            FROM hrana H INNER JOIN producator P ON (H.IDProducator=P.IDProducator)
            WHERE P.Nume LIKE '$prod'";
    $result=mysql_query($query, $GLOBALS['link']);
    if(!mysql_num_rows($result))alert("Nu exista acest producator!");
    else{
      echo '<table class="table table-bordered table-hover">
            <tr>
              <th>Denumire produs</th>
            </tr>';
      while($record=mysql_fetch_assoc($result)){
        echo '<tr>
                <td>'.$record['Denumire'].'</td>
              </tr>';
      }
    }
    echo "</table>";
  }
  echo "<hr />";
  
  //5
    /*5.Selectati denumirea produselor care contin alimentul indicat intr-o proportie mai mare decat procentul indicat%.*/
  echo "<li><strong>Denumirea produselor care contin alimentul indicat intr-o proportie mai mare decat procentul indicat.</strong></li><br />";
  echo '<form action=statistici.php method=POST>
        <input type=text name=numealiment /><br />
        <input type=text name=procent />
        <input type=submit name=submit4 value=SELECT /></form><br />';
  if(isset($_POST['submit4']) && $_POST['numealiment'] != "" && $_POST['procent'] !=""){
    $alim=$_POST['numealiment'];
    $proc=$_POST['procent'];
    $query="SELECT H.Denumire
            FROM compozitie C INNER JOIN hrana H ON (C.IDHrana=H.IDHrana)
                              INNER JOIN ingredient I ON (C.IDIngredient=I.IDIngredient)
            WHERE I.Denumire LIKE '$alim' AND C.Procent>'$proc'";
    $result=mysql_query($query, $GLOBALS['link']);
    if(!mysql_num_rows($result))alert("Nu exista produse care sa corespunda!");
    else{
      echo '<table class="table table-bordered table-hover">
            <tr>
              <th>Denumire produs</th>
            </tr>';
      while($record=mysql_fetch_assoc($result)){
        echo '<tr>
                <td>'.$record['Denumire'].'</td>
              </tr>';
      }
    }
    echo "</table>";
  }
  echo "<hr />";
 
  //6
  /*6.Selectati denumirea tuturor produselor realizare de "..." sau cele ale caror producator il au ca manager pe "...".*/
  echo "<li><strong>Denumirea produselor realizate de producatorul indicat sau de producatorul ce are managerul indicat.</strong></li><br />";
  echo '<form action=statistici.php method=POST>
        <input type=text name=numeproducator2 /><br />
        <input type=text name=manager />
        <input type=submit name=submit5 value=SELECT /></form><br />';
  if(isset($_POST['submit5']) && ($_POST['numeproducator2'] != "" || $_POST['manager'] !="")){
    $prod2=$_POST['numeproducator2'];
    $man=$_POST['manager'];
    $query="SELECT H.Denumire
            FROM producator P INNER JOIN manager M ON(P.Manager=M.IDManager)
                              INNER JOIN hrana H ON(P.IDProducator=H.IDProducator)
            WHERE P.Nume LIKE '$prod2' OR M.Nume LIKE '$man'";
    $result=mysql_query($query, $GLOBALS['link']);
    if(!mysql_num_rows($result))alert("Nu exista produse care sa corespunda!");
    else{
      echo '<table class="table table-bordered table-hover">
            <tr>
              <th>Denumire produs</th>
            </tr>';
      while($record=mysql_fetch_assoc($result)){
        echo '<tr>
                <td>'.$record['Denumire'].'</td>
              </tr>';
      }
    }
    echo "</table>";
  }
  echo "<hr />";
  //7
  /*7.Pentru fiecare producator afisati numarul de produse.*/
  echo "<li><strong>Numarul de produse per producator.</strong></li><br />";
  $query="SELECT P.Nume, COUNT(*) AS Numar
          FROM hrana H INNER JOIN producator P ON(H.IDProducator=P.IDProducator)
          GROUP BY P.Nume";
  $result=mysql_query($query, $GLOBALS['link']);
  echo '<table class="table table-bordered table-hover">
            <tr>
              <th>Producator</th>
              <th>Numar Produse</th>
            </tr>';
  while($record=mysql_fetch_assoc($result)){
        echo '<tr>
                <td>'.$record['Nume'].'</td>
                <td>'.$record['Numar'].'</td>
              </tr>';
  }
  echo "</table><hr />";
  echo "</ol>";
 ?>
<h3 align="left"><strong>Complexe</strong></h3>
<?php 

  require_once('database_connect.php');

  /*query:complexe
  1.Afisati denumirea, stocul, pretul si producatorul celor mai scumpe n produse.
  2.Afisati numele producatorilor care produc cel putin n produse.
  3.Afisati denumirea, pretul si stocul produselor care au pretul mai mare decat media preturilor.
  4.Afisati denumirea produselor care contin cel mai mare procentaj alimentul precizat.
  5.Afisati numele producatorului care realizeaza cele mai multe produse.
  6.Afisati produsele care au stocul mai mare decat media stocului per producator. 
  */
  //1
  echo "<ol>";
  echo "<li><strong>Denumirea, stocul, pretul si producatorul celor mai scumpe n produse.</strong></li><br />";
  echo '<form action=statistici.php method=POST>
        <input type=text name=topn />
        <input type=submit name=submit6 value=SELECT /></form><br />';
  if(isset($_POST['submit6']) && $_POST['topn'] != ""){
    $n=$_POST['topn'];
    $query="SELECT H.Denumire, H.Stoc, H.Pret, P.Nume
            FROM hrana H INNER JOIN producator P ON(H.IDProducator=P.IDProducator)
                         INNER JOIN (SELECT DISTINCT Pret
                                     FROM hrana
                                     ORDER BY Pret DESC
                                     LIMIT ".$n." ) subq ON (H.Pret=subq.pret)";
    $result=mysql_query($query, $GLOBALS['link']);
    echo '<table class="table table-bordered table-hover">
            <tr>
              <th>Denumire produs</th>
              <th>Stoc</th>
              <th>Pret</th>
              <th>Producator</th>
            </tr>';
      while($record=mysql_fetch_assoc($result)){
        echo '<tr>
                <td>'.$record['Denumire'].'</td>
                <td>'.$record['Stoc'].'</td>
                <td>'.$record['Pret'].'</td>
                <td>'.$record['Nume'].'</td>
              </tr>';
      }
    }
  echo "</table>";
  echo "<hr />";

  //2
  echo "<li><strong>Numele producatorului care realizeaza cel putin n produse.</strong></li><br />";
  echo '<form action=statistici.php method=POST>
        <input type=text name=nprod />
        <input type=submit name=submit7 value=SELECT /></form><br />';
  if(isset($_POST['submit7']) && $_POST['nprod'] != ""){
    $n1=$_POST['nprod'];
    $query="SELECT P.Nume
            FROM producator P
            WHERE ".$n1."<=(SELECT COUNT(*)
                         FROM hrana
                         WHERE IDProducator=P.IDProducator
                         GROUP BY IDProducator)";
    $result=mysql_query($query, $GLOBALS['link']);
    echo '<table class="table table-bordered table-hover">
            <tr>
              <th>Nume Producator</th>
            </tr>';
      while($record=mysql_fetch_assoc($result)){
        echo '<tr>
                <td>'.$record['Nume'].'</td>
              </tr>';
      }
    }
  echo "</table>";
  echo "<hr />";  

  //3
  /* 3.Afisati denumirea, pretul si stocul produselor care au pretul mai mare decat media preturilor.*/
  echo "<li><strong>Numele,pretul si stocul produselor care au pretul mai mare decat media preturilor.</strong></li><br />";
  $query="SELECT H.Denumire, H.Pret, H.Stoc
          FROM hrana H
          WHERE H.Pret > (SELECT AVG(Pret)
                          FROM hrana)";
  $result=mysql_query($query, $GLOBALS['link']);
  echo '<table class="table table-bordered table-hover">
          <tr>
            <th>Nume Produs</th>
            <th>Pret</th>
            <th>Stoc</th>
          </tr>';
  while($record=mysql_fetch_assoc($result)){
    echo '<tr>
            <td>'.$record['Denumire'].'</td>
            <td>'.$record['Pret'].'</td>
            <td>'.$record['Stoc'].'</td>
          </tr>';
  }
  echo "</table>";
  echo "<hr />"; 
  //4
  /*4.Afisati denumirea produselor care contin cel mai mare procentaj alimentul precizat.*/
  echo "<li><strong>Numele produsului care contine cel mai mare procentaj de :</strong></li><br />";
  echo '<form action=statistici.php method=POST>
        <input type=text name=naliment />
        <input type=submit name=submit8 value=SELECT /></form><br />';
  if(isset($_POST['submit8']) && $_POST['naliment'] != ""){
    $nalim=$_POST['naliment'];
    $query="SELECT H.Denumire,C.Procent
            FROM hrana H INNER JOIN compozitie C ON(H.IDHrana=C.IDHrana)
            WHERE C.Procent = (SELECT MAX(Procent)
                               FROM compozitie co INNER JOIN ingredient I ON(co.IDIngredient=I.IDIngredient)
                               WHERE I.Denumire LIKE '$nalim' AND C.IDIngredient=I.IDIngredient)";
    $result=mysql_query($query, $GLOBALS['link']);
    echo '<table class="table table-bordered table-hover">
            <tr>
              <th>Nume Produs</th>
              <th>Procent</th>
            </tr>';
      while($record=mysql_fetch_assoc($result)){
        echo '<tr>
                <td>'.$record['Denumire'].'</td>
                <td>'.$record['Procent'].'</td>
              </tr>';
      }
    }
  echo "</table>";
  echo "<hr />";  
  //5
  /*5.Afisati numele producatorului care realizeaza cele mai multe produse.*/
  echo "<li><strong>Numele producatorului care realizeaza cele mai multe produse.</strong></li><br />";
  $query="SELECT P.Nume, COUNT(*) NR_PRODUSE
		  FROM hrana H INNER JOIN producator P ON(H.IDProducator=P.IDProducator)
		  GROUP BY H.IDProducator
		  HAVING COUNT(*) = (SELECT COUNT(*) NR
		  	                 FROM hrana
		  		             GROUP BY IDProducator
                             ORDER BY NR DESC
		  		             LIMIT 1)";
  $result=mysql_query($query, $GLOBALS['link']);
  echo '<table class="table table-bordered table-hover">
          <tr>
            <th>Nume Producator</th>
            <th>NumarProduse</th>
          </tr>';
  while($record=mysql_fetch_assoc($result)){
    echo '<tr>
            <td>'.$record['Nume'].'</td>
            <td>'.$record['NR_PRODUSE'].'</td>
          </tr>';
  }
  echo "</table>";
  echo "<hr />";

  echo "</ol>";
 ?>
 </body>
 </html>



