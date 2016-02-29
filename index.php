<?php 
  include_once('user.php');
  error_reporting(0);
  function alert($s){
	  echo '<script type="text/javascript">alert("'.$s.'")</script>';
	}
  //daca se apasa butonul submit este verificat daca username-ul si parola se afla in baza de date, daca sunt corecte si contul este activat  
  if(isset($_POST['submit'])){
    $username=$_POST['username'];
    $password=$_POST['password'];
    if(!empty($username) && !empty($password)){
      $user=new User();
      session_start();
      $_SESSION['u'] = $user -> getInfoUsername($username) -> username;
      if($user->checkUsername($username)){
        if($user->getInfoUsername($username)->active){
          if($user->getInfoUsername($username)->password==$password)
            header("Location: home.php");
          else 
          	alert("Parola este incorecta!");
        }
        else
          alert("Contul nu este inca activat!");
      }
      else
        alert("Acest utilizator nu exista!");
    }
  }
 ?>

<html>
  <head>
    <link rel="stylesheet" href="cssmenu/login.css">
    <title>Login</title>
  </head>
  <div class="container">
    <div class="login">
      <h1>Login</h1>
      <form method="POST" action="">
        <br /><input type="text" name="username" value="" placeholder="Username" />
        <br/ ><input type="password" name="password" value="" placeholder="Password" />
        <br /><input type="submit" name="submit" value="Login"></p>
      </form>
    </div>
  <div class="register">
    <p>Daca nu aveti cont de utilizator click  <a href="register.php">aici</a> pentru a crea un cont nou.</p>
  </div>
  </div>
</html>