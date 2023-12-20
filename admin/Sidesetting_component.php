<?php
include "partials/connect.php";
// print_r($_POST);
if (isset($_POST["company_insert"])) {
      $name = $_POST["company_name"];
      $email = $_POST["company_email"];
      $phone = $_POST["company_phone"];
      $mobile = $_POST["company_mobile"];
      $map = $_POST["company_map"];
      $location = $_POST["company_location"];
      $link1 =  $_POST["facebook_link"];
      $link2 =  $_POST["instagram_link"];
      $link3 =  $_POST["twitter_link"];
      $link4 =  $_POST["linkedin_link"];
      // $image =  $_POST["portfolio_image"];




      $date = date("d/m/Y");
      $time = date("h/i/sa");




      // File upload
      $target_dir = "companyimages/";
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
                  $sql = "INSERT INTO side_setting ( company_logo, company_name ,company_map, company_email, company_mobile, company_phone, company_location, facebook_link, instagram_link, twitter_link, linkedin_link, date, time) VALUES ('$filename','$name','$map', '$email', '$mobile','$phone', '$location','$link1','$link2','$link3','$link4','$date','$time')";
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
                  <th>Company Name</th>
                  <th>Company location</th>
                  <th>Company logo </th>
                  <th>Action</th>

            </thead>

            <tbody>

                  <?php
                  $sql = "SELECT * FROM Side_setting ";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                              $company_id = $row['company_id'];
                  ?>
                              <tr>
                                    <td class='id'><?php echo $row['company_id']; ?></td>
                                    <td><?php echo $row['company_name']; ?></td>
                                    <td><?php echo $row['company_location']; ?></td>

                                    <td><img src="companyimages/<?php echo $row['company_logo']; ?>" alt="" srcset="" class="banner_img img-fluid"></td>
                                    <td>
                                          <div class="d-flex gap-3">
                                                <button class="btn btn-primary" onclick="viewcompany('<?php echo $company_id; ?>')"><i class='fa fa-eye fa-1x'></i></button>
                                                <button class="btn btn-primary" onclick="updateCompanyvalue('<?php echo $company_id; ?>')" data-bs-target="#myModalvalues"><i class='fa fa-pen-to-square fa-1x'></i></button>
                                                <button class="btn btn-primary" onclick="viewCompanybanner('<?php echo $company_id; ?>')"><i class='fa fa-camera fa-1x'></i></button>
                                                <!-- <button class="btn btn-primary" onclick="ViewStatus('<?php echo $company_id; ?>')"><i class='fa fa-trash fa-1x'></i></button> -->
                                          </div>
                                    </td>

                        <?php
                        }
                  }
                        ?>


            </tbody>
      </table>
      <?php
} else if (isset($_POST['action']) && $_POST['action'] == 'ViewCompany') {
      $company_id = $_POST['company_id'];
      // echo $portfolio_id;
      $sql = "SELECT * FROM side_setting WHERE company_id = $company_id";
      // echo $sql;
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
      ?>


                  <!-- <form id="submit_form" method="post" enctype="multipart/form-data"> -->
                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_title" class="form-label fw-bold"> Company Name:</label>
                        <span><?php echo $row['company_name']; ?></span>

                  </div>
                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_title" class="form-label fw-bold"> Company Email:</label>
                        <span><?php echo $row['company_email']; ?></span>

                  </div>
                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_title" class="form-label fw-bold"> Company Mobile:</label>
                        <span><?php echo $row['company_mobile']; ?></span>

                  </div>
                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_title" class="form-label fw-bold"> Company Phone:</label>
                        <span><?php echo $row['company_phone']; ?></span>

                  </div>
                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_title" class="form-label fw-bold"> Company Location:</label>
                        <span><?php echo $row['company_location']; ?></span>

                  </div>
                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_title" class="form-label fw-bold"> Company Map:</label>
                        <span><?php echo $row['company_map']; ?></span>

                  </div>
                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_title" class="form-label fw-bold"> Facebook Link:</label>
                        <span><?php echo $row['facebook_link']; ?></span>

                  </div>
                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_title" class="form-label fw-bold"> Instagram Link:</label>
                        <span><?php echo $row['instagram_link']; ?></span>

                  </div>
                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_title" class="form-label fw-bold"> Twitter Link:</label>
                        <span><?php echo $row['twitter_link']; ?></span>

                  </div>
                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_title" class="form-label fw-bold"> Linkedin Link:</label>
                        <span><?php echo $row['linkedin_link']; ?></span>

                  </div>






                  </div>



                  <div class="mb-3 d-flex gap-4">
                        <label for="banner_text d-flex gap-4 fw-bold" class="form-label fw-bold">Company Logo</label>

                        <img src="companyimages/<?php echo $row['company_logo'] ?> " alt="" srcset="" class="img-fluid" style="width:500px; height :auto;">

                  </div>




                  <!-- </form> -->


            <?php
            }
      }
} else if (isset($_POST['action']) && $_POST['action'] == 'updateCompanyvalue') {
      $company_id = $_POST['company_id'];
      // echo "$banner_id";
      $sql = "SELECT * FROM side_setting WHERE company_id = '$company_id'";
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
            ?>

                  <form id="submit_form_" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                              <label for="company_location" class="form-label">Company Name</label>
                              <input type="text" class="form-control" id="company_name" aria-describedby="emailHelp" name="company_name" value="<?php echo $row['company_name']; ?>" required>
                              <input type="hidden" name="insert_updateCompanyvalue">
                              <input type="hidden" name="company_id" value="<?php echo $row['company_id']; ?>">


                        </div>
                        <div class="mb-3">
                              <label for="team_name" class="form-label">Company email</label>
                              <input type="text" class="form-control" id="company_email" aria-describedby="emailHelp" name="company_email" value="<?php echo $row['company_email']; ?>">



                        </div>
                        <div class="mb-3">
                              <label for="team_name" class="form-label">Company mobile</label>
                              <input type="text" class="form-control" id="company_mobile" aria-describedby="emailHelp" name="company_mobile" value="<?php echo $row['company_mobile']; ?>">



                        </div>
                        <div class="mb-3">
                              <label for="company_phone" class="form-label">Company Phone</label>
                              <input type="text" class="form-control" id="company_phone" aria-describedby="emailHelp" name="company_phone" value="<?php echo $row['company_phone']; ?>" required>


                        </div>
                        <div class="mb-3">
                              <label for="company_location" class="form-label">Company Location</label>
                              <input type="text" class="form-control" id="company_location" aria-describedby="emailHelp" name="company_location" value="<?php echo $row['company_location']; ?>" required>


                        </div>
                        <div class="mb-3">
                              <label for="company_location" class="form-label">Company Map</label>
                              <input type="text" class="form-control" id="company_location" aria-describedby="emailHelp" name="company_map" value="<?php echo $row['company_map']; ?>" required>


                        </div>
                        <div class="mb-3">
                              <label for="facebook_link" class="form-label">Facebook Link</label>
                              <input type="text" class="form-control" id="facebook_link" aria-describedby="emailHelp" name="facebook_link" value="<?php echo $row['facebook_link']; ?>" required>


                        </div>
                        <div class="mb-3">
                              <label for="team_position" class="form-label">Instagram Link</label>
                              <input type="text" class="form-control" id="instagram_link" aria-describedby="emailHelp" name="instagram_link" value="<?php echo $row['instagram_link']; ?>" required>


                        </div>
                        <div class="mb-3">
                              <label for="team_position" class="form-label">Twitter Link</label>
                              <input type="text" class="form-control" id="twitter_link" aria-describedby="emailHelp" name="twitter_link" value="<?php echo $row['twitter_link']; ?>" required>


                        </div>
                        <div class="mb-3">
                              <label for="team_position" class="form-label">Linkedin Link</label>
                              <input type="text" class="form-control" id="team_description" aria-describedby="emailHelp" name="linkedin_link" value="<?php echo $row['linkedin_link']; ?>" required>


                        </div>


                        <div class="form-group mb-3">

                              <button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold">Submit</button>

                        </div>

                  </form>
      <?php
            }
      }
} else if (isset($_POST["insert_updateCompanyvalue"])) {
      $id = $_POST["company_id"];
      $name = $_POST["company_name"];
      $email = $_POST["company_email"];
      $phone = $_POST["company_phone"];
      $mobile = $_POST["company_mobile"];
      $map = $_POST["company_map"];
      $location = $_POST["company_location"];
      $link1 =  $_POST["facebook_link"];
      $link2 =  $_POST["instagram_link"];
      $link3 =  $_POST["twitter_link"];
      $link4 =  $_POST["linkedin_link"];
      
      $date = date("d/m/Y");
      $time = date("h/i/sa");


      // $sql = "INSERT INTO side_setting ( company_name ,company_map, company_email, company_mobile, company_phone, company_location, facebook_link, instagram_link, twitter_link, linkedin_link, date, time) VALUES ('$name','$map', '$email', '$mobile','$phone', '$location','$link1','$link2','$link3','$link4','$date','$time')";


      $sql = "UPDATE side_setting   set company_name = '$name',company_email = '$email', company_phone ='$phone', company_location = '$location', facebook_link = '$link1', instagram_link = '$link2', twitter_link = '$link3',linkedin_link = '$link4', date ='$date', time = '$time'  WHERE company_id =$id";
      echo  $sql;
      $result = mysqli_query($conn, $sql);
      // if($result){
      //      echo "success";
      // }
      // else{
      //          echo "failure";
      // }



}
if (isset($_POST['action']) && $_POST['action'] == 'viewCompanylogo') {
      $id = $_POST['company_id'];

      $sql = "SELECT * from side_setting where company_id = $id";
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
                                    <input type="hidden" name="insert_update_companylogo">
                                    <input type="hidden" name="id" value="<?php echo $row['company_id']; ?>">
                              </div>
                              <div class="form-group mb-3">

                                    <button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold" id="submit_banner">Submit</button>

                              </div>
                        </form>

                  </div>
                  <div class="col-lg-6">
                        <h3 class="center fw-bold mb-5 text-primary">PREVIOUS IMAGE</h3>

                        <img src="companyimages/<?php echo $row['company_logo']; ?>" alt="" srcset="" class="img-fluid">
                  </div>

            </div>
      </div>


<?php
} else if (isset($_POST["insert_update_companylogo"])) {
      $id = $_POST['id'];
      $target_dir = "companyimages/";
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
                  $sql = "UPDATE  side_setting SET  company_logo = '$filename' WHERE company_id = $id ";
                  echo $sql;
                  mysqli_query($conn, $sql);
            } else {
                  echo "failure";
            }
      }
}



?>