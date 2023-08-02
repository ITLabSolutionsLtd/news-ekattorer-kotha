<!doctype html>
<html lang="en" class="no-js">

<head>
    <title>HotMagazine</title>

    <meta charset="utf-8">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Lato:300,400,700,900,400italic' rel='stylesheet' type='text/css'>
	<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/bootstrap.min.css'); ?>" media="all">	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/jquery.bxslider.css'); ?>" media="all">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/font-awesome.css'); ?>" media="all">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/magnific-popup.css'); ?>" media="all">	
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/owl.carousel.css'); ?>" media="all">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/owl.theme.css'); ?>" media="all">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/ticker-style.css'); ?>" media="all">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css'); ?>" media="all">
	<link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/custom-style.css'); ?>" media="all" />
    <script>
        function printContent(el){
            var restorPage = document.body.innerHTML;
            var printContent = document.getElementById(el).innerHTML;
            document.body.innerHTML = printContent;
            window.print();
            document.body.innerHTML = restorPage;
        }
    </script>

</head>

<body>

    <!-- Container -->
    <div class="container">
        <button class="btn btn-info btn-sm" onclick="printContent('container')" style="margin: 10px 0; float: right;"><i class="fa fa-print"></i>Print</button>
    </div>
    <div id="container" class="container" style="box-shadow: 0.5px 1px 10px #666; padding: 5px;">

        <!-- Header
		    ================================================== -->
        <header>
            <div style="height: 100px; display: flex; align-items: center; justify-content: center; ">
                <h2 style="margin-left: 15px"><a style="text-decoration: none" href="<?php echo base_url()?>"><span style="color: green;">Syl</span>News</a></h2>
            </div>
            <hr style="border-top: 1px solid #888;">

        </header>
        
                <div class="row">
                    <div class="col-sm-12">
                        <!-- block content -->
                        <div class="block-content">
                            <!-- single-post box -->
                            <?php if($print_data){

                                foreach($print_data as $row){?>
                                    <div class="single-post-box">
                                    <center>
                                        <div class="title-post" style="margin-top: 15px;">
                                            <h1><?php echo $row-> news_headline; ?></h1>
                                        </div>
                                    </center>

                                    <div class="post-gallery">
                                        <!-- Vimeo -->
                                        <?php if($row-> img_ext){ ?>
                                            <img src="<?php echo base_url();?>images/news/<?php echo $row->news_id.$row->img_ext ?>" style="width: 80%; max-height: 500px" alt="">
                                        <?php } else{?>
                                            <img  src="<?php echo base_url();?>images/news/small/demo.jpg"  style="width: 80%; max-height: 500px" alt="">
                                        <?php } ?>
                                        <!-- End Vimeo -->
                                    </div>

                                    

                                    

                                    <div class="post-content">
                                        <p style="width: 80%; margin: 0 auto;">
                                            <?php 
                                                if($row-> news_details){
                                                    $details  = strip_tags(html_entity_decode($row-> news_details));
                                                    
                                                    echo stripslashes($details); 
                                                }
                                            ?>
                                        </p>
                                    </div>
                                    <!-- End contact form box -->
                                </div>

                            <?php
                                }
                            }?>
                            
                            <!-- End single-post box -->
                        </div>
                        <!-- End block content -->
                    </div>
                </div>
            

        <!-- footer 
			================================================== -->
        
            <div class="container" style="height: 20px; display: flex; align-items: center; justify-content: center;">
                All rights reserved || copyright@ IT Lab solutions Ltd.
            </div>
        
        <!-- End footer -->
    </div>
    <!-- End Container -->

    <script type="text/javascript" src="<?= base_url('assets/js/jquery.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/jquery.migrate.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/jquery.bxslider.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/jquery.magnific-popup.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/bootstrap.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/jquery.ticker.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/jquery.imagesloaded.min.js'); ?>"></script>
  	<script type="text/javascript" src="<?= base_url('assets/js/jquery.isotope.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/owl.carousel.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/theia-sticky-sidebar.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/sticky.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/retina-1.1.0.min.js'); ?>"></script>
	<script type="text/javascript" src="<?= base_url('assets/js/script.js'); ?>"></script>

</body>

</html>