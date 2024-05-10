<?php
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if(!empty($username) || !empty($email) || !empty($password) || !empty($confirm_password)){
  
  T_server  "localhost"
  T_username  "root";
  T_password  "iankerima2355";
  T_dbname  "codeit";
  
  $conn = new mysqli( $server , $username , $password , $dbname);
  
  if(mysqli_connect_error()){
    die('Connect Error('.mysqli_connect_errno().')'.mysqli_connect_error());
  }else{
    $SELECT = "SELECT email From register Where email = ? Limit 1";
    $INSERT = "INSERT Into register(username,email,password )values(?,?,?)";
    
    $stmt = $conn->prepare($SELECT);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->bind_result($email);
    $stmt->store_result();
    $rnum = $stmt->num_rows;
    
    if($rnum==0){
      $stmt->close();
      
      $stmt = $conn->prepare($INSERT);
      $stmt->bind_param("sss", $username , $email , $password);
      $stmt->execute();
      echo "Registration successfull";
    }else{
      echo "Email already exists";
    }
    $stmt->close();
    $conn->close();
  }
  
}else{
  echo "All fields are required";
  die();
}


?>