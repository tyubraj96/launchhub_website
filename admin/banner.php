<?php
include "partials/connect.php";
include "admin_header.php";
include "admin_sidebar.php";
?>

<div id="admin-content" style=" margin-top:66px; margin-left: 271px;">
         <div class="container">
                  <div class="row">
                           <div class="col-md-10">
                                    <h1 class="admin-heading text-center text-primary mt-1">Banner Setting</h1>
                           </div>
                           <div class="col-md-2 text-center fs-4 mt-2">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                             Add Banner
                                    </button>

                           </div>
                           <div class="col-lg-12">
                                    <table class="table" id="display_table">
                                            
                                            
                                    </table>

                           </div>
                                    <!-- The Modal -->
                                    <div class="modal" id="myModal">
                                             <div class="modal-dialog" id="modal-dialog">
                                                      <div class="modal-content">
                                                              

                                                               <!-- Modal Header -->
                                                               <div class="modal-header">
                                                                        <h4 class="modal-title">"Add banner"</h4>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                               </div>

                                                               <!-- Modal body -->
                                                               <div class="modal-body">

                                                                        <form id="submit_form" method="post" enctype="multipart/form-data">
                                                                                 <div class="mb-3">
                                                                                          <label for="banner_title" class="form-label"> Banner Title</label>
                                                                                          <input type="text" class="form-control" id="banner_title" aria-describedby="emailHelp" name="banner_title">


                                                                                 </div>
                                                                                 <div class="mb-3">
                                                                                          <label for="banner_text" class="form-label"> Banner Text</label>
                                                                                          <input type="text" class="form-control" id="banner_text" aria-describedby="emailHelp" name="banner_text">


                                                                                 </div>
                                                                                 <div class="mb-3">
                                                                                          <label for="banner_button" class="form-label">Banner Button</label>
                                                                                          <input type="text" class="form-control" id="banner_button" aria-describedby="emailHelp" name="banner_button">


                                                                                 </div>
                                                                                 <div class="mb-3">
                                                                                          <label for="banner_text" class="form-label">Banner Button link</label>
                                                                                          <input type="text" class="form-control" id="banner_button_link" aria-describedby="emailHelp" name="banner_button_link">
                                                                                          <input type="hidden" name="banner_insert">


                                                                                 </div>
                                                                                 <div class="mb-3">

                                                                                          <select class="form-select" aria-label="Default select example" name="banner_status">
                                                                                                   <option selected>status</option>
                                                                                                   <option value="1">show</option>
                                                                                                   <option value="0">hide</option>

                                                                                          </select>

                                                                                 </div>

                                                                                 <div class="form-group mb-3">
                                                                                          <label class="fw-bold">Select Image</label>
                                                                                          <input type="file" name="file" id="upload_file" />

                                                                                 </div>
                                                                                 <div class="form-group mb-3">

                                                                                          <button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold">Submit</button>

                                                                                 </div>

                                                                        </form>
                                                               </div>

                                                               <!-- Modal footer -->
                                                               <div class="modal-footer">
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                               </div>

                                                      </div>
                                             </div>
                                    </div>

                                    <div class="modal" id="myModaldatas">
                                             <div class="modal-dialog" id="modal-dialog">
                                                      <div class="modal-content">
                                                               <div id="Ajaxdata"class="modal-body">

                                                               </div>


                                                      </div>
                                             </div>
                                    </div>
                  </div>
         </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script>
         function displaydata() {
                           var displaydata = "true";
                           $.ajax({
                                    url: "banner_component.php",
                                    type: "post",
                                    data: {
                                             displaysend: displaydata
                                    },
                                    success: function(data, status) {
                                             $('#display_table').html(data);
                                             // console.log(status);
                                    }


                           });
         }
         function viewbanner(banner_id) {
                           var banner_id = banner_id;
                           // console.log(banner_id);
                           $.ajax({
                                    url: "banner_component.php",
                                    type: "post",
                                    data: {
                                             banner_id: banner_id,
                                             action: "ViewData",
                                             form_mode: "view"
                                    },
                                    success: function(data, status) {
                                             
                                             $('.modal-content #Ajaxdata').html(data);
                                             $('input[name="form_mode"]').val('view');
                                             $('#myModaldatas').modal('show');
                                             console.log(status);
                                    }


                           });
         }
         function updatevalue(banner_id){
                           var banner_id =banner_id;
                           // console.log(banner_id);
                           $.ajax({
                                    url: "banner_component.php",
                                    type: "post",
                                    data: {
                                             banner_id: banner_id,
                                             action: "updatevalue"
                                    },
                                    success: function(data, status) {
                                             $('#modal-dialog .modal-body').html(data);
                                             $('#myModal').show();
                                             console.log(status);
                                    }


                           });

                  }
         $(document).ready(function() {

                  displaydata();

         });

         $(document).ready(function() {
                  $("#submit_form").on("submit", function(e) {
                           e.preventDefault();

                           var formData = new FormData(this);
                           formData.append('file', $('#upload_file')[0].files[0]);
                           // console.log(formData);

                           $.ajax({
                                    url: "banner_component.php",
                                    type: "POST",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(data) {
                                             
                                                      displaydata();
                                                      $("#submit_form").trigger("reset");
                                             
                                    }

                           });

                  });
                 
         });
</script>