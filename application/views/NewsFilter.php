<section class="news-filter">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <form action='<?php echo base_url(); ?>archive' method='get'>
                    <div class="search-filter">
                        <input type="text" value="<?php if ($search_item) echo $search_item; ?>" name="search" id="">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </div>
                </form>
            </div>
        </div>
        <hr>

        <div class="row mt-3">
            <div class="col-md-3">
                <div class="filter-heading">
                    <h2>অনুসন্ধান</h2>
                    <!-- <p style="float: right;"><small>প্রাপ্ত ফলাফল: <strong><?php if ($archive_news_list) echo bn_date(sprintf('%02d', COUNT($archive_news_list))); ?></strong></small></p> -->
                </div>
                <br>
                <div class="widget-content">

                    <form action="<?php echo base_url() ?>news-filter" method="get">

                        <ul id="accordion">
                            <li>
                                <h4>ক্যাটাগরি <span class="plusminus"> ▽ </span></h4>
                                <ul>
                                    <li>
                                        <input type="hidden" name="search" value="<?php echo $search_item; ?>">
                                        <select name="category" id="" class="form-control">
                                            <option value="">সিলেক্ট করুন</option>
                                            <?php
                                            foreach ($category_info as $row) { ?>
                                                <option value="<?php echo $row->cat_id ?>" <?php if (isset($cat_id) && $cat_id == $row->cat_id) echo 'selected'; ?>><?php echo $row->cat_name ?></option>
                                            <?php }
                                            ?>
                                        </select>
                                    </li>

                                </ul>
                            </li>
                            <li>
                                <h4>সাজানো <span class="plusminus">▽ </span></h4>
                                <ul>
                                    <li>

                                        <?php
                                        echo form_dropdown('sortType', $sortType, $sortTypeValue, 'class="form-control"');
                                        ?>

                                    </li>
                                </ul>
                            </li>
                            <li>
                                <h4>তারিখ <span class="plusminus">▽ </span></h4>

                                <ul>


                                    <li style="width: 45%; float: left;"><input type="text" data-toggle="datepicker" value="<?php if (isset($d1)) echo $d1; ?>" name="start_date" class="form-control" placeholder="শুরু" onkeydown="return false"></li>
                                    <li style="width: 45%; float: right;"><input type="text" data-toggle="datepicker" value="<?php if (isset($d2)) echo $d2; ?>" name="end_date" class="form-control" placeholder="শেষ" onkeydown="return false"></li>


                                </ul>

                            </li>

                            <center>

                                <button type="submit" class="btn btn-sm btn-primary" style="font-size: 20px;">খুজুন</button>
                            </center>
                        </ul>
                    </form>
                </div>
            </div>
            <div class="col-md-6 pb-2" id="load_data_table">
                <?php
                if ($filter_news) {
                    $count = 0;
                    foreach ($filter_news as $row) {
                        $folder_name = ceil($row->news_id / 1000);
                        $count++;
                        if ($row->cat_id == 5) {
                            $url_1 = 'opinion/';
                        } else {
                            $url_1 = 'news/';
                        }
                ?>
                        <div class="news-more">
                            <div class="news-content">
                                <h2><a href="<?php echo base_url($url_1 . $row->news_id) ?>"><?php echo ($row->headline_tag) ? '<span>' . stripslashes($row->headline_tag) . '</span> / ' . stripslashes($row->news_headline) : stripslashes($row->news_headline) ?></a></h2>
                                <p class="news-brief-details"><?php echo word_limiter(stripslashes($row->news_details_brief), 18) ?></p>
                                <div class="news-time">
                                    <p class="mb-0"><?php echo bn_date(date('d M Y H:i', strtotime($row->news_pub_date . $row->news_pub_time))) ?></p>
                                </div>
                            </div>
                            <div class="news-image">
                                <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/' . $folder_name . '/small' . '/' . $row->news_id . $row->img_ext) : $default_image ?>" alt="">
                            </div>
                        </div>
                        <hr>

                        <?php
                        if ($count == 10) { ?>
                            <div class="more-btn" id="remove_row">
                                <button type="button" name="btn_more" data-search="<?php echo $search_item; ?>" <?php if (isset($cat_id)) { ?> data-cat="<?php echo $cat_id ?>" <?php } ?> <?php if (isset($sortTypeValue)) { ?> data-sort="<?php echo $sortTypeValue ?>" <?php } ?> <?php if (isset($d1)) { ?> data-date1="<?php echo $d1 ?>" <?php } ?> <?php if (isset($d2)) { ?> data-date2="<?php echo $d2 ?>" <?php } ?> data-vid="<?php echo $row->news_id; ?>" id="btn_filter_more_avd" class="btn btn-primary form-control more-btn-load">আরো</button>
                            </div>
                        <?php       }
                    }
                } else {
                    if (isset($archive_news_list)) {
                        if($archive_news_list == '') {echo 'No data';}
                        
                        else {
                            $count = 0;
                            foreach ($archive_news_list as $row) {
                            $folder_name = ceil($row->news_id / 1000);
                            $count++;
                            if ($row->cat_id == 5) {
                                $url_1 = 'opinion/';
                            } else {
                                $url_1 = 'news/';
                            }
                        ?>
                            <div class="news-more">
                                <div class="news-content">
                                    <h2><a href="<?php echo base_url($url_1 . $row->news_id) ?>"><?php echo ($row->headline_tag) ? '<span>' . stripslashes($row->headline_tag) . '</span> / ' . stripslashes($row->news_headline) : stripslashes($row->news_headline) ?></a></h2>
                                    <p class="news-brief-details"><?php echo word_limiter(stripslashes($row->news_details_brief), 18) ?></p>
                                    <div class="news-time">
                                        <p class="mb-0"><?php echo bn_date(date('d M Y H:i', strtotime($row->news_pub_date . $row->news_pub_time))) ?></p>
                                    </div>
                                </div>
                                <div class="news-image">
                                    <img class="lazy" data-src="<?php echo ($row->img_ext) ? base_url('images/news/' . $folder_name . '/small' . '/' . $row->news_id . $row->img_ext) : $default_image ?>" alt="">
                                </div>
                            </div>
                            <hr>

                            <?php
                            if ($count == 10) { ?>
                                <div class="more-btn" id="remove_row">
                                    <button type="button" name="btn_more" data-search="<?php echo $search_item; ?>" data-vid="<?php echo $row->news_id; ?>" id="btn_filter_more" class="btn btn-primary form-control more-btn-load">আরো</button>
                                </div>
                <?php       }
                        }
                        }
                    }
                    
                }

                ?>


                <!-- <div class="more-btn">
                    <button class="btn btn-primary">আরো</button>
                </div> -->

            </div>
            <div class="col-md-3">
                <div class="top-advertise">
                    <img src="images/ads/8024890831010512924.png" alt="" width="100%">
                </div>
            </div>
        </div>
    </div>
</section>