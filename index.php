<?php

$conn = mysqli_connect("localhost", "root", "", "launchhub") or die("connection failed:" . mysqli_connect_error());
include 'functions.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>boostrap 5</title>
    <link rel="stylesheet" href="css/main.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    link
    <link href="http://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet" />
</head>

<?php include "header.php"; ?>

<body class="">


    <?php
    $banners = getBanner();
    // print_r($banners);
    ?>
    <section id="carouselsection">

        <div id="carousel" class="carousel slide  overflow-hidden">



            <div class="carousel-indicators" id="carousel-indicators">
                <?php
                $count = 0;
                foreach ($banners as $key => $bannervalue) {
                ?>
                    <button type="button" data-bs-target="#carousel" data-bs-slide-to="<?php echo $count; ?>" id="carousel-button-<?php echo $count; ?>" class="<?php if ($count == 0) {
                                                                                                                                                                    echo "active";
                                                                                                                                                                } ?>" aria-label="Slide <?php echo ++$count; ?>"></button>
                <?php
                }
                ?>


            </div>
            <div class="carousel-inner position-relative" id="carousel-inner">

                <?php
                $count = 0;
                foreach ($banners as $key => $bannervalue1) {
                ?>
                    <div class="carousel-item <?php if ($count == 0) {
                                                    echo "active";
                                                } ?>" id="carousel-item1">
                        <img src="admin/images/<?php echo $bannervalue1->image; ?>" class="d-block w-100 image1" alt="...">
                        <div class="carousel-caption  " id="carousel-caption">
                            <div class="d-flex  flex-column ">
                                <h2 class="fw-bold display-5"><?php echo $bannervalue1->banner_title; ?></h2>
                                <p class="mt-3 mb-5"><?php echo $bannervalue1->banner_text; ?></p>
                                <!-- <p><a href="#" class="btn btn-warning btn-lg mt-3">Learn More</a></p> -->
                                <a href="<?php echo $bannervalue1->banner_button_link; ?>" type="button" class="btn btn-warning d-block m-auto fw-semibold text-white" style="--bs-btn-padding-y: .2rem; --bs-btn-padding-x: .5rem; --bs-btn-font-size: 2rem; width: 300px;">
                                    <?php echo $bannervalue1->banner_button; ?>
                                </a>
                            </div>
                        </div>
                    </div>
                <?php
                    $count++;
                }
                ?>

            </div>

        </div>


    </section>
    <!-- services -->
    <?php
    $Services = getServices();
     print_r($Services);
    ?>
    <section id="services" class="bg-light">
        <div class="container">
            <div class="row">
                <div class=" services col-12 text-center">
                    <h5 class="my-4 position-relative">
                        <span class="service bg-primary text-white fw-bold ">OUR SERVICES</span>
                    </h5>
                </div>
                <div class="d-flex justify-content-end my-3">
                    <a href="services.php" class="btn btn-primary text-white fw-semibold">More work</a>
                </div>
                <div class="row py-4">
                    <?php
                        foreach($Services as $key => $serviceValue){

                            ?>
                    <div class="col-lg-3">
                        <img src="admin/serviceimages/<?php echo $serviceValue->service_image ?>" alt="" class="img-fluid" style="height: 100px;">
                        <div class="text-container mt-3">
                            <h4 class="fw-semibold"><?php echo $serviceValue->service_title ?></h4>
                            <p><?php echo substr($serviceValue->service_text,0,50) ?><a class="text-primary text-decoration-none" href="SingleServices.php/id=<?php echo $serviceValue->service_id ?>">.....See More</a></p>
                        </div>
                    </div>
                        <?php
                        }
                        ?>
                    <!-- <div class="col-lg-3">
                        <img src="images/search.png" alt="" class="img-fluid" style="height: 110px;">
                        <div class="text-container mt-3">
                            <h4 class="fw-semibold">Web design</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus, eum nulla ipsa quisquam eligendi beatae vero reprehenderit illo,<span class="text-primary fw-semibold">Details</span></p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <img src="images/online shop.png" alt="" class="img-fluid" style="height: 110px;">
                        <div class="text-container mt-3">
                            <h4 class="fw-semibold">Web design</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus, eum nulla ipsa quisquam eligendi beatae vero reprehenderit illo,<span class="text-primary fw-semibold">Details</span></p>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <img src="images/social media.png" alt="" class="img-fluid" style="height: 110px;">
                        <div class="text-container mt-3">
                            <h4 class="fw-semibold">Web design</h4>
                            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus, eum nulla ipsa quisquam eligendi beatae vero reprehenderit illo,<span class="text-primary fw-semibold">Details</span></p>
                        </div>
                    </div> -->
                </div>

            </div>
        </div>
    </section>
    <!-- portfolio -->
    <section id="portfolio" class="bg-dark">
        <div class="container ">
            <div class="d-flex py-5">

                <h3 class="fw-bold text-warning flex-grow-1">Our Portfolio Awesome</h3>
                <a href="portfolio.php" class="btn btn-primary text-white fw-semibold">More work</a>
            </div>
            <div class="row pb-5">
                <div class="col-md-4 services">
                    <img src="images/portfolio1.png" alt="" srcset="" class="service1-img">
                    <h3 class="mt-3 text-warning">Growth marketting</h3>
                    <p class="text-secondary">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt eligendi in qui nihil officia ullam, inventore possimus accusamus temporibus aliquid aliquam doloribus!</p>
                </div>
                <div class="col-md-4 services">
                    <img src="images/portfolio1.png" alt="" srcset="" class="service-img">
                    <h3 class="mt-3 text-warning">online marketting</h3>
                    <p class="text-secondary">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt eligendi in qui nihil officia ullam, </p>
                </div>
                <div class="col-md-4 services">
                    <img src="images/portfolio3.png" alt="" srcset="" class="service-img">
                    <h3 class="mt-3 text-warning">Animated ads </h3>
                    <p class="text-secondary">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Deserunt eligendi in qui nihil officia ullam, inventore possimus accusamus temporibus aliquid aliquam doloribus,</p>
                </div>
            </div>

        </div>
    </section>

    <!-- what we offer -->
    <section id="offer" class="bg-secondary py-5">
        <div class="container">
            <div class="row">
                <div class="col-8 offset-2">
                    <h1 class=" text-primary text-center fw-bold">WHAT WE OFFER</h1>
                    <p class="text-center mt-3">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Rerum placeat, ad explicabo dignissimos nihil necessitatibus alias nulla veniam quisquam velit unde voluptate ab eveniet quas quo et. Aliquam, hic perferendis?</p>
                </div>
                <div class="row pt-4">
                    <div class="col-lg-3  ">

                        <h4 class="fw-bold text-primary">Web design</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus, eum nulla ipsa quisquam eligendi beatae vero reprehenderit illo</p>
                        <div class="d-flex justify-content-end">
                            <a href="" class="btn btn-primary me-3">Details</a>
                        </div>

                    </div>
                    <div class="col-lg-3  ">

                        <h4 class="fw-bold text-primary">Web design</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus, eum nulla ipsa quisquam eligendi beatae vero reprehenderit<a class="text-primary">Details..</a></p>


                    </div>
                    <div class="col-lg-3  ">

                        <h4 class="fw-bold text-primary">Web design</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus, eum nulla ipsa quisquam eligendi beatae vero reprehenderit illo</p>
                        <div class="d-flex justify-content-end">
                            <a href="" class="btn btn-primary me-3">Details</a>
                        </div>

                    </div>
                    <div class="col-lg-3  ">

                        <h4 class="fw-bold text-primary">Web design</h4>
                        <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ducimus, eum nulla ipsa quisquam eligendi beatae vero reprehenderit illo</p>


                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Testimonial Section -->
    <section id="testimonials" class="bg-secondary py-4">


        <div id="carouselExampleCaptions" class="carousel slide  position-relative">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active bg-primary" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2" class="bg-primary"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3" class="bg-primary"></button>
            </div>
            <div class="carousel-inner pb-3">
                <div class="carousel-item active">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center ">
                        <img src="images/testimonial-1.jpg" class=" m-auto rounded-circle" alt="..." style="width: 120px;">
                        <p class="w-50 my-4 fst-italic fs-4 mb-4">"Some representative placeholder content for the first slide."</p>
                        <div class="fw-bold mt-4 fs-5 ">Marlene viscotee</div>
                        <div class="text-uppercase">general manager - scouter</div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <img src="images/testimonial-2.jpg" class="  m-auto rounded-circle" alt="..." style="width: 120px;">
                        <p class="w-50 my-4 fst-italic fs-4 mb-4">"Some representative placeholder content for the first slide."</p>
                        <div class="fw-bold fs-5 mt-4 text-uppercase">john spiker</div>
                        <div class="text-uppercase">team leader - scouter</div>
                    </div>
                </div>
                <div class="carousel-item ">
                    <div class="d-flex flex-column justify-content-center align-items-center text-center">
                        <img src="images/testimonial-3.jpg" class="  m-auto rounded-circle" alt="..." style="width: 120px;">
                        <p class="w-50 my-4 fst-italic fs-4 mb-4">"Some representative placeholder content for the first slide."</p>
                        <div class="fw-bold fs-5 mt-4">Stela Vietuoso</div>
                        <div class="text-uppercase">Design chief - scouter</div>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <i class="fas fa-arrow-left fa-3x text-primary"></i>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <i class="fas fa-arrow-right fa-3x text-primary"></i>
                <span class="visually-hidden">Next</span>
            </button>
        </div>





        </div>
    </section>

    <?php
    include "footer.php";
    ?>



    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
</body>

</html>