<?php session_start();

if (!isset($_SESSION['username'])) {
  header("location: http://localhost/launchhub_website/admin/login.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Panel</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>



  <link rel="stylesheet" href="assets/css/shared/style.css">

  <link rel="stylesheet" href="assets/css/demo_1/style.css">


</head>


<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
  <div class="text-center navbar-brand-wrapper d-flex align-items-top justify-content-center">
    <a class="navbar-brand brand-logo" href="index.php">
      <h1 class="fw-bolder mt-3">CMS</h1>
    </a>
    <a class="navbar-brand brand-logo-mini" href="index.html">
      <img src="assets/images/logo-mini.svg" alt="logo" />
    </a>
  </div>
  <div class="navbar-menu-wrapper d-flex align-items-center">
    <ul class="navbar-nav">

    </ul>

    <ul class="navbar-nav ml-auto">
      <div class="dropdown">
        <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown">
          Welcome <?php echo $_SESSION["username"]; ?>
        </button>
        <ul class="dropdown-menu"> <!-- Add the "dropdown-menu" class here -->
          <li><a class="dropdown-item" href="admin_logout.php">Logout</a></li>
        </ul>
      </div>
    </ul>
  </div>
</nav>

