<?php
   include "partials/connect.php.php";
   session_start();
   session_unset();
   session_destroy();
   header("location: http://localhost/launchhub_website/admin/login.php");


?>