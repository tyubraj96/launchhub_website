<?php
 include "partials/connect.php";
 $username =$_POST['username'];
 $password =$_POST['password'];
 $cpassword =$_POST['cpassword'];
 $sql="INSERT into users( username, password) values('$username','$password') where $password = $cpassword";
 
 
 $result=mysqli_query($conn,$sql) or die("sql query failed");
 if($result){
  echo "success";
 }
 else{
  echo "failure";
 }
?>