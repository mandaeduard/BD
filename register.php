<?php 
  require_once('user.php');
   function alert($s){
     echo '<script type="text/javascript">alert("'.$s.'")</script>';
   }
  //formular pentru adaugare noi user in baza de administrare
  if(isset($_POST['submit'])){
    if (!empty($_POST['firstname']) && !empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['parola']) && !empty($_POST['reparola'])){
      $firstName=$_POST['firstname'];
      $lastName=$_POST['lastname'];
      $email=$_POST['email'];
      $username=$_POST['username'];
      $password=$_POST['parola'];
      $reparola=$_POST['reparola'];
      $user=new User();
      if($user->validFirstName($firstName)){
        $user->firstName=$firstName;
        if($user->validLastName($lastName)){
          $user->lastName=$lastName;
          if($user->validateEmail($email)){
            $user->email=$email;
            if($user->validUser($username)){
              if(!$user->checkUsername($username)){
                $user->username=$username;
                if($password==$reparola){
                  $user->password=$password;
                  $user->active=0;
                  if($user->save())
                    echo alert("Contul a fost creat cu succes!");
                  else
                    echo alert("Contul nu a fost creat!");
                }
                else 
                  alert ("Parolele nu coincid!");
             }
              else
                alert ("Userul se afla in baza de date!");
            }
            else
              alert("Username invalid!");

          }
          else
            alert("Email invalid!");

        }
        else
        alert ("Numele este invalid!");
      }
      else
        alert ("Prenumele este invalid!");
    
  }}
 ?>

  <html>
  <head>
    <title>Register</title>
 	<link rel="stylesheet" href="cssmenu/register.css">
  </head>
  <div class="container">
 	<div class="register">
    <h1>Register </h1>
    <form method="POST">
 		<br />
 		<input type="text" name="firstname" placeholder="Prenume" />
 		<input type="text" name="lastname" placeholder="Nume" />
 		<br />
 		<input type="text" name="username" placeholder="Username" />
 		<br />
 		<input type="text" name="email" placeholder="E-mail" />
 		<br />
 		<input type="password" name="parola" placeholder="Parola" />
		<br />
		<input type="password" name="reparola" placeholder="Reintroduceti parola" />
 		<br />
 		<input type="submit" value="Register" name="submit" />
 	  </form>
 	</div>
 	<div class="login">
    <p>Daca  aveti cont de utilizator click  <a href="index.php">aici</a>.</p>
  </div>
 	</div>
 
 </html>