<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Admin Panel</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
  <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
  <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script> -->
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="assets/css/shared/style.css">
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/demo_1/style.css">
  <!-- End Layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.ico" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <?php include('admin_header.php'); ?>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <?php include('admin_sidebar.php'); ?>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->

        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
    <? include('admin_footer.php'); ?>
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->

  <!-- <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <!-- <script src="assets/js/shared/off-canvas.js"></script>
  <script src="assets/js/shared/misc.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- <script src="assets/js/demo_1/dashboard.js"></script> -->
  <!-- End custom js for this page  -->

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      //       function loadTable() {
      //     $.ajax({
      //         url: "ajax-load.php",
      //         type: "POST",
      //         success: function(data) {
      //             $("#table-data").html(data);
      //         }
      //     });
      // }
      // loadTable(); // Load Table Records on Page Load

      // $("#save-button").on("click", function(e) {
       function adduser(e) {
        e.preventDefault();
        var username = $("#username").val();
        var password = $("#password").val();
        var cpassword = $("#cpassword").val();
        if (username == "" || password == "" || cpassword == "") {
          // $("#error-message").html("all fields are required").slideDown(); //for animation
          // $("#success-message").slideUp(); //slideup hide if any success message is printed
        } else {
          $.ajax({
            url: "admin/src/pages/samples/register.php",
            type: "POST",
            data: {
              username: username,
              password: password,
              cpassword: cpassword
            },
            success: function(data) {
              if (data.trim() == "success") {
                // loadTable();
                $("#addForm").trigger("reset");

              }

            }
          });

        }
        // });
      }
      // $("#save-button").on("click", adduser);
    });
    
    $(document).ready(function() {
      
      // $("#login-btn").on("click", function(e) {
        $(document).on("click", "#login-btn", function() {
        var login_username = $("#login_username").val();
        var login_password = $("#login_password").val();
        console.log(login_username);
      });
    });
  
      
  </script>
</body>

</html>