<?php  
  require_once('mysql_connect.php');
  //clasa user
  class User{
  	private $uid;//Id-ul user-ului
  	private $info;//informatii despre user

  	//constructor fara parametrii pentru initializare
  	public function __construct(){
  	  $this->uid=null;
  	  $this->info=array('firstName'=>'','lastName'=>'','email'=>'','username'=>'','password'=>'','active'=>false);	
  	}

  	//verifica daca datele pentru inregistrare au un format valid
  	public function validUser($username){
  	  return preg_match('/^[a-zA-Z0-9]{3,15}$/', $username);
  	}

  	public function validFirstName($firstName){
  	  return preg_match('/^[a-zA-Z-]{3,20}$/',$firstName);
  	}
  	
  	public function validLastName($lastName){
  	  return preg_match('/^[a-zA-Z-]{3,20}$/',$lastName);
  	}

  	public function validateEmail($email){
  	  return preg_match('/^([a-zA-Z0-9]+[a-zA-Z0-9._%-]*@([a-zA-Z0-9-]+\.)+[a-zA-Z]{2,4})$/', $email);
  	}

  	//informatii in functie de id-ul userului
  	public function getInfoID($userID){
  	  $user=new User();
  	  $query="SELECT firstName,lastName,email,username,password,active FROM users WHERE userID='$userID' ";
  	  $result=mysql_query($query, $GLOBALS['dblogin']);
  	  if(mysql_num_rows($result)){
  	  	$row=mysql_fetch_assoc($result);
  	  	$user->firstName=$row['firstName'];
  	  	$user->lastName=$row['lastName'];
  	  	$user->email=$row['email'];
  	  	$user->username=$row['username'];
  	  	$user->password=$row['password'];
  	  	$user->active=$row['active'];
  	  	$user->uid=$userID;
  	  }
  	  mysql_free_result($result);
  	  return $user;
  	}

  	//informatii in functie de username
  	public function getInfoUsername($username){
  	  $user=new User();
  	  $query="SELECT userID,firstName,lastName,email,password,active FROM users WHERE username='$username'";
  	  $result=mysql_query($query, $GLOBALS['dblogin']);
  	  if(mysql_num_rows($result)){
  	  	$row=mysql_fetch_assoc($result);
  	  	$user->firstName=$row['firstName'];
  	  	$user->lastName=$row['lastName'];
  	  	$user->email=$row['email'];
  	  	$user->username=$username;
  	  	$user->password=$row['password'];
  	  	$user->active=$row['active'];
  	  	$user->uid=$row['userID'];
  	  }
  	  mysql_free_result($result);
  	  return $user;	
  	}

  	//functie pentru a verifica daca username-ul este deja in BD
  	public function checkUsername($username){
  	   $query="SELECT userID,firstName,lastName,email,password,active FROM users WHERE username='$username'";
  	   $result=mysql_query($query,$GLOBALS['dblogin']);
  	   $numResult=mysql_num_rows($result);
  	   if($numResult>0)
  	     return true;
  	   else
  	     return false;		
    }

    //introducere inregistrare in baza de date
    public function save(){
      $query="INSERT INTO users (firstName,lastName,email,username,password,active)
      		  VALUES('$this->firstName','$this->lastName','$this->email','$this->username','$this->password','$this->active')";
      if(mysql_query($query,$GLOBALS['dblogin']))
      	return true;
      else
      	return false;
    }

    //activeaza contul
    public function setActive($id){
      $query="UPDATE users SET active=1 WHERE userID='$id' ";
      if(mysql_query($query,$GLOBALS['dblogin']))
        return true;
      else
        return false;
    }
    //dezactiveaza contul
    public function setInactive($id){
      $query="UPDATE users SET active=0 WHERE userID='$id";
      if(mysql_query($query.$GLOBALS['dblogin']))
        return true;
      else 
        return false;
    }
    //sterge contul
    public function delete($id){
      $query="DELETE FROM users WHERE userID='$id'";
      if(mysql_query($query.$GLOBALS['dblogin']))
        return true;
      else 
        return false;
    }
  }

 ?>