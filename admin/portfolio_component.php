<?php
include "partials/connect.php";
// print_r($_POST);
if (isset($_POST["portfolio_insert"])) {

         $title =  $_POST["portfolio_title"];
         // $image =  $_POST["portfolio_image"];
         $text =  $_POST["portfolio_text"];
         $button =  $_POST["portfolio_button_text"];
         $status =  $_POST["portfolio_status"];

         $date = date("d/m/Y");
         $time = date("h/i/sa");




         // File upload
         $target_dir = "portfolioimages/";
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
                           $sql = "INSERT INTO portfolio ( portfolio_image, portfolio_text, portfolio_button_text, portfolio_status, portfolio_title, date, time) VALUES ('$filename','$text', '$button', '$status','$title','$date','$time')";
                           echo $sql;

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
                           <th>Portfolio Title</th>
                           <th>Portfolio Status</th>
                           <th>Portfolio Image </th>
                           <th>Action</th>

                  </thead>

                  <tbody>

                           <?php
                           $sql = "SELECT * FROM portfolio ";
                           $result = mysqli_query($conn, $sql);
                           if (mysqli_num_rows($result) > 0) {
                                    while ($row = mysqli_fetch_assoc($result)) {
                                             $portfolio_id = $row['portfolio_id'];
                           ?>
                                             <tr>
                                                      <td class='id'><?php echo $row['portfolio_id']; ?></td>
                                                      <td><?php echo $row['portfolio_title']; ?></td>
                                                      <td><?php
                                                               if ($row['portfolio_status'] == 1) {
                                                                        echo "show";
                                                               } else {
                                                                        echo "hide";
                                                               }
                                                               ?>
                                                      </td>
                                                      <td><img src="portfolioimages/<?php echo $row['portfolio_image']; ?>" alt="" srcset="" class="banner_img img-fluid"></td>
                                                      <td>
                                                               <div class="d-flex gap-3">
                                                                        <button class="btn btn-primary" onclick="viewportfolio('<?php echo $portfolio_id; ?>')"><i class='fa fa-eye fa-1x'></i></button>
                                                                        <button class="btn btn-primary" onclick="updatePortfoliovalue('<?php echo $portfolio_id; ?>')" data-bs-target="#myModalvalues"><i class='fa fa-pen-to-square fa-1x'></i></button>
                                                                        <button class="btn btn-primary" onclick="viewPortfoliobanner('<?php echo $portfolio_id; ?>')"><i class='fa fa-camera fa-1x'></i></button>
                                                                        <button class="btn btn-primary" onclick="ViewStatus('<?php echo $portfolio_id; ?>')"><i class='fa fa-trash fa-1x'></i></button>
                                                               </div>
                                                      </td>

                                    <?php
                                    }
                           }
                                    ?>


                  </tbody>
         </table>
         <?php
} else if (isset($_POST['action']) && $_POST['action'] == 'Viewportfolio') {
         $portfolio_id = $_POST['portfolio_id'];
         // echo $portfolio_id;
         $sql = "SELECT * FROM portfolio WHERE portfolio_id = $portfolio_id";
         // echo $sql;
         $result = mysqli_query($conn, $sql);
         if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
         ?>


                           <!-- <form id="submit_form" method="post" enctype="multipart/form-data"> -->
                           <div class="mb-3 d-flex gap-4">
                                    <label for="banner_title" class="form-label fw-bold"> Portfolio Title:</label>
                                    <span><?php echo $row['portfolio_title']; ?></span>

                           </div>



                           </div>
                           <div class="mb-3 d-flex gap-4">
                                    <label for="banner_text" class="form-label fw-bold"> Portfolio Text:</label>
                                    <span><?php echo $row['portfolio_text']; ?></span>



                           </div>
                           <div class="mb-3 d-flex gap-4">
                                    <label for="banner_button" class="form-label fw-bold">portfolio button text:</label>
                                    <span><?php echo $row['portfolio_button_text']; ?></span>
                                    <input type="hidden" name="portfolio_insert">



                           </div>
                           <div class="mb-3 d-flex gap-4">
                                    <label for="banner_button" class="form-label fw-bold">Portfolio status</label>
                                    <span><?php echo $row['portfolio_status']; ?></span>




                           </div>

                           <div class="mb-3 d-flex gap-4">
                                    <label for="banner_text d-flex gap-4 fw-bold" class="form-label fw-bold">Portfolio Images</label>

                                    <img src="portfolioimages/<?php echo $row['portfolio_image'] ?> " alt="" srcset="" class="img-fluid" style="width:500px; height :auto;">

                           </div>




                           <!-- </form> -->


                  <?php
                  }
         }
} else if (isset($_POST['action']) && $_POST['action'] == 'updatePortfoliovalue') {
         $portfolio_id = $_POST['portfolio_id'];
         // echo "$banner_id";
         $sql = "SELECT * FROM portfolio WHERE portfolio_id = '$portfolio_id'";
         $result = mysqli_query($conn, $sql);
         if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
                  ?>

                           <form id="submit_form_" method="post" enctype="multipart/form-data">
                                    <div class="mb-3">
                                             <label for="banner_title" class="form-label"> Portfolio Title</label>
                                             <input type="text" class="form-control" id="portfolio_title" aria-describedby="emailHelp" name="portfolio_title" value="<?php echo $row['portfolio_title']; ?>">
                                             <input type="hidden" name="update_insert_portfoliovalue">
                                             <input type="hidden" name="portfolio_id" value="<?php echo $row['portfolio_id']; ?>">


                                    </div>
                                    <div class="mb-3">
                                             <label for="comment">Portfolio Text</label>
                                             <textarea class="form-control" rows="5" id="comment" name="portfolio_text" value="<?php echo $row['portfolio_text']; ?>"></textarea>
                                             


                                    </div>
                                    <div class="mb-3">
                                             <label for="banner_button" class="form-label">Portfolio button text</label>
                                             <input type="text" class="form-control" id="portfolio_button_text" aria-describedby="emailHelp" name="portfolio_button_text" value="<?php echo $row['portfolio_button_text']; ?>">


                                    </div>



                                    <div class="form-group mb-3">

                                             <button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold">Submit</button>

                                    </div>

                           </form>
         <?php
                  }
         }
} else if (isset($_POST["update_insert_portfoliovalue"])) {
         $id = $_POST["portfolio_id"];
         $title =  $_POST["portfolio_title"];
         $text =  $_POST["portfolio_text"];
         $button =  $_POST["portfolio_button_text"];
         $date = date("d/m/Y");
         $time = date("h/i/sa");


         $sql = "UPDATE portfolio   set  portfolio_button_text ='$button', portfolio_text = '$text' ,portfolio_title = '$title' , date ='$date', time = '$time'  WHERE portfolio_id =$id";
         echo  $sql;
         $result = mysqli_query($conn, $sql);
         echo $result;
         // if($result){
         //      echo "success";
         // }
         // else{
         //          echo "failure";
         // }



}
if (isset($_POST['action']) && $_POST['action'] == 'viewPortfolio') {
         $id = $_POST['portfolio_id'];

         $sql = "SELECT * from portfolio where portfolio_id = $id";
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
                                                      <input type="hidden" name="insert_update_portfolioimage">
                                                      <input type="hidden" name="id" value="<?php echo $row['portfolio_id']; ?>">
                                             </div>
                                             <div class="form-group mb-3">

                                                      <button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold" id="submit_banner">Submit</button>

                                             </div>
                                    </form>

                           </div>
                           <div class="col-lg-6">
                                    <h3 class="center fw-bold mb-5 text-primary">PREVIOUS IMAGE</h3>

                                    <img src="portfolioimages/<?php echo $row['portfolio_image']; ?>" alt="" srcset="" class="img-fluid">
                           </div>

                  </div>
         </div>


<?php
} else if (isset($_POST["insert_update_portfolioimage"])) {
         $id = $_POST['id'];
         $target_dir = "portfolioimages/";
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
                           $sql = "UPDATE  portfolio SET  portfolio_image = '$filename' WHERE portfolio_id = $id ";
                           echo $sql;
                           mysqli_query($conn, $sql);
                  } else {
                           echo "failure";
                  }
         }
} else if (isset($_POST['action']) && $_POST['action'] == 'ViewStatus') {
         $id = $_POST['portfolioid'];
         // echo "$id";
         // Fetch the current banner_status value
         $sql = "SELECT portfolio_status FROM portfolio WHERE portfolio_id = $id";
         $Result1 = mysqli_query($conn, $sql);

         if ($Result1) {
                  $Row1 = mysqli_fetch_assoc($Result1);
                  $currentStatus = $Row1['portfolio_status'];

                  // Toggle the status between 0 and 1
                  $newStatus = ($currentStatus == 1) ? 0 : 1;

                  // Update the banner_status
                  $sql2 = "UPDATE portfolio SET portfolio_status = $newStatus WHERE portfolio_id = $id";
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