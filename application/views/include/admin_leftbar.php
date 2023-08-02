<!DOCTYPE html>
<html lang="en">
<!-- BEGIN : Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta name="title" content="iNews - Panel">

    <title>Dashboard - iNews</title>
    <link rel="shortcut icon" href="<?= base_url('assets/panel/images/i-news.jfif') ?>">

    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,700,900|Montserrat:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" type="text/css" rel="stylesheet" />
    <link href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/vendors/tokenhead/bootstrap-tokenfield.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />

    <?php
    if ($this->uri->segment(2) == 'ePaperSetup') { ?>
        <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/vendors/dropzone/dropzone.min.css'); ?>">
    <?php }
    ?>

    <?php
        if($this->uri->segment(2) == 'AdsList' || $this->uri->segment(2) == 'GalleryList'){ ?>
            <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/vendors/lightbox/magnific-popup.min.css'); ?>">
    <?php } ?>

    <!-- BEGIN VENDOR CSS-->
    <!-- font icons-->
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/fonts/feather/style.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/fonts/simple-line-icons/style.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/fonts/font-awesome/css/font-awesome.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/vendors/lightbox/magnific-popup.min.css') ?>" media="screen">

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/vendors/css/prism.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/vendors/css/chartist.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/vendors/css/tables/datatable/datatables.min.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/vendors/css/sweetalert2.min.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">



    <!-- END VENDOR CSS-->


    <!-- BEGIN APEX CSS-->

    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/css/chosen.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/css/app.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/css/custom-app.css'); ?>">
    
    <!-- END APEX CSS-->
    

    <?php
        if($this->uri->segment(1) == 'news-upload' || $this->uri->segment(1) == 'opinion-upload' || $this->uri->segment(2) == 'EditOpinion' || $this->uri->segment(2) == 'EditNews'){ ?>
            <script type="text/javascript" src="<?= base_url('assets/app-assets/js/ckeditor/ckeditor.js') ?>"></script>
            <script type="text/javascript" src="<?= base_url('assets/app-assets/js/ckfinder/ckfinder.js') ?>"></script>
        <?php }
    ?>
    <?php
        if($this->uri->segment(2) == 'WriterSetup' || $this->uri->segment(2) == 'EditWriter' ){ ?>
            <link rel="stylesheet" type="text/css" href="<?= base_url('assets/app-assets/vendors/summernote/summernote.min.css'); ?>">
        <?php }
    ?>

    <?php
        $segment = $this->uri->segment(1);
    ?>


</head>



<body data-col="2-columns" class=" 2-columns  layout-dark" style="overflow-x: hidden;">
    <!-- ////////////////////////////////////////////////////////////////////////////-->
    <div class="wrapper">
        <div data-background-color="black" class="app-sidebar">
            <!-- <div data-background-color="black" data-image="<?= base_url('assets/app-assets/img/sidebar-bg/01.jpg'); ?>" class="app-sidebar"> -->
            <div class="sidebar-header">
                <div class="logo clearfix">
                    <a href="<?php echo base_url(); ?>panel" class="logo-text float-left">
                        <div class="logo-img">
                            <img src="<?= base_url('assets/panel/images/i-news.jpg'); ?>">
                        </div>
                        <div class="logo-text">
                            <span class="text align-middle ml-1">News</span>
                        </div>
                    </a>
                    <a id="sidebarToggle" href="javascript:;" class="nav-toggle d-none d-sm-none d-md-none d-lg-block">
                        <i data-toggle="expanded" class="toggle-icon ft-toggle-right"></i>
                    </a>
                    <a id="sidebarClose" href="javascript:;" class="nav-close d-block d-md-block d-lg-none d-xl-none">
                        <i class="ft-x"></i>
                    </a>
                </div>
            </div>


            <div class="sidebar-content">
                <div class="nav-container">
                    <ul id="main-menu-navigation" data-menu="menu-navigation" data-scroll-to-active="true" class="navigation navigation-main">
                        <li class="nav-item <?php if($segment == 'panel') echo "active"; ?>"><a href="<?php echo base_url() ?>panel"><i class="ft-home"></i><span data-i18n="" class="menu-title">Dashboard</span></a></li>

                        <?php if ($user_type == 7) { ?>
                            <li class="has-sub nav-item"><a><i class="ft-chevrons-right"></i><span data-i18n="" class="menu-title">Category Module</span> <!--- <span class="tag badge badge-pill badge-danger float-right mr-1 mt-1">4</span> ---></a>
                                <ul class="menu-content">
                                    <li><a href="<?php echo base_url(); ?>Admin/NewsCategoryInsert" class="menu-item">Category Setup</a></li>
                                    <li><a href="<?php echo base_url() ?>Admin/CategoryList" class="menu-item">Category List</a></li>
                                    <li><a href="<?php echo base_url() ?>Admin/SubCategoryEntry" class="menu-item">Sub-Category Setup</a></li>
                                    <li><a href="<?php echo base_url() ?>Admin/SubCategoryList" class="menu-item">Sub-Category List</a></li>
                                </ul>
                            </li>

                            <li class="nav-item <?php if($segment == 'share-footer-image') echo "active"; ?>">
                                <a href="<?php echo base_url() ?>share-footer-image"><i class="ft-image"></i><span data-i18n="" class="menu-title">Share Image</span></a>
                            </li>
                            
                            <li class="has-sub nav-item"><a><i class="ft-chevrons-right"></i><span data-i18n="" class="menu-title">Configure</span> </a>
                                <ul class="menu-content">
                                    <li class="<?php if($segment == 'news-page') echo "active"; ?>" ><a href="<?php echo base_url('news-page') ?>" class="menu-item">News Page</a></li>
                                    <li class="<?php if($segment == 'news-type') echo "active"; ?>" ><a href="<?php echo base_url('news-type') ?>" class="menu-item">News Type</a></li>
                                     <li class="<?php if($segment == 'news-segment') echo "active"; ?>" ><a href="<?php echo base_url('news-segment') ?>" class="menu-item">News Segment</a></li>
                                </ul>
                            </li>
                            
                        <?php } ?>

                        <?php if ($user_type == 5) { ?>
                            <li class="has-sub nav-item"><a><i class="ft-chevrons-right"></i><span data-i18n="" class="menu-title">Configure</span> </a>
                                <ul class="menu-content">
                                    <li class="<?php if($segment == 'news-page') echo "active"; ?>" ><a href="<?php echo base_url('news-page') ?>" class="menu-item">News Page</a></li>
                                    <li class="<?php if($segment == 'news-type') echo "active"; ?>" ><a href="<?php echo base_url('news-type') ?>" class="menu-item">News Type</a></li>

                                </ul>
                            </li>

                            <li class="nav-item <?php if($segment == 'share-footer-image') echo "active"; ?>">
                                <a href="<?php echo base_url() ?>share-footer-image"><i class="ft-image"></i><span data-i18n="" class="menu-title">Share Image</span></a>
                            </li>
                        <?php } ?>


                        <li class="has-sub nav-item"><a><i class="fa fa-newspaper"></i><span data-i18n="" class="menu-title">News Module</span></a>
                            <ul class="menu-content">
                                <li class="<?php if($segment == 'news-upload') echo "active"; ?>">
                                    <a href="<?php echo base_url(); ?>news-upload" class="menu-item"> <i class="fa fa-circle-o"></i> News Upload</a>
                                </li>
                                <?php
                                if ($user_type != 2) { ?>
                                    <li class="<?php if($segment == 'opinion-upload') echo "active"; ?>">
                                        <a href="<?php echo base_url() ?>opinion-upload" class="menu-item"><i class="fa fa-circle-o"></i> Opinion Upload</a>
                                    </li>
                                <?php
                                }
                                ?>
                                <li class="<?php if($segment == 'news-filter') echo "active"; ?>" ><a href="<?php echo base_url() ?>news-filter" class="menu-item"> <i class="fa fa-circle-o"></i>Search</a></li>
                                <?php
                                if ($user_type != 2) { ?>
                                    <!-- <li><a href="<?php echo base_url() ?>Admin/NewsReport" class="menu-item"> <i class="fa fa-circle-o"></i> News Report</a></li> -->
                                <?php
                                }
                                ?>

                                <?php
                                if ($user_type == 7 || $user_type == 5 || $user_type == 3) { ?>

                                    <li>
                                        <a href="<?php echo base_url() ?>Admin/NewsApproveList">
                                             <i class="fa fa-circle-o"></i> Pending News <span class="tag badge badge-pill badge-danger float-right mr-1 mt-1"></span> <img class="float-right mt-2" src="https://i.makeagif.com/media/9-18-2017/XorLdI.gif" style="width: 10px; height: 10px; border-radius: 50%" alt="">
                                        </a>
                                    </li>

                                <?php
                                }
                                ?>
                            </ul>
                        </li>
                        
                        
                        <?php if ($user_type >= 5) { ?>
                            <li class="has-sub nav-item"><a><i class="fas fa-file-alt"></i><span data-i18n="" class="menu-title">Statistics</span> </a>
                                <ul class="menu-content">
                                    <li class="<?php if($this->uri->segment(1) == 'daily-visitors-list') echo "active"; ?>" ><a href="<?php echo base_url(); ?>daily-visitors-list" class="menu-item">Daily Visitors</a></li>
                                    <li class="<?php if($this->uri->segment(1) == 'daily-report') echo "active"; ?>" ><a href="<?php echo base_url("daily-report") ?>" class="menu-item">Daily Report</a></li>
                                    <li class="<?php if($this->uri->segment(1) == 'daily-category-report') echo "active"; ?>" ><a href="<?php echo base_url("daily-category-report") ?>" class="menu-item">Category Report</a></li>
                                </ul>
                            </li>
                        <?php } ?>




                        <?php
                        if ($user_type == 7 || $user_type == 5 || $user_type == 3) { ?>
                            <?php
                            if ($user_type == 7 || $user_type == 5) { ?>
                                <li class="has-sub nav-item"><a><i class="ft-triangle"></i><span data-i18n="" class="menu-title">Advertisement</span></a>
                                    <ul class="menu-content">
                                        <?php
                                        if ($user_type == 7) { ?>
                                            <li><a href="<?php echo base_url(); ?>Admin/AdSetup" class="menu-item"> <i class="fa fa-circle-o"></i>Setup</a></li>
                                        <?php
                                        }
                                        ?>

                                        <li> <a href="<?php echo base_url() ?>Admin/AdsList" class="menu-item"> <i class="fa fa-circle-o"></i>Manage</a></li>
                                    </ul>
                                </li>
                            <?php
                            }
                            ?>

                            <li class="has-sub nav-item"><a><i class="fab fa-envira"></i><span data-i18n="" class="menu-title">Gallery Module</span></a>
                                <ul class="menu-content">
                                    <li><a href="<?php echo base_url(); ?>Admin/GallerySetup" class="menu-item">Gallery Setup</a></li>
                                    <li><a href="<?php echo base_url() ?>Admin/GalleryList" class="menu-item">Show Gallery List</a></li>
                                </ul>
                            </li>

                            <li class="has-sub nav-item"><a><i class=" ft-zap"></i><span data-i18n="" class="menu-title">Reporter / Writer</span></a>
                                <ul class="menu-content">
                                    <li><a href="<?php echo base_url(); ?>Admin/WriterSetup" class="menu-item">Setup</a></li>
                                    <li><a href="<?php echo base_url() ?>Admin/WriterList/1" class="menu-item">Reporter List</a></li>
                                    <li><a href="<?php echo base_url() ?>Admin/WriterList/2" class="menu-item">Opinion Writer</a></li>
                                </ul>
                            </li>

                            

                            <li class="has-sub nav-item" style="display: none;"><a><i class="ft-home"></i><span data-i18n="" class="menu-title">Media Module</span></a>
                                <ul class="menu-content">
                                    <li><a href="<?php echo base_url(); ?>Admin/MediaEntry" class="menu-item">Media Entry</a></li>
                                    <li><a href="<?php echo base_url() ?>Admin/MediaList" class="menu-item">Media List</a></li>
                                </ul>
                                <ul class="menu-content">
                                    <li><a href="<?php echo base_url(); ?>Admin/EventEntry" class="menu-item">New Event Entry</a></li>
                                    <li><a href="<?php echo base_url() ?>Admin/GalleryList" class="menu-item">All Events</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($user_type == 7) { ?>
                            <li class="has-sub nav-item"><a><i class="ft-users"></i><span data-i18n="" class="menu-title">Our Team</span></a>
                                <ul class="menu-content">


                                    <li><a href="<?php echo base_url(); ?>Admin/MemberSetup" class="menu-item">Member setup</a></li>

                                    <li><a href="<?php echo base_url() ?>Admin/Memberlist" class="menu-item">Member list</a></li>
                                </ul>
                            </li>
        
                        <?php }  ?>

                        <?php
                        if ($user_type == 7 || $user_type == 5) {
                        ?>
                            <li class="has-sub nav-item"><a><i class="fa fa-user"></i><span data-i18n="" class="menu-title">User Module</span></a>
                                <ul class="menu-content">
                                    <li><a href="<?php echo site_url() ?>auth/register" class="menu-item">Create User</a></li>
                                    <li><a href="<?php echo site_url() ?>Admin/UsersList" class="menu-item">User Info</a></li>
                                </ul>
                            </li>
                        <?php
                        }
                        ?>

                    </ul>
                </div>
            </div>
      
            <div class="sidebar-background"></div>
          
        </div>