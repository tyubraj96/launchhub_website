<?php
include "partials/connect.php";
// print_r($_POST);
if (isset($_POST["team_insert"])) {
	
	$position =  $_POST["team_position"];
         $name =  $_POST["team_name"];
         $email =  $_POST["team_email"];
	$status =  $_POST["team_status"];
	
         $text =  $_POST["team_description"];
         $date = date("d/m/Y");
         $time = date("h/i/sa");



	// File upload
	$target_dir = "teamimages/";
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
			$sql = "INSERT INTO team ( team_image, team_position, team_name, team_email , team_description, team_status, date, time) VALUES ('$filename','$position', '$name', '$email','$text','$status','$date','$time')";
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
		<th> Team Position</th>
		<th> Team status</th>
		<th> Team image</th>
		<th>Action</th>

	</thead>

	<tbody>

		<?php
		$sql = "SELECT * FROM team ";
		$result = mysqli_query($conn, $sql);
		if (mysqli_num_rows($result) > 0) {
			
			while ($row = mysqli_fetch_assoc($result)) {
				 $team_id = $row['team_id'];
				//  var_dump($row);
		?>
				<tr>
					<td class='id'><?php echo $row['team_id']; ?></td>
					<td><?php echo $row['team_position']; ?></td>
					<td><?php
						if ($row['team_status'] == 1) {
							echo "show";
						} else {
							echo "hide";
						}
						?>
					</td>
					<td><img src="teamimages/<?php echo $row['team_image']; ?>" alt="" srcset="" class="banner_img img-fluid" ></td>
					<td>
						<div class="d-flex gap-3">
							<button class="btn btn-primary" onclick="viewTeam('<?php echo $team_id; ?>')"><i class='fa fa-eye fa-1x'></i></button>
							<button class="btn btn-primary" onclick="updateTeamvalue('<?php echo $team_id; ?>')" data-bs-target="#myModalvalues" ><i class='fa fa-pen-to-square fa-1x'></i></button>
							<button class="btn btn-primary" onclick="viewTeamimage('<?php echo $team_id; ?>')"><i class='fa fa-camera fa-1x'></i></button>
							<button class="btn btn-primary" onclick="ViewStatus('<?php echo $team_id; ?>')"><i class='fa fa-trash fa-1x'></i></button>
						</div>
					</td>

			<?php
			}
		}
			?>


	</tbody>
</table>
	<?php
} else if (isset($_POST['action']) && $_POST['action'] == 'ViewTeam') {
	$team_id = $_POST['team_id'];
	// echo "$banner_id";
	$sql = "SELECT * FROM team WHERE team_id = '$team_id'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
	?>


			<form id="submit_form" method="post" enctype="multipart/form-data">
				<input type="hidden" id="form_mode" name="form_mode" value="view">
				<div class="mb-3 d-flex gap-4">
					<label for="banner_title" class="form-label"> Team Position:</label>
					<span><?php echo $row['team_position']; ?></span>
					
				</div>



				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_text" class="form-label">Team name</label>
					<span><?php echo $row['team_name']; ?></span>
					


				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_button" class="form-label">Team email</label>
					<span><?php echo $row['team_email']; ?></span>
					


				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_text d-flex gap-4" class="form-label">Team Description</label>
					<span><?php echo $row['team_description']; ?></span>
					
					<input type="hidden" name="team_insert">


				</div>
				<div class="mb-3 d-flex gap-4">
					<label for="banner_text d-flex gap-4" class="form-label">Images</label>
					
					<img src="teamimages/<?php echo $row['team_image'] ?> " alt="" srcset=""  style="width:500px; height :auto;">
					
					


				</div>
				

				
				
			</form>


		<?php
		}
	}
} else if (isset($_POST['action']) && $_POST['action'] == 'updateTeamvalue') {
	$teamid = $_POST['team_id'];
	// echo "$banner_id";
	$sql = "SELECT * FROM team WHERE team_id = $teamid ";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
		?>

			<form id="submit_form_" method="post" enctype="multipart/form-data">
				<div class="mb-3">
					<label for="banner_title" class="form-label"> team position</label>
					<input type="text" class="form-control" id="team_position" aria-describedby="emailHelp" name="team_position" value="<?php echo $row['team_position']; ?>">
					<input type="hidden" name="insert_updateteamvalue">
					<input type="hidden" name="team_id" value="<?php echo $row['team_id']; ?>">


				</div>
				<div class="mb-3">
					<label for="banner_text" class="form-label">Team name</label>
					<input type="text" class="form-control" id="banner_text" aria-describedby="emailHelp" name="team_name" value="<?php echo $row['team_name']; ?>">


				</div>
				<div class="mb-3">
					<label for="banner_button" class="form-label">Team email</label>
					<input type="text" class="form-control" id="banner_button" aria-describedby="emailHelp" name="team_email" value="<?php echo $row['team_email']; ?>">

				</div>
				<div class="mb-3">
					<label for="banner_text" class="form-label">Team description</label>
					<input type="text" class="form-control" id="team_email" aria-describedby="emailHelp" name="team_description" value="<?php echo $row['team_description']; ?>">
					<!-- <input type="hidden" name="banner_update" > -->


				</div>
				<div class="mb-3">
					<label for="banner_text" class="form-label">Team description</label>
					<input type="text" class="form-control" id="team_email" aria-describedby="emailHelp" name="team_description" value="<?php echo $row['team_description']; ?>">
				</div>

				

				<div class="form-group mb-3">

					<button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold">Submit</button>

				</div>

			</form>
	<?php
		}
	}
} else if (isset($_POST["insert_updateteamvalue"])) {
	$position =  $_POST["team_position"];
         $name =  $_POST["team_name"];
         $email =  $_POST["team_email"];
	$id = $_POST["team_id"];
         $text =  $_POST["team_description"];
         $date = date("d/m/Y");
         $time = date("h/i/sa");


	$sql = "UPDATE  team  set  team_position ='$position', team_name = '$name' ,team_email = '$email' , team_description
	='$text', date ='$date', time='$time' WHERE team_id =$id";
	echo " $sql";
	$result = mysqli_query($conn, $sql);
	// if($result){
	//      echo "success";
	// }
	// else{
	//          echo "failure";
	// }



}
if (isset($_POST['action']) && $_POST['action'] == 'viewimage') {
	$id = $_POST['teamid'];

	$sql = "SELECT * from team where team_id = $id";
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
						<input type="hidden" name="update_teamimage">
						<input type="hidden" name="id" value="<?php echo $row['team_id']; ?>">
					</div>
					<div class="form-group mb-3">

						<button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold" id="submit_banner">Submit</button>

					</div>
				</form>

			</div>
			<div class="col-lg-6">
				<h3 class="center fw-bold mb-5 text-primary">PREVIOUS IMAGE</h3>

				<img src="teamimages/<?php echo $row['team_image']; ?>" alt="" srcset="" class="img-fluid">
			</div>

		</div>
	</div>


<?php
} else if (isset($_POST["update_teamimage"])) {
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
			$sql = "UPDATE  team SET  team_image = '$filename' WHERE team_id = $id ";
			echo $sql;
			mysqli_query($conn, $sql);
				
		} else {
			echo "failure";
		}
	}
}
else if (isset($_POST['action']) && $_POST['action'] == 'ViewStatus') { 
	$id=$_POST['teamid'];
	// echo "$id";
	// Fetch the current banner_status value
	$sql = "SELECT team_status FROM team WHERE team_id = $id";
	$Result1 = mysqli_query($conn, $sql);
 
	if ($Result1) {
	    $Row1 = mysqli_fetch_assoc($Result1);
	    $currentStatus = $Row1['team_status'];
 
	    // Toggle the status between 0 and 1
	    $newStatus = ($currentStatus == 1) ? 0 : 1;
 
	    // Update the banner_status
	    $sql2 = "UPDATE team SET team_status = $newStatus WHERE team_id = $id";
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