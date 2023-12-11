<?php
include "partials/connect.php";
// print_r($_POST);
if (isset($_POST["banner_insert"])) {
         $status = $_POST["banner_status"];
         $title =  $_POST["banner_title"];
         $text =  $_POST["banner_text"];
         $btn =  $_POST["banner_button"];
         $btn_link =  $_POST["banner_button_link"];



         // File upload
         $target_dir = "images/";
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
                           $sql = "INSERT INTO banner (banner_title, banner_status, image,banner_text,banner_button,banner_button_link) VALUES ('$title', '$status', '$filename','$text','$btn','$btn_link')";
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
         <thead>
                  <th>S.No.</th>
                  <th> Banner Title</th>
                  <th> Banner status</th>
                  <th>image</th>
                  <th>Action</th>

         </thead>

         <tbody>

                  <?php
                  $sql = "SELECT * FROM banner ";
                  $result = mysqli_query($conn, $sql);
                  if (mysqli_num_rows($result) > 0) {
                           while ($row = mysqli_fetch_assoc($result)) {
                                    $banner_id = $row['banner_id'];
                  ?>
                                    <tr>
                                             <td class='id'><?php echo $row['banner_id']; ?></td>
                                             <td><?php echo $row['banner_title']; ?></td>
                                             <td><?php
                                                      if ($row['banner_status'] == 1) {
                                                               echo "show";
                                                      } else {
                                                               echo "hide";
                                                      }
                                                      ?>
                                             </td>
                                             <td><img src="images/<?php echo $row['image']; ?>" alt="" srcset="" class="img-fluid"></td>
                                             <td>
                                                      <div class="d-flex gap-3">
                                                               <button class="btn btn-primary" onclick="viewbanner('<?php echo $banner_id; ?>')"><i class='fa fa-eye fa-2x'></i></button>
                                                               <a href='' onclick="updatevalue     ('<?php echo $banner_id; ?>')"><i class='fa fa-pen-to-square fa-2x'></i></a>
                                                               <a href=''><i class='fa fa-camera fa-2x'></i></a>
                                                               <a href=''><i class='fa fa-trash fa-2x'></i></a>
                                                      </div>
                                             </td>

                           <?php
                           }
                  }
                           ?>


         </tbody>
         <?php
} else if (isset($_POST['banner_id'])) {
         $banner_id = $_POST['banner_id'];
         // echo "$banner_id";
         $sql = "SELECT * FROM banner WHERE banner_id = '$banner_id'";
         $result = mysqli_query($conn, $sql);
         if (mysqli_num_rows($result) > 0) {
                  while ($row = mysqli_fetch_assoc($result)) {
         ?>
                           

                                    <form id="submit_form" method="post" enctype="multipart/form-data">
                                    <input type="hidden" id="form_mode" name="form_mode" value="view">
                                             <div class="mb-3">
                                                      <label for="banner_title" class="form-label"> Banner Title</label>
                                                      <input type="text" class="form-control" id="banner_title" aria-describedby="emailHelp" name="banner_title" <?php echo ($_POST['form_mode'] === 'view') ? 'disabled' : ''; ?>  value="<?php echo $row['banner_title'];?>">
        </div>
                                                      


                                             </div>
                                             <div class="mb-3">
                                                      <label for="banner_text" class="form-label"> Banner Text</label>
                                                      <input type="text" class="form-control" id="banner_text" aria-describedby="emailHelp" name="banner_text" <?php echo ($_POST['form_mode'] === 'view') ? 'disabled' : ''; ?> value="<?php echo $row['banner_text'];?>">


                                             </div>
                                             <div class="mb-3">
                                                      <label for="banner_button" class="form-label">Banner Button</label>
                                                      <input type="text" class="form-control" id="banner_button" aria-describedby="emailHelp" name="banner_button" <?php echo ($_POST['form_mode'] === 'view') ? 'disabled' : ''; ?> value="<?php echo $row['banner_button'];?>">


                                             </div>
                                             <div class="mb-3">
                                                      <label for="banner_text" class="form-label">Banner Button link</label>
                                                      <input type="text" class="form-control" id="banner_button_link" aria-describedby="emailHelp" name="banner_button_link" <?php echo ($_POST['form_mode'] === 'view') ? 'disabled' : ''; ?> value="<?php echo $row['banner_button_link'];?>">
                                                      <input type="hidden" name="banner_insert">


                                             </div>
                                             <div class="mb-3">

                                                      <select class="form-select" aria-label="Default select example" name="banner_status <?php echo ($_POST['form_mode'] === 'view') ? 'disabled' : ''; ?>">
                                                      <option <?php echo ($row['banner_status'] === '1') ? 'selected' : ''; ?> value="1">show</option>
                                                      <option <?php echo ($row['banner_status'] === '0') ? 'selected' : ''; ?> value="o">hide</option>
                                                           

                                                      </select>

                                             </div>

                                             <div class="form-group mb-3">
                                                      <label class="fw-bold">Select Image</label>
                                                      <input type="file" name="file" id="upload_file" <?php echo ($_POST['form_mode'] === 'view') ? 'disabled' : ''; ?> />
                                             </div>
                                             <div class="form-group mb-3">
                                                      <button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold" <?php echo ($_POST['form_mode'] === 'view') ? 'disabled' : ''; ?>>Submit</button>
                                             </div>

                                    </form>
                           

<?php
                  }
         }
}


?>