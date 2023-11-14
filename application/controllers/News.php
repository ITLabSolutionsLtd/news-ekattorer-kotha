<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class News extends CI_Controller{
        public function __construct()
        {
            parent::__construct();
            
            $this -> load -> library('form_validation');
            $this -> load -> library('javascript');
            $this -> load -> library('tank_auth');
            $this -> load -> model('query_model');
            date_default_timezone_set("Asia/Dhaka");
            
       }

        function isMobile() {
            return preg_match("/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i", $_SERVER["HTTP_USER_AGENT"]);
        }

        function visitor_counter()
	    {
            // return true;
            $DateToday=date("Y-m-d");
            if(!$this -> tank_auth -> get_temp_session_status( 'visitor' ))
            {
                $time=date('H:i:s');  //00:05:00 - 5 minutes
                if((strtotime($time)>=strtotime('00:00:00')) && (strtotime($time)<=strtotime('12:00:00'))){
                    $currentDate = $this-> query_model-> visitor_current_date();

                    if($DateToday!=$currentDate)
                        $this-> query_model-> create_daily_visitor_row($DateToday);
                }
                
                $this -> tank_auth -> set_temp_session( 'visitor' );
                $visitorToday=$this-> query_model-> daily_visitor_today();

                if($visitorToday){
                    foreach($visitorToday as $row):{
                        $dayID=$row-> day_id;
                        $todayVisitor=$row-> day_visitor;
                    }
                    endforeach;
                    $this-> query_model-> updateDailyVisitor($dayID, $todayVisitor);  /* ALL VISTIOR COUNTER INCREMENT */
                }
            }
        }

        public function index(){

            $this->visitor_counter(); 

            $data['isMobile'] = $this->isMobile();
            $data['news_advertise']         = $this-> query_model->news_advertise_info();
            $data['newspaper']              = $this-> query_model->page_info();
            $data['latest_news']            = $this-> query_model-> latest_news_info(10);
            $data['lead_news']              = $this-> query_model-> head_line_info(1);
            $data['breaking_news']          = $this-> query_model-> breaking_news_info();
            $data['top_news']               = $this-> query_model-> top_news_info(10);
            $data['selective_news']         = $this-> query_model-> selective_news_info(2);
            $data['popular_ten_news']       = $this-> query_model-> popular_seven_news_info_updated(10);

            $data['wc_news']                = '';
            // $data['wc_news']                = $this-> query_model->common_news_info_updated_by_subcategory('sports', 'football-wc', 8);
            $data['segment_news']           =  $this->segment_check();
            
            $data['sylhet_news']            = $this-> query_model-> common_news_info_updated_sylhet('sylhet', 6);

            $data['national_news']          = $this->query_model->common_news_info_updated('national', 4);
            $data['politics_news']          = $this->query_model->common_news_info_updated('politics', 4);

            $data['dosdik_news']            = $this->query_model->common_news_info_updated('news-around', 3);
            $data['hridoye_ekattor']        = $this->query_model->common_news_info_updated('hridoye-ekattor', 3);
            $data['aboard_news']            = $this->query_model->common_news_info_updated('aboard', 3);
            $data['rupali_kotha_news']      = $this->query_model->common_news_info_updated('rupali-kotha', 10);
            $data['sports_news']            = $this->query_model->common_news_info_updated('sports', 5);

            $data['presbox_news']           = $this->query_model->common_news_info_updated('press-box', 3);
            $data['tech_news']              = $this->query_model->common_news_info_updated('info-tech', 3);
            $data['all_arround_news']       = $this->query_model->common_news_info_updated('all-around-news', 3);
            $data['economy_news']           = $this->query_model->common_news_info_updated('economy', 3);
            $data['opinion_news']           = $this->query_model->common_news_info_updated_opinion('opinion', 3);


            $data['main_content'] = 'home-main';
            $this->load->view('include/template',$data);
        }
        
        function segment_check(){
            $date = date('Y-m-d');
            return $this->query_model-> date_range_check($date); 
        }
        

        /*-----------------------------------------------------/ 
        /--------------------- NEWS DETAILS -------------------/
        /-----------------------------------------------------*/

        
        function details($news_id, $news_slug = '')
        {
            $this->visitor_counter(); 

            $data['isMobile']               = $this->isMobile();
            $data['news_advertise']         = $this-> query_model-> news_advertise_info();
            $data['latest_news']            = $this-> query_model-> latest_news_info(5);
            $data['newspaper']              = $this-> query_model-> page_info();
            $data['specific_news']		    = $this-> query_model-> single_news_info_updated($news_id);

            if($data['specific_news'] == ''){
                redirect('');
            }

            $data['newsID']                 =  $data['specific_news'][0]->news_id ; 
            $data['postCategory']           =  $data['specific_news'][0]->cat_id ;
            $author_id                      =  $data['specific_news'][0]->author_id; 

            $data['authorInfo']			    = $this-> query_model-> writerInfo($news_id, 1);
		    $data['reporterData']		    = $this-> query_model-> writerInfo($news_id, 2);

            $category                       = $data['specific_news'][0]->cat_key_name;
            $data['cat_key_name']           = $data['specific_news'][0]->cat_key_name;
            $data['category_bn']            = $data['specific_news'][0]->cat_name;
            $data['category_wise_news']	    = $this-> query_model-> category_wise_news_info($category, $news_id, 6);
      

            $news_reader_number			= $this-> query_model-> news_reader_number_updated($news_id);
            $data['news_reader']		= "";
            
            if(!$this-> tank_auth-> get_temp_session_status($news_id)){ 
                $this-> session-> set_userdata(array('temp_session_'.$news_id => true));
                $data['news_reader']	= $this-> query_model-> news_reader_increment_updated($news_id, $news_reader_number);
            }
            $data['newsID']				    = $news_id;
            $data['main_content'] = 'details';
            $this->load->view('include/template', $data);
        }

        function OpinionDetails($news, $news_id)
        {
            $data['isMobile'] = $this->isMobile();
            $data['news_advertise']         = $this->query_model->news_advertise_info();
            $data['newspaper']              = $this->query_model->page_info();
            $data['specific_news']		    = $this-> query_model-> single_news_info_updated($news_id);
            $data['newsID']         =  $data['specific_news'][0]->news_id ; 
            $data['postCategory']   =  $data['specific_news'][0]->cat_id ;
            

            $data['writer_list']    = $this->query_model->writer_list(10);
            $data['authorInfo']	    = $this-> query_model-> writerInfo($news_id, 1);
		    $data['reporterData']	= $this-> query_model-> writerInfo($news_id, 2); 

            if($data['specific_news'] == ''){
                redirect('');
            }
            $category                   = $data['specific_news'][0]->cat_key_name;
            $data['category_wise_news']	= $this-> query_model-> category_wise_news_info($category, $news_id, 6);
            $data['latest_ten_news']        = $this-> query_model-> latest_news_info(10);
            
            $data['newsID']				= $news_id;
            $data['main_content'] = 'opinion';
            $this->load->view('include/template', $data);
        }

        

        public function load_data(){
            $this->query_model-> load_data($this->input->post('id'), $this->input->post('cat'),$this->input->post('limit'), $this->input->post('start'));
        }


    



        /*------------------------------------------------------------------/ 
        /------------------------ CATEGORY DETAILS -------------------------/
        /------------------------------------------------------------------*/
        
        function category($category)
        {
            $this->visitor_counter(); 
            $data['isMobile']                   = $this->isMobile();
            $data['news_advertise']		        = $this-> query_model-> news_advertise_info();
            $data['latest_news']                = $this-> query_model-> latest_news_info(5);
            $data['newspaper']                  = $this->query_model->page_info();
            $category_id                        = $this-> query_model-> news_category_id($category);
            $catName                            = $category;
            $segment_name                       = $this-> uri-> segment(4);
            if($category){
                $data['category_wise_news']     = $this->query_model->category_wise_news_all_info($catName, 13);
                $data['get_cat_name']           = $this->query_model->get_cat_name($category);
                $data['cat_segment']            = $data['get_cat_name'][0]->cat_name; 
            }
            $data['res'] = '';
            $data['main_content'] = 'category';
            $this->load->view('include/template', $data);
        }

        public function Loadmore_category(){
            if($this->input->post('news_id')){
                $cat_id = $this->input->post('cat');

                if($this->input->post('segment') == 'author'){
                     $this->query_model->load_category_author($cat_id, $this->input->post('news_id'));
                }
                else{
                    $subcat_id = $this->input->post('subcat');
                    $total = $this->query_model->load_category($cat_id, $subcat_id, $this->input->post('news_id'));
             
                } 
            }
        }


        /*------------------------------------------------------------------/ 
        /---------------------- SUB CATEGORY DETAILS -----------------------/
        /------------------------------------------------------------------*/
	
        function subcategory($category,$subCategory)
        {
            $data['isMobile']                   = $this->isMobile();
            $data['news_advertise']		        = $this-> query_model-> news_advertise_info();
            $data['latest_news']                = $this-> query_model-> latest_news_info(5);
            $data['newspaper']                  = $this-> query_model->page_info();
        
            $data['cat_name']                   = $category; 
            $data['subCategoryNews'] 	        = '';
            $limit 						        = 13;

            if($subCategory){
                $data['subCategoryNews']	    = $this-> query_model-> subCategoryWiseNewsUpdated($subCategory, $limit);
                $data['getSubcategory']         = $this->query_model->get_subcategory($subCategory);
                $data['category']               = $category;
                $data['getCategory']            = $this->query_model->get_cat_name($category);
                $data['subcat_segment']         = $data['getSubcategory'][0]->sub_cat_name; 
            }

            $data['main_content']               = 'sub_category';
            $this->load->view('include/template', $data);
        }

        /*-----------------------------------------------------------/ 
        /------------------------- Author --------------------------/
        /-----------------------------------------------------------*/

        function replaceDash($str)
        {
            $from = array('-');
            $to   = array(' ');
            return str_replace($from, $to, $str);
        }

        public function author($author_id, $author_bn){
            $data['isMobile']               = $this->isMobile();
            $data['news_advertise']         = $this->query_model->news_advertise_info();
            $data['newspaper']              = $this->query_model->page_info();
            $data['latest_ten_news']        = $this-> query_model-> latest_news_info(10);

            $this->load->library('pagination');
            $config['base_url']         = base_url('author/'.$author_id.'/'.$author_bn);  
            $config = array();
            $config["base_url"]         = base_url('author/'.$author_id.'/'.$author_bn);  
            $config["total_rows"]       = $this->query_model->count_row_for_spc_author($author_id);
            $config["per_page"]         = 20;
            $config["uri_segment"]      = 4;


            //config for bootstrap pagination class integration
            $config['full_tag_open'] = '<ul class="pagination">';
            $config['full_tag_close'] = '</ul>';
            $config['first_link'] = false;
            $config['last_link'] = false;
            $config['first_tag_open'] = '<li>';
            $config['first_tag_close'] = '</li>';
            $config['prev_link'] = '&laquo';
            $config['prev_tag_open'] = '<li class="prev">';
            $config['prev_tag_close'] = '</li>';
            $config['next_link'] = '&raquo';
            $config['next_tag_open'] = '<li>';
            $config['next_tag_close'] = '</li>';
            $config['last_tag_open'] = '<li>';
            $config['last_tag_close'] = '</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">';
            $config['cur_tag_close'] = '</a></li>';
            $config['num_tag_open'] = '<li>';
            $config['num_tag_close'] = '</li>';

            $this->pagination->initialize($config);

            $authorID                       = $author_id;
            $data['author_info']            = $this-> query_model->author_info($authorID);
            $data['all_news_by_author']     = $this-> query_model-> all_news_author($authorID);

            $this->pagination->initialize($config);
            $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

            $data['author_wise_news']       = $this-> query_model-> get_author_wise_news($authorID, $config["per_page"], $page);
            // print_r($data['author_wise_news']); die(); 
            $data['main_content']           = 'authorwise_news';
            $this->load->view('include/template', $data);
        }


        function PrintNews($news_id){
            $data['print_data'] = $this->query_model -> print_news($news_id);
            $this->load->view('print', $data);
            
        }



        /*-----------------------------------------------------------/ 
        /------------------------- ARCHIVE --------------------------/
        /-----------------------------------------------------------*/

        function date_bn_en($str)
        {
            $en = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0, '-');
            $bn = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০', '/');
            $str = str_replace($bn, $en, $str);
            return $str;
        }


        public function archive()
        {
            $data['isMobile']               = $this-> isMobile();
            $data['news_advertise']         = $this-> query_model -> news_advertise_info();
            $data['latest_news']            = $this-> query_model -> latest_news_info(5);
            $data['newspaper']              = $this-> query_model -> page_info();

            $news_keyword	= $this-> input-> get('search');
            $date = $this->input->get('date');


            if ($date && $news_keyword) {
                $date_bn =  $this->date_bn_en($date); 
                $date = date('Y-m-d', strtotime($date_bn));
                
                $data['archive_news_list']          = $this->query_model->date_key_wise_news_list($date, $news_keyword);
                $data['date']                       = $date;
                $data['search_item']                = $news_keyword;
            } 
           
            else {
                if ($date) {
                    $date_bn =  $this->date_bn_en($date); 
                    $date = date('Y-m-d', strtotime($date_bn));

                    $data['archive_news_list']   = $this->query_model->date_wise_news_list($date);
                    $data['date']                = $date;
                    $data['search_item']         = ''; 
                } 

                if ($news_keyword) {
                    $data['archive_news_list']      = $this->query_model->keyword_wise_news_list($news_keyword);
                    $data['search_item']            = $news_keyword;
                    $data['date']                   = '';
                    // print_r($data['archive_news_list']); die();

                
            
                }
            }

            $data['main_content'] 		= 'news_archive';
            $this->load->view('include/template', $data);
        }


        public function news_filter(){
            $data['isMobile'] = $this->isMobile();
            $data['latest_ten_news']        = $this-> query_model-> latest_news_info(10);

            $date2                          = $this->input->get('end_date');
            $sortType                       = $this->input->get('sortType');

            $data['category_info']          = $this->query_model->category_list();
            $data['sortType']               = array('date-new' => 'নতুন থেকে পুরোনো', 'date-old' => 'পুরোনো থেকে নতুন');

            $data['filter_news']            = $this->query_model->news_list_report($subject,$category, $date1, $date2, $sortType);

            $data['search_item']                = $this->input->get('search');
            $data['cat_id']                     = $this->input->get('category');
            $data['d1']                         = $this->input->get('start_date');
            $data['d2']                         = $this->input->get('end_date');
            $data['sortTypeValue']              = $this->input->get('sortType');

            $data['main_content']         = 'NewsFilter';
            $this->load->view('include/template', $data);
            
        }

        public function Loadmore_filter_news(){
            if ($this->input->post('news_id')) {
                $src_item = $this->input->post('search_item');
                $this->query_model->load_news_all_filter($src_item, $this->input->post('news_id'));

            }
        }

        public function Loadmore_filter_news_avd()
        {
            if ($this->input->post('news_id')) {
                $src_item   = $this->input->post('search_item');
                $date      = $this->input->post('search_date');
                $this->query_model->load_news_all_filter_avd($src_item, $date, $this->input->post('news_id'));
            }
        }


        /*-----------------------------------------------------------/ 
        /------------------------- Tagwise News --------------------------/
        /-----------------------------------------------------------*/
        public function topic()
        {
            $data['isMobile']                   = $this->isMobile();
            $data['newspaper']                  = $this->query_model->page_info();
            $data['latest_news']                = $this-> query_model-> latest_news_info(10);

            $data['keyword_wise_news_list']     = '';
            $data['archive_news_list']          = '';
            $news_keyword                       = $this->input->get('subject');
            $data['title']                      = $news_keyword;
            $data['current_url']                = ''; 
            $data['seo_title']                  = '';
            $data['seo_description']            = '';
            $data['seo_keywords']               = '';
            $data['seo_image']                  = ''; 

            if ($news_keyword) {
                $check_topic           = $this->query_model->check_topic($news_keyword); 
                if($check_topic){
                    $data['title']              = $check_topic->segment_title;
                    $data['seo_title']          = $check_topic->segment_seo_title;
                    $data['seo_description']    = $check_topic->segment_seo_details;
                    $data['seo_keywords']       = $check_topic->segment_seo_keywords; 
                    $data['current_url']        = base_url('topic?subject='.$check_topic->segment_tag);
                    
                    if($check_topic->banner_show == 1){
                        if($check_topic->segment_banner_img){
                            $data['seo_image']          = base_url('images/segment/banner/'.$check_topic->segment_id.$check_topic->segment_banner_img); 
                        }
                    }
                }
                $data['topic_news_list']        = $this->query_model->tag_wise_news_list($news_keyword);
                $data['topic_subject_item']     = $news_keyword;
            }
            $data['main_content']               = 'tagwise_news';
            $this->load->view('include/template', $data);
        }

        public function about(){
            $data['isMobile'] = $this->isMobile();
            $data['news_advertise']        = $this->query_model->news_advertise_info();
            $data['latest_ten_news']        = $this-> query_model-> latest_news_info(10);
            $data['newspaper']              = $this->query_model->page_info();
            $data['aboard_subcategory']     = $this->query_model->fetch_menu('abroad');
            $data['secetary_info'] = $this->query_model->member_list(1);
            $data['reporter_info'] = $this->query_model->member_list(2);
            $data['photo_section_info'] = $this->query_model->member_list(3);
            $data['office_staff_info'] = $this->query_model->member_list(4);

            $data['main_content'] = 'about';
            $this->load->view('include/template', $data);
        }
        
        function newspaper($page_id ,$date1, $page_name){
            $data['isMobile']               = $this->isMobile();
            $data['news_advertise']         = $this->query_model->news_advertise_info();
            $data['newspaper']              = $this->query_model->page_info();
            $data['latest_ten_news']        = $this-> query_model-> latest_news_info(10);


            if($this->input->post('date')){
                $date = $this->input->post('date'); 
                $date_bn =  $this->date_bn_en($date); 
                $date = date('Y-m-d', strtotime($date_bn));
            }else{
                $date = $date1; 
                
            }
            $data['date'] = $date; 


            $page_query                     = $this->db->query('SELECT `page_id`,`name_bn`,`name` FROM `news_page_info` WHERE `page_id` = "'.$page_id.'" ');
            $page_id                        = $page_query->row()->page_id;
            $data['page_id']                = $page_id; 
            $data['page_name']              = $page_query->row()->name_bn;
            $data['newspaper_news']         = $this->query_model->newspaper_news($page_id,$date);
           

            $data['main_content'] = 'page_news';
            $this->load->view('include/template', $data);
        }

        public function ePaper(){
            $this->db->cache_off();
            $this->load->library("pagination");

            $config = array();
            $config["base_url"] = base_url('News/ePaper');
            $config["total_rows"] = $this->query_model->get_count();
            $config["per_page"] = 30;
            $config["uri_segment"] = 3;
            $config['full_tag_open'] = "<div id='pagination'>";
            $config['full_tag_close'] = '</div>';
            $config['prev_link'] = '«';
            $config['next_link'] = '»';
            $data['filter_data_ePaper'] = '';  
            $this->pagination->initialize($config);
            $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
            $data['ePaper_data'] = $this->query_model->e_paper_getData($config["per_page"], $page);
            $data['main_content'] = 'e_paper';
            $this->load->view('include/template', $data);
        }

        function filter_ePaper(){
            $subject    = $this->input->post('subject');
            $date = $this->input->post('date');

            $data['subject'] = $subject;
            $data['date'] = $date;

            // $date_new =  date('Y-m-d', strtotime($date));

            if ($subject || $date ) {
                $data['filter_data_ePaper']    = $this->query_model->filter_ePaper($subject, $date);
            }

            $data['ePaper_data'] = ''; 
            

            $data['main_content'] = 'e_paper';
            $this->load->view('include/template', $data);
        }


        function subscribe(){
        
            $data['newspaper']              = $this->query_model->page_info();
            $this->form_validation->set_rules('subscription_email', 'Email', 'required|valid_email|is_unique[subscription_tbl.subscription_email]');
            
            if($this->form_validation->run()== FALSE){
                $data['message'] = 'exist';
                $data['main_content'] = 'subscription/message';
                $this->load->view('include/template', $data);
            }
            else{
                $captcha_response = trim($this->input->post('g-recaptcha-response'));
                if($captcha_response != ''){
                    $keySecret = '6LdXA_gcAAAAAF-R6LfXBfgcAAAAAAo5w8VWpuQr53xBXiAIUN6b0m6T';
                    $check = array(
                        'secret'        => $keySecret,
                        'response'      =>$this->input->post('g-recaptcha-response'),
                    );
                    $startProcess = curl_init();

                    curl_setopt($startProcess, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
                    curl_setopt($startProcess, CURLOPT_POST, true);
                    curl_setopt($startProcess, CURLOPT_POSTFIELDS, http_build_query($check));
                    curl_setopt($startProcess, CURLOPT_SSL_VERIFYPEER, false);
                    curl_setopt($startProcess, CURLOPT_RETURNTRANSFER, true);
                    $receiveData = curl_exec($startProcess);
                    $finalResponse = json_decode($receiveData, true);
                    if($finalResponse)
                    {
                        $storeData = array(
                            'subscription_email'	=>	$this->input->post('subscription_email'),
                            'create_at'             => date('Y-m-d H:i:s'),
                            'status'                => '0'
                        );
                        $this->query_model->store_subscription($storeData);

                        // Email Sending System 
                        $from_email = "idevsoumitra@gmail.com";
                        $to_email = $this->input->post('subscription_email');
                        $this->load->helper('url');
                        $this->load->helper('form');
                        $email_config = Array(
                            'protocol'  => 'smtp',
                            'smtp_host' => 'ssl://smtp.googlemail.com',
                            'smtp_port' => '465',
                            'smtp_user' => 'idevsoumitra@gmail.com',
                            'smtp_pass' => 'gmmhqtxcnocdkbnh',
                            'mailtype'  => 'html',
                            'starttls'  => true,
                            'newline'   => "\r\n"
                        );

                        $this->load->library('email', $email_config);
                        $verify_email['email'] = $this->input->post('subscription_email');
                        $mesg = $this->load->view('subscription/verify_email',$verify_email,true);
                        $this->email->from($from_email, 'Shyamal-Sylhet');
                        $this->email->to($to_email);
                        $this->email->subject('Email Verification');
                        $this->email->message($mesg);
                        if($this->email->send()){
                            $data['message'] = 'success';
                        }
                        $data['main_content'] = 'subscription/message';
                        $this->load->view('include/template', $data);
                    }
                    else
                    {
                        $data['message'] = 'unsuccess';
                        $data['main_content'] = 'subscription/message';
                        $this->load->view('include/template', $data);
                    }
                }
            }
        }

        function verify_email(){
            $data['newspaper']              = $this->query_model->page_info();
            $email = $this->input->post('email');
            $data['email_info'] = $this->query_model->email_verify_info($email); 

            if($data['email_info']->status == 0){
                $data['update_status'] = $this->query_model->email_verify_confirm($email); 
                $data['main_content'] = 'subscription/success_msg';
                $this->load->view('include/template', $data);
                // redirect(base_url()); 
            } 
            else{
                $this->load->view('subscription/access-denied'); 
            }

        }

        // function enc_dnc(){
        //     $input = "Lazy Coder";
        //     $encrypted = encryptIt( $input );
        //     $decrypted = decryptIt( $encrypted );
            
        //     function encryptIt( $q ) {
        //         $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        //         $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        //         return( $qEncoded );
        //     }
            
        //     function decryptIt( $q ) {
        //         $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        //         $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        //         return( $qDecoded );
        //     }
        // }

        function newsletter_template(){
            $this->load->view('newsletter/newsletter');
        }


        /********************************************************/
        /********************* Newsletter ***********************/
        /********************************************************/

        function newsletter(){

            $date = date('Y-m-d'); 
            $prv_date =  date('Y-m-d', strtotime($date .' -1 day')); 

            $data['newses']  =  $this->query_model->newsletter_news($prv_date);

            // print_r($data['newses']); 
            $this->load->view('newsletter/newsletter',$data);


        }

        /********************************************************/
        /********************* Newsletter ***********************/
        /********************************************************/

        public function contact(){
            $data['latest_ten_news']        = $this-> query_model-> latest_news_info(10);
            $data['main_content'] = 'contact/contact';
            $this->load->view('include/template', $data);
        }


        
    }
