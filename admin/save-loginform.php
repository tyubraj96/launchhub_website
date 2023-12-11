<?php
 include "partials/connect.php";
 if(isset($_POST['login_submit'])){

          $username =$_POST['login_username'];
          $password =$_POST['login_password'];
          
          $sql="SELECT * from users where username='$username' and password='$password' ";
          
          $result =mysqli_query($conn,$sql) or die("query failed.");
             if(mysqli_num_rows($result) > 0){
                 $row =mysqli_fetch_assoc($result);
                     session_start();
                     $_SESSION["username"] =$row['username'];
                     $_SESSION["user_id"] =$row['user_id'];
                     
                    
                     echo "success";
                  }
             else{
                 echo"failure";
             }
          
 }
?>