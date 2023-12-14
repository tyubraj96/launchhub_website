<?php
include "partials/connect.php";
include "admin_header.php";
include "admin_sidebar.php";
?>


<div id="admin-content" style=" margin-top:66px; margin-left: 271px;">
     <div id="error_message"></div>
     <div id="success_message"></div>
     <div class="container">
          <div class="row">
               <div class="col-md-10">
                    <h1 class="admin-heading text-center text-primary mt-1">Service Setting</h1>
               </div>
               <div class="col-md-2 text-center fs-4 mt-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                         Add service
                    </button>

               </div>
               <div class="col-lg-12">
                    <div id="display_table">

				</div>


               </div>
               <!-- The Modal -->
               <div class="modal" id="myModal">
                    <div class="modal-dialog" id="modal-dialog">
                         <div class="modal-content">


                              <!-- Modal Header -->
                              <div class="modal-header">
                                   <h4 class="modal-title">Add service</h4>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">

                                   <form id="submit_form" method="post" enctype="multipart/form-data">
                                        <div class="mb-3">
                                             <label for="banner_title" class="form-label"> Service heading Title</label>
                                             <input type="text" class="form-control" id="serviceheading_title" aria-describedby="emailHelp" name="serviceheading_title" required>
                                    
                                    	</div>
								<div class="form-group mb-3">
                                             <label class="fw-bold">Service Image</label>
                                             <input type="file" name="file" id="upload_file" required>

                                        </div>
                                        <div class="mb-3">
                                             <label for="service_title" class="form-label"> Service Title</label>
                                             <input type="text" class="form-control" id="service_title" aria-describedby="emailHelp" name="service_title" required>


                                        </div>
                                        <div class="mb-3">
                                             <label for="service_text" class="form-label">Service Text</label>
                                             <input type="text" class="form-control" id="service_text" aria-describedby="emailHelp" name="service_text" required>
									<input type="hidden" name="service_insert" required>


                                        </div>
                                       
                                        <div class="mb-3">

                                             <select class="form-select" aria-label="Default select example" name="service_status" required>
                                                  <option selected>status</option>
                                                  <option value="1">show</option>
                                                  <option value="0">hide</option>

                                             </select>

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
                    <div class="modal-dialog" id="modal-dialog">
                         <div class="modal-content">
                              <div class="modal-header">
                                   <h4 class="modal-title">View banner</h4>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>
                              <div id="Ajaxview" class="modal-body">

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
               <!-- <div class="modal" id="Modal_status">
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
               </div> -->

          </div>
     </div>
</div>
<?php include "scripts.php"; ?>
<script>
     function displaydata() {
          var displaydata = "true";
          $.ajax({
               url: "service_component.php",
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

     function closeModal(modalId) {
          $("#" + modalId).hide();
     }

     function viewservice(service_id) {
          var service_id = service_id;
           console.log(service_id);
          $.ajax({
               url: "service_component.php",
               type: "post",
               data: {
                    service_id: service_id,
                    action: "ViewServices",
                    // form_mode: "view"
               },
               success: function(data, status) {

                    $("#Ajaxview").html(data);
                    // $('input[name="form_mode"]').val('view');
                    $('#myModalview').modal('show');
                     console.log(status);
               }


          });
     }

     function updateServicevalue(service_id) {

          var service_id = service_id;
          console.log(service_id);
          $.ajax({
               url: "service_component.php",
               type: "post",
               data: {
                    service_id: service_id,
                    action: "updateServicevalue"
               },
               success: function(data, status) {
                    $('.modal-content #ajaxmodal_value').html(data);
                    $('#myModalvalues').show();
                    console.log(status);
                    $("#submit_form_").on("submit", function(e) {
                         e.preventDefault();

                         var formData1 = new FormData(this);

                         submit_updatevalue(formData1);
                        
                         showsuccess_message("success", "Bannerdata updated successfully");
                    });
               }


          });

     }

     function submit_updatevalue(datas) {


          console.log(datas);
          $.ajax({
               url: "service_component.php",
               type: "POST",
               data: datas,
               contentType: false,
               processData: false,
               success: function(data) {
                      if(data == "success"){
                    displaydata();

                    console.log(datas);
                     }

               }


          });
		return "success";

     }

     function viewServicesbanner(serviceid) {
          var serviceid = serviceid;
          // console.log(bannerid);
          $.ajax({
               url: "service_component.php",
               type: "post",
               data: {
                    serviceid: serviceid,
                    action: "viewService"
               },
               success: function(data, status) {


                    displaydata();
                    $('.modal-content #modal_image').html(data);
                    $('#Modal_imagebanner').show();

                    console.log(status);
                    //      $("#submit_form_").on("submit", function(e) {
                    //           e.preventDefault();

                    //           var formData1 = new FormData(this);

                    //           submit_updatevalue(formData1);
                    //     });
                    $("#form_imagesubmit").on("submit", function(e) {
                         e.preventDefault();

                         var formData2 = new FormData(this);
                         // console.log(formData2);

                         update_submitbanner(formData2);
                         
                              
						
                              $("#Modal_imagebanner").hide();
                              showsuccess_message("success", "Bannerimage updated successfully");
                         

                    });
               }


          });

     }

     function update_submitbanner(data) {

          console.log(data);
          $.ajax({
               url: "service_component.php",
               type: "POST",
               data: data,
               contentType: false,
               processData: false,
               success: function(data) {
                    if (data === "success") {
					displaydata();

                    } else if (data === "failure") {
                         showerror_message("failure", "Your image cant be updated");
                    }

               }


          });
     }

     function ViewStatus(banner_id) {
          var banner_id = banner_id;
          console.log(banner_id);
          confirm_alert();
          $.ajax({
               url: "service_component.php",
               type: "post",
               data: {
                    banner_id: banner_id,
                    action: "ViewStatus",
                    // form_mode: "view"
               },
               success: function(data, status) {
                    
                    if (data == "success") {
                         displaydata();
                         confirm_alert("Saved!", "", "success");
                    } else {
                         confirm_alert("Saved!", "", "success");
                    }

                    // $('.modal-content #modal_status_update').html(data);

                    // $('#Modal_status').modal('show');
                    // $("#submit_status").on("submit", function(e) {
                    //      e.preventDefault();

                    //      var formData3 = new FormData(this);
                    //      // console.log(formData2);

                    //      update_status(formData3);
                    //      $('#Modal_imagebanner').hide();
                    // });

               }


          });
     }

     function update_status(data) {
          console.log(data);

     }

     $(document).ready(function() {

          displaydata();

     });

     $(document).ready(function() {
          $("#submit_form").on("submit", function(e) {
               e.preventDefault();

               var formData = new FormData(this);
               formData.append('file', $('#upload_file')[0].files[0]);
               console.log(formData);

               $.ajax({
                    url: "service_component.php",
                    type: "POST",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(data) {

                         displaydata();
                         $("#submit_form").trigger("reset");
                         if (data) {
                              displaydata();
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
          Swal.fire({
               title: "Do you want to save the changes?",
               showDenyButton: true,
               showCancelButton: true,
               confirmButtonText: "Save",
               denyButtonText: `Don't save`
          }).then((result) => {
               /* Read more about isConfirmed, isDenied below */
               if (result.isConfirmed) {
                    Swal.fire("Saved!", "", "success");
               } else if (result.isDenied) {
                    Swal.fire("Changes are not saved", "", "info");
               }
          });
     }
</script>