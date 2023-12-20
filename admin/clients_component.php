<?php
include "partials/connect.php";
// print_r($_POST);
if (isset($_POST["client_insert"])) {

         $link =  $_POST["client_link"];
         // $image =  $_POST["portfolio_image"];
         
         
         $status =  $_POST["client_status"];

         $date = date("d/m/Y");
         $time = date("h/i/sa");




         // File upload
         $target_dir = "clientimages/";
         $target_file = $target_dir . basename($_FILES["file"]["name"]);
         $uploadOk = 1;
         // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
         $filename = $_FILES["file"]["name"];
         $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

         // Check if image file is a actual image or fake image
         if (isset($_POST["submit_banner"])) {
                  $check = getimagesize($_FILES["file"]["tmp_name"]);
                  if ($check !== false) {
                           $uploadOk = 1;
                  } else {
                           echo "File is not an image.";
                           $uploadOk = 0;
                  }
         }

         // Check file size
         if ($_FILES["file"]["size"] > 500000) {
                  echo "Sorry, your file is too large.";
                  $uploadOk = 0;
         }

         // Allow certain file formats
         $allowed_formats = array("jpg", "jpeg", "png", "gif");
         if (!in_array($imageFileType, $allowed_formats)) {
                  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                  $uploadOk = 0;
         }

         if ($uploadOk == 0) {
                  echo "Sorry, your file was not uploaded.";
         } else {
                  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                           // Insert data into the database
                           $sql = "INSERT INTO clients ( client_image, client_link , client_status, date, time) VALUES ('$filename','$link', '$status','$date','$time')";
			echo "$sql";

                           if (mysqli_query($conn, $sql)) {
                                    echo "success";
                           } else {
                                    echo "ERROR: Could not execute $sql. " . mysqli_error($conn);
                           }
                  } else {
                           echo "failure";
                  }
         }
}
?>
<?php
if (isset($_POST["displaysend"])) {
?>
         <table class="table" id="banner_table">
                  <thead>
                           <th>S.No.</th>
                           <th>Client link</th>
                           <th>Client Status</th>
                           <th>Client Image </th>
                           <th>Action</th>

                  </thead>

                  <tbody>

                           <?php
                           $sql = "SELECT * FROM clients ";
                           $result = mysqli_query($conn, $sql);
                           if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                             $client_id = $row['client_id'];
                           ?>
                                             <tr>
                                                      <td class='id'><?php echo $row['client_id']; ?></td>
                                                      <td><?php echo $row['client_link']; ?></td>
                                                      <td><?php
                                                               if ($row['client_status'] == 1) {
                                                                        echo "show";
                                                               } else {
                                                                        echo "hide";
                                                               }
                                                               ?>
                                                      </td>
                                                      <td><img src="clientimages/<?php echo $row['client_image']; ?>" alt="" srcset="" class="banner_img img-fluid"></td>
                                                      <td>
                                                               <div class="d-flex gap-3">
                                                                        <button class="btn btn-primary" onclick="viewclients('<?php echo $client_id; ?>')"><i class='fa fa-eye fa-1x'></i></button>
                                                                        <button class="btn btn-primary" onclick="updateClientvalue('<?php echo $client_id; ?>')" data-bs-target="#myModalvalues"><i class='fa fa-pen-to-square fa-1x'></i></button>
                                                                        <button class="btn btn-primary" onclick="viewClientbanner('<?php echo $client_id; ?>')"><i class='fa fa-camera fa-1x'></i></button>
                                                                        <button class="btn btn-primary" onclick="ViewStatus('<?php echo $client_id; ?>')"><i class='fa fa-trash fa-1x'></i></button>
                                                               </div>
                                                      </td>

                                    <?php
                                    }
                           }
                                    ?>


                  </tbody>
         </table>
         <?php
} else if (isset($_POST['action']) && $_POST['action'] == 'Viewclients') {
         $client_id = $_POST['client_id'];
         // echo $portfolio_id;
         $sql = "SELECT * FROM clients WHERE client_id = $client_id";
         // echo $sql;
         $result = mysqli_query($conn, $sql);
         if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
         ?>


                           <!-- <form id="submit_form" method="post" enctype="multipart/form-data"> -->
                           <div class="mb-3 d-flex gap-4">
                                    <label for="banner_title" class="form-label fw-bold"> Client Link:</label>
                                    <span><?php echo $row['client_link']; ?></span>

                           </div>



                           </div>
                          
                           
                           <div class="mb-3 d-flex gap-4">
                                    <label for="banner_button" class="form-label fw-bold">Client status</label>
                                    <span><?php
                                     if($row['client_status'] == 1) {
                                             echo "show";
                                     }
                                     else{
                                             echo "hide";   
                                     }
                                      ?>
                                     </span>
                                    



                           </div>

                           <div class="mb-3 d-flex gap-4">
                                    <label for="banner_text d-flex gap-4 fw-bold" class="form-label fw-bold">Client Images</label>

                                    <img src="clientimages/<?php echo $row['client_image'] ?> " alt="" srcset="" class="img-fluid" style="width:500px; height :auto;">

                           </div>




                           <!-- </form> -->


                  <?php
                  }
         }
} else if (isset($_POST['action']) && $_POST['action'] == 'updateClientsvalue') {
         $client_id = $_POST['client_id'];
         // echo "$banner_id";
         $sql = "SELECT * FROM clients WHERE client_id = '$client_id'";
         $result = mysqli_query($conn, $sql);
         if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>

                           <form id="submit_form_" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                             <label for="banner_title" class="form-label"> Client link</label>
                                             <input type="text" class="form-control" id="portfolio_title" aria-describedby="emailHelp" name="client_link" value="<?php echo $row['client_link']; ?>">
                                             <input type="hidden" name="update_insert_clientvalue">
                                             <input type="hidden" name="client_id" value="<?php echo $row['client_id']; ?>">


                                    </div>
                                   
                                  

                                   

                                    <div class="form-group mb-3">

                                             <button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold">Submit</button>

                                    </div>

                           </form>
         <?php
                  }
         }
} else if (isset($_POST["update_insert_clientvalue"])) {
         $id = $_POST["client_id"];
         $link =  $_POST["client_link"];
         // $text =  $_POST["portfolio_text"];
         // $button =  $_POST["portfolio_button_text"];
         $date = date("d/m/Y");
         $time = date("h/i/sa");


         $sql = "UPDATE clients   set  client_link ='$link' , date ='$date', time = '$time'  WHERE client_id =$id";
         echo  $sql;
         $result = mysqli_query($conn, $sql);
         // if($result){
         //      echo "success";
         // }
         // else{
         //          echo "failure";
         // }



}
if (isset($_POST['action']) && $_POST['action'] == 'viewClientbanner') {
         $id = $_POST['client_id'];

         $sql = "SELECT * from clients where client_id = $id";
         $result = mysqli_query($conn, $sql);
         $row = mysqli_fetch_assoc($result);
         ?>

         <div class="container">
                  <div class="row">
                           <div class="col-lg-6">
                                    <h3 class="center fw-bold mb-4 text-primary">UPLOAD IMAGE</h3>
                                    <form id="form_imagesubmit" method="post" enctype="multipart/form-data">
                                             <div class="form-group mb-3">
                                                      <label class="fw-bold fs-5 fw-semibold">Select New Image</label>
                                                      <input type="file" name="file" id="upload_file" />
                                                      <input type="hidden" name="insert_update_clientimage">
                                                      <input type="hidden" name="id" value="<?php echo $row['client_id']; ?>">
                                             </div>
                                             <div class="form-group mb-3">

                                                      <button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold" id="submit_banner">Submit</button>

                                             </div>
                                    </form>

                           </div>
                           <div class="col-lg-6">
                                    <h3 class="center fw-bold mb-5 text-primary">PREVIOUS IMAGE</h3>

                                    <img src="clientimages/<?php echo $row['client_image']; ?>" alt="" srcset="" class="img-fluid">
                           </div>

                  </div>
         </div>


<?php
} else if (isset($_POST["insert_update_clientimage"])) {
         $id = $_POST['id'];
         $target_dir = "clientimages/";
         $target_file = $target_dir . basename($_FILES["file"]["name"]);
         $uploadOk = 1;
         // $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
         $filename = $_FILES["file"]["name"];
         $imageFileType = strtolower(pathinfo($filename, PATHINFO_EXTENSION));

         // Check if image file is a actual image or fake image
         if (isset($_POST["submit_banner"])) {
                  $check = getimagesize($_FILES["file"]["tmp_name"]);
                  if ($check !== false) {
                           $uploadOk = 1;
                  } else {
                           // echo "File is not an image.";
                           $uploadOk = 0;
                  }
         }

         // Check file size
         if ($_FILES["file"]["size"] > 500000) {
                  // echo "Sorry, your file is too large.";
                  $uploadOk = 0;
         }

         // Allow certain file formats
         $allowed_formats = array("jpg", "jpeg", "png", "gif");
         if (!in_array($imageFileType, $allowed_formats)) {
                  // echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                  $uploadOk = 0;
         }

         if ($uploadOk == 0) {
                  echo "failure";
                  die();
         } else {
                  if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                           // update data into the database
                           $sql = "UPDATE  clients SET  client_image = '$filename' WHERE client_id = $id ";
                           echo $sql;
                           mysqli_query($conn, $sql);
                  } else {
                           echo "failure";
                  }
         }
} else if (isset($_POST['action']) && $_POST['action'] == 'ViewStatus') {
         $id = $_POST['clientid'];
         // echo "$id";
         // Fetch the current banner_status value
         $sql = "SELECT client_status FROM clients WHERE client_id = $id";
         $Result1 = mysqli_query($conn, $sql);

         if ($Result1) {
                  $Row1 = mysqli_fetch_assoc($Result1);
                  $currentStatus = $Row1['client_status'];

                  // Toggle the status between 0 and 1
                  $newStatus = ($currentStatus == 1) ? 0 : 1;

                  // Update the banner_status
                  $sql2 = "UPDATE clients SET client_status = $newStatus WHERE client_id= $id";
                  $Result2 = mysqli_query($conn, $sql2);

                  if ($Result2) {

                           echo "success";
                  } else {

                           echo "failure";
                  }
         } else {

                  echo "failure";
         }
}





?>