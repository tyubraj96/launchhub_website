<?php
include "connect.php";
include 'functions.php';
$id ='';
if(isset($_GET["id"])){

         $id = $_GET["id"];
}
         ?>



<!DOCTYPE html>
<html lang="en">

<head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Document</title>
         <link rel="stylesheet" href="css/main.min.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

         <link href="http://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet" />
</head>

<body>
         <div class="container">
                  <?php
                  $service = getALLservices();
                   print_r($service);
                   foreach($service as $key => $serviceValue){
                                     $serviceValue->service_id;
                   }
                  if ($id ==  $serviceValue->service_id) {

                  ?>
                           <div class="row text-center">
                                    <h4 class="fw-bold my-4 text-center"><?php echo  $serviceValue->service_title ?></h4>
                                    <img src="admin/portfolioimages/<?php echo  $serviceValue->service_image ?>" alt="" class="img-fluid mt-4 mb-5 img-thumbnail">
                           </div>
                           <div class="row">

                                    <p class="lead text-center"><?php echo  $serviceValue->service_text ?></p>

                           </div>
                  <?php
                  }

                  ?>

         </div>
</body>

</html>