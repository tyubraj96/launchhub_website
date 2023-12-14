<?php
include "partials/connect.php";
// print_r($_POST);
if (isset($_POST["about_insert"])) {
	$status = $_POST["about_status"];
	$heading =  $_POST["about_heading"];
	$position =  $_POST["team_position"];
         $name =  $_POST["team_name"];
         $email =  $_POST["team_email"];
	$abouttext =  $_POST["about_text"];
         $text =  $_POST["team_text"];
         $date = date("d/m/Y");
         $time = date("h/i/sa");



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
			$sql = "INSERT INTO about (about_heading, about_text, team_image, team_position, team_name, team_email ,team_text,team_status,date,time) VALUES ('$heading', '$abouttext', '$filename','$position', '$name', '$email','$text','$status','$date','$time')";
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
<table class="table"  id="banner_table" >
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
					<td><img src="images/<?php echo $row['image']; ?>" alt="" srcset="" class="banner_img img-fluid" ></td>
					<td>
						<div class="d-flex gap-3">
							<button class="btn btn-primary" onclick="viewbanner('<?php echo $banner_id; ?>')"><i class='fa fa-eye fa-1x'></i></button>
							<button class="btn btn-primary" onclick="updatevalue('<?php echo $banner_id; ?>')" data-bs-target="#myModalvalues" ><i class='fa fa-pen-to-square fa-1x'></i></button>
							<button class="btn btn-primary" onclick="viewimagebanner('<?php echo $banner_id; ?>')"><i class='fa fa-camera fa-1x'></i></button>
							<button class="btn btn-primary" onclick="ViewStatus('<?php echo $banner_id; ?>')"><i class='fa fa-trash fa-1x'></i></button>
						</div>
					</td>

			<?php
			}
		}
			?>


	</tbody>
</table>
	<?php
} else if (isset($_POST['action']) && $_POST['action'] == 'ViewData') {
	$banner_id = $_POST['banner_id'];
	// echo "$banner_id";
	$sql = "SELECT * FROM banner WHERE banner_id = '$banner_id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
	?>


			<form id="submit_form" method="post" enctype="multipart/form-data">
				<input type="hidden" id="form_mode" name="form_mode" value="view">
				<div class="mb-3 d-flex gap-4">
					<label for="banner_title" class="form-label"> Banner Title:</label>
					<span><?php echo $row['banner_title']; ?></span>
					<!-- <input type="text" class="form-control" id="banner_title" aria-describedby="emailHelp" name="banner_title" <?php echo ($_POST['form_mode'] === 'view') ? 'disabled' : ''; ?> value="<?php echo $row['banner_title']; ?>"> -->
				</div>



				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_text" class="form-label"> Banner Text:</label>
					<span><?php echo $row['banner_text']; ?></span>
					


				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_button" class="form-label">Banner Button:</label>
					<span><?php echo $row['banner_button']; ?></span>
					


				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_text d-flex gap-4" class="form-label">Banner Button link:</label>
					<span><?php echo $row['banner_button_link']; ?></span>
					
					<input type="hidden" name="banner_insert">


				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_text d-flex gap-4" class="form-label">Images</label>
					
					<img src="images/<?php echo $row['image'] ?> " alt="" srcset=""  style="width:500px; height :auto;">
					
					


				</div>
				

				
				
			</form>


		<?php
		}
	}
} else if (isset($_POST['action']) && $_POST['action'] == 'updatebannervalue') {
	$banner_id = $_POST['updatevalue_id'];
	// echo "$banner_id";
	$sql = "SELECT * FROM banner WHERE banner_id = '$banner_id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
		?>

			<form id="submit_form_" method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="banner_title" class="form-label"> Banner Title</label>
					<input type="text" class="form-control" id="banner_title" aria-describedby="emailHelp" name="banner_title" value="<?php echo $row['banner_title']; ?>">
					<input type="hidden" name="insert_updatevalue">
					<input type="hidden" name="banner_id" value="<?php echo $row['banner_id']; ?>">


				</div>
				<div class="mb-3">
					<label for="banner_text" class="form-label"> Banner Text</label>
					<input type="text" class="form-control" id="banner_text" aria-describedby="emailHelp" name="banner_text" value="<?php echo $row['banner_text']; ?>">


				</div>
				<div class="mb-3">
					<label for="banner_button" class="form-label">Banner Button</label>
					<input type="text" class="form-control" id="banner_button" aria-describedby="emailHelp" name="banner_button" value="<?php echo $row['banner_button']; ?>">


				</div>
				<div class="mb-3">
					<label for="banner_text" class="form-label">Banner Button link</label>
					<input type="text" class="form-control" id="banner_button_link" aria-describedby="emailHelp" name="banner_button_link" value="<?php echo $row['banner_button_link']; ?>">
					<!-- <input type="hidden" name="banner_update" > -->


				</div>
				<div class="mb-3">

					<!-- <select class="form-select" aria-label="Default select example" name="banner_status" > -->





				</div>

				<div class="form-group mb-3">

					<button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold">Submit</button>

				</div>

			</form>
	<?php
		}
	}
} else if (isset($_POST["insert_updatevalue"])) {
	$id = $_POST["banner_id"];
	$title =  $_POST["banner_title"];
	$text =  $_POST["banner_text"];
	$btn =  $_POST["banner_button"];
	$btn_link =  $_POST["banner_button_link"];

	$sql = "UPDATE  banner  set  banner_title ='$title', banner_text = '$text' ,banner_button = '$btn' , banner_button_link = '$btn_link' WHERE banner_id =$id";
	echo " $sql";
	$result = mysqli_query($conn, $sql);
	// if($result){
	//      echo "success";
	// }
	// else{
	//          echo "failure";
	// }



}
if (isset($_POST['action']) && $_POST['action'] == 'updatebanner') {
	$id = $_POST['bannerid'];

	$sql = "SELECT * from banner where banner_id = $id";
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
						<input type="hidden" name="insert_updateimage">
						<input type="hidden" name="id" value="<?php echo $row['banner_id']; ?>">
					</div>
					<div class="form-group mb-3">

						<button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold" id="submit_banner">Submit</button>

					</div>
				</form>

			</div>
			<div class="col-lg-6">
				<h3 class="center fw-bold mb-5 text-primary">PREVIOUS IMAGE</h3>

				<img src="images/<?php echo $row['image']; ?>" alt="" srcset="" class="img-fluid">
			</div>

		</div>
	</div>


<?php
} else if (isset($_POST["insert_updateimage"])) {
	$id = $_POST['id'];
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
			$sql = "UPDATE  banner SET  image = '$filename' WHERE banner_id = $id ";
			echo "$sql";
			if (mysqli_query($conn, $sql)) {
				echo "success";
			} else {
				echo "failure";
			}
		} else {
			echo "failure";
		}
	}
}
else if (isset($_POST['action']) && $_POST['action'] == 'ViewStatus') { 
	$id=$_POST['banner_id'];
	// echo "$id";
	// Fetch the current banner_status value
	$sql = "SELECT banner_status FROM banner WHERE banner_id = $id";
	$Result1 = mysqli_query($conn, $sql);
 
	if ($Result1) {
	    $Row1 = mysqli_fetch_assoc($Result1);
	    $currentStatus = $Row1['banner_status'];
 
	    // Toggle the status between 0 and 1
	    $newStatus = ($currentStatus == 1) ? 0 : 1;
 
	    // Update the banner_status
	    $sql2 = "UPDATE banner SET banner_status = $newStatus WHERE banner_id = $id";
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