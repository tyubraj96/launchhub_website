<?php
include "partials/connect.php";
include "admin_header.php";
include "admin_sidebar.php";
?>

<div id="admin-content" style=" margin-top:66px; margin-left: 271px;">

     <div class="container">
          <div class="row">
               <div class="col-md-10">
                    <h1 class="admin-heading text-center text-primary mt-1">Portfolio Setting</h1>
               </div>
               <div class="col-md-2 text-center fs-4 mt-2">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                         Add Portfolio
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
                                   <h4 class="modal-title">Add Portfolio</h4>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                              </div>

                              <!-- Modal body -->
                              <div class="modal-body">

                                   <form id="submit_form" method="post" enctype="multipart/form-data">

                                        <div class="mb-3">
                                             <label for="team_position" class="form-label">Portfolio title</label>
                                             <input type="text" class="form-control" id="team_position" aria-describedby="emailHelp" name="portfolio_title" required>
                                             <input type="hidden" name="portfolio_insert" required>

                                        </div>
                                       
                                        <div class="mb-3">
                                        <label for="comment">Portfolio Text</label>
                                             <textarea class="form-control" rows="5" id="comment" name="portfolio_text"></textarea>


                                        </div>
                                        <div class="mb-3">
                                             <label for="team_position" class="form-label">Portfolio button text</label>
                                             <input type="text" class="form-control" id="team_description" aria-describedby="emailHelp" name="portfolio_button_text" required>


                                        </div>

                                        <div class="mb-3">

                                             <select class="form-select" aria-label="Default select example" name="portfolio_status" required>
                                                  <option selected>status</option>
                                                  <option value="1">show</option>
                                                  <option value="0">hide</option>

                                             </select>

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
                                   <h4 class="modal-title">View Portfolio</h4>
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
               url: "portfolio_component.php",
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

     function viewportfolio(portfolio_id) {
          var portfolio_id = portfolio_id;
           console.log(portfolio_id);
          $.ajax({
               url: "portfolio_component.php",
               type: "post",
               data: {
                    portfolio_id: portfolio_id,
                    action: "Viewportfolio",
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

     function updatePortfoliovalue(portfolio_id) {

          var portfolio_id = portfolio_id;
          console.log(portfolio_id);
          $.ajax({
               url: "portfolio_component.php",
               type: "post",
               data: {
                    portfolio_id: portfolio_id,
                    action: "updatePortfoliovalue"
               },
               success: function(data, status) {
                    $('.modal-content #ajaxmodal_value').html(data);
                    $('#myModalvalues').show();
                    console.log(status);
                    $("#submit_form_").on("submit", function(e) {
                         e.preventDefault();

                         var formData1 = new FormData(this);

                         submit_updatevalue(formData1);
                         $("#myModalvalues").hide();
                         showsuccess_message("success", "Bannerdata updated successfully");
                    });
               }


          });

     }

     function submit_updatevalue(datas) {


          console.log(datas);
          $.ajax({
               url: "portfolio_component.php",
               type: "POST",
               data: datas,
               contentType: false,
               processData: false,
               success: function(data) {
                    //  if(data == "success"){
                    loadtable();

                    // console.log(datas);
                    //  }

               }


          });

     }

     function viewPortfoliobanner(portfolio_id) {
          var portfolio_id = portfolio_id;
          // console.log(bannerid);
          $.ajax({
               url: "portfolio_component.php",
               type: "post",
               data: {
                    portfolio_id: portfolio_id,
                    action: "viewPortfolio"
               },
               success: function(data, status) {


                    // loadtable();
                    $('.modal-content #modal_image').html(data);
                    $('#Modal_imagebanner').show();

                    console.log(status);
               
                    $("#form_imagesubmit").on("submit", function(e) {
                         e.preventDefault();

                         var formData2 = new FormData(this);
                         

                         update_submit_portfoliobanner(formData2);



                    });
               }


          });

     }

     function  update_submit_portfoliobanner(data) {

          console.log(data);
          $.ajax({
               url: "portfolio_component.php",
               type: "POST",
               data: data,
               contentType: false,
               processData: false,
               success: function(data) {
                    if (data == "failure") {
                         showerror_message("failure", "Your image cant be updated");
                        
                         
                    } 
                    else {
                         loadtable();
                         $("#Modal_imagebanner").hide();
                         
                         showsuccess_message("success", "Bannerimage updated successfully");
                         
                         
                        
                    }
               }


          });
     }

     function ViewStatus(portfolioid) {
          var portfolioid = portfolioid;
          Swal.fire({
               title: "Do you want to save the changes?",
               showDenyButton: true,
               showCancelButton: true,
               confirmButtonText: "Save",
               denyButtonText: `Don't save`
          }).then((result) => {
               /* Read more about isConfirmed, isDenied below */
               if (result.isConfirmed) {


                    console.log(portfolioid);

                    $.ajax({
                         url: "portfolio_component.php",
                         type: "post",
                         data: {
                              portfolioid: portfolioid,
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
                    url: "portfolio_component.php",
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