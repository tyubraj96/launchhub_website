
 <!-- <?php include "partials/connect.php"; 
 session_start();
 if(isset($_SESSION['username'])){
     header("location: http://localhost/launchhub_website/admin/index.php");
 }
 ?> -->

<!DOCTYPE html>

<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Star Admin Premium Bootstrap Admin Dashboard Template</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.addons.css">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="assets/css/shared/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
    <link rel="shortcut icon" href="assets/images/favicon.ico" />
  
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
          <div class="row w-100">
            <div class="col-lg-4 mx-auto">
              <div class="auto-form-wrapper">
                <form action="#" id="submit_form">
                  <div class="form-group">
                    <label class="label">Username</label>
                    <div class="input-group">
                      <input type="text" class="form-control" placeholder="Username" name="login_username">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label class="label">Password</label>
                    <div class="input-group">
                      <input type="password" class="form-control" placeholder="*********" name="login_password">
                      <input type="hidden" name="login_submit">
                      <div class="input-group-append">
                        <span class="input-group-text">
                          <i class="mdi mdi-check-circle-outline"></i>
                        </span>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <button class="btn btn-primary submit-btn btn-block" id="login-btn" type="submit">Login</button>
                  </div>
                  
                  
                  <div class="text-block text-center my-3">
                    <span class="text-small font-weight-semibold">Not a member ?</span>
                    <a href="register.html" class="text-black text-small">Create new account</a>
                  </div>
                </form>
              </div>
              <ul class="auth-footer">
                <li>
                  <a href="#">Conditions</a>
                </li>
                <li>
                  <a href="#">Help</a>
                </li>
                <li>
                  <a href="#">Terms</a>
                </li>
              </ul>
              <p class="footer-text text-center">copyright © 2020 Bootstrapdash. All rights reserved.</p>
              <p class="footer-text text-center text-center"><a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank"> Free Bootstrap template </a> from BootstrapDash templates</p>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    
    <!-- endinject -->
    <!-- inject:js -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script>
    $(document).ready(function() {
     
    });
    
    $(document).ready(function() {
      
      $("#submit_form").on("submit", function(e) {
        e.preventDefault();
        // var login_username = $("#login_username").val();
        // var login_password = $("#login_password").val();
        console.log($(this).serialize());
        $.ajax({
          url:"save-loginform.php",
          type:"post",
          data:$(this).serialize(),
          success:function(data,status){
            if(data === "success"){

              window.location.href = "http://localhost/launchhub_website/admin/index.php";
            }
            else {
            
            console.log("Login failed");
          }

          }
          });
      });
    });
  
      
  </script>
   
  </body>
</html>