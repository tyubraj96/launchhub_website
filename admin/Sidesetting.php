<?php
include "partials/connect.php";
include "admin_header.php";
include "admin_sidebar.php";
?>

<div id="admin-content" style=" margin-top:66px; margin-left: 271px;">

         <div class="container">
                  <div class="row">
                           <div class="col-md-10">
                                    <h1 class="admin-heading text-center text-primary mt-1">Side Setting</h1>
                           </div>
                           <div class="col-md-2 text-center fs-4 mt-2">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                                             Add Side Setting
                                    </button>

                           </div>
                           <div class="col-lg-12">
                                    <div id="display_table"></div>


                           </div>
                           <!-- The Modal -->
                           <div class="modal" id="myModal">
                                    <div class="modal-dialog" id="modal-dialog">
                                             <div class="modal-content">


                                                      <!-- Modal Header -->
                                                      <div class="modal-header">
                                                               <h4 class="modal-title">Add Side Setting</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                      </div>

                                                      <!-- Modal body -->
                                                      <div class="modal-body">

                                                               <form id="submit_form" method="post" enctype="multipart/form-data">

                                                                        <div class="mb-3">
                                                                                 <label for="company_location" class="form-label">Company Name</label>
                                                                                 <input type="text" class="form-control" id="company_name" aria-describedby="emailHelp" name="company_name" required>


                                                                        </div>
                                                                        <div class="mb-3">
                                                                                 <label for="team_name" class="form-label">Company email</label>
                                                                                 <input type="text" class="form-control" id="company_email" aria-describedby="emailHelp" name="company_email">
                                                                                 <input type="hidden" name="company_insert" required>


                                                                        </div>
                                                                        <div class="mb-3">
                                                                                 <label for="team_name" class="form-label">Company mobile</label>
                                                                                 <input type="text" class="form-control" id="company_mobile" aria-describedby="emailHelp" name="company_mobile">



                                                                        </div>
                                                                        <div class="mb-3">
                                                                                 <label for="company_phone" class="form-label">Company Phone</label>
                                                                                 <input type="text" class="form-control" id="company_phone" aria-describedby="emailHelp" name="company_phone" required>


                                                                        </div>
                                                                        <div class="mb-3">
                                                                                 <label for="company_location" class="form-label">Company Location</label>
                                                                                 <input type="text" class="form-control" id="company_location" aria-describedby="emailHelp" name="company_location" required>


                                                                        </div>
                                                                        <div class="mb-3">
                                                                                 <label for="company_location" class="form-label">Company Map</label>
                                                                                 <input type="text" class="form-control" id="company_location" aria-describedby="emailHelp" name="company_map" required>


                                                                        </div>
                                                                        <div class="mb-3">
                                                                                 <label for="facebook_link" class="form-label">Facebook Link</label>
                                                                                 <input type="text" class="form-control" id="facebook_link" aria-describedby="emailHelp" name="facebook_link" required>


                                                                        </div>
                                                                        <div class="mb-3">
                                                                                 <label for="team_position" class="form-label">Instagram Link</label>
                                                                                 <input type="text" class="form-control" id="instagram_link" aria-describedby="emailHelp" name="instagram_link" required>


                                                                        </div>
                                                                        <div class="mb-3">
                                                                                 <label for="team_position" class="form-label">Twitter Link</label>
                                                                                 <input type="text" class="form-control" id="twitter_link" aria-describedby="emailHelp" name="twitter_link" required>


                                                                        </div>
                                                                        <div class="mb-3">
                                                                                 <label for="team_position" class="form-label">Linkedin Link</label>
                                                                                 <input type="text" class="form-control" id="team_description" aria-describedby="emailHelp" name="linkedin_link" required>


                                                                        </div>



                                                                        <div class="form-group mb-3">
                                                                                 <label class="fw-bold">Select Image</label>
                                                                                 <input type="file" name="file" id="upload_file" required>

                                                                        </div>

                                                                        <div class="form-group mb-3">

                                                                                 <button type="submit" name="submit_banner" class="form-control btn btn-primary fw-bold" id="insert_banner">Submit</button>

                                                                        </div>

                                                               </form>
                                                      </div>


                                             </div>
                                    </div>
                           </div>

                           <div class="modal" id="myModalview">
                                    <div class="modal-dialog modal-lg" id="modal-dialog">
                                             <div class="modal-content modal-lg">
                                                      <div class="modal-header">
                                                               <h4 class="modal-title">View banner</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                      </div>
                                                      <div id="Ajaxdata" class="modal-body">

                                                      </div>


                                             </div>
                                    </div>
                           </div>
                           <div class="modal" id="myModalvalues">
                                    <div class="modal-dialog" id="modal_values">
                                             <div class="modal-content">
                                                      <div class="modal-header">
                                                               <h4 class="modal-title">Update banner</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="myModalvalues" onclick="closeModal('myModalvalues')"></button>
                                                      </div>
                                                      <div id="ajaxmodal_value" class="modal-body">

                                                      </div>


                                             </div>
                                    </div>
                           </div>
                           <div class="modal" id="Modal_imagebanner">
                                    <div class="modal-dialog modal-xl" id="modal-dialog">
                                             <div class="modal-content">
                                                      <div class="modal-header">
                                                               <h4 class="modal-title">Update banner image</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closeModal('Modal_imagebanner')"></button>
                                                      </div>
                                                      <div id="modal_image" class="modal-body">

                                                      </div>


                                             </div>
                                    </div>
                           </div>
                           <div class="modal" id="Modal_status">
                                    <div class="modal-dialog" id="modal-dialog">
                                             <div class="modal-content">
                                                      <div class="modal-header">
                                                               <h4 class="modal-title">Update banner Status</h4>
                                                               <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                                      </div>
                                                      <div id="modal_status_update" class="modal-body">

                                                      </div>


                                             </div>
                                    </div>
                           </div>

                  </div>
         </div>
</div>
<?php include "scripts.php"; ?>
<script>
         function loadtable() {
                  var displaydata = "true";
                  $.ajax({
                           url: "Sidesetting_component.php",
                           type: "post",
                           data: {
                                    displaysend: displaydata
                           },
                           success: function(data, status) {
                                    $('#display_table').html(data);
                                    $('#banner_table').DataTable();
                                    // console.log(status);
                           }


                  });
         }

         $(document).ready(function() {

                  loadtable();

         });

         function closeModal(modalId) {
                  $("#" + modalId).hide();
         }

         function viewcompany(company_id) {
                  var company_id = company_id;
                  // console.log(banner_id);
                  $.ajax({
                           url: "Sidesetting_component.php",
                           type: "post",
                           data: {
                                    company_id: company_id,
                                    action: "ViewCompany",
                                    form_mode: "view"
                           },
                           success: function(data, status) {

                                    $('.modal-content #Ajaxdata').html(data);
                                    $('input[name="form_mode"]').val('view');
                                    $('#myModalview').modal('show');
                                    // console.log(status);
                           }


                  });
         }

         function updateCompanyvalue(company_id) {

                  var company_id = company_id;
                  console.log(company_id);
                  $.ajax({
                           url: "Sidesetting_component.php",
                           type: "post",
                           data: {
                                    company_id: company_id,
                                    action: "updateCompanyvalue"
                           },
                           success: function(data, status) {
                                    $('.modal-content #ajaxmodal_value').html(data);
                                    $('#myModalvalues').show();
                                    console.log(status);
                                    $("#submit_form_").on("submit", function(e) {
                                             e.preventDefault();

                                             var formData1 = new FormData(this);

                                             submit_updatevalue(formData1);

                                    });
                           }


                  });

         }

         function submit_updatevalue(datas) {


                  console.log(datas);
                  $.ajax({
                           url: "Sidesetting_component.php",
                           type: "POST",
                           data: datas,
                           contentType: false,
                           processData: false,
                           success: function(data) {
                                    //  if(data == "success"){
                                    loadtable();
                                    $("#myModalvalues").hide();
                                    showsuccess_message("success", "Bannerdata updated successfully");


                           }


                  });

         }

         function viewCompanybanner(company_id) {
                  var company_id = company_id;
                  // console.log(bannerid);
                  $.ajax({
                           url: "Sidesetting_component.php",
                           type: "post",
                           data: {
                                    company_id: company_id,
                                    action: "viewCompanylogo"
                           },
                           success: function(data, status) {


                                    // loadtable();
                                    $('.modal-content #modal_image').html(data);
                                    $('#Modal_imagebanner').show();

                                    console.log(status);

                                    $("#form_imagesubmit").on("submit", function(e) {
                                             e.preventDefault();

                                             var formData2 = new FormData(this);


                                             update_submit_teambanner(formData2);



                                    });
                           }


                  });

         }

         function update_submit_teambanner(data) {

                  console.log(data);
                  $.ajax({
                           url: "Sidesetting_component.php",
                           type: "POST",
                           data: data,
                           contentType: false,
                           processData: false,
                           success: function(data) {
                                    if (data == "failure") {
                                             showerror_message("failure", "Your image cant be updated");


                                    } else {
                                             loadtable();
                                             $("#Modal_imagebanner").hide();

                                             showsuccess_message("success", "Bannerimage updated successfully");



                                    }
                           }


                  });
         }

         function ViewStatus(teamid) {
                  var teamid = teamid;
                  Swal.fire({
                           title: "Do you want to save the changes?",
                           showDenyButton: true,
                           showCancelButton: true,
                           confirmButtonText: "Save",
                           denyButtonText: `Don't save`
                  }).then((result) => {
                           /* Read more about isConfirmed, isDenied below */
                           if (result.isConfirmed) {


                                    console.log(teamid);

                                    $.ajax({
                                             url: "Sidesetting_component.php",
                                             type: "post",
                                             data: {
                                                      teamid: teamid,
                                                      action: "ViewStatus",
                                                      // form_mode: "view"
                                             },
                                             success: function(data, status) {

                                                      if (data == "success") {
                                                               Swal.fire("Saved!", "", "success");
                                                               loadtable();
                                                               // confirm_alert("Saved!", "", "success");
                                                      } else {
                                                               confirm_alert("Saved!", "", "success");
                                                      }



                                             }


                                    });



                           } else if (result.isDenied) {
                                    Swal.fire("Changes are not saved", "", "info");
                           }
                  });

         }

         function update_status(data) {
                  console.log(data);

         }

         // $(document).ready(function() {

         //      displaydata();

         // });

         $(document).ready(function() {
                  $("#submit_form").on("submit", function(e) {
                           e.preventDefault();

                           var formData = new FormData(this);
                           formData.append('file', $('#upload_file')[0].files[0]);
                           console.log(formData);

                           $.ajax({
                                    url: "Sidesetting_component.php",
                                    type: "POST",
                                    data: formData,
                                    contentType: false,
                                    processData: false,
                                    success: function(data) {

                                             // loadtable();
                                             // $("#submit_form").trigger("reset");
                                             if (data) {
                                                      loadtable();
                                                      $("#myModal").modal("hide");

                                                      showsuccess_message("success", "data inserted successfully");

                                             } else {
                                                      $("#myModal").modal("hide");

                                                      showerror_message("failure", "cant save records")
                                             }

                                    },
                                    error: function(xhr, textStatus, errorThrown) {
                                             console.error("AJAX Error:", textStatus, errorThrown);
                                             // Handle AJAX error
                                             showerror_message("failure", "An error occurred while processing the request.");
                                    }

                           });

                  });


         });

         function showsuccess_message(title, text) {
                  Swal.fire({
                           title: title,
                           text: text,
                           icon: "success"
                  });
         }

         function showerror_message(title, text) {
                  Swal.fire({
                           title: title,
                           text: text,
                           icon: "error"
                  });
         }

         function confirm_alert() {

         }
</script>