<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS / Fontawsome js / Main css -->
    <link rel="icon" type="image/x-icon" href="<?= base_url('images/favicon.png') ?>">


    <?php include 'header-code.php';?>

    <link rel="stylesheet" href="<?= base_url('assets/web/vendor/fontawesome/all.min.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/web/vendor/bootstrap-5.0.2-dist/css/bootstrap.min.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/web/vendor/OwlCarousel2-2.3.4/dist/assets/owl.carousel.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/web/css/animation.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/web/css/main.css'); ?> ">
    <link rel="stylesheet" href="<?= base_url('assets/web/css/responsive/responsive.css'); ?> ">



    <!-- Javascript Code -->
    <script src="<?= base_url('assets/web/js/jQuary.js'); ?>"></script>
    <script src="<?= base_url('assets/web/vendor/bootstrap-5.0.2-dist/js/bootstrap.min.js'); ?>"></script>
    <script src="<?= base_url('assets/web/js/main.js'); ?>"></script>
    <script src="<?= base_url('assets/web/js/jquery.lazy.min.js') ?>"></script>
    <script src="<?= base_url('assets/web/vendor/OwlCarousel2-2.3.4/dist/owl.carousel.js'); ?>"></script>
    
    <?php if($this->uri->segment(1) == 'details'){ ?>
        <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=648079ae19ebc20012fab456&product=sop' async='async'></script>
    <?php } ?>

    <?php
        if($this->uri->segment(1) == '' || $this->uri->segment(1) == "archive" || $this->uri->segment(1) == "news-paper"){ ?>
            <link rel="stylesheet" href="<?= base_url('assets/web/css/jquery-ui.css'); ?> ">
            <script src="<?= base_url('assets/web/js/jquery-ui-bangla.js') ?>"></script>
        <?php }
    ?>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-HH9FVE2829"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
    
      gtag('config', 'G-HH9FVE2829');
    </script>
    
    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5248664437668325" crossorigin="anonymous"></script>
    <script>
    	 (adsbygoogle = window.adsbygoogle || []).push({
    		  google_ad_client: "ca-pub-5248664437668325",
    		  enable_page_level_ads: true
    	 });
    </script>

</head>

<body>

    <style>
        .sidebar-li{ list-style: none }
        .inner-ul{padding-right: 25px;}
        .inner-ul li{
            text-align: right;
        }
        .inner-ul li a{
            font-size: 13px;
            color: #6d6d6d; 
            transition: .1s ease all; 
        }
        .inner-ul li a:hover{
            color: #fe0000; 
        }
        .sidenav {
            padding-bottom: 15px;
        }
        .sidenav .sidebar-link {
            padding: 8px 8px 3px 15px;
        }
    </style>
    <div id="mySidenav" class="sidenav">
        <a clas href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
        <a class="sidebar-link" href="<?=  base_url()?>"> মূলপাতা</a>
        <?php if($newspaper){ ?>
            <li class="nav-item sidebar-li">
                <a class="mt-2 sidebar-link" href="#">আজকের পত্রিকা</a>
                <ul class="inner-ul">
                    <?php
                        foreach($newspaper as $row){ ?>
                            <li><a href="<?php echo base_url('news-paper/'.$row->page_id.'/'.date('Y-m-d').'/'.seoURL($row->name_bn)); ?>"><?= $row->name_bn ; ?> </a></li>
                        <?php }
                    ?>
                </ul>
            </li>
        <?php } ?>
        <li class="nav-item sidebar-li">
            <a class="mt-2 sidebar-link " href="<?=  base_url('sylhet')?>">সিলেটের কথা</a>
            <ul class="inner-ul">
                <li><a href="<?php echo base_url('sylhet/sylhet-district')?>">সিলেট</a></li>
                <li><a href="<?= base_url('sylhet/sunamganj')?>">সুনামগঞ্জ </a></li>
                <li><a href="<?= base_url('sylhet/maulvibazar')?>">মৌলভীবাজার</a></li>
                <li><a href="<?= base_url('sylhet/habiganj')?>">হবিগঞ্জ  </a></li>
            </ul>
        </li>
        <a class="mt-2 sidebar-link" href="<?=  base_url('national')?>">দেশের কথা</a>
        <a class="mt-2 sidebar-link" href="<?=  base_url('news-around')?>">দশদিক</a>
        <a class="mt-2 sidebar-link" href="<?=  base_url('politics')?>">রাজনীতি</a>
        <a class="mt-2 sidebar-link" href="<?=  base_url('economy')?>">অর্থনীতি</a>
        <a class="mt-2 sidebar-link" href="<?=  base_url('economy')?>">তথ্যপ্রযুক্তি</a>
        <li class="nav-item sidebar-li">
            <a class="mt-2 sidebar-link " href="<?=  base_url('sports')?>">খেলা</a>
            <ul class="inner-ul">
                <li><a href="<?php echo base_url('sports/cricket')?>">ক্রিকেট</a></li>
                <li><a href="<?= base_url('sports/football')?>">ফুটবল </a></li>
                <li><a href="<?= base_url('sports/other-sports')?>">অন্যান্য</a></li>
            </ul>
        </li>
        <a class="mt-2 sidebar-link" href="<?=  base_url('rupali-kotha')?>">রূপালিকথা </a>
        <li class="nav-item sidebar-li">
            <a class="mt-2 sidebar-link " href="#">অন্যান্য</a>
            <ul class="inner-ul">
                <li><a href="<?php echo base_url('aboard')?>">প্রবাসের কথা</a></li>
                <li><a href="<?= base_url('press-box')?>">প্রেসবক্স </a></li>
                <li><a href="<?= base_url('opinion')?>">মুক্তমত</a></li>
            </ul>
        </li>
        <a class="mt-2 sidebar-link" href="<?=  base_url('hridoye-ekattor')?>">হৃদয়ে একাত্তর</a>
    </div>







    <!--========================  HEADER SECTION  ==========================-->
    <header>
        <!-- <div class="header-overlay"></div> -->
        <div class="top-header">
            <div class="container position-relative">
                <div class="row">

                    <div class="col-xl-4 col-lg-4 col-md-4 col-2 d-flex justify-content-between align-items-center">
                        <span class="opennav" style="font-size:30px;cursor:pointer;     font-weight: bold;" onclick="openNav()">&#9776;</span>
                        <div class="template-date">
                            <span class="B-time"><?php echo 'আজ '.bn_convert(date('l, d M Y')); ?></span>
                        </div>
                        <div class="ePaper-button">
                            <!-- <a href="#" target="_blank"> ই-পেপার  <i class=" blink_me fas fa-hand-pointer"></i></a> -->
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-4 col-8 d-md-flex justify-content-center align-items-center">
                        <div class="template-logo">
                            <a href="<?php echo base_url(); ?>"> <img src="<?= base_url('images/ekattorer-kotha-logo.png'); ?>" alt="Ekattorer-Kotha"> </a>
                        </div>
                    </div>

                    <div class="col-xl-4 col-lg-4 col-md-4 col-2 d-md-flex justify-content-center align-items-center">

                        <!-- <a href="#">
                            <img class="mbl-epaper" src="<?php echo base_url('images/ePaper.png')?>" alt="e-paper Ekattorer kotha">
                        </a> -->

                        
                        <div class="search-box">
                            <div id='toggle-search' class="search-label d-flex justify-content-between align-items-center">
                                <a  title="আর্কাইভ">
                                    <span><i class="fas fa-search" ></i> </span>
                                </a>
                            </div>
                            <div id='searchBar' style='display:none;'>
                                <form class="d-flex" action="<?php echo base_url('archive')?>" method="get">
                                    <input class="form-control" type="search" name="search" placeholder="অনুসন্ধান" aria-label="Search" autocomplete="off" required>
                                    <button class="btn btn-outline-success" type="submit"><i class="fas fa-search"></i></button>
                                </form>
                            </div>
                        </div>
                        <ul class="social-icon-header d-flex justify-content-between align-items-center flex-wrap">
                            <a href="https://www.facebook.com/ekattorerkotha/" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="https://www.youtube.com/channel/UCUtVg6kZ6R2UC71_9Mihc8g/featured" target="_blank"><i class="fab fa-youtube"></i></a>
                        </ul>
                    </div>
                </div>
            </div>
        </div>



        <!---main navbar-->
        <style>
            .fixed-nav {
                border-bottom: 1px solid #fff;
                -moz-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
                -webkit-box-shadow: 0 5px 5px rgba(182, 182, 182, 0.75);
                box-shadow: 0 5px 5px rgba(182, 182, 182, 0.15);
            }
            @media(max-width: 991px){
                #fixed_top_navbar {
                    height: 68px;
                    background: #0000000f !important;
                    z-index: 0;
                }
            }
        </style>

        <div id="fixed_top_navbar" class="fixed-nav" >
            <div class="main-nav">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <div class="container-fluid">
                        <!-- <a class="navbar-brand" href="#">Navbar</a> -->
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav mx-auto">
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == '') echo 'active'; ?>" aria-current="page" href="<?php echo base_url(); ?>"><i class="fas fa-home"></i> মূলপাতা</a>
                                </li>
                                <?php if($newspaper){ ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == 'sylhet') echo 'active'; ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">আজকের পত্রিকা</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php
                                            foreach($newspaper as $row){ ?>

                                                <!-- <li><a class="dropdown-item" href="<?php echo base_url('sylhet/sylhet-district')?>">সিলেটের কথা</a></li> -->
                                                <li><a class="dropdown-item" href="<?php echo base_url('news-paper/'.$row->page_id.'/'.date('Y-m-d').'/'.seoURL($row->name_bn)); ?>"><?= $row->name_bn ; ?> </a></li>
                                                <?php
                                                    if(next($newspaper)){
                                                        echo '<li class="dropdown-divider"> </li>';
                                                    }
                                                ?>
                                                

                                            <?php }
                                        ?>
                                    </ul>
                                </li>
                                <?php } ?>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == 'sylhet') echo 'active'; ?> dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">সিলেটের কথা</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="<?php echo base_url('sylhet/sylhet-district')?>">সিলেট</a></li>
                                        <li class="dropdown-divider"> </li>
                                        <li><a class="dropdown-item" href="<?= base_url('sylhet/sunamganj')?>">সুনামগঞ্জ </a></li>
                                        <li class="dropdown-divider"> </li>
                                        <li><a class="dropdown-item" href="<?= base_url('sylhet/maulvibazar')?>">মৌলভীবাজার</a></li>
                                        <li class="dropdown-divider"> </li>
                                        <li><a class="dropdown-item" href="<?= base_url('sylhet/habiganj')?>">হবিগঞ্জ  </a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == 'national') echo 'active'; ?>" href="<?php echo base_url('national')?>">দেশের কথা</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == 'news-around') echo 'active'; ?>" href="<?php echo base_url('news-around')?>">দশদিক</a>
                                </li>
                            
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == 'politics') echo 'active'; ?>" href="<?php echo base_url('politics')?>">রাজনীতি</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == 'economy') echo 'active'; ?>" href="<?php echo base_url('economy')?>">অর্থনীতি</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == 'info-tech') echo 'active'; ?>" href="<?php echo base_url('info-tech')?>">তথ্যপ্রযুক্তি</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == 'sports') echo 'active'; ?> dropdown-toggle" href="<?php echo base_url('sports')?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">খেলা</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="<?php echo base_url('sports/cricket')?>">ক্রিকেট</a></li>
                                        <li class="dropdown-divider"> </li>
                                        <li><a class="dropdown-item" href="<?php echo base_url('sports/football')?>">ফুটবল</a></li>
                                        <li class="dropdown-divider"> </li>
                                        <li><a class="dropdown-item" href="<?php echo base_url('sports/other-sports')?>">অন্যান্য</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == 'rupali-kotha') echo 'active'; ?>" href="<?php echo base_url('rupali-kotha')?>">রূপালিকথা</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">অন্যান্য খবর</a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="<?php echo base_url('aboard')?>">প্রবাসের কথা</a></li>
                                        <li class="dropdown-divider"> </li>
                                        <li><a class="dropdown-item" href="<?php echo base_url('press-box')?>">প্রেসবক্স</a></li>
                                        <li class="dropdown-divider"> </li>
                                        <li><a class="dropdown-item" href="<?php echo base_url('opinion'); ?>">মুক্তমত </a></li>
                                    </ul>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link <?php if($this->uri->segment(1) == 'hridoye-ekattor') echo 'active'; ?>" href="<?php echo base_url('hridoye-ekattor')?>">হৃদয়ে একাত্তর </a>
                                </li>

                            </ul>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
     <style>
        .owl-carousel {
            display: none;
        }
        .no-js .owl-carousel {
            display: block;
        }
        .owl-carousel.owl-loaded {
            display: block;
        }
    </style>

    <?php if($this->uri->segment(1) == ''){
        
        if($latest_news) { ?>
            <section class="section-slider">
                <div class="container">
                    <div class="header-slider py-3 ">
                        <span class="heading-title">শিরোনাম</span>
                        <div class="carousal-custom">
                            <div class="owl-carousel  header-owl">
                                <?php
                                    foreach($latest_news as $row){ ?>
                                        <div class="item">
                                            <div class="header-child-div">
                                                <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                    <p class=""><?php echo stripslashes($row->news_headline); ?></p>
                                                </a>
                                                <!-- <span class="time"> <i class="fab fa-ethereum"></i> <input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></span> -->
                                            </div>
                                        </div>
                                    <?php 
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <?php 
        } 
    } ?>

    