


<!DOCTYPE html>
<html lang="en">
<head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Contact</title>
         <link rel="stylesheet" href="css/main.min.css">
         <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
         
         <link href="http://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap"
      rel="stylesheet"/>
</head>
<body class="">
        <?php
        include "header.php"
        ?>
         <div class="contact-banner container-fluid overflow-hidden">
                <div class="contact-text ">
                    <h1 class="">Contact Us</h1>
               </div>    
         </div>
         
         <body class="">
   <section id="getintouch" class="py-5 bg-secondary">
      <div class="container px-5">
            <div class="row mb-5">
                   <div class="col-lg-8 offset-lg-2"> 
                        <h3 class="text-primary text-center fw-bold mb-2">GET IN TOUCH</h3>
                        <P class="text-dark fs-6 mt-3">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quas aliquam, error esse commodi nesciunt voluptatem quia odio. Magnam officiis sint nam ratione voluptatum natus eos odio placeat totam sed repudiandae quisquam officia, consectetur tempora nihil perspiciatis facere at delectus deserunt.</P>
                   </div>
            </div>
            <div class="row text-dark gx-5 gx-lg-5"> 
                  <div class="col-lg-6">
                        <form action="/action_page.php">
                              <div class="mb-5 mt-3">
                                    <label for="name" class="form-label">NAME</label>
                                    <input type="text" class="form-control" id="email" placeholder="" name="email">
                              </div>
                              <div class="mb-5 ">
                                    <label for="email" class="form-label">Email:</label>
                                    <input type="email" class="form-control" id="email" placeholder="" name="email">
                              </div>
                              <div class="mb-5">
                                    <label for="text" class="form-label">SUBJECT</label>
                                    <input type="text" class="form-control" id="text" placeholder="" name="text">
                              </div>
                              <div class="mb-5">
                                    <label for="comment">MESSAGE</label>
                                    <textarea class="form-control" rows="5" id="message" name="message"></textarea> 
                              </div>
                              
                              <div class="mb-5 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary fw-semibold">Send</button>
                              </div>
                              
                            </form>  
                  </div>
                  <div class="col-lg-6 text-center">
                        
                        <div class=" d-flex flex-column justify-content-center align-items-center">
                              <div class="d-flex flex-column ">
                                    <div class="d-flex gap-3 mb-3">
                                          <a href="">
                                                <i class="fa fa-4x fa-phone text-primary mb-3"></i>
                                          </a>
                                          <div class="text ">
                                                <div class=""><a class="" href="">office:</a>0123456</div>
                                                <div class=""><a class="" href="">Mobile:</a>9845977216</div>
                                                            
                                          </div>
                                    </div>
                                    <div class="d-flex gap-3 mb-3">
                                          <a href="">
                                                <i class="fa fa-4x fa-home text-primary mb-3"></i>
                                          </a>
                                          <div class="text text-center mt-2">
                                                <div class="text-dark">Lorem ipsum dolor sit amet.</div>
                                                <p class=""><span class="text-primary">New York: United states </span></p>
                                          </div>
                                    </div>
                                                
                                    <div class="d-flex gap-3">
                                          <a href="">
                                                <i class="fa fa-4x fa-envelope text-primary mb-3"></i>
                                          </a>
                                          <div class="text d-flex flex-column">
                                                <a href="http://">timsina.yubra92@gmail.com</a>
                                                <a href="http://">timsina.yubra92@gmail.com</a>
                                          </div>
                                    </div>
                                                

                              </div>
                                          
                                 
                        </div>

                        <div class="embed-responsive embed-responsive-16by9 mt-5">
                              <iframe class="embed-responsive-item" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.734077828091!2d-122.41941568570979!3d37.77492979715587!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80859a6d00690021%3A0x4a501367f076adff!2sGolden%20Gate%20Bridge!5e0!3m2!1sen!2sus!4v1572027730289!5m2!1sen!2sus" allowfullscreen></iframe>
                        </div>
                        <div class="d-flex gap-3 mt-5 justify-content-center">
                               <a href="http://" class="text-primary mt-4">
                                    <i class="fab fa-facebook fa-3x text-center"></i>
                               </a>
                               <a href="http://" class=" mt-4">
                                    <i class="instagram-icon
                                    fab fa-instagram fa-3x text-center"></i>
                               </a>
                               <a href="http://" class="text-primary mt-4">
                                    <i class="fab fa-twitter fa-3x text-center"></i>
                               </a>
                               <a href="http://" class="text-primary mt-4">
                                    <i class="fab fa-linkedin fa-3x text-center"></i>
                               </a>
                        </div>                   
                  </div>
            </div>
      </div>
   </section>
     
<?php
    include "footer.php";
?>         
   <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>      
</body>
</html>
