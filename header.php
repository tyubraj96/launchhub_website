<?php

$conn =mysqli_connect("localhost","root","","launchhub") or die("connection failed:" . mysqli_connect_error());


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


    <nav class="navbar navbar-expand-sm bg-light navbar-orange fixed-top">
        <div class="container">
            <a class="navbar-brand" href="index.html">
                <img src="images/logo.png" alt="" srcset="" width="90" height="80">

            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#collapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="collapsibleNavbar">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold" href="index.php">Home</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold" href="portfolio.php">Portfolio</a>
                    </li>

                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold" href="about.php">About</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold" href="contact.php">Contact</a>
                    </li>
                    <li class="nav-item mx-2">
                        <a class="nav-link fw-semibold" href="#projects">
                            <h4><span class="badge bg-warning">New</span></h4>
                        </a>
                    </li>

                </ul>
                <form class="d-flex align-items-center" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <a href="http://"><i class="fa fa-search "></i></a>
                </form>

            </div>
        </div>
    </nav>
