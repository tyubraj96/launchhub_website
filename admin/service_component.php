<?php
include "partials/connect.php";
// print_r($_POST);
if (isset($_POST["service_insert"])) {
	$status = $_POST["service_status"];
	$title =  $_POST["service_title"];
	$text =  $_POST["service_text"];
	$heading_title =  $_POST["serviceheading_title"];
         $date = date("d/m/Y");
         $time = date("h/i/sa");
	



	// File upload
	$target_dir = "serviceimages/";
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
			$sql = "INSERT INTO services (serviceheading_title, service_image, service_title, service_text,
                           service_status, date, time) VALUES ('$heading_title', '$filename', '$title', '$text', '$status', '$date', '$time')";
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
		<th> Service heading title</th>
                  <th>Service Status</th>
		<th>Service Image </th>
		<th>Action</th>

	</thead>

	<tbody>

		<?php
		$sql = "SELECT * FROM services ";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			while ($row = mysqli_fetch_assoc($result)) {
				$service_id = $row['service_id'];
		?>
				<tr>
					<td class='id'><?php echo $row['service_id']; ?></td>
					<td><?php echo $row['serviceheading_title']; ?></td>
					<td><?php
						if ($row['service_status'] == 1) {
							echo "show";
						} else {
							echo "hide";
						}
						?>
					</td>
					<td><img src="serviceimages/<?php echo $row['service_image']; ?>" alt="" srcset="" class="banner_img img-fluid" ></td>
					<td>
						<div class="d-flex gap-3">
							<button class="btn btn-primary" onclick="viewservice('<?php echo $service_id; ?>')"><i class='fa fa-eye fa-1x'></i></button>
							<button class="btn btn-primary" onclick="updateServicevalue('<?php echo $service_id; ?>')" data-bs-target="#myModalvalues" ><i class='fa fa-pen-to-square fa-1x'></i></button>
							<button class="btn btn-primary" onclick="viewServicesbanner('<?php echo $service_id; ?>')"><i class='fa fa-camera fa-1x'></i></button>
							<button class="btn btn-primary" onclick="ViewStatus('<?php echo $service_id; ?>')"><i class='fa fa-trash fa-1x'></i></button>
						</div>
					</td>

			<?php
			}
		}
			?>


	</tbody>
</table>
	<?php
} else if (isset($_POST['action']) && $_POST['action'] == 'ViewServices') {
	$service_id = $_POST['service_id'];
	echo "$service_id";
	$sql = "SELECT * FROM services WHERE service_id = $service_id";
         echo "$sql";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
	?>


			<!-- <form id="submit_form" method="post" enctype="multipart/form-data"> -->
				<div class="mb-3 d-flex gap-4">
					<label for="banner_title" class="form-label"> Service Heading Title:</label>
					<span><?php echo $row['serviceheading_title']; ?></span>
					
				</div>



				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_text" class="form-label"> Service Title:</label>
					<span><?php echo $row['service_title']; ?></span>
					


				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_button" class="form-label">Service Text:</label>
					<span><?php echo $row['service_text']; ?></span>
                                             <input type="hidden" name="service_insert">
					


				</div>
				
				<div class="mb-3 d-flex gap-4">
					<label for="banner_text d-flex gap-4" class="form-label">Service Images</label>
					
					<img src="images/<?php echo $row['service_image'] ?> " alt="" srcset="" class="img-fluid">
					
				</div>
				

				
				
			<!-- </form> -->


		<?php
		}
	}
} else if (isset($_POST['action']) && $_POST['action'] == 'updateServicevalue') {
	$service_id = $_POST['service_id'];
	// echo "$banner_id";
	$sql = "SELECT * FROM services WHERE service_id = '$service_id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
		?>

			<form id="submit_form_" method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="banner_title" class="form-label"> Serviceheading Title</label>
					<input type="text" class="form-control" id="serviceheading_title" aria-describedby="emailHelp" name="serviceheading_title" value="<?php echo $row['serviceheading_title']; ?>">
					<input type="hidden" name="insert_updatevalue">
					<input type="hidden" name="service_id" value="<?php echo $row['service_id']; ?>">


				</div>
				<div class="mb-3">
					<label for="banner_text" class="form-label">Service Text</label>
					<input type="text" class="form-control" id="banner_text" aria-describedby="emailHelp" name="service_text" value="<?php echo $row['service_text']; ?>">


				</div>
				<div class="mb-3">
					<label for="banner_button" class="form-label">service title</label>
					<input type="text" class="form-control" id="banner_button" aria-describedby="emailHelp" name="service_title" value="<?php echo $row['service_title']; ?>">


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
}else if (isset($_POST["insert_updatevalue"])) {
	$id = $_POST["service_id"];
	$headingtitle =  $_POST["serviceheading_title"];
	$text =  $_POST["service_text"];
	$title =  $_POST["service_title"];
         $date = date("d/m/Y");
         $time = date("h/i/sa");
	

	$sql = "UPDATE  services  set  serviceheading_title ='$headingtitle', service_text = '$text' ,service_title = '$title' , date ='$date', time = '$time'  WHERE service_id =$id";
	echo  $sql;
	$result = mysqli_query($conn, $sql);
	// if($result){
	//      echo "success";
	// }
	// else{
	//          echo "failure";
	// }



}
if (isset($_POST['action']) && $_POST['action'] == 'viewService') {
	$id = $_POST['serviceid'];

	$sql = "SELECT * from services where service_id = $id";
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
						<input type="hidden" name="id" value="<?php echo $row['service_id']; ?>">
					</div>
					<div class="form-group mb-3">

						<button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold" id="submit_banner">Submit</button>

					</div>
				</form>

			</div>
			<div class="col-lg-6">
				<h3 class="center fw-bold mb-5 text-primary">PREVIOUS IMAGE</h3>

				<img src="serviceimages/<?php echo $row['service_image']; ?>" alt="" srcset="" class="img-fluid">
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
			$sql = "UPDATE  services SET  service_image = '$filename' WHERE service_id = $id ";
			echo $sql;
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
	$sql = "SELECT service_status FROM services WHERE service_id = $id";
	$Result1 = mysqli_query($conn, $sql);
 
	if ($Result1) {
	    $Row1 = mysqli_fetch_assoc($Result1);
	    $currentStatus = $Row1['service_status'];
 
	    // Toggle the status between 0 and 1
	    $newStatus = ($currentStatus == 1) ? 0 : 1;
 
	    // Update the banner_status
	    $sql2 = "UPDATE services SET service_status = $newStatus WHERE service_id = $id";
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