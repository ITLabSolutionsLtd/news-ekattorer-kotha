<style>
    .advert{
        width: 100%;
        float: left;
        margin-bottom: 10px;
    }
    .advert .banner img{
        max-height: 100px;
        min-height: 100px;
    }
</style>
<div class="main-content">
    <section class="details-section mb-3">
        <div class="container">
            <div class="row pt-3">
                <div class="col-md-12">
                    <div class="bc-icons-2">

                        <ol class="breadcrumb blue-grey lighten-4">
                            <li class="breadcrumb-item"><a class="black-text" href="<?php echo base_url(); ?>">প্রচ্ছদ</a><i class="fa fa-angle-double-right mx-2" aria-hidden="true"></i></li>
                            <li class="breadcrumb-item"><a class="black-text" href="<?php echo base_url('opinion')?>">মুক্তমত</a><i class="fa fa-angle-double-right mx-2" aria-hidden="true"></i></li>
                            <li class="breadcrumb-item active">বিস্তারিত</li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-2 pt-3">
                    <div class="writer-box">
                        <center>
                            <?php
                                if($authorInfo){
                                    foreach($authorInfo as $row){ ?>
                                        <a href="<?php echo base_url('author/'.$row->writer_id.'/'.seoURL($row->writer_name)); ?>">
                                            <img src="<?php if($row->img_ext) echo base_url('images/writer/thumb/'.$row->writer_id.$row->img_ext); else echo base_url('images/writer/writer.jpg');  ?>" width="80" height="80" class="rounded-circle" alt="">
                                            <div class="writer-name">
                                                <h3><?php echo $row->writer_name; ?></h3>
                                                <p class="pt-1"><?php echo $row->writer_designation; ?></p>
                                            </div>
                                        </a>
                                    <?php }
                                }
                                if (empty($authorInfo) && isset($reporterData->reporter_ids)) {
                                    $linksArray = explode(',', $reporterData->reporter_ids);
                                    foreach ($linksArray as $link) { ?>
                                        <a>
                                            <img src="<?php echo base_url('images/writer/writer.jpg') ?>" width="80" height="80" class="rounded-circle" alt="">
                                            <div class="writer-name">
                                                <h3><?php echo $link; ?></h3>
                                                <p class="pt-1"><?php echo 'মুক্তমত ডেস্ক'; ?></p>
                                            </div>
                                        </a>
                                            
                                        <?php
                                        }
                                    ?>  
                                <?php }
                            ?>
                            
                        </center>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="details-content">
                        <?php
                            if($specific_news){
                                foreach($specific_news as $row){
                                    $folder_name = ceil($row->news_id / 1000);
                                ?>
                                    <div class="details-caption">
                                        <span><?php echo stripcslashes($row->headline_tag)?></span>
                                    </div>
                                    <div class="details-headline">
                                        <h1><?php echo stripcslashes($row->news_headline)?></h1>
                                    </div>
                                    <?php
                                        if($row->news_sub_headline){ ?>
                                            <div class="details-sub-headline">
                                                <p><?php echo stripcslashes($row->news_sub_headline)?></p>
                                            </div>
                                        <?php }
                                    ?>

                                    <div class="author-share">
                                        <div class="author">
                                            <?php
                                                if($authorInfo){
                                                    $author = 0;
                                                    foreach($authorInfo as $item){ 
                                                            $author++;
                                                        ?>
                                                        <div class="author-div p-0">
                                                            <div class="author-info">
                                                                <div class="author-image">
                                                                    <a href="<?php echo base_url('author/'.$item->writer_id.'/'.seoURL($item->writer_name)); ?>"><img src="<?php if($item->img_ext){ echo base_url('images/writer/thumb/'.$item->writer_id.$item->img_ext); } else { echo base_url('images/writer/writer.jpg'); }?>" alt=""></a>
                                                                </div>
                                                                <div class="author-details">
                                                                    <strong>
                                                                        <p><a href="<?php echo base_url('author/'.$item->writer_id.'/'.seoURL($item->writer_name)); ?>"><?php echo $item->writer_name; ?></a></p>
                                                                    </strong>
                                                                    <p class="des"><?php echo $item-> writer_designation; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php }
                                                }
                                                
                                                if (isset($reporterData->reporter_ids)) {
                                                    $linksArray = explode(',', $reporterData->reporter_ids);
                                                    foreach ($linksArray as $link) { ?>
                                                            <div class="author-div">
                                                                <div class="author-info">
                                                                    <div class="author-image">
                                                                        <a><img src="<?php echo base_url('images/writer/writer.jpg') ?>" alt=""></a>
                                                                    </div>
                                                                    <div class="author-details">
                                                                        <strong>
                                                                            <p><a><?php echo $link; ?></a></p>
                                                                        </strong>
                                                                        <p class="des">রিপোর্টার</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        <?php
                                                        }
                                                    ?>  
                                                <?php }
                                                if($authorInfo == '' && empty($reporterData->reporter_ids)){?>
                                                    <div class="author-div">
                                                        <div class="author-info">
                                                            <div class="author-image">
                                                                <a><img src="<?php echo base_url('images/writer/demo.jpg') ?>" alt=""></a>
                                                            </div>
                                                            <div class="author-details">
                                                                <strong>
                                                                    <p><a>নিউজ ডেস্ক</a></p>
                                                                </strong>
                                                                <p class="des">শ্যামল সিলেট</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php }

                                            ?>
                                        </div>
                                        <div class="share">
                                            <div id="share">
                                                <a class="facebook" href="https://www.facebook.com/share.php?u={{url}}&title={{title}}" target="blank"><i class="fab fa-facebook-f"></i></a>
                                                <a class="twitter" href="https://twitter.com/intent/tweet?status={{title}}+{{url}}" target="blank"><i class="fab fa-twitter"></i></a>
                                                <a class="linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url={{url}}&title={{title}}&source={{source}}" target="blank"><i class="fab fa-linkedin-in"></i></a>
                                                <a class="pinterest" href="https://pinterest.com/pin/create/bookmarklet/?media={{media}}&url={{url}}&is_video=false&description={{title}}" target="blank"><i class="fab fa-pinterest-p"></i></a>
                                            </div>
                                        </div>
                                    </div>

                                    <a class="item" data-sub-html="<h4><?php echo stripcslashes($row->news_headline)?></h4>" data-pinterest-text="Pin it1" data-tweet-text="lightGallery slide  1" data-facebook-share-url="share/www.soumitra.com" data-twitter-share-url="share/twitter-share-url" href="<?php echo ($row->img_ext) ? base_url('images/news/' . $folder_name . '/' . $row->news_id . $row->img_ext) : $default_image ?>">
                                        <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/' . $folder_name . '/' . $row->news_id . $row->img_ext) : $default_image ?>" width="100%" >
                                    </a>
                                    <div class="img-caption mt-1"> <?php echo stripslashes($row->img_caption) ?> </div>

                                    <div class="row pt-2">
                                        <?php
                                            if($news_advertise){
                                            
                                                $count = 0;
                                                foreach ($news_advertise as $ads) {
                                                    if($ads->add_id == 1 && $ads-> cat_id == 0){ ?>
                                                        <div class="col-md-6">
                                                            <div class="advert">
                                                                <div class="small-4 banner columns">
                                                                    <a class="main" href="<?php echo $ads->add_link; ?>" target="_blank" title="<?php echo $ads->add_title; ?>"><img class="banner" src="<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext)?>" alt=""> </a>
                                                                    <div class="share-click">
                                                                        <a class="button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext); ?>&t=Shyamal Sylhet" target="_blank"><i class="fab fa-facebook"></i></a>
                                                                        <a class="button" href="http://twitter.com/share?text=Shyamal Sylhet&url=<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext); ?> &hashtags=Daily_Shyamal_Sylhet" target="_blank"><i class="fab fa-twitter"></i></a>
                                                                        <a class="button" href="https://web.whatsapp.com/send?text=<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                                    </div>
                                                                </div>  
                                                            </div>
                                                        </div>
                                                    <?php }
                                                    if($ads->add_id == 2 && $ads-> cat_id == 0){ ?>
                                                        <div class="col-md-6">
                                                            <div class="advert">
                                                            <div class="small-4 banner columns">
                                                                    <a class="main" href="<?php echo $ads->add_link; ?>" target="_blank" title="<?php echo $ads->add_title; ?>"><img class="banner" src="<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext)?>" alt=""> </a>
                                                                    <div class="share-click">
                                                                        <a class="button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext); ?>&t=Shyamal Sylhet" target="_blank"><i class="fab fa-facebook"></i></a>
                                                                        <a class="button" href="http://twitter.com/share?text=Shyamal Sylhet&url=<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext); ?> &hashtags=Daily_Shyamal_Sylhet" target="_blank"><i class="fab fa-twitter"></i></a>
                                                                        <a class="button" href="https://web.whatsapp.com/send?text=<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    <?php }
                                                    if($ads->add_id == 11 && $ads-> cat_id == 0){ ?>
                                                        <div class="col-md-12">
                                                            <div class="advert">
                                                            <div class="small-4 leaderboard columns">
                                                                    <a class="main" href="<?php echo $ads->add_link; ?>" target="_blank" title="<?php echo $ads->add_title; ?>"><img class="banner" src="<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext)?>" alt=""> </a>
                                                                    <div class="share-click">
                                                                        <a class="button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext); ?>&t=Shyamal Sylhet" target="_blank"><i class="fab fa-facebook"></i></a>
                                                                        <a class="button" href="http://twitter.com/share?text=Shyamal Sylhet&url=<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext); ?> &hashtags=Daily_Shyamal_Sylhet" target="_blank"><i class="fab fa-twitter"></i></a>
                                                                        <a class="button" href="https://web.whatsapp.com/send?text=<?php echo base_url('images/add/'.$ads->add_id.$ads->img_ext); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                        </div>
                                                    <?php }
                                                }
                                            }
                                        ?>
                                    </div>

                                    <div class="news-details">
                                        <?php
                                            if ($row->news_details) {
                                                $details = strip_tags($row->news_details, "<a><table><tr><td><th><h1><h2><h3><h3><h5><h5><b><i><br><u><strong><img><a><p><span><blockquote>");

                                                $ads = "<img src='".base_url('images/efood.png')."'>"; 

                                                $details_content = insertAd($details,'',2);
                                                echo stripslashes($details_content);
                                            }
                                        ?>
                                    </div>
                                    
                                    

                                <?php
                                }
                            }
                        ?>
                        <?php
                            if ($row->news_tag) { ?>
                                <div class="news-tag">
                                    <ul class="list-group list-group-horizontal">
                                        <li class="list-group-item"><i class="fas fa-tags"></i></li>
                                        <?php
                                        $linksArray = explode(',', $row->news_tag);
                                        foreach ($linksArray as $link) {
                                        ?>
                                            <form action='<?php echo base_url(); ?>topic' method='get'>
                                                <input type="hidden" value="<?php echo $link ?>" name="subject">
                                                <li class="list-group-item"> <button><?php echo $link ?></button></li>
                                            </form>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </div>
                            <?php 
                            }
                        ?>
                        <div class="news-share">

                            <div class='social-share-btns-container'>
                                <div class='social-share-btns dsk-lg-share'>
                                    <span> <i class="fas fa-share-alt"></i> শেয়ার করুন </span>
                                    <a class='share-btn share-btn-twitter' href='https://twitter.com/intent/tweet?text=https://codepen.io/marko-zub/#' rel='nofollow' target='_blank'>
                                        <i class='fab fa-twitter'></i> Twitter
                                    </a>
                                    <a class='share-btn share-btn-facebook' href='https://www.facebook.com/sharer/sharer.php?u=https://codepen.io/marko-zub/#' rel='nofollow' target='_blank'>
                                        <i class='fab fa-facebook-f'></i> Facebook
                                    </a>
                                    <a class='share-btn share-btn-linkedin' href='https://www.linkedin.com/cws/share?url=https://codepen.io/marko-zub/#' rel='nofollow' target='_blank'>
                                        <i class='fab fa-linkedin-in'></i>
                                    </a>
                                    <a class='share-btn share-btn-reddit' rel='nofollow' target=''>
                                        <i class='fas fa-print'></i>
                                    </a>
                                    <a class='share-btn share-btn-mail' href='mailto:?subject=Look Fun Codepen Account&amp;amp;body=https://codepen.io/marko-zub/#' rel='nofollow' target='_blank' title='via email'>
                                        <i class="fas fa-paper-plane"></i>
                                    </a>
                                </div>

                                <div class='social-share-btns mbl-lg-share'>
                                    <span> <i class="fas fa-share-alt"></i> </span>
                                    <a class='share-btn share-btn-twitter' href='https://twitter.com/intent/tweet?text=https://codepen.io/marko-zub/#' rel='nofollow' target='_blank'>
                                        <i class='fab fa-twitter'></i>
                                    </a>
                                    <a class='share-btn share-btn-facebook' href='https://www.facebook.com/sharer/sharer.php?u=https://codepen.io/marko-zub/#' rel='nofollow' target='_blank'>
                                        <i class='fab fa-facebook-f'></i>
                                    </a>
                                    <a class='share-btn share-btn-linkedin' href='https://www.linkedin.com/cws/share?url=https://codepen.io/marko-zub/#' rel='nofollow' target='_blank'>
                                        <i class='fab fa-linkedin-in'></i>
                                    </a>
                                    <a class='share-btn share-btn-reddit' href='http://www.reddit.com/submit?url=https://codepen.io/marko-zub/&amp;title=Marko+Zub+codepen' rel='nofollow' target='_blank'>
                                        <i class='fab fa-reddit'></i>
                                    </a>
                                    <a class='share-btn share-btn-mail' href='mailto:?subject=Look Fun Codepen Account&amp;amp;body=https://codepen.io/marko-zub/#' rel='nofollow' target='_blank' title='via email'>
                                        <i class="fas fa-paper-plane"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-md-3">
                    <div class="sidebar">
                        <div class="page-section">
                            <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2Fdailyshyamalsylhet&tabs&width=250&height=70&small_header=true&adapt_container_width=true&hide_cover=false&show_facepile=false&appId" width="250" height="70" style="border:none;overflow:hidden"
                                scrolling="no" frameborder="0" allowfullscreen="true" allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>
                        </div>
                        <div class="writer-list-box pt-3 pb-5" style="width: 100%; float: left">
                            <?php
                                if($writer_list){
                                    foreach($writer_list as $row){ ?>
                                        <a href="<?php echo base_url('author/'.seoURL($row->writer_name_en).'/'.seoURL($row->writer_name)); ?>" title="<?php echo $row->writer_name; ?>"><img class="rounded-circle z-depth-2 mb-2" width="50" height="50" src="<?php if($row->img_ext){ echo base_url('images/writer/'.$row->writer_id.$row->img_ext); } else { echo base_url('images/writer/writer.jpg'); }?>" data-holder-rendered="true"> </a>
                                    <?php }
                                }
                            ?>
                        </div>
                        <div class="latest-section">
                            <div class="heading">
                                <h3>সর্বশেষ</h3>
                            </div>
                            <div class="list-news">
                                <?php
                                    if($latest_ten_news){
                                        foreach($latest_ten_news as $row){ ?>
                                            <div class="post-content">
                                                <a href="<?php echo base_url('news/'.$row->news_id); ?>">
                                                    <h2><i class="fas fa-caret-square-right"></i> <?php echo stripslashes($row->news_headline); ?></h2>
                                                </a>
                                            </div>
                                        <?php }
                                    }
                                ?>
                                
                                
                            </div>
                        </div>

                        <div class="advertisement pt-3 ">
                            <div class="advert">
                                <?php
                                    if($news_advertise){
                                        $count = 0;
                                        foreach ($news_advertise as $row) {
                                            if($row->add_id == 21 && $row-> cat_id == 0){ ?>
                                                <div class="small-4 columns">
                                                    <a class="main" href="<?php echo $row->add_link; ?>" target="_blank" title="<?php echo $row->add_title; ?>"><img class="banner" src="<?php echo base_url('images/add/'.$row->add_id.$row->img_ext)?>" alt=""> </a>
                                                    <div class="share-click">
                                                        <a class="button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?>&t=Shyamal Sylhet" target="_blank"><i class="fab fa-facebook"></i></a>
                                                        <a class="button" href="http://twitter.com/share?text=Shyamal Sylhet&url=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?> &hashtags=Daily_Shyamal_Sylhet" target="_blank"><i class="fab fa-twitter"></i></a>
                                                        <a class="button" href="https://web.whatsapp.com/send?text=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                    </div>
                                                    
                                                </div>   
                                            <?php }
                                        }
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="advertisement py-5">
                            <div class="advert">
                                <?php
                                    if($news_advertise){
                                        $count = 0;
                                        foreach ($news_advertise as $row) {
                                            if($row->add_id == 22 && $row-> cat_id == 0){ ?>
                                                <div class="small-4 columns">
                                                    <a class="main" href="<?php echo $row->add_link; ?>" target="_blank" title="<?php echo $row->add_title; ?>"><img class="banner" src="<?php echo base_url('images/add/'.$row->add_id.$row->img_ext)?>" alt=""> </a>
                                                    <div class="share-click">
                                                        <a class="button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?>&t=Shyamal Sylhet" target="_blank"><i class="fab fa-facebook"></i></a>
                                                        <a class="button" href="http://twitter.com/share?text=Shyamal Sylhet&url=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?> &hashtags=Daily_Shyamal_Sylhet" target="_blank"><i class="fab fa-twitter"></i></a>
                                                        <a class="button" href="https://web.whatsapp.com/send?text=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                    </div>
                                                    
                                                </div>   
                                            <?php }
                                        }
                                    }
                                ?>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="row">
                        <?php
                            if($news_advertise){
                                $count = 0;
                                foreach ($news_advertise as $row) {
                                    if($row->add_id == 3 && $row-> cat_id == 0){ ?>
                                        <div class="col-md-6">
                                            <div class="advert">
                                                <div class="small-4 banner columns">
                                                    <a class="main" href="<?php echo $row->add_link; ?>" target="_blank" title="<?php echo $row->add_title; ?>"><img class="banner" src="<?php echo base_url('images/add/'.$row->add_id.$row->img_ext)?>" alt=""> </a>
                                                    <div class="share-click">
                                                        <a class="button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?>&t=Shyamal Sylhet" target="_blank"><i class="fab fa-facebook"></i></a>
                                                        <a class="button" href="http://twitter.com/share?text=Shyamal Sylhet&url=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?> &hashtags=Daily_Shyamal_Sylhet" target="_blank"><i class="fab fa-twitter"></i></a>
                                                        <a class="button" href="https://web.whatsapp.com/send?text=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                    </div>
                                                </div>  
                                            </div>
                                        </div>
                                    <?php }
                                    if($row->add_id == 4 && $row-> cat_id == 0){ ?>
                                        <div class="col-md-6">
                                            <div class="advert">
                                            <div class="small-4 banner columns">
                                                    <a class="main" href="<?php echo $row->add_link; ?>" target="_blank" title="<?php echo $row->add_title; ?>"><img class="banner" src="<?php echo base_url('images/add/'.$row->add_id.$row->img_ext)?>" alt=""> </a>
                                                    <div class="share-click">
                                                        <a class="button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?>&t=Shyamal Sylhet" target="_blank"><i class="fab fa-facebook"></i></a>
                                                        <a class="button" href="http://twitter.com/share?text=Shyamal Sylhet&url=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?> &hashtags=Daily_Shyamal_Sylhet" target="_blank"><i class="fab fa-twitter"></i></a>
                                                        <a class="button" href="https://web.whatsapp.com/send?text=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    <?php }
                                    if($row->add_id == 12 && $row-> cat_id == 0){ ?>
                                        <div class="col-md-8 mx-auto">
                                            <div class="advert">
                                            <div class="small-4 leaderboard columns">
                                                    <a class="main" href="<?php echo $row->add_link; ?>" target="_blank" title="<?php echo $row->add_title; ?>"><img class="banner" src="<?php echo base_url('images/add/'.$row->add_id.$row->img_ext)?>" style="max-height: 250px"> </a>
                                                    <div class="share-click">
                                                        <a class="button" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?>&t=Shyamal Sylhet" target="_blank"><i class="fab fa-facebook"></i></a>
                                                        <a class="button" href="http://twitter.com/share?text=Shyamal Sylhet&url=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?> &hashtags=Daily_Shyamal_Sylhet" target="_blank"><i class="fab fa-twitter"></i></a>
                                                        <a class="button" href="https://web.whatsapp.com/send?text=<?php echo base_url('images/add/'.$row->add_id.$row->img_ext); ?>" target="_blank"><i class="fab fa-whatsapp"></i></a>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    <?php }
                                }
                            }
                        ?>
                    </div>
                </div>
                <?php
                    if($category_wise_news){
                        $count = 0;
                        foreach($category_wise_news as $row){
                            $folder_name = ceil($row->news_id / 1000);
                            $count++; ?>
                                <div class="col-md-2">
                                    <div class="card text-center cat-writer">
                                        <div class="writer-img">
                                            <img width="100" height="100" class="rounded-circle" src="<?php echo ($row->img_ext) ? base_url('images/news/' . $folder_name . '/thumb' . '/' . $row->news_id . $row->img_ext) : $default_image ?>">
                                        </div>
                                        <div class="card-body">
                                            <a href="<?php echo base_url('opinion/'.$row->news_id); ?>">
                                                <h5 class="card-title"><?php echo stripslashes($row->news_headline); ?></h5>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php 
                            
                        }
                    }
                ?>
            </div>
        </div>
    </section>
</div>