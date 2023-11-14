<?php 
    $default_image  = base_url('images/default-ekattorer-kotha.jpg') ;
    $thumb = '/thumb'.'/' ;
    $small = '/small'.'/' ;
?>


<style>
    .wc .floting-item-inner a p {
        padding: 10px 0px 0px 0px;
        color: white;
        margin-bottom: 0;
        overflow: hidden;
         font-weight: normal; 
        text-align: center;
        font-size: 1.2rem;
        max-height: unset; 
        min-height: unset; 
    }
    .wc .floting-item-inner a:hover p {
        color: #ffd610 !important;
    }
    .wc .floting-slider .owl-nav .owl-prev span, .wc .floting-slider .owl-nav .owl-next span{
        color: #fff;
    }
</style>

<?php
    if($breaking_news){ ?>
        <section class="my-2 w-100 float-start">
            <div class="container">
                <div class="row">
                    <div class="braking-news">
                        <div class="ticker-wrap">
                            <div class="ticker-heading">এইমাত্র</div>
                            <div class="ticker">
                                <?php
                                    foreach($breaking_news as $row){ ?>
                                        <div class="ticker__item"><a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>"><?php echo stripslashes($row->news_headline); ?></a></div>
                                    <?php }
                                ?>
                            </div>
                            <svg height="100" width="100" class="blinking"> <circle cx="50" cy="50" r="10" fill="red" />  Sorry, your browser does not support inline SVG.  </svg>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php }
?>


<div class="body-add-box-one advertise  py-3">
    <div class="container leaderboard">

        <?php
            if($news_advertise){
                foreach($news_advertise as $row){
                    if($row->position == 1){
                        if($row->add_link)  { $link = 'href="'.$row->add_link.'"'; $target = 'target="_blank"'; }
                        else { $link = ""; $target = "";}
                        echo '<a '.$link.$target.' class="d-flex justify-content-center align-items-center">';
                            echo '<img src="'.base_url("images/add/".$row->add_id.$row->img_ext).'">';
                        echo '</a>';
                    }
                }
            }
        ?>
    </div>
</div>



<section id="section-one" class="section-one">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-6 order-xl-1 order-lg-2 order-2 mt-lg-0 mt-2">
                <div class="div-title">
                    <h3 class="title-one">তাজা খবর</h3>
                </div>

                <?php if($top_news) {?>
                    <div class="owl-carousel owl-theme list-slider">
                        <?php 
                            $count = 0;
                            $numItems = count($top_news);
                            foreach($top_news as $row){
                                
                                $count++ ;   
                                if($count == 1){ ?>
                                    <div class="item">
                                        <div class="group-list-item">  
                                <?php } 
                                if($count >= 1 && $count <=5){ ?>
                                            <div class="list-box">
                                                <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                    <p><?php echo stripslashes($row->news_headline); ?></p>
                                                </a>
                                                <a href="<?php echo base_url($row->cat_key_name); ?>"><span class="list-tag"><?php echo $row->cat_name; ?></span></a>
                                                <small class="list-time"> <input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></small>
                                            </div>
                                        
                                <?php } 
                                if($count == 5){ ?>
                                        </div>
                                    </div>
                                <?php }
                                if($count == 6){ ?>
                                    <div class="item">
                                        <div class="group-list-item">  
                                <?php } 
                                if($count >= 6 && $count <=10){ ?>
                                            <div class="list-box">
                                                <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                    <p><?php echo stripslashes($row->news_headline); ?></p>
                                                </a>
                                                <a href="<?php echo base_url($row->cat_key_name); ?>"><span class="list-tag"><?php echo $row->cat_name; ?></span></a>
                                                <small class="list-time"> <input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></small>
                                            </div>
                                        
                                <?php } 
                                if($count == 10){ ?>
                                        </div>
                                    </div>
                                <?php }
                                else{
                                    if($count == $numItems){ ?>
                                        </div>
                                    </div>
                                    <?php }
                                }
                                ?>
                                
                            <?php 
                            }
                        ?>

                    </div>
                <?php }
                ?>
            </div>

            <div class="col-xl-4 col-lg-6 border-xl-1 order-lg-1 order-1 ">
                <?php
                    if($lead_news){
                        $count = 0;
                        foreach($lead_news as $row){
                            $count++;
                            $folder = ceil($row->news_id/1000);
                            if($count == 1){ ?>
                                <div class="center-div">
                                    <div class="ratio " style="--bs-aspect-ratio: calc(9 / 9 * 100%);">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>" class="">
                                            <img src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.'/'.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>">
                                        </a>
                                        <div class="overlay-content">
                                            <div class="ratio-content">
                                                <a><span class="box-tag"><input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></span></a>
                                                <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                    <h1 class="ratio-headding"><?php echo stripslashes($row->news_headline);?></h1>
                                                </a>
                                                <?php  if($row->news_details_brief) echo '<p>'.word_limiter($row->news_details_brief, 15).'</p>'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                            }
                        }
                    }
                ?>
            </div>

            <div class="col-xl-2 col-lg-12 order-3 order-xl-3 mt-xl-0 mt-2 order-lg-3 order-4">
                <div class="row custom-row">
                    <?php
                        if($selective_news){
                            $count = 0;
                            foreach($selective_news as $row){
                                $folder = ceil($row->news_id / 1000);
                                $count++; ?>
                                <div class="col-xl-12  col-6">
                                    <div class="child-div mid-lead">
                                        <div class="ratio">
                                            <img src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>">
                                        </div>
                                        <div class="child-div-content">
                                            <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>" class="child-box-tag"><?php echo stripslashes($row->news_headline);?></a>
                                            <br>
                                            <small class="list-time"> <input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></small>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="col-xl-3  col-lg-12 order-4 order-xl-4  order-lg-4 order-3">
                <div class="list-box-two mt-1">
                    <div class="div-title">
                        <h3 class="title-one">আলোচিত</h3>
                    </div>
                    <?php
                        if($popular_ten_news){
                            foreach($popular_ten_news as $row){?> 
                                <div class="list-box ">
                                    <!-- <a href="#"><span class="list-tag">মেক-আপভি</span></a> -->
                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                        <p><?php echo stripslashes($row->news_headline); ?></p>
                                    </a>
                                    <small class="list-time"><input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></small>
                                </div>
                            
                            <?php }
                        }
                    ?>
                    
                </div>

            </div>
        </div>
    </div>
</section>



<div class="body-add-box-one advertise  py-3">
    <div class="container leaderboard">

        <?php
            if($news_advertise){
                foreach($news_advertise as $row){
                    if($row->position == 2){
                        if($row->add_link)  { $link = 'href="'.$row->add_link.'"'; $target = 'target="_blank"'; }
                        else { $link = ""; $target = "";}
                        echo '<a '.$link.$target.' class="d-flex justify-content-center align-items-center">';
                            echo '<img src="'.base_url("images/add/".$row->add_id.$row->img_ext).'">';
                        echo '</a>';
                    }
                }
            }
        ?>
    </div>
</div>



<section id="slider-box-positioning" class="slider-box-positioning bg-light py-2 my-5 wc" style="width: 100%;float: left;background: linear-gradient(45deg, #3c313100  0%, #3c313100  100%), url(<?php echo base_url('assets/bg-wc.jpg'); ?>) no-repeat center center fixed; background-size: cover">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="large-section-title">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one text-light">বিশ্বকাপ ফুটবল </h3>
                        <a href="<?= base_url('sports/football-worldcup'); ?>">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i>   </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="floting-slider-box">
                    <div class="owl-carousel owl-theme floting-slider" style="background: unset;box-shadow: none;">
                        <?php
                            if($wc_news){
                                $count = 0;
                                foreach($wc_news as $row){
                                    $count++;
                                    $folder = ceil($row->news_id/1000);
                                    if($count > 0){ ?>
                                        <div class="item">
                                            <div class="floting-item-inner">
                                                <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                    <div class="image-box">
                                                        <img class="owl-lazy" style=" aspect-ratio: 16/10; object-fit: cover;" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                                    </div>
                                                    <div class="content-box">
                                                        <p class="text-start"> <?php if($count == 1 && $row->headline_tag) echo '<span>'.$row->headline_tag.'</span>'; ?> <?php echo stripslashes($row->news_headline); ?></p>
                                                    </div>
                                                </a>
                                            </div>
                                        </div>
                                    <?php 
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>



<section id="section-four" class="section-four mt-5">
    <div class="container">
        <div class="section-title-style mb-3">
            <h1 class="overlay-title">সিলেটের কথা</h1>
            <h3 class="child-overlay-title">সিলেটের কথা</h3>
        </div>

        <div class="row">

            <?php
                if($sylhet_news){
                    $count = 0;
                    foreach($sylhet_news as $row){
                        $folder = ceil($row->news_id/ 1000);
                        $count++;
                        if($count < 3){ ?>
                            <div class="col-xl-6 col-lg-6 col-md-6">
                                <div class="row">
                                    <div class="col-xl-6  <?php if($count == 2) echo "col-4 mt-2"?>">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>" class="ratio-div">
                                            <div>
                                                <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                            </div>
                                        </a>
                                    </div>
                                    <div class="col-xl-6 d-flex justify-content-center align-items-center <?php if($count == 2) echo "col-8"?> ">
                                        <div class="content-box-div ">
                                            <div class="content-box mb-2">
                                                <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                    <h1 class="lead-headding"> <?php echo stripslashes($row->news_headline); ?></h1>
                                                    <span class=" d-md-block <?php if($count == 2) echo "d-none"?>">
                                                        <?php if($row->news_details_brief) echo word_limiter($row->news_details_brief, 15); ?>
                                                    </span>
                                                </a>
                                            </div>
                                            <div class="author-box">
                                                <div class="d-flex justify-content-start align-items-center">
                                                    <div class="detail-box d-flex justify-content-start align-items-center">
                                                        <div class="time"><span class="mark"><?php if($row->sub_cat_name) echo $row->sub_cat_name; else echo "সিলেট"; ?></span> - <input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                        <?php }
                        
                        
                        else{?>
                             <?php   
                                if($count == 3){
                                    echo '<div class="classified-row py-2"></div>'; 
                                }
                                ?>
                            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6 col-6">
                                <div class="child-div-two">
                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                         <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">  
                                    </a>
                                    <div class="content-box">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                            <h1 class="lead-headding"><?php echo stripslashes($row->news_headline); ?></h1>
                                        </a>
                                    </div>
                                    
                                </div>
                            </div>
                        <?php }
                    }
                }
            ?>

            
        </div>
    </div>
</section>


<div class="body-add-box-one advertise  py-3">
    <div class="container leaderboard">

        <?php
            if($news_advertise){
                foreach($news_advertise as $row){
                    if($row->position == 3){
                        if($row->add_link)  { $link = 'href="'.$row->add_link.'"'; $target = 'target="_blank"'; }
                        else { $link = ""; $target = "";}
                        echo '<a '.$link.$target.' class="d-flex justify-content-center align-items-center">';
                            echo '<img src="'.base_url("images/add/".$row->add_id.$row->img_ext).'">';
                        echo '</a>';
                    }
                }
            }
        ?>
    </div>
</div>


<section id="section-three" class="section-three mt-2 ">
    <div class="container">
        <div class="row">
            <div class="col-xl-9 col-lg-9 col-md-9 col-12 ">
                <div class="large-section-title ">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">দেশের কথা</h3>
                        <a href="#">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i> </span>
                        </a>
                    </div>
                </div>

                <div class="row mt-3">
                    <?php
                        if($national_news){
                            foreach($national_news as $row){
                                $folder = ceil($row->news_id/1000); ?>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                    <div class="child-div-two">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                        <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                        </a>
                                        <div class="content-box">
                                            <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                <h1 class="lead-headding"><?php echo stripslashes($row->news_headline); ?></h1>
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                            <?php }
                        }
                    ?>
                </div>

                
                <div class="large-section-title mt-3">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">রাজনীতি</h3>
                        <a href="#">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i> </span>
                        </a>
                    </div>
                </div>

                <div class="row mt-3">
                    <?php
                        if($politics_news){
                            foreach($politics_news as $row){
                                $folder = ceil($row->news_id/1000); ?>
                                <div class="col-xl-3 col-lg-4 col-md-6 col-6">
                                    <div class="child-div-two">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                            <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                        </a>
                                        <div class="content-box">
                                            <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                <h1 class="lead-headding"><?php echo stripslashes($row->news_headline); ?></h1>
                                            </a>
                                        </div>
                                        
                                    </div>
                                </div>
                            <?php }
                        }
                    ?>
                </div>
                
            </div>
            <div class="col-xl-3 col-lg-3 col-md-3 col-12 sticky-part-arc">
                <div id="itemtFixed" class="positionin">
                    <div id="itemSticky" class="positioning-items">
                        <!-- <div class="add-box">
                            <a href="#">
                                <img src="assets/images/template/rec-sb.jpg" alt="" class="img-fluid">
                            </a>
                        </div> -->
                        <div class="footer-box sub-box mt-5">
                            <h3>আর্কাইভ</h3>
                            <div class="subscribe-box">
                                <form action="<?php echo base_url('archive')?>" method="get">
                                    <input type="text" name="date" id="date_of_birth" value="<?php if(!empty($date)) echo bn_convert(date('d/m/y',strtotime($date))); ?>" class="form-control" placeholder="তারিখ অনুযায়ী দেখুন..."  onkeydown="return false"/ autocomplete="off" required>
                                    <button type="submit">খুজুন</button>
                                </form>
                                <div class="d-flex justify-content-start align-items-center">
                                    <span class="chackbox-title"> নির্দিষ্ট দিন অনুযায়ী খবর দেখুন </span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="weather weather-div-main mt-3 position-relative">
                            <div class="weather-overlay"></div>
                            <a class="weatherwidget-io" href="https://forecast7.com/en/24d8991d87/sylhet/" data-label_1="সিলেট এর" data-label_2="আবহাওয়া" data-font="Noto Sans" data-icons="Climacons Animated" data-mode="Current" data-theme="pure" data-basecolor="#ff2b32" data-textcolor="#ffffff" data-suncolor="#ff8e33" data-mooncolor="#fff4f4" >সিলেট এর আবহাওয়া</a>
                            <script>
                            !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src='https://weatherwidget.io/js/widget.min.js';fjs.parentNode.insertBefore(js,fjs);}}(document,'script','weatherwidget-io-js');
                            </script>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="body-add-box-one advertise  py-3">
    <div class="container leaderboard">
        <?php
            if($news_advertise){
                foreach($news_advertise as $row){
                    if($row->position == 4){
                        if($row->add_link)  { $link = 'href="'.$row->add_link.'"'; $target = 'target="_blank"'; }
                        else { $link = ""; $target = "";}
                        echo '<a '.$link.$target.' class="d-flex justify-content-center align-items-center">';
                            echo '<img src="'.base_url("images/add/".$row->add_id.$row->img_ext).'">';
                        echo '</a>';
                    }
                }
            }
        ?>
    </div>
</div>


<section id="section-five" class="section-five ">
    <div class="container">
        
        <div class="row mt-4">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="large-section-title">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">দশদিক </h3>
                        <a href="<?php echo base_url('news-around')?>">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i>   </span>
                        </a>
                    </div>
                </div>
                <?php
                    if($dosdik_news){
                        $count = 0;
                        foreach($dosdik_news as $row){
                            $count++;
                            $folder = ceil($row->news_id/1000); 
                            if($count == 1){ ?>
                                <div class="child-div-two">
                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                        <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                    </a>
                                    <div class="content-box">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                            <h1 class="lead-headding"><?php echo stripslashes($row->news_headline); ?></h1>
                                        </a>
                                        <small class="list-time"><input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></small>
                                    </div>
                                </div>
                                <hr>
                            <?php }else{ ?>
                                <div class="list-box box-border-none">
                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                        <p><?php echo stripslashes($row->news_headline); ?></p>
                                    </a>
                                    <small class="list-time"><input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></small>
                                </div>
                                <?php if($count != 3) echo "<hr>"; ?>
                            <?php }
                        }
                    }
                ?>
                
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="large-section-title">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">হৃদয়ে একাত্তর</h3>
                        <a href="<?php echo base_url('hridoye-ekattor')?>">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i>   </span>
                        </a>
                    </div>
                </div>
                <?php
                    if($hridoye_ekattor){
                        $count = 0;
                        foreach($hridoye_ekattor as $row){
                            $count++;
                            $folder = ceil($row->news_id/1000); 
                            if($count == 1){ ?>
                                <div class="child-div-two">
                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                        <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                    </a>
                                    <div class="content-box">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                            <h1 class="lead-headding"><?php echo stripslashes($row->news_headline); ?></h1>
                                        </a>
                                        <small class="list-time"><input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></small>
                                    </div>
                                </div>
                                <hr>
                            <?php }else{ ?>
                                <div class="list-box box-border-none">
                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                        <p><?php echo stripslashes($row->news_headline); ?></p>
                                    </a>
                                    <small class="list-time"><input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></small>
                                </div>
                                <?php if($count != 3) echo "<hr>"; ?>
                            <?php }
                        }
                    }
                ?>
                
            </div>
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="large-section-title">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">প্রবাসের কথা</h3>
                        <a href="<?php echo base_url('aboard')?>">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i>   </span>
                        </a>
                    </div>
                </div>
                <?php
                    if($aboard_news){
                        $count = 0;
                        foreach($aboard_news as $row){
                            $count++;
                            $folder = ceil($row->news_id/1000); 
                            if($count == 1){ ?>
                                <div class="child-div-two">
                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                        <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                    </a>
                                    <div class="content-box">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                            <h1 class="lead-headding"><?php echo stripslashes($row->news_headline); ?></h1>
                                        </a>
                                        <small class="list-time"><input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></small>
                                    </div>
                                </div>
                                <hr>
                            <?php }else{ ?>
                                <div class="list-box box-border-none">
                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                        <p><?php echo stripslashes($row->news_headline); ?></p>
                                    </a>
                                    <small class="list-time"><input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"></small>
                                </div>
                                <?php if($count != 3) echo "<hr>"; ?>
                            <?php }
                        }
                    }
                ?>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">

                <div class="fb-page" style="width: 100%; text-align: center; float: left;">
                    <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fekattorerkotha%2F&tabs&width=280&height=130&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" width="280" height="130" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                </div>
                <div class="body-add-box-one advertise  py-3">
                    <div class="container">
                        <?php
                            if($news_advertise){
                                foreach($news_advertise as $row){
                                    if($row->position == 11){
                                        if($row->add_link)  { $link = 'href="'.$row->add_link.'"'; $target = 'target="_blank"'; }
                                        else { $link = ""; $target = "";}
                                        echo '<a '.$link.$target.' class="d-flex justify-content-center align-items-center">';
                                            echo '<img src="'.base_url("images/add/".$row->add_id.$row->img_ext).'">';
                                        echo '</a>';
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>



<div class="body-add-box-one advertise  py-3">
    <div class="container leaderboard">

        <?php
            if($news_advertise){
                foreach($news_advertise as $row){
                    if($row->position == 6){
                        if($row->add_link)  { $link = 'href="'.$row->add_link.'"'; $target = 'target="_blank"'; }
                        else { $link = ""; $target = "";}
                        echo '<a '.$link.$target.' class="d-flex justify-content-center align-items-center">';
                            echo '<img src="'.base_url("images/add/".$row->add_id.$row->img_ext).'">';
                        echo '</a>';
                    }
                }
            }
        ?>
    </div>
</div>



<section id="slider-box-positioning" class="slider-box-positioning bg-light pt-2 pb-3 my-5">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="large-section-title">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">রূপালিকথা</h3>
                        <a href="<?php echo base_url('rupali-kotha')?>">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i>   </span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-12">
                <div class="floting-slider-box">
                    <div class="owl-carousel owl-theme floting-slider">
                        <?php
                            if($rupali_kotha_news){
                                $count = 0;
                                foreach($rupali_kotha_news as $row){
                                    $count++;
                                    $folder = ceil($row->news_id/1000);
                                    if($count > 0){ ?>
                                        <div class="item">
                                            <div class="floting-item-inner">
                                                <div class="image-box">
                                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                        <img class="owl-lazy" style="max-height: 150px; min-height: 150px;" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                                    </a>
                                                </div>
                                                <div class="content-box">
                                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                        <p> <?php if($count == 1 && $row->headline_tag) echo '<span>'.$row->headline_tag.'</span>'; ?> <?php echo stripslashes($row->news_headline); ?></p>
                                                    </a>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    <?php 
                                    }
                                }
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="body-add-box-one advertise">
    <div class="container leaderboard">
        <a href="https://itlabsolutions.com" target="_blank" class="d-flex justify-content-center align-items-center">
            <?php
                if(!$isMobile){ ?>
                    <img src="<?= base_url('images/add/itlab/ITLab-solutions-leaderboard.gif')?>" >
                <?php }
                else{ ?>
                    <img class="mb-3" src="<?= base_url('images/add/itlab/ITLab-solutions-rectangle.gif')?>">
                <?php }
            ?>
            
        </a>
    </div>
</div>

<!------------------ ********* ------------------->
<!------------------ SECTION 6 ------------------->
<!------------------ ********* ------------------->

<section id="section-six" class="section-six">
    <div class="container">
        <div class="row">
            <div class="col-xl-12">
                <div class="large-section-title">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">খেলা</h3>
                        <a href="<?php echo base_url('sports')?>">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i>   </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
                if($sports_news){
                    $count = 0;
                    foreach($sports_news as $row){
                        $count++;
                        $folder = ceil($row->news_id/1000);
                        if($count == 1){ ?>
                            <div class="col-xl-6 col-lg-6 col-md-12 col-12 div-tag">
                                <div class="center-div">
                                    <div class="ratio ratio-4x3">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>" class="">
                                            <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.'/'.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                        </a>
                                        <div class="overlay-content">
                                            <div class="ratio-content">
                                                <a><span class="box-tag">মার্কেটিং</span></a>
                                                <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                    <h1 class="ratio-headding"><?php echo stripslashes($row->news_headline); ?></h1>
                                                </a>
                                                <?php if($row->headline_tag) echo '<p>'.stripslashes($row->headline_tag).'</p>'; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6 col-lg-6 col-md-4">
                                <div class="row">
                        <?php }
                        else{?> 
                            <div class="col-xl-6 col-lg-6 col-md-6 col-6 mt-lg-0 mt-2">
                                <div class="child-div child-div- sub-div">
                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                        <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                    </a>

                                    <div class="child-div-content mt-2">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>" class="">
                                            <h4 class="child-div-headding "> <?php echo stripslashes($row->news_headline); ?>৷</h4>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        
                        <?php 
                        }
                    }
                } ?>
                </div>
            </div>
        </div>
    </div>
</section>


<div class="body-add-box-one advertise  py-3">
    <div class="container leaderboard">

        <?php
            if($news_advertise){
                foreach($news_advertise as $row){
                    if($row->position == 5){
                        if($row->add_link)  { $link = 'href="'.$row->add_link.'"'; $target = 'target="_blank"'; }
                        else { $link = ""; $target = "";}
                        echo '<a '.$link.$target.' class="d-flex justify-content-center align-items-center">';
                            echo '<img src="'.base_url("images/add/".$row->add_id.$row->img_ext).'">';
                        echo '</a>';
                    }
                }
            }
        ?>
    </div>
</div>


<!------------------ ********* ------------------->
<!------------------ SECTION 7 ------------------->
<!------------------ ********* ------------------->

<div class="section-seven">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="large-section-title">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">প্রেসবক্স</h3>
                        <a href="<?php echo base_url('press-box')?>">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i>   </span>
                        </a>
                    </div>
                </div>
                    <?php
                        if($presbox_news){
                            $count = 0;
                            foreach($presbox_news as $item){
                                $count++;
                                $folder = ceil($item->news_id/1000); 
                                if($count < 4 ){ ?>
                                    <div class="list-box <?php if($count == 3) echo 'border-0'?>" >
                                        <div class="image-part">
                                            <img class="lazy" data-src="<?php echo ($item->img_ext) ? base_url('images/news/'.$folder.$small.$item->news_id.$item->img_ext) : $default_image; ?>" alt="<?php echo $item->news_headline; ?>" width="100%">
                                        </div>
                                        <div class="content-list">
                                            <a href="<?php echo base_url('details/'.$item->news_id.'/'.seoURL($item->news_headline)); ?>">
                                                <p><?php echo stripslashes($item->news_headline); ?></p>
                                            </a>
                                        </div>
                                    </div>
                                <?php 
                                }   
                            }
                        }
                    ?>
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="large-section-title">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">তথ্যপ্রযুক্তি</h3>
                        <a href="<?php echo base_url('info-tech')?>">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i>   </span>
                        </a>
                        
                    </div>
                </div>
                    <?php
                        if($tech_news){
                            $count = 0;
                            foreach($tech_news as $item){
                                $count++;
                                $folder = ceil($item->news_id/1000); 
                                if($count < 4 ){ ?>
                                    <div class="list-box <?php if($count == 3) echo 'border-0'?>" >
                                        <div class="image-part">
                                            <img class="lazy" data-src="<?php echo ($item->img_ext) ? base_url('images/news/'.$folder.$small.$item->news_id.$item->img_ext) : $default_image; ?>" alt="<?php echo $item->news_headline; ?>" width="100%">
                                        </div>
                                        <div class="content-list">
                                            <a href="<?php echo base_url('details/'.$item->news_id.'/'.seoURL($item->news_headline)); ?>">
                                                <p><?php echo stripslashes($item->news_headline); ?></p>
                                            </a>
                                        </div>
                                    </div>
                                <?php 
                                }   
                            }
                        }
                    ?>
                
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="large-section-title">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">অর্থনীতি</h3>
                        <a href="<?php echo base_url('economy')?>">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i>   </span>
                        </a>
                        
                    </div>
                </div>
                    <?php
                        if($economy_news){
                            $count = 0;
                            foreach($economy_news as $item){
                                $count++;
                                $folder = ceil($item->news_id/1000); 
                                if($count < 4 ){ ?>
                                    <div class="list-box <?php if($count == 3) echo 'border-0'?>" >
                                        <div class="image-part">
                                            <img class="lazy" data-src="<?php echo ($item->img_ext) ? base_url('images/news/'.$folder.$small.$item->news_id.$item->img_ext) : $default_image; ?>" alt="<?php echo $item->news_headline; ?>" width="100%">
                                        </div>
                                        <div class="content-list">
                                            <a href="<?php echo base_url('details/'.$item->news_id.'/'.seoURL($item->news_headline)); ?>">
                                                <p><?php echo stripslashes($item->news_headline); ?></p>
                                            </a>
                                        </div>
                                    </div>
                                <?php 
                                }   
                            }
                        }
                    ?>
                
            </div>
            
            <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="large-section-title">
                    <div class="d-flex justify-content-between align-items-center title-border">
                        <h3 class="title-one">মতামত</h3>
                        <a href="<?php echo base_url('opinion')?>">
                            <span class="title-span"> সব খবর <i class="fas fa-long-arrow-alt-right"></i>   </span>
                        </a>
                        
                    </div>
                </div>
                    <?php
                        if($opinion_news){
                            $count = 0;
                            foreach($opinion_news as $item){
                                $count++;
                                $folder = ceil($item->news_id/1000); 
                                if($count < 4 ){ ?>
                                    <div class="list-box <?php if($count == 3) echo 'border-0'?>" >
                                        <div class="image-part position-relative">
                                            <img class="lazy rounded-3" data-src="<?php echo ($item->img_ext) ? base_url('images/news/'.$folder.$small.$item->news_id.$item->img_ext) : $default_image; ?>" alt="<?php echo $item->news_headline; ?>" width="100%">
                                            <div class="overlay-type-image">
                                                <?PHP
                                                    if($item->writer_id){?> <a href="<?php echo base_url('author/'.$item->writer_id.'/'.seoURL($item->writer_name)); ?>"> <img class="author-img-sm" src="<?php echo base_url('images/writer/thumb/'.$item->writer_id.$item->writer_image); ?>" ></a> <?php } else {?> <img class="author-img-sm" src="<?php echo base_url('images/writer/writer.png'); ?>"> <?php }
                                                ?>
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="content-list">
                                            <a href="<?php echo base_url('details/'.$item->news_id.'/'.seoURL($item->news_headline)); ?>">
                                                <p><?php echo stripslashes($item->news_headline); ?></p>
                                            </a>
                                        </div>
                                    </div>
                                <?php 
                                }   
                            }
                        }
                    ?>
              
            </div>
            
        </div>
    </div>
</div>