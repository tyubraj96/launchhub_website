<?php
include "partials/connect.php";
// print_r($_POST);
if (isset($_POST["testimonial_insert"])) {
	
	
         $text=  $_POST["testimonial_text"];
         $position =  $_POST["testimonial_position"];
	$status =  $_POST["testimonial_status"];
         $name =  $_POST["testimonial_name"];
	
         
         $date = date("d/m/Y");
         $time = date("h/i/sa");



	// File upload
	$target_dir = "testimonialimage/";
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
			$sql = "INSERT INTO testimonial ( testimonial_image, testimonial_text, testimonial_position, testimonial_status, testimonial_name, date, time) VALUES ('$filename','$text', '$position', '$status', '$name ','$date','$time')";
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
<table class="table"  id="banner_table" >
	<thead>
		<th>S.No.</th>
		<th> Testimonial Name</th>
		<th> Testimonial Position</th>
                  <th> Testimonial status</th>
		<th> Team image</th>
		<th>Action</th>

	</thead>

	<tbody>

		<?php
		$sql = "SELECT * FROM testimonial ";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			
			while ($row = mysqli_fetch_assoc($result)) {
				 $testimonial_id = $row['testimonial_id'];
				//  var_dump($row);
		?>
				<tr>
					<td class='id'><?php echo $row['testimonial_id']; ?></td>
                                             <td class='id'><?php echo $row['testimonial_name']; ?></td>
					<td><?php echo $row['testimonial_position']; ?></td>
					<td><?php
						if ($row['testimonial_status'] == 1) {
							echo "show";
						} else {
							echo "hide";
						}
						?>
					</td>
					<td><img src="testimonialimage/<?php echo $row['testimonial_image']; ?>" alt="" srcset="" class="banner_img img-fluid" ></td>
					<td>
						<div class="d-flex gap-3">
							<button class="btn btn-primary" onclick="viewTestimonial('<?php echo $testimonial_id; ?>')"><i class='fa fa-eye fa-1x'></i></button>
							<button class="btn btn-primary" onclick="updateTestimonialvalue('<?php echo $testimonial_id; ?>')" data-bs-target="#myModalvalues" ><i class='fa fa-pen-to-square fa-1x'></i></button>
							<button class="btn btn-primary" onclick="viewTestimonialimage('<?php echo $testimonial_id; ?>')"><i class='fa fa-camera fa-1x'></i></button>
							<button class="btn btn-primary" onclick="ViewStatus('<?php echo $testimonial_id; ?>')"><i class='fa fa-trash fa-1x'></i></button>
						</div>
					</td>

			<?php
			}
		}
			?>


	</tbody>
</table>
	<?php
} else if (isset($_POST['action']) && $_POST['action'] == 'Viewtestimonial') {
	$testimonial_id = $_POST['testimonial_id'];
	// echo "$banner_id";
	$sql = "SELECT * FROM testimonial WHERE testimonial_id = '$testimonial_id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
	?>


			<form id="submit_form" method="post" enctype="multipart/form-data">
				<input type="hidden" id="form_mode" name="form_mode" value="view">
				<div class="mb-3 d-flex gap-4">
					<label for="banner_title" class="form-label"> Testimonial text:</label>
					<span><?php echo $row['testimonial_text']; ?></span>
					
				</div>



				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_text" class="form-label">Testimonial position </label>
					<span><?php echo $row['testimonial_position']; ?></span>
					


				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_button" class="form-label">Testimonial name</label>
					<span><?php echo $row['testimonial_name']; ?></span>
					


				</div>
                                    <div class="mb-3 d-flex gap-4">
                                    <label for="banner_button" class="form-label fw-bold">Testimonial status</label>
                                    <span><?php
                                     if($row['testimonial_status'] == 1) {
                                             echo "show";
                                     }
                                     else{
                                             echo "hide";   
                                     }
                                      ?>
                                     </span>
                                    </div>
				
				<div class="mb-3 d-flex gap-4">
					<label for="banner_text d-flex gap-4" class="form-label">Images</label>
					
					<img src="testimonialimage/<?php echo $row['testimonial_image'] ?> " alt="" srcset=""  style="width:500px; height :auto;">
					
					


				</div>
				

				
				
			</form>


		<?php
		}
	}
} else if (isset($_POST['action']) && $_POST['action'] == 'updateTestimonialvalue') {
	$testimonial_id = $_POST['testimonial_id'];
	// echo "$banner_id";
	$sql = "SELECT * FROM testimonial WHERE testimonial_id = $testimonial_id ";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
		?>

			<form id="submit_form_" method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="banner_title" class="form-label">Testimonial Text</label>
					<input type="text" class="form-control" id="team_position" aria-describedby="emailHelp" name="testimonial_text" value="<?php echo $row['testimonial_text']; ?>">
					<input type="hidden" name="insert_updateTestimonialvalue">
					<input type="hidden" name="testimonial_id" value="<?php echo $row['testimonial_id']; ?>">


				</div>
				<div class="mb-3">
					<label for="banner_text" class="form-label">Testimonial position</label>
					<input type="text" class="form-control" id="banner_text" aria-describedby="emailHelp" name="testimonial_position" value="<?php echo $row['testimonial_position']; ?>">


				</div>
				<div class="mb-3">
					<label for="banner_button" class="form-label">Testimonial name</label>
					<input type="text" class="form-control" id="banner_button" aria-describedby="emailHelp" name="testimonial_name" value="<?php echo $row['testimonial_name']; ?>">

				</div>
				
                                    
				<div class="form-group mb-3">

					<button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold">Submit</button>

				</div>

			</form>
	<?php
		}
	}
} else if (isset($_POST["insert_updateTestimonialvalue"])) {
	$position =  $_POST["testimonial_position"];
         $name =  $_POST["testimonial_name"];
         
	$id = $_POST["testimonial_id"];
         $text =  $_POST["testimonial_text"];
         $date = date("d/m/Y");
         $time = date("h/i/sa");


	$sql = "UPDATE  testimonial  set  testimonial_position ='$position', testimonial_name = '$name', testimonial_text='$text', date ='$date', time='$time' where testimonial_id = $id ";
         echo "<pre>";
         echo $sql;
         echo "</pre>";
	
	$result = mysqli_query($conn, $sql);
         if ($result){
                  echo "success";
         }
         
	



}
if (isset($_POST['action']) && $_POST['action'] == 'viewtestimonial') {
	$id = $_POST['testimonial_id'];

	$sql = "SELECT * from testimonial where testimonial_id = $id";
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
						<input type="hidden" name="update_testimonialimage">
						<input type="hidden" name="id" value="<?php echo $row['testimonial_id']; ?>">
					</div>
					<div class="form-group mb-3">

						<button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold" id="submit_banner">Submit</button>

					</div>
				</form>

			</div>
			<div class="col-lg-6">
				<h3 class="center fw-bold mb-5 text-primary">PREVIOUS IMAGE</h3>

				<img src="testimonialimage/<?php echo $row['testimonial_image']; ?>" alt="" srcset="" class="img-fluid">
			</div>

		</div>
	</div>


<?php
} else if (isset($_POST["update_testimonialimage"])) {
	$id = $_POST['id'];
	$target_dir = "testimonialimage/";
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
			$sql = "UPDATE  testimonial SET  testimonial_image = '$filename' WHERE testimonial_id = $id ";
			echo $sql;
			mysqli_query($conn, $sql);
				
		} else {
			echo "failure";
		}
	}
}
else if (isset($_POST['action']) && $_POST['action'] == 'ViewStatus') { 
	$id=$_POST['testimonial_id'];
	// echo "$id";
	// Fetch the current banner_status value
	$sql = "SELECT testimonial_status FROM testimonial WHERE testimonial_id = $id";
	$Result1 = mysqli_query($conn, $sql);
 
	if ($Result1) {
	    $Row1 = mysqli_fetch_assoc($Result1);
	    $currentStatus = $Row1['testimonial_status'];
 
	    // Toggle the status between 0 and 1
	    $newStatus = ($currentStatus == 1) ? 0 : 1;
 
	    // Update the banner_status
	    $sql2 = "UPDATE testimonial SET testimonial_status = $newStatus WHERE testimonial_id = $id";
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