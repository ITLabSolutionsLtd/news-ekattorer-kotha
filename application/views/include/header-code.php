<?php
    $title_default          = "দৈনিক একাত্তরের কথা | প্রতিদিনের প্রতিচ্ছবি";
    $key_default            = "একাত্তরেরকথা, একাত্তরের কথা, একাত্তর, খবর, Newsportal, সিলেটের পত্রিকা, নিউজ পেপার, খবর, সংবাদপত্র ";
    $news_description       = "Ekattorer Kotha is a Online Newsportal & Printed Newspaper from Bangladesh. ";
    // $news_url               = $ampURL = base_url();
    ?>

    <!-- Php Function  -->
    <?php

    $timezone = "Asia/Dhaka";
    date_default_timezone_set($timezone);

    function string_replace($str)
    {
        $from = array("1", "2", "3", "4", "5", "6", "7", "8", "9", "0");
        $to = array("১", "২", "৩", "৪", "৫", "৬", "৭", "৮", "৯", "০");
        return  str_replace($from, $to, $str);
    }

    function replaceChar($str)
    {
        $from = array('_');
        $to   = array(' ');
        return str_replace($from, $to, $str);
    }
    function replaceDays($str)
    {
        $from = array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
        $to   = array('শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার');
        return str_replace($from, $to, $str);
    }

    function replaceDash($str)
    {
        $from = array('-');
        $to   = array(' ');
        return str_replace($from, $to, $str);
    }

    function seoURL($str)
    {
        $from = array(' ', '!', '’', '‘', ':', '.', '?', ',', 'ঃ', "'", '%');
        $to   = array('-', '-', '', '', '', '', '-', '-', '-', '','');
        return str_replace($from, $to, $str);
    }

    function isMobile()
    {
        return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
    }

    function limit_text($text, $limit)
    {
        if (strlen($text) > $limit) {
            $text = substr($text, 0, $limit);
            $text = substr($text, 0, - (strlen(strrchr($text, ' '))));
        }
        return $text;
    }

    function insertAd($content, $ad, $pos = 0){
        $count = substr_count($content, "</p>");
        if($count == 0  or $count <= $pos){
            return $content;
        }
        else{
            if($pos == 0){
                $pos = rand (1, $count - 1);
            }

            for($pos; $pos <= $count; $pos += 3){
                $content = preg_replace('|</p>|', '<helper>', $content, $pos+1);
                // $content = preg_replace('|</p>|', '<helper>', $content, $pos + 1);
                $content = preg_replace('|<helper>|', '</p>', $content, $pos);
                $content = str_replace('<helper>', '<br>'.$ad . "</p>", $content);
                
            }
            return $content; 
        }
    }

    // include 'banglaDate.php';
    function bn_convert($str)
    {
        $en = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
        $bn = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
        $str = str_replace($en, $bn, $str);
        $en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
        $en_short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
        $bn = array('জানুয়ারি', 'ফেব্রুয়ারি', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
        $str = str_replace($en, $bn, $str);
        $str = str_replace($en_short, $bn, $str);
        $en = array('Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday');
        $en_short = array('Sat', 'Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri');
        $bn_short = array('শনি', 'রবি', 'সোম', 'মঙ্গল', 'বুধ', 'বৃহঃ', 'শুক্র');
        $bn = array('শনিবার', 'রবিবার', 'সোমবার', 'মঙ্গলবার', 'বুধবার', 'বৃহস্পতিবার', 'শুক্রবার');
        $str = str_replace($en, $bn, $str);
        $str = str_replace($en_short, $bn_short, $str);
        $en = array('AM', 'PM');
        $bn = array('পূর্বাহ্ন', 'অপরাহ্ন');
        $str = str_replace($en, $bn, $str);
        return $str;
    }



    $segment = $this->uri->segment(1);
    $news_image = base_url()."images/default-ekattorer-kotha.jpg";
    $news_keyword = $news_headline = $meta_description = '';

    if ($segment == "details") {
        if ($specific_news) {
            foreach ($specific_news as $row) : {

                    if ($row->news_details_brief)
                        $long = stripslashes($row->news_details_brief);
                    else
                        $long = stripslashes($row->news_details);

                    $news_description = strip_tags($long);
                    $news_description = limit_text($news_description, 600);

                    $meta_description = stripslashes($row->seo_description);
                    $meta_description = strip_tags($meta_description);

                    $news_description = ($meta_description) ? $meta_description : $news_description;
                    $news_headline = ($row->seo_title) ? stripslashes($row->seo_title) : stripslashes($row->news_headline);
                    $news_keyword = ($row->seo_keyword) ? $row->seo_keyword : '';
                    $folder_name = ceil($row->news_id / 1000);
                    $news_url = base_url() . 'details/' . $row->news_id.'/'.seoURL($row->news_headline);
                    // $ampURL = base_url() . 'news/amp/' . $row->news_id;

                    if ($row->img_ext != '') {
                        $filename = getcwd().'/images/news/'.$folder_name.'/share'.'/'.$row->news_id . $row->img_ext;
                        if (file_exists($filename) != null) {
                            $news_image = base_url() . 'images/news/' . $folder_name . '/share'.'/' . $row->news_id . $row->img_ext;
                        } 
                        if(file_exists($filename) == null) {
                            $news_image = base_url() . 'images/news/' . $folder_name . '/' . $row->news_id . $row->img_ext;
                        }
                    }
                    if ($row->img_ext == '') {
                        $news_image = base_url() . 'images/default-ekattorer-kotha.jpg';
                    }
                }
            endforeach;
        }
    }
    if ($segment == "opinion" && $this->uri->segment(2) != '') {
        if ($specific_news) {
            foreach ($specific_news as $row) : {

                    if ($row->news_details_brief)
                        $long = stripslashes($row->news_details_brief);
                    else
                        $long = stripslashes($row->news_details);

                    $news_description = strip_tags($long);
                    $news_description = limit_text($news_description, 600);

                    $meta_description = stripslashes($row->seo_description);
                    $meta_description = strip_tags($meta_description);

                    $news_description = ($meta_description) ? $meta_description : $news_description;
                    $news_headline = ($row->seo_title) ? stripslashes($row->seo_title) : stripslashes($row->news_headline);
                    $news_keyword = ($row->seo_keyword) ? $row->seo_keyword : '';
                    $folder_name = ceil($row->news_id / 1000);
                    $news_url = base_url() . 'details/' . $row->news_id.'/'.seoURL($row->news_headline);
                    // $ampURL = base_url() . 'news/amp/' . $row->news_id;

                    if ($row->img_ext != '') {
                        $news_image = base_url() . 'images/news/' . $folder_name . '/' . $row->news_id . $row->img_ext;
                    }
                    if ($row->img_ext == '') {
                        $news_image = base_url() . 'images/default-ekattorer-kotha.jpg';
                    }
                }
            endforeach;
        }
    }



    if ($news_keyword)
        $news_keyword = $news_keyword . ',' . $key_default;
    else
        $news_keyword = $key_default;



    if ($segment == 'details')
        $title    = replaceDash($news_headline) ;
    else if ($segment == 'opinion' && $this->uri->segment(2) != '')
        $title    = replaceDash($news_headline) ;

    else if ($segment == "index")
        $title = 'Home - ' . $title_default;
    else if ($segment == "archive")
        $title = 'আর্কাইভ - ' . $title_default;
    else if ($segment == "about")
        $title = 'আমাদের পরিবার - ' . $title_default;
    else if ($segment == "pol_details")
        $title = 'Pol - ' . $title_default;
    else if ($segment == "subscribtion")
        $title = 'News Subscribtion - ' . $title_default;
    else if ($segment == "login")
        $title = 'Log In - ' . $title_default;
    else if ($segment == "video_gallery")
        $title = 'Video Gallery - ' . $title_default;
    else if ($segment == "video")
        $title = 'Video - ' . $title_default;
    else if($segment == "topic"){
        if($seo_title){
            $title = $seo_title.' - '.$title_default;
        }
        if($seo_keywords){
            $news_keyword = $seo_keywords . ',' . $key_default;
        }
        if($seo_description){
            $news_description = $seo_description;
        }
        if($seo_image){
            $news_image = $seo_image;
        }
    }

    else if (isset($cat_segment)) {
        $title = $cat_segment . ' - ' . $title_default;
    } else if (isset($subcat_segment)) {
        $title = $subcat_segment . ' - ' . $title_default;
    } else if ($this->uri->segment(1) == '')
        $title = $title_default . '' . '';
    else
        $title = ucwords(replaceDash($this->uri->segment(1))) . ' - ' . $title_default;
    ?>
    <title> <?php echo replaceChar($title); ?> </title>
    
    <?php
	if ($segment == "details") {
		if ($specific_news) {
			foreach ($specific_news as $row) : {
					$seg3 = $this->uri->segment(1);
					$seg4 = $this->uri->segment(2);?>
					<meta name="description" content="<?php echo $news_description; ?> " />
					<meta property="og:description" content="<?php echo $news_description; ?>" />
					<meta property="og:url" content="<?php echo $news_url; ?>" />
					<meta property="og:image" content="<?php echo $news_image; ?>" /> <?php
    			}
    		endforeach;
    	}
    } else { ?>

        <meta property="og:title" content="<?php echo $title; ?>" />
        <meta name="keywords" content="<?php echo $key_default; ?>">
        <meta property="og:keywords" content="<?php echo $key_default; ?>">
		<meta name="description" content="<?php echo $news_description; ?>" />
		<meta property="og:description" content="<?php echo $news_description; ?>" />
		<meta property="og:image" content="<?php echo $news_image; ?>" />
	<?php
	    }
	?>

