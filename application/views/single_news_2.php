
<!--<div id="fb-root"></div>-->
<!--<script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v10.0" nonce="7xJqv1an"></script>-->


<!--<div class="subscribe-me text-center">-->
<!--    <a href="#close" class="sb-close-btn"><img class="<img-responsive></img-responsive> close-img" src="<?= base_url('images/close.png') ?>" alt="" /></a>-->
<!--    <img class="ads-img" src="<?= base_url() ?>assets/ads/wp_sq.png" alt="">-->
<!--</div>-->


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

                header {
                    display: none;
                }

                .ads-mbl {
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
            <p>সিলেটভিউ টুয়েন্টিফোর ডটকম, <?php echo bn_date(date('d M, Y', strtotime($row->news_pub_date))) . '  ' . bn_date(date('H:i', strtotime($row->news_pub_time))) ?> </p>
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
            <hr style="padding-bottom: 0; margin-bottom: 0">
                <?php $url = "http" . (($_SERVER['SERVER_PORT'] == 443) ? "s" : "") . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
                echo '<small>' . $url . '</small>';
            ?>
            <center>
                <div class="row mt">
                    <strong>সম্পাদক : মো. শাহ্ দিদার আলম চৌধুরী<br> </strong>
                    উপ-সম্পাদক : মশিউর রহমান চৌধুরী <br>
                    সহকারী সম্পাদক : পিংকু ধর<br>
                    ✉ sylhetview24@gmail.com ☎ ০১৬১৬-৪৪০ ০৯৫ (বিজ্ঞাপন), ০১৭৯১-৫৬৭ ৩৮৭ (নিউজ) <br>
                    আর বি কমপ্লেক্স (চতুর্থ তলা) <br>
                    পূর্ব জিন্দাবাজার, সিলেট-৩১০০ সিলেট <br>
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
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php
                $CatName = '';
                if ($specific_news) {
                    $count = 0;
                    foreach ($specific_news as $row) : {
                            $count++;
                            if ($count == 1) {
                                $CatName = $row->cat_name; ?>

                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-7">
                                        <ol class="breadcrumb" style="padding: 8px">
                                            <li> <a href="<?php echo base_url(); ?>"> <i class="fa fa-home"></i> </a> </li>
                                            <li> <a href="<?php echo base_url(); ?><?php echo $row->cat_key_name; ?>"> <?php echo $row->cat_name; ?> </a> </li>
                                            <li> বিস্তারিত </li>
                                        </ol> <!-- breadcump end-->

                                        <div class="block-content">
                                            <div class="single-post-box">
                                                <div class="title-post">
                                                    <h1><?php echo stripslashes($row->news_headline); ?></h1>
                                                    <ul class="post-tags" style="padding: 10px 0 30px 0">
                                                        <img class="posts-tag-single-image" src="<?= base_url('assets/images/editor-icon.webp')?>">
                                                        <div style="float: left; margin-top: 5px;">

                                                            <?php if ($row->author_id) { ?> <li class="single-post-tag writer"> <a href="<?php echo base_url() ?>author/<?php echo $row->author_id; ?>"><?php echo $row->writer_name; ?></a></li> <?php }
                                                                                                                                                                                                                                                if ($row->author_id == 0 && $row->news_reporter != '') { ?> <li class="single-post-tag writer"> <?php echo $row->news_reporter; ?></li> <?php }
                                                                                                                                                                                                                                                                                                                                                                                    if ($row->author_id == 0 && $row->news_reporter == '') { ?> <li class="single-post-tag writer">নিউজ ডেস্ক </li> <?php } ?> <br>
                                                            <?php
                                                            if ($row->news_pub_date) {
                                                            ?>
                                                                <li class="single-post-tag time"> প্রকাশিত : <?php echo bn_date(date('d M, Y', strtotime($row->news_pub_date))) . '  ' . bn_date(date('H:i', strtotime($row->news_pub_time))) ?></li>
                                                            <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="share-post-box">
                                                             <?php
                                                                if (!$isMobile) { ?>
                                                                    <!--<script type="text/javascript" src="https://s7.addthis.com/js/300/addthis_widget.js#pubid=ra-608a71e94924ed1c"></script>-->
                                                                <?php }
                                                            ?>

                                                            <ul class="share-box" style="display: inline-flex;">
                                                                <?php
                                                                if (!$isMobile) { ?>
                                                                    <!--<li>-->
                                                                    <!--    <div class="addthis_inline_share_toolbox_ml10"></div>-->
                                                                    <!--</li>-->
                                                                <?php }
                                                                ?>
                                                                <li><a href="" class="btn-print" onclick="window.print();"><i class="fa fa-print" style="margin: 0;"></i> </a></li>
                                                            </ul>
                                                        </div>
                                                    </ul>
                                                </div>
                                                <!-- youtube subscribe  -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <img class="add-hide" src="<?php echo base_url('assets/ads/gif-ads.gif')?>" style="width: 100%">
                                    </div>
                                    <div class="col-md-1"></div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="block-content mt">
                                            <div class="single-post-box">

                                                <div class="post-gallery">
                                                    <?php if ($row->img_ext) { ?>
                                                        <a style="cursor: zoom-in" class="image-popup-vertical-fit" href="<?php echo base_url(); ?>images/news/<?php echo $folder_name . '/' . $row->news_id . $row->img_ext ?>" title="<?php echo stripslashes($row->img_caption); ?>" alt="<?php echo stripslashes($row->news_headline); ?>">
                                                            <img src="<?php echo base_url(); ?>images/news/<?php echo $folder_name . '/' . $row->news_id . $row->img_ext ?>" alt="">
                                                        </a>
                                                    <?php } else if ($row->img_ext == '' && $row->cat_key_name = 'video' && $row->video_link != '') { ?>
                                                        <img class="lazy" style="max-height: 350px;" src="<?php echo base_url(); ?>images/lazy.jpg" data-src="https://img.youtube.com/vi/<?php echo $row->video_link . '/hqdefault.jpg' ?>" alt="">
                                                    <?php } else { ?>
                                                        <a class="image-popup-vertical-fit" href="<?php echo base_url(); ?>images/news/small/demo.jpg" title="Default Image">
                                                            <img class="lazy" src="<?php echo base_url(); ?>images/lazy.jpg" data-src="<?php echo base_url(); ?>images/news/small/demo.jpg" alt="">
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
                                                                    <a href="<?php echo $add_row->add_link ?>" target="_blank"><img style="max-width: 100%; height: auto; margin: 10px auto" src="<?= base_url('images/add/' . $add_row->add_id . $add_row->img_ext) ?>" alt=""></a>
                                                                </div>
                                                            <?php
                                                            }
                                                            if ($add_row->add_id == 10) { ?>
                                                                <div class="col-md-6">
                                                                    <a href="<?php echo $add_row->add_link ?>" target="_blank"><img style="max-width: 100%; height: auto; margin: 10px auto" src="<?= base_url('images/add/' . $add_row->add_id . $add_row->img_ext) ?>" alt=""></a>
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
                                                        <img class="add-hide" style="float: right;" src="<?= base_url('assets/ads/custom-add-10.jpg')?>" alt="" width="327px" height="276px">
                                                        <?php
                                                        if ($row->news_details) {
                                                            $details = strip_tags($row->news_details, "<b><i><br><u><strong><img><a><p><span><blockquote>");
                                                            echo stripslashes($details);
                                                        }
                                                        ?>
                                                    </p>
                                                    <hr>
                                                    <?php
                                                    if ($row->audio_link) {
                                                        $audioURL     = "https://w.soundcloud.com/player/?url=https%3A//api.soundcloud.com/tracks/" . $row->audio_link;
                                                        $audioURL    = $audioURL . "&color=%23ff5500&auto_play=false&hide_related=true&show_comments=true&show_user=true&show_reposts=false&show_teaser=true";
                                                    ?>
                                                        <iframe width="100%" height="166" scrolling="no" frameborder="no" allow="autoplay" src="<?php echo $audioURL; ?>"></iframe>
                                                    <?php
                                                    }



                                                    if ($row->news_details && $row->video_link) {
                                                        echo '<p style="font-size: 16px; margin-bottom: 0px"> ভিডিও - ' . $row->video_caption . '</p>'; ?>
                                                        <p>
                                                            <iframe width="100%" height="360" loading="lazy" src="https://www.youtube.com/embed/<?php echo $row->video_link ?>?autoplay=1" srcdoc="<style>*{padding:0;margin:0;overflow:hidden}html,body{height:100%}img,span{position:absolute;width:100%;top:0;bottom:0;margin:auto}span{height:1.5em;text-align:center;font:48px/1.5 sans-serif;color:white;text-shadow:0 0 0.5em black}</style><a href=https://www.youtube.com/embed/<?php echo $row->video_link ?>?autoplay=1><img src=https://img.youtube.com/vi/<?php echo $row->video_link ?>/hqdefault.jpg alt='Video The Dark Knight Rises: What Went Wrong? – Wisecrack Edition'><span>▶</span></a>" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                                                        </p>


                                                    <?php
                                                    }
                                                    if ($row->news_source && $row->news_source_link) {
                                                        echo '<p>সূত্র : <a href="' . $row->news_source_link . '" target="_blank">' . $row->news_source . '</a></p>';
                                                    }
                                                    if ($row->news_source != "" && $row->news_source_link == '') {
                                                        echo '<p>সূত্র : ' . $row->news_source . '</p>';
                                                    }
                                                    ?>
                                                </div>

                                                <div class="share-post-boxx">
                                                    <ul class="share-box" style="padding: 20px 0px">
                                                        <!-- ShareThis BEGIN -->
                                                            <div class="sharethis-inline-share-buttons"></div>
                                                        <!-- ShareThis END -->
                                                    </ul>
                                                </div>


                                                <div class="post-tags-box" style="display:none">
                                                    <ul class="tags-box">
                                                        <li><i class="fa fa-tags"></i><span>Tags:</span></li>
                                                        <li><a href="#">News</a></li>
                                                        <li><a href="#">Fashion</a></li>
                                                        <li><a href="#">Politics</a></li>
                                                        <li><a href="#">Sport</a></li>
                                                    </ul>
                                                </div>

                                                <!--<div class="row" style="display: none;">-->
                                                <!--    <div class="col-md-12">-->
                                                <!--        <div class="facebook-share" style='float:left; width: 100%;'>-->
                                                <!--            <div id="fb-root"></div>-->
                                                <!--            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v10.0" nonce="oc9DoR5g"></script>-->
                                                <!--            <div class="fb-comments" data-href="http://localhost/sylhetview-live/news/-->
                                                <!--            
                                                            //echo $row->news_id; 
                                                <!--            ?>" data-width="100%" data-numposts=""></div>-->
                                                <!--        </div>-->
                                                <!--    </div>-->
                                                <!--</div>-->


                                                <!-- youtube subscribe  -->
                                                <div class="row" style="padding: 10px 0">

                                                    <div class="yt-channel-blocks">
                                                        <!-- <center> -->
                                                        <script src="https://apis.google.com/js/platform.js"></script>
                                                        <div class="yt-channel-block block--left">
                                                            <center>
                                                                <h6 class="y-subscribe-text"><i class="fa fa-angle-double-down"> </i> সিলেটভিউ২৪ ইউটিউব চ্যানেলে সাবস্ক্রাইব করুন</h6>
                                                                <div class="pt">
                                                                    <div class="g-ytsubscribe" data-channelid="UCaYcqwh952xkMCAXFiNpZ1w" data-layout="full" data-count="default"></div>
                                                                </div>
                                                            </center>
                                                        </div>
                                                        <div class="yt-channel-block block--right">
                                                            <center>
                                                                <h6 class="y-subscribe-text"><i class="fa fa-angle-double-down"> </i> বাংলাভিউ ইউটিউব চ্যানেলে সাবস্ক্রাইব করুন</h6>
                                                                <div class="pt">
                                                                    <div class="g-ytsubscribe" data-channelid="UCPmLfnuj3apn4YrBSBrjM2g" data-layout="full" data-count="default"></div>
                                                                </div>
                                                            </center>
                                                        </div>
                                                        <!-- </center> -->
                                                    </div>
                                                    <div class="yt-mbl-view">

                                                        <div class="col-md-6 col-xs-6">
                                                            <center>
                                                                <h6 class=""><i class="fa fa-angle-double-right"> </i> সিলেটভিউ২৪ ইউটিউব চ্যানেলে সাবস্ক্রাইব করুন</h6>
                                                                <script src="https://apis.google.com/js/platform.js"></script>
                                                                <div class="g-ytsubscribe" data-channelid="UCaYcqwh952xkMCAXFiNpZ1w" data-layout="default" data-count="default"></div>
                                                            </center>
                                                        </div>

                                                        <div class="col-md-6 col-xs-6">
                                                            <center>
                                                                <h6 class=""><i class="fa fa-angle-double-right"> </i> বাংলাভিউ ইউটিউব চ্যানেলে সাবস্ক্রাইব করুন</h6>
                                                                <script src="https://apis.google.com/js/platform.js"></script>
                                                                <div class="g-ytsubscribe" data-channelid="UCPmLfnuj3apn4YrBSBrjM2g" data-layout="default" data-count="default"></div>
                                                            </center>
                                                        </div>

                                                    </div>
                                                </div>
                                                <hr>
                                                <!-- youtube subscribe  -->
                                                
                                                <div class="row">
                                                    <?php
                                                    if ($news_advertise) {
                                                        
                                                        foreach ($news_advertise as $add_row) {
                                                            if ($add_row->add_id == 11) { ?>
                                                                <div class="col-md-2"></div>
                                                                <div class="col-md-8">
                                                                    <div align="center">
                                                                        <a href="<?php echo $add_row->add_link ?>" target="_blank"><img style="max-height: 130px; max-width: 100%;   margin: 10px auto" src="<?= base_url('images/add/' . $add_row->add_id . $add_row->img_ext) ?>" alt=""></a>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2"></div>
                                                            <?php
                                                            }
                                                            
                                                        }
                                                    }
                                                    ?>
                                                </div>






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
                                                                                <div class="col-lg-4 col-md-4 col-sm-4">
                                                                                    <div class="news-post single-image-suggest">
                                                                                        <?php if ($cat_row->img_ext) { ?>
                                                                                            <?php
                                                                                                if($isMobile){?>
                                                                                                    <img class="large-img lazy" src="<?php echo base_url(); ?>images/news/<?php echo $folder_name . '/small'.'/' . $cat_row->news_id . $cat_row->img_ext ?>" alt="">
                                                                                                <?php
                                                                                                }
                                                                                                else{ ?>
                                                                                                
                                                                                                    <img class="large-img lazy" src="<?php echo base_url(); ?>images/news/<?php echo $folder_name . '/thumb'.'/' . $cat_row->news_id . $cat_row->img_ext ?>" alt="">
                                                                                                    <?php
                                                                                                }
                                                                                            ?>
                                                                                        <?php } else { ?>
                                                                                            <img class="large-img lazy" src="<?php echo base_url(); ?>images/news/small/demo.jpg" alt="">
                                                                                        <?php } ?>
                                                                                        <div class="hover-box">
                                                                                            <h2><a href="<?php echo base_url(); ?>news/<?php echo $cat_row->news_id ?>"><?php echo stripslashes($cat_row->news_headline);  ?></a></h2>
                                                                                            <ul class="post-tags">
                                                                                                <?php
                                                                                                if ($cat_row->news_pub_date) {
                                                                                                ?>
                                                                                                    <li><i class="fa fa-bell-o"></i><?php echo bn_date(date('d M, Y', strtotime($cat_row->news_pub_date))) ?></li>
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
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                                </div>
                <?php
                            }
                            break;
                        }
                    endforeach;
                }
                ?>
            </div>
        </div>
    </div>
</section>