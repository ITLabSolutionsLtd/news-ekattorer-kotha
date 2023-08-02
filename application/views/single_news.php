<script type="text/javascript" src="https://platform-api.sharethis.com/js/sharethis.js#property=603f3bc2a784de0012cc798a&product=inline-share-buttons" async="async"></script>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0" nonce="7xJqv1an"></script>
<?php
if ($ads) {
    echo $ads;
?>
    <div class="subscribe-me text-center">
        <a href="#close" class="sb-close-btn"><img class="<img-responsive></img-responsive> close-img" src="<?= base_url('images/close.png') ?>" alt="" /></a>
        <img class="ads-img" src="<?= base_url() ?>assets/ads/wp_sq.png" alt="">
    </div>
<?php
}
?>

<?php
if ($specific_news) {
    foreach ($specific_news as $row) {
        $folder_name = ceil($row->news_id / 1000);
?>
        <style>
            .printable {
                display: none;
            }

            @media print {
                .block-wrapper {
                    display: none;
                }
                header{
                    display: none;
                }
                .ads-mbl{
                    display: none;
                }
                footer {
                    display: none;
                }

                .facebook-share {
                    display: none;
                }

                .printable,
                .printable * {
                    visibility: visible;
                    display: block;
                }

                .printable h1 {
                    line-height: 1.5;
                    font-family: 'solaimanlipi';
                }

                .printable {
                    position: absolute;
                    top: 0;
                    left: 0;
                    bottom: 0;
                    right: 0;
                    padding: 0 20px;
                }
            }
        </style>

        <div class="printable" id="printMe" style="background:green;">
            <center>
                <img src="<?= base_url('images/sylhetview24_logo.jpg'); ?>" alt=""> <br>
            </center>
            <h1><?php echo stripslashes($row->news_headline); ?></h1>
            <p>সিলেটভিউ টুেয়িটেফার ডটকম, <?php echo bn_date(date('d M, Y', strtotime($row->news_pub_date))) . '  ' . bn_date(date('H:i', strtotime($row->news_pub_time))) ?> </p>
            <hr>
            <div class="row">
                <?php if ($row->img_ext) { ?>
                    <img style="width: 100%;" src="<?php echo base_url(); ?>images/news/<?php echo $folder_name . '/' . $row->news_id . $row->img_ext ?>" alt="">
                <?php } else { ?>

                    <img style="width: 100%;" src="<?php echo base_url(); ?>images/news/small/demo.jpg" alt="">
                <?php } ?>
            </div>

            <div class="row">
                <?php
                if ($row->news_details) {
                    $details = strip_tags($row->news_details, "<b><i><br><u><strong><img><a><p>");
                    echo stripslashes($details);
                }
                ?>
            </div>
            <hr>
            <center>
                <div class="row">
                    সম্পাদক : মো. শাহ্ দিদার আলম চৌধুরী <br>
                    উপ-সম্পাদক : মশিউর রহমান চৌধুরী <br>
                    সহকারী সম্পাদক : পিংকু ধর<br>
                    ✉ sylhetview24@gmail.com ☎ ০১৬১৬-৪৪০ ০৯৫ (বিজ্ঞাপন), ০১৭৯১-৫৬৭ ৩৮৭ (নিউজ) <br>
                    আর বি কমপ্লেক্স (চতুর্থ তলা) <br>
                    পূর্ব জিন্দাবাজার, সিলেট-৩২৩৫ সিলেট <br>
                    তথ্য প্রযুক্তি সহযোগী - আইটি ল্যাব সলিউশন্স লি.
                </div>
            </center>
        </div>
<?php
    }
}
?>

<!------- block-wrapper-section------>
<section class="block-wrapper" style="padding-top: 30px; margin-bottom: 20px;">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                <?php
                $CatName = '';
                if ($category_wise_news) {
                    $count = 0;
                    foreach ($category_wise_news as $row) : {
                            $count++;
                            if ($count == 1) {
                                $CatName = $row->cat_name; ?>

                                <ol class="breadcrumb" style="padding: 8px">
                                    <li> <a href="<?php echo base_url(); ?>"> <i class="fa fa-home"></i> </a> </li>
                                    <li> <a href="<?php echo base_url(); ?><?php echo $row->cat_key_name; ?>"> <?php echo $row->cat_name; ?> </a> </li>
                                    <li> বিস্তারিত </li>
                                </ol> <!-- breadcump end-->
                <?php
                            }
                            break;
                        }
                    endforeach;
                }
                ?>
                <!-- block content -->
                <div class="block-content">
                    <!-- single-post box -->
                    <?php foreach ($specific_news as $row) : {
                            $folder_name = ceil($row->news_id / 1000);
                    ?>
                            <div class="single-post-box">

                                <div class="title-post">
                                    <h1><?php echo stripslashes($row->news_headline); ?></h1>
                                    <ul class="post-tags" style="padding: 10px 0 30px 0">
                                        <img class="posts-tag-single-image" src="https://icons.iconarchive.com/icons/custom-icon-design/flatastic-4/512/Male-user-edit-icon.png">
                                        <div style="float: left">
                                            <!--<li class="single-post-tag"><i class="fa fa-user single-article-fa"></i> <a href="#"></a></li>  <br>-->
                                            <?php if ($row->author_id) { ?> <li class="single-post-tag"> <a href="<?php echo base_url() ?>author/<?php echo $row->author_id; ?>"><?php echo $row->writer_name; ?></a></li> <?php }
                                                                                                                                                                                                                        if ($row->author_id == 0 && $row->news_reporter != '') { ?> <li class="single-post-tag"> <?php echo $row->news_reporter; ?></li> <?php } ?> <br>
                                            <?php
                                            if ($row->news_pub_date) {
                                            ?>
                                                <li class="single-post-tag"> প্রকাশিত : <?php echo bn_date(date('d M, Y', strtotime($row->news_pub_date))) . '  ' . bn_date(date('H:i', strtotime($row->news_pub_time))) ?></li>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="share-post-box" style="float: right">
                                            <ul class="share-box">
                                                <li><a href="" class="btn btn-warning btn-sm" onclick="window.print();"><i class="fa fa-print" style="margin: 0;"></i> </a></li>
                                            </ul>
                                        </div>

                                    </ul>
                                </div>
                                <div class="post-gallery">
                                    <?php if ($row->img_ext) { ?>
                                        <a style="cursor: zoom-in" class="image-popup-vertical-fit" href="<?php echo base_url(); ?>images/news/<?php echo $folder_name . '/' . $row->news_id . $row->img_ext ?>" title="<?php echo stripslashes($row->img_caption); ?>" alt="<?php echo stripslashes($row->news_headline); ?>">
                                            <img src="<?php echo base_url(); ?>images/news/<?php echo $folder_name . '/' . $row->news_id . $row->img_ext ?>" alt="">
                                        </a>
                                    <?php }
                                        else if($row->img_ext == '' && $row-> cat_key_name ='video' && $row-> video_link != ''){ ?>
                                            <img style="max-height: 350px;" src="https://img.youtube.com/vi/<?php echo $row->video_link. '/hqdefault.jpg' ?>" alt="">
                                        <?php }
                                        else { ?>
                                        <a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>images/news/small/demo.jpg" title="Default Image">
                                            <img src="<?php echo base_url(); ?>images/news/small/demo.jpg" alt="">
                                        </a>
                                    <?php } ?>
                                    <?php
                                    if ($row->img_caption) { ?> <p class="text-bg"> <?php echo stripslashes($row->img_caption); ?> </p> <?php }
                                                                                                                                    if ($row->news_sub_headline) { ?> <h3 class="sub-title-single-post"> <?php echo stripslashes($row->news_sub_headline); ?> </h3> <br> <?php
                                                                                                                                                                                                                                                                        } ?>
                                </div>

                                <div class="row">
                                    <?php
                                    if ($news_advertise) {
                                        $count = 0;
                                        foreach ($news_advertise as $add_row) {
                                            if ($add_row->add_id == 9) { ?>
                                                <div class="col-md-6">
                                                    <a href="<?php echo $add_row->add_link ?>"><img style="width: 100%; height: 120px; margin: 5px auto" src="<?= base_url('images/add/' . $add_row->add_id . $add_row->img_ext) ?>" alt=""></a>
                                                </div>
                                            <?php
                                            }
                                            if ($add_row->add_id == 10) { ?>
                                                <div class="col-md-6">
                                                    <a href="<?php echo $add_row->add_link ?>"><img style="width: 100%; height: 120px; margin: 5px auto" src="<?= base_url('images/add/' . $add_row->add_id . $add_row->img_ext) ?>" alt=""></a>
                                                </div>
                                            <?php
                                            }
                                            ?>

                                    <?php
                                        }
                                    }
                                    ?>
                                </div>



                                <div class="post-content">

                                    <p class='single-news-description-p'>
                                        <img style="float: right;" src="https://wordstream-files-prod.s3.amazonaws.com/s3fs-public/styles/simple_image/public/images/media/images/banner-ads-examples-umass-dartmouth.jpg?1q59CUC2zaorkmQmeAb7eUeAJ3EuEyPE&amp;itok=LkWGLATS" alt="" width="327px" height="276px">
                                        <?php
                                        if ($row->news_details) {
                                            $details = strip_tags($row->news_details, "<b><i><br><u><strong><img><a><p><span><blockquote>");
                                            echo stripslashes($details);
                                        }
                                        ?>
                                    </p>
                                    <hr>
                                    <?php
                                    if ($row->news_details && $row->video_link) {
                                        echo '<p style="font-size: 16px; margin-bottom: 0px"> ভিডিও - ' . $row->video_caption . '</p>'; ?>
                                        <p>
                                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/<?php echo $row->video_link; ?>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                        </p>


                                    <?php
                                    }
                                    if ($row->news_source && $row->news_source_link) {
                                        echo '<p>সূত্র : <a href="' . $row->news_source_link . '" target="_blank">' . $row->news_source . '</a></p>';
                                    }
                                    if ($row->news_source) {
                                        echo '<p>সূত্র : ' . $row->news_source . '</p>';
                                    }
                                    ?>
                                </div>

                                <div class="share-post-box">
                                    <ul class="share-box" style="padding: 20px 0px">
                                        <div class="sharethis-inline-share-buttons" style="margin: 0px ; padding: 0"></div>
                                    </ul>
                                </div>
                                <hr>

                                <div class="post-tags-box" style="display:none">
                                    <ul class="tags-box">
                                        <li><i class="fa fa-tags"></i><span>Tags:</span></li>
                                        <li><a href="#">News</a></li>
                                        <li><a href="#">Fashion</a></li>
                                        <li><a href="#">Politics</a></li>
                                        <li><a href="#">Sport</a></li>
                                    </ul>
                                </div>

                                <div class="row" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="facebook-share" style='float:left; width: 100%;'>
                                            <div id="fb-root"></div>
                                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="oc9DoR5g"></script>
                                            <div class="fb-comments" data-href="http://localhost/sylhetview-live/news/<?php echo $row->news_id; ?>" data-width="100%" data-numposts=""></div>
                                        </div>
                                    </div>
                                </div>


                                <!-- youtube subscribe  -->
                                <div class="row" style="padding: 10px 0">
                                    <center>
                                        <div class="col-md-6" style="background: #f1f1f1">
                                            <h6 class="y-subscribe-text">সিলেটভিউ২৪ ইউটিউব চ্যানেলে সাবস্ক্রাইব করুন</h6>
                                            <script src="https://apis.google.com/js/platform.js"></script>
                                            <div class="g-ytsubscribe" data-channelid="UCaYcqwh952xkMCAXFiNpZ1w" data-layout="full" data-count="default"></div>
                                        </div>
                                        <div class="col-md-6" style="background: #f1f1f1">
                                            <h6 class="y-subscribe-text">বাংলাভিউ ইউটিউব চ্যানেলে সাবস্ক্রাইব করুন</h6>
                                            <script src="https://apis.google.com/js/platform.js"></script>
                                            <div class="g-ytsubscribe" data-channelid="UCPmLfnuj3apn4YrBSBrjM2g" data-layout="full" data-count="default"></div>
                                        </div>
                                    </center>
                                </div>
                                <hr>
                                <!-- youtube subscribe  -->






                                <div class="about-more-autor" style="padding-top: 20px">
                                    <ul class="nav nav-tabs">
                                        <li class="active">
                                            <a>এ সম্পর্কিত আরো খবর</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="more-autor">
                                            <div class="more-autor-posts">
                                                <div class="row">
                                                    <?php
                                                    if ($category_wise_news) {
                                                        $folder_name = ceil($row->news_id / 1000);
                                                        $count = 0;
                                                        foreach ($category_wise_news as $key => $cat_row) {
                                                            $count++;
                                                            if ($count < 4) {
                                                    ?>
                                                                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                                                    <div class="news-post single-image-suggest">
                                                                        <?php if ($cat_row->img_ext) { ?>
                                                                            <img class="large-img lazy" src="<?php echo base_url(); ?>images/news/<?php echo $folder_name . '/' . $cat_row->news_id . $cat_row->img_ext ?>" alt="">
                                                                        <?php } else { ?>
                                                                            <img class="large-img lazy" src="<?php echo base_url(); ?>images/news/small/demo.jpg" alt="">
                                                                        <?php } ?>
                                                                        <div class="hover-box">
                                                                            <h2><a href="<?php echo base_url(); ?>news/<?php echo $cat_row->news_id ?>"><?php echo $cat_row->news_headline;  ?></a></h2>
                                                                            <ul class="post-tags">
                                                                                <?php
                                                                                if ($cat_row->news_pub_date) {
                                                                                ?>
                                                                                    <li><i class="fa fa-bell-o"></i><?php echo bn_date(date('d M, Y', strtotime($cat_row->news_pub_date))) . '  ' . bn_date(date('H:i', strtotime($cat_row->news_pub_time))) ?></li>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                    <?php
                                                            }
                                                            if ($isMobile) {
                                                                if ($count % 2 == 0) echo '<div class="row"> </br> </div>';
                                                            } else {
                                                                if ($count % 4 == 0) echo '<div class="row"> </br> </div>';
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                    <?php }
                    endforeach; ?>
                    <!-- End single-post box -->
                </div>
                <!-- End block content -->
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6">
                        <img src="https://www.searchinfluence.com/wp-content/uploads/2018/05/google-ads.gif" style="width: 100%">
                    </div>
                </div>





                <!-- sidebar -->
                <div class="sidebar" style="margin-top: 5px;">
                    <?php
                    if ($category_wise_news) { ?>
                        <div class="widget tab-posts-widget">
                            <ul class="nav nav-tabs">
                                <li class="active details-tab">
                                    <a href="#option1" data-toggle="tab">এ বিভাগের আরো খবর</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="option1">
                                    <ul class="list-posts">
                                        <?php
                                        foreach ($category_wise_news as $key => $row) : {
                                                $folder_name = ceil($row->news_id / 1000);
                                                if ($key > 3 && $key < 14) { ?>
                                                    <li>
                                                        <?php if ($row->img_ext) { ?>
                                                            <img class="lazy" style="max-height: 100px" src="<?php echo base_url(); ?>images/load.gif" data-src="<?php echo base_url(); ?>images/news/<?php echo $folder_name . '/small' . '/' . $row->news_id . $row->img_ext ?>" alt="">
                                                        <?php } else { ?>
                                                            <img class="lazy" style="max-height: 100px" src="<?php echo base_url(); ?>images/load.gif" data-src="<?php echo base_url(); ?>images/news/small/demo.jpg" alt="">
                                                        <?php } ?>
                                                        <div class="post-content">
                                                            <h2><a class="tab-content-link" href="<?php echo base_url(); ?>news/<?php echo  $row->news_id; ?>"><?php echo stripslashes($row->news_headline); ?></a>
                                                            </h2>
                                                        </div>
                                                    </li>
                                        <?php
                                                }
                                            }
                                        endforeach;
                                        ?>
                                    </ul>
                                </div>

                            </div>
                        </div>

                    <?php
                    }
                    ?>

                </div>

                <div class="row">
                    <div class="col-md-12">
                        <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6" style="padding-top: 20px;padding-bottom: 20px ">
                            <img src="<?php echo base_url('assets/ads/bkash.jfif'); ?>" style="width: 100%">
                        </div>
                    </div>
                </div>

                <div class="sidebar" style="margin-top: 5px;">
                    <?php
                    if ($headline_all_news) { ?>
                        <div class="widget tab-posts-widget">
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#option1" data-toggle="tab">সর্বশেষ</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="option1">
                                    <ul class="list-posts">
                                        <?php

                                        foreach ($headline_all_news as $key => $row) : {
                                                $folder_name = ceil($row->news_id / 1000);
                                                if ($key > 3 && $key < 14) { ?>
                                                    <li>
                                                        <?php if ($row->img_ext) { ?>
                                                            <img class="lazy" style="max-height: 100px" src="<?php echo base_url(); ?>images/load.gif" data-src="<?php echo base_url(); ?>images/news/<?php echo $folder_name . '/small' . '/' . $row->news_id . $row->img_ext ?>" alt="">
                                                        <?php } else { ?>
                                                            <img class="lazy" style="max-height: 100px" src="<?php echo base_url(); ?>images/load.gif" data-src="<?php echo base_url(); ?>images/news/small/demo.jpg" alt="">
                                                        <?php } ?>
                                                        <div class="post-content">
                                                            <h2><a class="tab-content-link" href="<?php echo base_url(); ?>news/<?php echo  $row->news_id; ?>"><?php echo stripslashes($row->news_headline); ?></a>
                                                            </h2>
                                                        </div>
                                                    </li>
                                        <?php   }
                                            }
                                        endforeach;

                                        ?>
                                    </ul>
                                </div>

                            </div>
                        </div>
                    <?php
                    }
                    ?>
                </div>
                <!-- sidebar -->


                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-6 col-xs-6" style="padding-top: 20px;padding-bottom: 20px ">
                        <img src="https://tpc.googlesyndication.com/simgad/11120884426894159701" style="width: 100%">
                    </div>
                </div>
                <!-- End sidebar -->
            </div>
        </div>
    </div>
</section>