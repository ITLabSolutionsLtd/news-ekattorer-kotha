<?php 
    $default_image  = base_url('images/default-ekattorer-kotha.jpg') ;
    $thumb = '/thumb'.'/' ;
    $small = '/small'.'/' ;
?>

<div class="body-add-box-one advertise  py-3">
    <div class="container leaderboard">
        <a href="#" class="d-flex justify-content-center align-items-center">
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
        </a>
    </div>
</div>

<section class="details-section py-2">
    <div class="container">
        <div class="sharethis-sticky-share-buttons"></div>

        <div class="row">
            <div class="col-xl-12 col-lg-12">

                <?php
                    if($specific_news){
                        foreach($specific_news as $row){ 
                            $folder = ceil($row->news_id / 1000); ?>


                            <div class="main-details">
                                <div class="row">
                                    <div class="col-xl-9 col-lg-8 col-md-8 col-12 mt-md-0 mt-3 " id="titleDIV">
                                        <div class="ratio-content-large-div">

                                            <div class="title-section">
                                                <a href="<?= base_url($row->cat_key_name); ?>" class="category-tag"> <span></span> <?= $row-> cat_name; ?></a>
                                            </div>

                                            <h1 class="lead-headding"> <?php echo stripslashes($row->news_headline); ?></h1>

                                            <div class="title-section">
                                                <div class="author-box">

                                                    <?php
                                                        if($authorInfo){
                                                            $author = 0;
                                                            foreach($authorInfo as $item){ 
                                                                    $author++;
                                                                ?>
                                                                <div class="author-part  me-3">
                                                                    <i class="fas fa-pencil"></i>
                                                                    <div class="detail-box ">
                                                                        <a href="<?php echo base_url('author/'.$item->writer_id.'/'.seoURL($item->writer_name)); ?>" class="name"><?php echo $item->writer_name; ?></a>
                                                                       
                                                                    </div>
                                                                </div>
                                                                
                                                            <?php }
                                                        }
                                                        
                                                        if (isset($reporterData->reporter_ids)) {
                                                            $linksArray = explode(',', $reporterData->reporter_ids);
                                                            foreach ($linksArray as $link) { ?>
                                                                    <div class="author-part  me-3">
                                                                        <i class="fas fa-pencil"></i>
                                                                        <div class="detail-box ">
                                                                            <a class="name"><?php echo $link; ?></a>
                                                                        </div>
                                                                    </div>
                                                                <?php
                                                                }
                                                            ?>  
                                                        <?php }
                                                        if($authorInfo == '' && empty($reporterData->reporter_ids)){?>
                                        
                                                                <div class="author-part me-3">
                                                                <i class="fas fa-pencil-alt"></i>
                                                                    <div class="detail-box ">
                                                                        <a class="name">একাত্তরের কথা ডেস্ক</a>
                                                                    </div>
                                                                </div>
                                                    
                                                        <?php 
                                                        }
                                                    ?>
                                                </div>

                                                <div class="time-box ">
                                                    <div class="time"> <i class="fab fa-hive"></i> <strong>প্রকাশিত - </strong> <?= bn_convert(date('d M Y H:i', strtotime($row->news_pub_date.$row->news_pub_time))); ?></div>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="main-image">
                                                <?php
                                                    if($row->video_link){ ?>
                                                        <div class="youtube" <?php if($row->img_ext){ ?> data-image="<?php echo base_url('images/news/'.$folder.'/'.$row->news_id.$row->img_ext.'?newst='.strtotime($row->news_mod_date.$row->news_mod_time)); ?>" <?php } ?> data-embed="<?php echo $row->video_link; ?>">
                                                            <div class="play-button"></div>
                                                        </div>
                                                        <span class="img-caption"><?php echo $row->video_caption; ?></span>
                                                    <?php }
                                                    else {?> 
                                                        <img src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.'/'.$row->news_id.$row->img_ext.'?newst='.strtotime($row->news_mod_date.$row->news_mod_time)) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                                        <span class="img-caption"><?php echo $row->img_caption; ?></span>
                                                    <?php 
                                                    }
                                                ?>
                                            </div>


                                            <?php
                                                if($row->news_sub_headline){?> 
                                                    <p class="sub-headline"><?php echo $row->news_sub_headline; ?></p>
                                                <?php }
                                            ?>
                                            


                                            <div class="news-share">
                                                <!-- ShareThis BEGIN -->
                                                <div class="sharethis-inline-share-buttons"></div>
                                                <!-- ShareThis END -->
                                                
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-xl-3 col-lg-3 col-md-3 col-12 sticky-part">
                                    
                                        <div class="row">
                                            <div class="col-md-12">
                                                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5248664437668325"
                                                     crossorigin="anonymous"></script>
                                                <!-- e-kotha-responsive -->
                                                <ins class="adsbygoogle"
                                                     style="display:block"
                                                     data-ad-client="ca-pub-5248664437668325"
                                                     data-ad-slot="4326156888"
                                                     data-ad-format="auto"
                                                     data-full-width-responsive="true"></ins>
                                                <script>
                                                     (adsbygoogle = window.adsbygoogle || []).push({});
                                                </script>
                                            </div>
                                        </div>
                                     

                                        
                                        <div class="body-add-box-one advertise d-none py-3">
                                            <?php
                                                if($news_advertise){
                                                    foreach($news_advertise as $ads){
                                                        if($ads->position == 11){
                                                            if($ads->add_link)  { $link = 'href="'.$ads->add_link.'"'; $target = 'target="_blank"'; }
                                                            else { $link = ""; $target = "";}
                                                            echo '<a '.$link.$target.' class="d-flex justify-content-center align-items-center">';
                                                                echo '<img src="'.base_url("images/add/".$ads->add_id.$ads->img_ext).'" width="100%" >';
                                                            echo '</a>';
                                                        }
                                                    }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    
                                </div>

                                <div class="row">
                                    <div class="body-add-box-one advertise  py-3">
                                        <div class="leaderboard">
                                            <a href="#" class="d-flex justify-content-center align-items-center">
                                                <?php
                                                    if($news_advertise){
                                                        foreach($news_advertise as $ads){
                                                            if($ads->position == 2){
                                                                if($ads->add_link)  { $link = 'href="'.$ads->add_link.'"'; $target = 'target="_blank"'; }
                                                                else { $link = ""; $target = "";}
                                                                echo '<a '.$link.$target.' class="d-flex justify-content-center align-items-center">';
                                                                    echo '<img src="'.base_url("images/add/".$ads->add_id.$ads->img_ext).'">';
                                                                echo '</a>';
                                                            }
                                                        }
                                                    }
                                                ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>

                                

                                <div class="row">
                                    <div class="col-xl-8">
                                        <div class="news-details">
                                            <?php
                                                if($row->news_details){
                                                    echo '<div class="inner-news-details">';
                                                        if ($row->news_details) {
                                                            $details = strip_tags($row->news_details, "<a><table><tr><td><th><h1><h2><h3><h3><h5><h5><b><i><br><u><strong><img><a><p><span><blockquote>");

                                                            $ads = "<img src='".base_url('images/efood.png')."'>"; 

                                                            $details_content = insertAd($details,'',2);
                                                            echo stripslashes($details_content);
                                                        }
                                                    echo '</div>'; 
                                                    
                                                }
                                            ?>

                                            <?php
                                                if ($row->news_tag) { ?>
                                                    <div class="news-tags d-flex justify-content-start flex-wrap align-items-center my-4">
                                                        <ul class="list-group list-group-horizontal news-tag-items d-flex justify-content-start align-items-center flex-wrap ms-2">
                                                            <i class="fas fa-tags"></i>
                                                            <?php
                                                            $linksArray = explode(',', $row->news_tag);
                                                            foreach ($linksArray as $link) {
                                                            ?>
                                                                <form action='<?php echo base_url(); ?>topic' method='get'>
                                                                    <input type="hidden" value="<?php echo $link ?>" name="subject">
                                                                    <li> <button><?php echo $link ?></button></li>
                                                                </form>
                                                            <?php 
                                                            }
                                                        ?>
                                                        </ul>
                                                    </div>
                                                <?php 
                                                }
                                            ?>
                                        </div>
                                    </div>
                                    <div class="col-xl-4 list-part">
                                        <div class="div-title">
                                            <h3 class="title-one">সর্বশেষ</h3>
                                        </div>
                                        <div class="list-box-two mt-3">
                                            <?php
                                                if($latest_news){
                                                    foreach($latest_news as $key => $item){ ?>
                                                        <div class="list-box <?php if($key == 4) echo 'border-0'?>" >
                                                            <div class="image-part">
                                                                <img class="lazy" data-src="<?php echo ($item->img_ext) ? base_url('images/news/'.$folder.$small. $item->news_id.$item->img_ext.'?newst='.strtotime($item->news_mod_date.$item->news_mod_time)) : $default_image; ?>" alt="<?php echo $item->news_headline; ?>" width="100%">
                                                            </div>
                                                            <div class="content-list">
                                                                <a href="<?php echo base_url('details/'.$item->news_id.'/'.seoURL($item->news_headline)); ?>">
                                                                    <p><?php echo stripslashes($item->news_headline); ?></p>
                                                                </a>
                                                                <small class="list-time"><input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $item->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($item->news_pub_date . ' ' . $item->news_pub_time)) ?>"></small>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                }
                                            ?>
                                            
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>

                        <?php 
                        }
                    }
                ?>
                
 
                <div class="row">
                    <div class="col-md-12">
                        <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-5248664437668325"
                             crossorigin="anonymous"></script>
                        <!-- e-kotha-responsive -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-5248664437668325"
                             data-ad-slot="4326156888"
                             data-ad-format="auto"
                             data-full-width-responsive="true"></ins>
                        <script>
                             (adsbygoogle = window.adsbygoogle || []).push({});
                        </script>
                    </div>
                </div>



                <div class="row">
                    <div class="body-add-box-one advertise  py-3">
                        <div class="leaderboard">
                       
                            <?php
                                if($news_advertise){
                                    foreach($news_advertise as $ads){
                                        if($ads->position == 3){
                                            if($ads->add_link)  { $link = 'href="'.$ads->add_link.'"'; $target = 'target="_blank"'; }
                                            else { $link = ""; $target = "";}
                                            echo '<a '.$link.$target.' class="d-flex justify-content-center align-items-center">';
                                                echo '<img src="'.base_url("images/add/".$ads->add_id.$ads->img_ext).'">';
                                            echo '</a>';
                                        }
                                    }
                                }
                            ?>
                            
                        </div>
                    </div>
                </div>

                <div class="row pb-5">
                    <div class="col-xl-12">
                        <div class="large-section-title mt-3">
                            <div class="d-flex justify-content-between align-items-center title-border">
                                <h3 class="title-one">আরো পড়ুন</h3>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <?php
                                if($category_wise_news){
                                    foreach($category_wise_news as $row){
                                        $folder = ceil($row->news_id/1000); ?>
                                        <div class="col-xl-2 col-lg-3 col-md-3 col-6">
                                            <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>" class="news-link">
                                                <div class="child-div-two">
                                                    <div>
                                                        <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.$thumb.$row->news_id.$row->img_ext.'?newst='.strtotime($row->news_mod_date.$row->news_mod_time)) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                                    </div>
                                                    <div class="content-box">
                                                        <h2 class="lead-headding"><?php echo stripslashes($row->news_headline); ?></h2>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php 
                                    }
                                }
                            ?>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>


<script>
    (function() {

        var image = $('.youtube').data("image");
        var youtube = document.querySelectorAll(".youtube");
        for (var i = 0; i < youtube.length; i++) {
        /* 
            - mqdefault 320 x 180
            - hqdefault 480 x 360
            - sddefault - 640 x 480
            - maxresdefault - 1920 x 1080
        */
        if(image){
            var source = image;
        }
        else{
            var source = "https://img.youtube.com/vi/" + youtube[i].dataset.embed + "/sddefault.jpg";
        }

        var image = new Image();
        image.src = source;
        image.addEventListener("load", function() {
            youtube[i].appendChild(image);
        }(i));

        youtube[i].addEventListener("click", function() {
            var iframe = document.createElement("iframe");
            iframe.setAttribute("frameborder", "0");
            iframe.setAttribute("allowfullscreen", "");
            iframe.setAttribute("allow", "autoplay");
            iframe.setAttribute("src", "https://www.youtube.com/embed/" + this.dataset.embed + "?rel=0&showinfo=0&autoplay=1");
            this.innerHTML = "";
            this.appendChild(iframe);
        });
        };

    })();
</script>