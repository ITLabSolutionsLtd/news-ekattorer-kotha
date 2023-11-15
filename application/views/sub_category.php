<?php 
    $default_image  = base_url('images/default-ekattorer-kotha.jpg') ;
    $thumb = '/thumb'.'/' ;
    $small = '/small'.'/' ;
?>

<style>
    .alert-danger {
        color: #ffffff;
        background-color: #fe00009c;
        border-color: #f5c2c7;
    }
</style>

<div class="body-add-box-one advertise  py-3">
    <div class="container leaderboard">
        <a href="#" class="d-flex justify-content-center align-items-center">
            <?php
                if($news_advertise){
                    foreach($news_advertise as $row){
                        if($row->position == 1){
                            echo '<img src="'.base_url("images/add/".$row->add_id.$row->img_ext).'">';
                        }
                    }
                }
            ?>
        </a>
    </div>
</div>

<section class="master-multi py-2">
    <div class="container">
        <div class="page-wrap">
            <div class="section-title-style">
                <h1 class="overlay-title"><?php echo $subcat_segment; ?></h1>
                <h3 class="child-overlay-title"><?php echo $subcat_segment; ?></h3>
            </div>
            <div class="row">
                <div class="col-xl-9 col-lg-9">
                    <div class="row" id="load_data_table">
    
                    <?php if($subCategoryNews){
                        $count = 0;
                        foreach($subCategoryNews as $row){
                            $count++;
                            $folder = ceil($row->news_id / 1000);
                            if($count == 1){ ?> 
                                <div class="col-xl-12 mb-3">
                                    <div class="center-large-div">
                                        <div class="row">
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-6 col-12">
                                                <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                    <div class="">
                                                        <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.'/'.$row->news_id.$row->img_ext.'?newst='.strtotime($row->news_mod_date.$row->news_mod_time)) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                                    </div>
                                                </a>
                                            </div>
    
                                            <div class="col-xl-6 col-lg-6 col-md-6 col-12 mt-md-0 mt-3 d-flex justify-content-center align-items-center">
                                                <div class="ratio-content-large-div">
                                                    <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                        <h1 class="lead-headding"> <?php echo stripslashes($row->news_headline);?> </h1>
                                                    </a>
                                                    <div class="d-flex justify-content-start align-items-center">
                                                        <a href="#" class="tag"> <span></span> <input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $row->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($row->news_pub_date . ' ' . $row->news_pub_time)) ?>"> </a>
                                                    </div>
                                                    <p><?php  if($row->news_details_brief) echo '<p>'.word_limiter($row->news_details_brief, 15).'</p>'; ?></p>
    
                                                </div>
                                            </div>
                                        </div>
    
                                    </div>
                                </div>
                            <?php 
                            }else{ ?> 
                                <div class="col-xl-3 col-lg-3 col-md-6 col-6">
                                     <div class="child-div-two">
                                        <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                            <div class="">
                                                <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/'.$folder.'/'.$row->news_id.$row->img_ext.'?newst='.strtotime($row->news_mod_date.$row->news_mod_time)) : $default_image; ?>" alt="<?php echo $row->news_headline; ?>" width="100%">
                                            </div>
                                        </a>
                                        <div class="content-box">
                                            <a href="<?php echo base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)); ?>">
                                                <h1 class="lead-headding"><?php echo stripslashes($row->news_headline);?></h1>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo $row->cat_id; ?>" id="fetch_cat_id">
                                <input type="hidden" value="<?php echo $row->sub_cat_id; ?>" id="fetch_subcat_id">
                            <?php 
                            }
                            if (next($subCategoryNews)==false) {?> 
                         
                                <?php if($count == 13){ ?>
                                    <div class="load-more-btn d-flex justify-content-center align-items-center">
                                        <div class="more-btn" id="remove_row">
                                            <button type="button" name="btn_more" data-vid="<?php echo $row->news_id; ?>" id="btn_more" class="btn  more-btn-load">আরো</button>
                                        </div>
                                    </div> 
                                <?php } 
                            } 
                        }
                    }
                    else{ ?>
                        <div class="col-md-12">
                            <div class="alert alert-danger text-center" role="alert">
                                <h4 class="mb-0"><strong>দুঃখিত</strong> , এ বিষয়ে কোন তথ্য পাওয়া যায়নি !</h4>
                            </div>
                        </div>
                    <?php 
                    }
                    
                    ?>
    
                    </div> <!---row--->
                </div>
    
                <div class="col-xl-3 list-part">
                    <div class="div-title">
                        <h3 class="title-one">সর্বশেষ</h3>
                    </div>
                    <div class="list-box-two mt-3">
                        <?php
                            if($latest_news){
                                foreach($latest_news as $key => $item){ 
                                    $folder = ceil($item->news_id / 1000); 
                                    ?>
                                    <div class="list-box <?php if($key == 4) echo 'border-0'?>" >
                                        <div class="image-part">
                                            <img class="lazy" data-src="<?php echo ($item->img_ext) ? base_url('images/news/'.$folder.$small.$item->news_id.$item->img_ext.'?newst='.strtotime($item->news_mod_date.$item->news_mod_time)) : $default_image; ?>" alt="<?php echo $item->news_headline; ?>" width="100%">
                                        </div>
                                        <div class="content-list">
                                            <a href="<?php echo base_url('details/'.$item->news_id.'/'.seoURL($item->news_headline)); ?>">
                                                <p><?php echo stripslashes($item->news_headline); ?></p>
                                            </a>
                                            <small class="list-time"><input type="hidden" class="previous_date" id="prev_time" data-news_id="<?php echo $item->news_id ?>" value="<?php echo date("m d Y H:i:s", strtotime($item->news_pub_date . ' ' . $item->news_pub_time)) ?>"></small>
                                        </div>
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
</section>