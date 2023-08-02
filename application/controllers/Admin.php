<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->output->set_header("Expires: Thu, 19 Nov 1981 08:52:00 GMT");
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->load->model('image_upload');
		$this->load->library('image_lib');
		$this->load->library('form_validation');
		$this -> load -> model('admin_model');
		$this->load->library('tank_auth');
		$this->is_logged_in();

	}

	public function is_logged_in()
	{
		if(!$this-> tank_auth->is_logged_in())
		{
			redirect(base_url('login'),'refresh');  
		}
	}

	/*(START)THIS FUNCTIION  USE for GET CURRENT URL   */
	function curPageURL() {
			$pageURL = 'http';
			// if ($_SERVER["HTTPS"] == "on") {$pageURL .= "s";}
			$pageURL .= "://";
			if ($_SERVER["SERVER_PORT"] != "80") {
			$pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["REQUEST_URI"];
			} else {
			$pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"];
			}
		return $pageURL;
	}
	/*----------  End of Function curPageURL() ----------------*/
	function log_in()
	{
		$data['user_name'] 			= $this-> tank_auth -> get_username();
		$data['user_full_name'] 	= $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 			= $this-> tank_auth -> get_user_type();

		$data['all_news'] 			= $this->admin_model->all_news();
		$data['all_category'] 		= $this->admin_model->all_category();
		$data['all_users'] 			= $this->admin_model->all_users();
		$data['visitors'] 			= $this->admin_model->visitors_count();


		$data['user_list_info'] 	= $this->admin_model->user_info_list($data['user_type']);
		$data['latest_news_info'] 	= $this->admin_model->latest_news_info();
		$user_by_id 				= $this->tank_auth->get_user_id();
		$data['user_info_by_id'] 	= $this->admin_model->user_info_by_id($data['user_type'], $user_by_id);
		
		if($data['user_type']==7 || $data['user_type']==5 || $data['user_type'] == 3 || $data['user_type'] == 2)
		{
			$data['status']		='';
			$data['content'] 	= 'admin_pages/dashboard';
			$this->load->view('include/admin_template',$data);
		}
	}
	
	
	
	/***************************************************************************/
	/*------------------------  START NEWS STATISTIC  -------------------------*/
	/***************************************************************************/


	function daily_visitors_list()
	{
		$data['user_name'] 				= $this-> tank_auth -> get_username();
		$data['user_full_name'] 		= $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 				= $this-> tank_auth -> get_user_type();

		$this->load->library('pagination'); 
		$config = array();
		$config["base_url"]         = base_url('daily-visitors-list');  
		$config["total_rows"]       = $this->admin_model->daily_visitors_row();

		$config["per_page"]         = 30;
		$config["uri_segment"]      = 2;


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

		$data['from_date'] = '';
		$data['to_date'] = '';

		if($this->input->get('from_date') && $this->input->get('to_date')){
			$data['from_date'] = $this->input->get('from_date');
			$data['to_date'] = $this->input->get('to_date');
		}

		$this->pagination->initialize($config);
		$page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
		$data['daily_visitors_list']	= $this ->admin_model-> daily_visitors_list($config["per_page"], $page);
		$data['content'] = 'admin_pages/statistic/visitors';
		$this->load->view('include/admin_template',$data);
	}


	function daily_report()
	{
		$data['user_name'] 				= $this-> tank_auth -> get_username();
		$data['user_full_name'] 		= $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 				= $this-> tank_auth -> get_user_type();

		if($this->input->get('date')){
			$date = $this->input->get('date');
		}
		else{
			$date = date('Y-m-d');
		}
		$data['date'] = $date;  
		$data['daily_news_report']		= $this ->admin_model-> daily_news_report_by_reporter($data['user_type'], $date);
		
		$data['content'] = 'admin_pages/statistic/report';
		$this->load->view('include/admin_template',$data);
	}

	
	function daily_category_report()
	{
		$data['user_name'] 				= $this-> tank_auth -> get_username();
		$data['user_full_name'] 		= $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 				= $this-> tank_auth -> get_user_type();

		if($this->input->get('date')){
			$date = $this->input->get('date');
		}
		else{
			$date = date('Y-m-d');
		}
		$data['date'] = $date;  
		$data['report']		= $this ->admin_model-> daily_news_report_by_category($date);

		
		$data['content'] = 'admin_pages/statistic/daily_category_report';
		$this->load->view('include/admin_template',$data);
	}


	/***************************************************************************/
	/*-------------------------  END NEWS STATISTIC  --------------------------*/
	/***************************************************************************/


	

	/************************************************************************/
	/*------------------------- START NEWS SETUP ---------------------------*/
	/************************************************************************/

	

	public function NewsEntry()
	{
		$data['user_name'] 		= $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth -> get_user_type();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('cat_id','Category', 'required|trim');

		if($data['user_type'] == 7 || $data['user_type'] == 5 || $data['user_type'] == 3){
			$this->form_validation->set_rules('news_status','News Status', 'required|trim');
		}

		$this->form_validation->set_rules('news_headline','Head Line', 'required|trim');
		$this->form_validation->set_rules('news_details','News Description', 'required|trim');

		$data['sub_category_info']	= '';
		$data['category_info']		= $this -> admin_model-> category_info_news_setup();
		$data['type_info']			= $this -> admin_model-> type_info();
		$data['sub_category_info']	= $this -> admin_model-> sub_category_info();
		$data['writerList']			= $this -> admin_model-> writerList();
		$data['pageList']			= $this -> admin_model-> page_info_news_setup();

		$data['news_edit']			= '';

		if($this->form_validation->run() == FALSE){
			$data['status'] = '';
			$data['content'] = 'admin_pages/news_entry';
			$this->load->view('include/admin_template',$data);
		}
		else{
			if($data['last_id'] = $this ->admin_model-> news_entry()){
			    
				$last_id        = $data['last_id'];
				$newsID = $last_id;
				$email  = '';
				$tbl_name 	= $this-> input-> post('tbl_name');
				$i 			= -10;  /// For Single Upload

				$folder_name = ceil($last_id/1000);
				$directory   = './images/news/'.$folder_name.'/';
				
				if(!is_dir($directory)){
					mkdir('./images/news/'.$folder_name, 0777, true);
					mkdir('./images/news/'.$folder_name.'/thumb', 0777, true);
					mkdir('./images/news/'.$folder_name.'/small', 0777, true);
					mkdir('./images/news/'.$folder_name.'/share', 0777, true);
				}
				$this-> test_upload($last_id, $tbl_name, $i, $directory);
                $this-> cache_optimizer('insert', $newsID);  

				$success_data['success_message'] = "News Added Successfully";
				$this->session->set_userdata($success_data);
				redirect(base_url('news-upload'));
			}
		}
	}

	public function OpinionEntry()
	{
		$data['user_name'] 		= $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] 		= $this->tank_auth->get_user_type();

		$this->load->library('form_validation');

		$this->form_validation->set_rules('cat_id', 'Category', 'required|trim');
		$this->form_validation->set_rules('news_status', 'News Status', 'required|trim');
		$this->form_validation->set_rules('news_headline', 'Head Line', 'required|trim');
		$this->form_validation->set_rules('news_details', 'News Description', 'required|trim');

		$data['sub_category_info']	= '';
		$data['category_info']		= $this->admin_model->category_info_opinion();
		$data['sub_category_info']	= $this->admin_model->sub_category_info();
		$data['writerList']			= $this->admin_model->OpinionWriterList();

		$data['news_edit']			= '';

		if ($this->form_validation->run() == FALSE) {
			$data['status'] = '';
			$data['content'] = 'admin_pages/opinion/opinion_entry';
			$this->load->view('include/admin_template', $data);
		} else {
			if ($data['last_id'] = $this->admin_model->news_entry()) {

				$last_id        = $data['last_id'];
				$newsID = $last_id;
				$email  = '';
				$tbl_name 	= $this->input->post('tbl_name');
				$i 			= -10;  /// For Single Upload

				$folder_name = ceil($last_id / 1000);
				$directory   = './images/news/' . $folder_name . '/';


				if (!is_dir($directory)) {
					mkdir('./images/news/' . $folder_name, 0777, true);
					mkdir('./images/news/' . $folder_name . '/thumb', 0777, true);
					mkdir('./images/news/' . $folder_name . '/small', 0777, true);
					mkdir('./images/news/' . $folder_name . '/share', 0777, true);
				}
				$this->test_upload($last_id, $tbl_name, $i, $directory);

				$this->cache_optimizer('insert', $newsID);  /// $this->db->cache_delete_all();
				$success_data['success_message'] = "News Added Successfully";
				$this->session->set_userdata($success_data);
				redirect(base_url('opinion-upload'));
			}
		}
	}

	function fetch_subcat()
	{
		if($this->input->post('cat_id'))
		{
			echo $this->admin_model->fetch_subcat($this->input->post('cat_id'));
		}
	}

	function fetch_relevant()
	{
		if($this->input->post('news_tag'))
		{
			echo $this->admin_model->fetch_relevant($this->input->post('news_tag'));
		}
	}

	/***************************************************************************/
	/*--------------------------- START NEWS SEARCH ----------------------------*/
	/***************************************************************************/

	/*----------------------START NEWS FETCH WITH CATEGORY ----------------------*/
	public function NewsSearch(){
		$data['user_name'] 		= $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth -> get_user_type();


		$data['all_user_list']	= $this-> admin_model-> get_user_list();
		$data['sortType'] 		= array('' => 'Select One', 'date-new' => 'Publish Date (Newest)', 'date-old' => 'Publish Date (Oldest)', 'reader-high' => 'Reader (High)', 'reader-low' => 'Reader (Low)', 'publisher' => 'Publisher');

		$data['category_info']		= $this-> admin_model-> category_info();
		$data['sub_category_info'] = '';
		if($this-> input-> get('cat_id') != ''){
			$data['sub_category_info']	= $this-> admin_model-> sub_category_info_by_cat($this-> input-> get('cat_id'));
		}

		$data['writerList']			= $this -> admin_model-> WriterListInfoAll();
		$data['pageList']			= $this -> admin_model-> page_info_news_setup();

		$newsID					= $this-> input-> get('news_id');
		$category_id			= $this-> input-> get('cat_id');
		$sub_category_id		= $this-> input-> get('sub_cat_id');
		$news_status			= $this-> input-> get('news_status');
		// $publisherID			= $this-> tank_auth-> get_user_id();
		$author_id 				= $this-> input-> get('author_id');
		$page_id				= $this-> input-> get('page_id');
		$publisherID			= $this-> input-> get('userID');
		$publisherType			= $data['user_type'];
		$start_date				= $this-> input-> get('starting_date');
		$end_date				= $this-> input-> get('ending_date');
		$sortType				= $this-> input-> get('sortType');
		

		// if($date1 && $date2){
		// 	$data['news_list_info']	= $this-> admin_model-> news_list_report($publisherID, $date1, $date2, $sortType);
		// }
		


		if($newsID || $category_id || $sub_category_id || $news_status != '' || $author_id || $page_id  || $start_date || $end_date || $sortType || $publisherID && $publisherType){
			$limit = '';
			$data['news_list_info'] = $this-> admin_model-> news_list_search_new($newsID, $category_id, $sub_category_id ,$news_status , $author_id, $page_id, $publisherID, $publisherType, $start_date, $end_date, $sortType, $limit);
		}
		else{
			$limit = 50;
			$data['news_list_info'] = $this-> admin_model-> news_list_search_new($newsID, $category_id, $sub_category_id ,$news_status , $author_id, $page_id, $publisherID, $publisherType, $start_date, $end_date, $sortType, $limit);
		}
		
		$data['news_delete']	= '';
		$data['status']			= '';

		$data['content'] = 'admin_pages/news_search';
		$this->load->view('include/admin_template',$data);
		
	}
	/*----------------------END NEWS FETCH WITH CATEGORY ----------------------*/

	/***************************************************************************/
	/*--------------------------- END NEWS SEAECH ----------------------------*/
	/***************************************************************************/


	/***************************************************************************/
	/*--------------------------- START NEWS REPORT ----------------------------*/
	/***************************************************************************/

	function NewsReport()
	{
		$data['user_name'] 		= $this-> tank_auth-> get_username();
		$data['user_full_name'] = $this-> tank_auth-> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth-> get_user_type();

		$data['all_user_list']	= $this-> admin_model-> get_user_list();
		$data['sortType'] 		= array('date-new' => 'Publish Date (Newest)', 'date-old' => 'Publish Date (Oldest)', 'reader-high' => 'Reader (High)', 'reader-low' => 'Reader (Low)', 'publisher' => 'Publisher');
		$data['news_list_info']	= '';

		$this->load->library('form_validation');
		$this->form_validation->set_rules('starting_date','From Date', 'required|trim');
		$this->form_validation->set_rules('ending_date','To Date', 'required|trim');

		$publisherID			= $this-> input-> post('userID');
		$date1					= $this-> input-> post('starting_date');
		$date2					= $this-> input-> post('ending_date');
		$sortType				= $this-> input-> post('sortType');

		if($date1 && $date2){
			$data['news_list_info']	= $this-> admin_model-> news_list_report($publisherID, $date1, $date2, $sortType);
		}

		$data['news_delete']	= '';
		$data['status']			= '';

		$data['content'] = 'admin_pages/news_report';
		$this-> load-> view('include/admin_template', $data);
	}


	/***************************************************************************/
	/*--------------------------- END NEWS REPORT ----------------------------*/
	/***************************************************************************/



	/****************************************************************************************/
	/*------------------------------------- NEWS EDIT  -------------------------------------*/
	/****************************************************************************************/
	function EditNews($news_id)
	{
		$data['user_name'] 		= $this-> tank_auth-> get_username();
		$data['user_full_name'] = $this-> tank_auth-> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth-> get_user_type();

		$data['news_edit']			= $this-> admin_model-> news_edit($news_id);
		$data['news_id']			= $news_id;
		$data['cat_id'] 			= '';  

		$cat_id = $data['news_edit'][0]->cat_id;
		
		$data['sub_category_info']	= '';
		$data['category_info']		= $this-> admin_model-> category_info();
		$data['sub_category_info']	= $this-> admin_model-> sub_category_info_by_cat($cat_id);
		$data['type_info']			= $this -> admin_model-> type_info();
		$data['pageList']			= $this -> admin_model-> page_info_news_setup();
		$data['status'] 			= '';


		$data['writerInfo']			= $this-> admin_model-> writerInfo($news_id, 1);
		$data['reporterInfo']		= $this-> admin_model-> writerInfo($news_id, 2);

		$data['writerList']			= $this -> admin_model-> writerList();

		

		
		$data['content'] = 'admin_pages/news_edit';
		$this->load->view('include/admin_template',$data);
	}

	function EditOpinion($news_id)
	{
		$data['user_name'] 		= $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] 		= $this->tank_auth->get_user_type();

		$data['news_edit']			= $this->admin_model->news_edit($news_id);
		$data['news_id']			= $news_id;
		$data['sub_category_info']	= '';
		$data['category_info']		= $this->admin_model->category_info_opinion();
		$data['cat_id']            = 5;

		$data['sub_category_info']	= $this->admin_model->sub_category_info();
		$data['writerList']			= $this->admin_model->OpinionWriterList();
		$data['status'] 			= '';

		// $book_subject = DB::table('tbl_book_subject')->where('book_id',$id)->get();
		$data['writerInfo']			= $this-> admin_model-> writerInfo($news_id, 1);
		$data['reporterInfo']		= $this-> admin_model-> writerInfo($news_id, 2);

		$data['content'] = 'admin_pages/opinion/opinion_edit';
		$this->load->view('include/admin_template', $data);
	}

	function EditNewsEntry($news_id)
	{

		$data['user_name'] 		= $this-> tank_auth-> get_username();
		$data['user_full_name'] = $this-> tank_auth-> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth-> get_user_type();

		$data['news_edit']			= $this-> admin_model-> news_edit($news_id);
		$data['news_id']			= $news_id;

		$data['sub_category_info']	= '';

		$category = $this->input->post('cat_id');
		if ($category == '5') {
			$data['category_info']		= $this->admin_model->category_info_opinion();
			$data['writerList']			= $this->admin_model->OpinionWriterList();
		} else {
			$data['category_info']		= $this->admin_model->category_info_news_setup();
			$data['writerList']			= $this->admin_model->writerList();

			$data['writerInfo']			= $this-> admin_model-> writerInfo($news_id, 1);
			$data['reporterInfo']		= $this-> admin_model-> writerInfo($news_id, 2);
		}

		$data['category_info']		= $this-> admin_model-> category_info();
		$data['sub_category_info']	= $this-> admin_model-> sub_category_info();
		$data['writerList']			= $this-> admin_model-> writerList();
		$data['pageList']			= $this -> admin_model-> page_info_news_setup();
		$data['status'] 			= '';

		


		$this->load->library('form_validation');
		$this->form_validation->set_rules('cat_id','Category', 'required|trim');
		if ($data['user_type'] == 7 || $data['user_type'] == 5 || $data['user_type'] == 3) {
			$this->form_validation->set_rules('news_status', 'News Status', 'required|trim');
		}
		$this->form_validation->set_rules('news_headline','Head Line', 'required|trim');
		$this->form_validation->set_rules('news_details','News Description', 'required|trim');

		if($this->form_validation->run() == FALSE){
			$data['status'] = '';
			$data['content'] = 'admin_pages/news_edit';
			$this->load->view('include/admin_template', $data);
		}
		else{
			if($data['last_id'] = $this ->admin_model-> news_edit_entry($news_id)){
			    
				if(isset( $_FILES['user_avatar']['name'])){
					$file = $_FILES['user_avatar']['name'];
					if($file)
					{
						$last_id		= $news_id;
						$tbl_name 		= $this-> input-> post('tbl_name');
						$i				= -10;
						$folder_name 	= ceil($last_id/1000);
						$directory   	= './images/news/'.$folder_name.'/';
						// $directory   	= './images/news/';
						
						if(!is_dir($directory)){
							mkdir('./images/news/'.$folder_name, 0777, true);
							mkdir('./images/news/'.$folder_name.'/thumb', 0777, true);
							mkdir('./images/news/'.$folder_name.'/small', 0777, true);
							mkdir('./images/news/'.$folder_name.'/share', 0777, true);
						}
						$this-> test_upload($last_id, $tbl_name, $i, $directory);
					}
				}
				
				$this-> cache_optimizer('edit', $news_id);      // $this->db->cache_delete_all();
				$data['edit_status'] 	= 'edit';
				$data['news_edit']			= $this-> admin_model-> news_edit($news_id);
				$success_data['success_message'] = "News Updated Successfully";
				$this->session->set_userdata($success_data);
				redirect($_SERVER['HTTP_REFERER']);
			

			}
		}		
	}


	function EditOpinionEntry($news_id)
	{

		$data['user_name'] 		= $this-> tank_auth-> get_username();
		$data['user_full_name'] = $this-> tank_auth-> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth-> get_user_type();

		$data['news_edit']			= $this-> admin_model-> news_edit($news_id);
		$data['news_id']			= $news_id;

		$data['sub_category_info']	= '';

		$category = $this->input->post('cat_id');
		if ($category == '5') {
			$data['category_info']		= $this->admin_model->category_info_opinion();
			$data['writerList']			= $this->admin_model->OpinionWriterList();
		} else {
			$data['category_info']		= $this->admin_model->category_info_news_setup();
			$data['writerList']			= $this->admin_model->writerList();

			$data['writerInfo']			= $this-> admin_model-> writerInfo($news_id, 1);
			$data['reporterInfo']		= $this-> admin_model-> writerInfo($news_id, 2);
		}

		$data['category_info']		= $this-> admin_model-> category_info();
		$data['sub_category_info']	= $this-> admin_model-> sub_category_info();
		$data['writerList']			= $this-> admin_model-> writerList();
		$data['status'] 			= '';

		


		$this->load->library('form_validation');
		$this->form_validation->set_rules('cat_id','Category', 'required|trim');
		if ($data['user_type'] == 7 || $data['user_type'] == 5 || $data['user_type'] == 3) {
			$this->form_validation->set_rules('news_status', 'News Status', 'required|trim');
		}
		$this->form_validation->set_rules('news_headline','Head Line', 'required|trim');
		$this->form_validation->set_rules('news_details','News Description', 'required|trim');

		if($this->form_validation->run() == FALSE){
			$data['status'] = '';
			$data['content'] = 'admin_pages/news_edit';
			$this->load->view('include/admin_template', $data);
		}
		else{
			if($data['last_id'] = $this ->admin_model-> opinion_edit_entry($news_id)){
			    
				if(isset( $_FILES['user_avatar']['name'])){
					$file = $_FILES['user_avatar']['name'];
					if($file)
					{
						$last_id		= $news_id;
						$tbl_name 		= $this-> input-> post('tbl_name');
						$i				= -10;
						$folder_name 	= ceil($last_id/1000);
						$directory   	= './images/news/'.$folder_name.'/';
						// $directory   	= './images/news/';
						
						if(!is_dir($directory)){
							mkdir('./images/news/'.$folder_name, 0777, true);
							mkdir('./images/news/'.$folder_name.'/thumb', 0777, true);
							mkdir('./images/news/'.$folder_name.'/small', 0777, true);
							mkdir('./images/news/'.$folder_name.'/share', 0777, true);
						}
						$this-> test_upload($last_id, $tbl_name, $i, $directory);
					}
				}
				$this-> cache_optimizer('edit', $news_id);      // $this->db->cache_delete_all();
				$data['edit_status'] 	= 'edit';
				$data['news_edit']			= $this-> admin_model-> news_edit($news_id);
				$success_data['success_message'] = "News Updated Successfully";
				$this->session->set_userdata($success_data);
				redirect($_SERVER['HTTP_REFERER']);
			

			}
		}		
	}

	/********************************************************************************/
	/*-------------------------------News Approve-----------------------------------*/
	/********************************************************************************/
	public function NewsApproveList(){
		$data['user_name'] 		= $this-> tank_auth-> get_username();
		$data['user_full_name'] = $this-> tank_auth-> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth-> get_user_type();
		$data['requested_news'] = $this->admin_model->requested_news();
		$data['content'] = 'admin_pages/news_request_list';
		$this->load->view('include/admin_template',$data);
	}

	function NewsApproveEdit($news_id){
		$data['user_name'] 		= $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth -> get_user_type();

		$data['news_id'] = $news_id;
		
// 		print_r($data);
		$data['content'] = 'admin_pages/news_request_edit';
		$this->load->view('include/admin_template',$data);

	}

	function NewsApproveUpdate($news_id){
		$data['user_name'] 		= $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth -> get_user_type();

		$data['news_id'] = $news_id;
		$this->admin_model->update_news($news_id);
		$data['requested_news'] = $this->admin_model->requested_news();
		
		$data['success_message'] = 'News Approved Successfully' ;
		$data['content'] = 'admin_pages/news_request_list';
		$this->load->view('include/admin_template',$data);

	}
	/********************************************************************************/
	/*-------------------------------News Approve-----------------------------------*/
	/********************************************************************************/
	

	/********************************************************************************/
	/*------------------------------- NEWS PAGE ------------------------------------*/
	/********************************************************************************/

	function page(){
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();

		$this->form_validation->set_rules('page_name','Page Name', 'required|trim|is_unique[news_page_info.name]');
		$this->form_validation->set_rules('page_name_bn','Page Name (BN)', 'required|trim');
		if ($this->form_validation->run() == FALSE)
		{
			$data['page_list']	=  $this ->admin_model-> news_page_info_list();
			$data['content'] 	= 'admin_pages/page/page';
			$this->load->view('include/admin_template',$data);
		}else{
			if($data['last_id']=$this ->admin_model-> news_page_entry())
			{
				$last_id=$data['last_id'];
				$success_data['success_message'] = "Page Successfully Created";
				$this->session->set_userdata($success_data);
				redirect('news-page');
			}
		}
		
	}

	public function updatePagePosition(){
		$position = $this->input->post('position');
		$this->admin_model->updatePagePosition($position);
		
	}

	function UpdatePage($page_id){
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();

		$this->form_validation->set_rules('page_name','Page Name', 'required|trim');
		$this->form_validation->set_rules('page_name_bn','Page Name (BN)', 'required|trim');
		// $this->form_validation->set_rules('page_position',' ', 'required|trim');


		if ($this->form_validation->run() == TRUE) {
			if ($data['last_id'] = $this->admin_model->page_edit_entry($page_id)) {
				$success_data['success_message'] = "Page Updated Successfully";
				$this->session->set_userdata($success_data);
				redirect('news-page');
			}
		} 
	}
	/********************************************************************************/
	/*------------------------------- NEWS PAGE ------------------------------------*/
	/********************************************************************************/


	/********************************************************************************/
	/*------------------------------- NEWS TYPE ------------------------------------*/
	/********************************************************************************/


	function news_type(){
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();

		$this->form_validation->set_rules('type_name','Type Name', 'required|trim|is_unique[news_type_info.type_name]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['type_list']	=  $this ->admin_model-> news_type_info_list();
			$data['content'] 	= 'admin_pages/news_type/index';
			$this->load->view('include/admin_template',$data);
		}else{
			if($data['last_id']=$this ->admin_model-> news_type_entry())
			{
				$last_id=$data['last_id'];
				$success_data['success_message'] = "News Type Successfully Created";
				$this->session->set_userdata($success_data);
				redirect('news-type');
			}
		}
	}

	function news_type_update($id){
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();

		$this->db->cache_off(); 
		$query = $this-> db-> query("SELECT `type_name`,`type_status` FROM `news_type_info` WHERE `news_type_id` = '".$id."'");

		$data['edit_id'] 		= $id ;
		$data['edit_name'] 		= $query->row()->type_name;  
		$data['edit_status'] 	= $query->row()->type_status;  

		if($query->row()->type_name != $this->input->post('type_name')){
			$this->form_validation->set_rules('type_name','Type Name', 'required|trim|is_unique[news_type_info.type_name]');
		}else{
			$this->form_validation->set_rules('type_name','Type Name', 'required|trim');
		}
		 
		if ($this->form_validation->run() == FALSE)
		{
			$data['type_list']	=  $this ->admin_model-> news_type_info_list();
			$data['content'] 	= 'admin_pages/news_type/edit';
			$this->load->view('include/admin_template',$data);
		}else{
			if($data['last_id']=$this ->admin_model-> news_type_edit($id))
			{
				$last_id=$data['last_id'];
				$success_data['success_message'] = "News Type Updated Created";
				$this->session->set_userdata($success_data);
				redirect('news-type');
			}
		}
	}

	/********************************************************************************/
	/*------------------------------- NEWS TYPE ------------------------------------*/
	/********************************************************************************/


	/****************************************************************************************/
	/*----------------------------------Strat Category Module ------------------------------*/
	/****************************************************************************************/

	function NewsCategoryInsert()
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		$this->form_validation->set_rules('cat_name','Category (Bangla)', 'required|trim');
		$this->form_validation->set_rules('cat_key_name','Category (English)', 'required|trim');
		if ($this->form_validation->run() == FALSE)
		{
			$data['status'] = '';
			$data['content'] = 'admin_pages/category_entry';
			$this->load->view('include/admin_template',$data);
		}
		else
		{
			if($data['last_id']=$this ->admin_model-> news_category_entry())
			{
				$last_id=$data['last_id'];
				$success_data['success_message'] = "Category Successfully Created";
				$this->session->set_userdata($success_data);
				redirect('Admin/NewsCategoryInsert');
			}
			else
			{
				$data['status'] = 'failed';
				$data['content'] = 'admin_pages/category_entry';
				$this->load->view('include/admin_template',$data);
			}
		}
	}

	/*---------------End Category Setup ------------------*/

	/*---------------Category List ------------------*/
	function CategoryList()
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		$data['category_info']=$this ->admin_model-> category_info_list();
		$data['category_delete']='';
		$data['content'] = 'admin_pages/category_list';
		$this->load->view('include/admin_template',$data);
	}
	
	function edit_cat_status($id,$status){
		$this->admin_model->update_cat_status($id, $status);
		redirect(base_url('Admin/CategoryList'));
	}
	
	function EditCategory($cat_id)
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();
		$this->form_validation->set_rules('cat_name', 'Category (Bangla)', 'required|trim');
		$this->form_validation->set_rules('cat_key_name', 'Category (English)', 'required|trim');
		$data['category_edit'] = $this->admin_model->category_edit($cat_id);
		$data['cat_id'] = $cat_id;
		$data['status'] = '';

		if ($this->form_validation->run() == FALSE) {
			$data['status'] = '';
			$data['content'] = 'admin_pages/category_edit';
			$this->load->view('include/admin_template', $data);
		} else {
			if ($data['last_id'] = $this->admin_model->category_edit_entry($cat_id)) {
			    $this->db->cache_delete_all();
				$success_data['success_message'] = "Category Updated Successfully";
				$this->session->set_userdata($success_data);
				redirect('Admin/CategoryList');
			}
		}
	}

	/****************************************************************************************/
	/*--------------------------------End Category Module ----------------------------------*/
	/****************************************************************************************/



	/****************************************************************************************/
	/*-------------------------------Start Sub-Category Module -----------------------------*/
	/****************************************************************************************/

	function SubCategoryEntry()
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();

		$data['category_info']		= $this->admin_model->category_info();
		$data['content'] = 'admin_pages/subcategory_entry';
		$this->load->view('include/admin_template', $data);
	}

	function SubcatInsert()
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();

		$data['category_info']		= $this->admin_model->category_info();

		$this->form_validation->set_rules('subcat_name', 'Sub-Category (Bangla)', 'required|trim');
		$this->form_validation->set_rules('subcat_key_name', 'Sub-Category (English)', 'required|trim');
		$this->form_validation->set_rules('cat_name', 'Category field', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$data['status'] = '';
			$data['content'] = 'admin_pages/subcategory_entry';
			$this->load->view('include/admin_template', $data);
		} else {
			if ($data['last_id'] = $this->admin_model->news_subcategory_entry()) {
				$last_id = $data['last_id'];
				$success_data['success_message'] = 'Sub Category Successfully Listed';
				$this->session->set_userdata($success_data);
				redirect('Admin/SubCategoryEntry');
			} else {
				$data['status'] = 'failed';
				$data['content'] = 'admin_pages/subcategory_entry';
				$this->load->view('include/admin_template', $data);
			}
		}
	}

	function SubCategoryList()
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();
		$data['sub_category_info'] = $this->admin_model->sub_category_info_list();
		$data['content'] = 'admin_pages/sub_cat_list';
		$this->load->view('include/admin_template', $data);
	}

	function edit_subcat_status($id,$status)
	{
		$this->admin_model->update_subcat_status($id, $status);
		redirect('Admin/SubCategoryList');
	}

	function UpdateSubCategory($subcat_id)
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();
		$data['sub_category_edit'] = $this->admin_model->sub_category_edit($subcat_id);
		$data['category_info']		= $this->admin_model->category_info();
		$data['subcat_id'] = $subcat_id;
		$data['content'] = 'admin_pages/subcategory_edit';
		$this->load->view('include/admin_template', $data);
	}

	function SubCategoryUpdateEntry($subcat_id)
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();

		$this->form_validation->set_rules('subcat_name', 'Sub-Category (Bangla)', 'required|trim');
		$this->form_validation->set_rules('subcat_key_name', 'Sub-Category (English)', 'required|trim');
		$this->form_validation->set_rules('cat_name', 'Category field', 'required|trim');
		if ($this->form_validation->run() == FALSE) {
			$data['sub_category_edit'] = $this->admin_model->sub_category_edit($subcat_id);
			$data['category_info']		= $this->admin_model->category_info();
			$data['subcat_id'] = $subcat_id;
			$data['status'] = '';
			$data['content'] = 'admin_pages/subcategory_edit';
			$this->load->view('include/admin_template', $data);
		} else {
			if ($data['last_id'] = $this->admin_model->subcategory_edit_entry($subcat_id)) {
				$last_id = $data['last_id'];
				$data['sub_category_edit'] = $this->admin_model->sub_category_edit($subcat_id);
				$data['category_info']		= $this->admin_model->category_info();
				$data['subcat_id'] = $subcat_id;
				$success_data['success_message'] = 'Sub Category Successfully Listed';
				$this->session->set_userdata($success_data); 
				redirect($_SERVER['HTTP_REFERER']);
			}
		}
	}
	/****************************************************************************************/
	/*--------------------------------End Sub-Category Module ------------------------------*/
	/****************************************************************************************/



	/****************************************************************************/
	/*---------------------- START NEWS ADs SETUP ----------------------------*/
	/***************************************************************************/
		
	function AdSetup()
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		$this->load->library('form_validation');
		$this->form_validation->set_rules('add_title','Add Title', 'required|trim');
		$this->form_validation->set_rules('add_start_date','Starting Date', 'required|trim');
		$this->form_validation->set_rules('add_end_date','Ending Date', 'required|trim');
	
		$data['category_info']=$this -> admin_model-> category_info();
		$data['news_add_edit']='';

		if ($this->form_validation->run() == FALSE)
		{
			$data['status'] = '';
		}
		else
		{

			$prev_data = $this ->admin_model-> prev_ad_id();
			if($prev_data){
				$error_data['error_message'] = "Ads Already Exist";
				$this->session->set_userdata($error_data);
				redirect('admin/AdSetup');
			}

			if($data['last_id']=$this ->admin_model-> news_add_entry())
			{
				$last_id=$data['last_id'];
				
				$data['status'] = 'successful';
				$data['success_message'] = "Ad Store Successfully";

				$file= $_FILES['user_avatar']['name'];
				
				if($file)
				{
					$tbl_name = $this -> input -> post('tbl_name'); /**** hidden table name get korce ****/
					$i=-10; /* For Single Upload */
					$this-> test_upload($last_id,$tbl_name,$i);
				}
			}
			else
			{
				$data['status'] = 'failed';
			}
			$success_data['success_message'] = "Ads Added Successfully";
			$this->session->set_userdata($success_data);

			redirect('admin/AdsList');
		}
		
		$data['content'] ='admin_pages/ads_setup';
		$this->load->view('include/admin_template', $data);
	}

	/***************************************************************************/
	/*----------------------------- ADVERTISE  LIST ---------------------------*/
	/***************************************************************************/
	
	function AdsList()
	{
		$data['user_name'] 			= $this-> tank_auth -> get_username();
		$data['user_full_name'] 	= $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 			= $this-> tank_auth -> get_user_type();
		
		// $data['advertise_info']		= $this ->admin_model-> advertise_info_list();

		$data['advertise_info_banner']	=$this ->admin_model-> advertise_info_list(1);
		$data['advertise_info_lb']		=$this ->admin_model-> advertise_info_list(2);
		$data['advertise_info_rac']		=$this ->admin_model-> advertise_info_list(3);

		$data['advertise_delete']	= '';


		$data['content'] = 'admin_pages/ads_list';
		$this->load->view('include/admin_template', $data);
	}

	/*****************************************************************************************/
	/*--------------------------------- Edit Advertise --------------------------------------*/
	/*****************************************************************************************/



	function SetAdSlot($position_id)
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();


		$get_add_id = $this ->admin_model-> get_add_id($position_id); 
		$add_id 	=  $get_add_id->add_id;
		
		$this->form_validation->set_rules('add_title','Add Title', 'required|trim');
		$this->form_validation->set_rules('add_start_date','Starting Date', 'required|trim');
		$this->form_validation->set_rules('add_end_date','Ending Date', 'required|trim');
		
		if($this->form_validation->run() == FALSE)
		{
			$data['status'] = '';
		}
		else
		{

			$file= $_FILES['user_avatar']['name'];
			if($file){
				if($data['last_id']=$this ->admin_model-> news_advertise_edit_entry_with_file($add_id, $position_id))
				{
					if($file)
					{
						$last_id   	=	$data['last_id'];
						$tbl_name 	= 	$this -> input -> post('tbl_name'); 
						$i			=	-10;
						$this-> test_upload($last_id,$tbl_name,$i);
					}
				}
			}else{
				$this->admin_model->news_advertise_edit_entry($add_id);
			}

			
			$this->db->cache_delete_all();
			$success_data['success_message'] = 'Ads Set Successfully';
			$this->session->set_userdata($success_data);
			redirect('admin/AdsList');
		}

		$data['category_info']	= $this -> admin_model-> category_info();
		$data['news_add_edit']	= $this -> admin_model-> news_advertise_edit($add_id);
		$data['add_id']			= $add_id;
		$data['position_id']	= $position_id;
		$data['status'] 		= '';

		$data['content'] 		= 'admin_pages/ads_setup';
		$this->load->view('include/admin_template', $data);
	}


	// function EditAdvertise($add_id)
	// {
	// 	$data['user_name'] = $this-> tank_auth -> get_username();
	// 	$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
	// 	$data['user_type'] = $this-> tank_auth -> get_user_type();
		
	// 	$this->form_validation->set_rules('add_title','Add Title', 'required|trim');
	// 	$this->form_validation->set_rules('add_start_date','Starting Date', 'required|trim');
	// 	$this->form_validation->set_rules('add_end_date','Ending Date', 'required|trim');
		
	// 	if($this->form_validation->run() == FALSE)
	// 	{
	// 		$data['status'] = '';
	// 		// $this -> load -> view('include/admin_template', $data);
	// 	}
	// 	else
	// 	{
	// 		if($data['last_id']=$this ->admin_model-> news_advertise_edit_entry($add_id))
	// 		{
	// 		    $this->db->cache_delete_all();
	// 			$file= $_FILES['user_avatar']['name'];
	// 			if($file)
	// 			{
	// 				$last_id=$add_id;
				
	// 				$tbl_name = $this -> input -> post('tbl_name'); 
	// 				$i=-10;
	// 				$this-> test_upload($last_id,$tbl_name,$i);
	// 			}
	// 			$data['status'] = 'edit';
	// 			$success_data['success_message'] = 'Ads Set Successfully';
	// 			$this->session->set_userdata($success_data);
	// 			redirect('admin/AdsList');
	// 			// $this -> load -> view('include/admin_template', $data);
	// 		}
	// 		else
	// 		{
	// 			$data['status'] = 'failed';
	// 			// $this -> load -> view('include/admin_template', $data);
	// 		}
	// 	}
	// 	$data['category_info']=$this -> admin_model-> category_info();
		
	// 	$data['news_add_edit']=$this -> admin_model-> news_advertise_edit($add_id);
	// 	$data['add_id']=$add_id;
	// 	$data['status'] = '';
	// 	$data['content'] ='admin_pages/ads_setup';
	// 	$this->load->view('include/admin_template', $data);
	// }
	/**********************************************************************************************************************/
	/*-----------------------------------------------End Advertise Module--------------------------------------------------/
	/**********************************************************************************************************************/



	/****************************************************************************/
	/*------------------------ START NEWS GALLERY SETUP ------------------------*/
	/********************************************************************-*******/
	function GallerySetup()
	{
		$data['user_name'] 		= $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth -> get_user_type();

		$this->form_validation->set_rules('img_caption', 'Caption', 'required|trim');


		if(empty($_FILES['user_avatar']['name'])){ $this->form_validation->set_rules('user_avatar', 'File Upload', 'required'); }
		
		$data['news_gallery_edit']	= '';
		if ($this->form_validation->run() == FALSE){
			$date['img_caption'] = $this->input->post('img_caption');
			$data['status'] = '';
		}
		else
		{
			if($data['last_id']=$this-> admin_model-> news_gallery_entry())
			{
				$last_id		= $data['last_id'];
				$file			= $_FILES['user_avatar']['name'];
				if($file){
					$tbl_name 	= $this -> input -> post('tbl_name'); /**** hidden table name get korce ****/
					$i			= -10; /* For Single Upload */
					$this-> test_upload($last_id,$tbl_name,$i);
				}
				$success_data['success_message'] = 'Gallery Stored Successfully';
				$this->session->set_userdata($success_data);
				redirect('Admin/GalleryList');
			}
			// else{
			// 	$data['status'] = 'failed';
			// }
		}

		$data['content'] = 'admin_pages/gallery_setup';
		$this->load->view('include/admin_template', $data);
		
	}

	/****************************************************************************/
	/*---------------------------- NEWS GALLERY LIST ---------------------------*/
	/****************************************************************************/
	
	function GalleryList()
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();

		$data['news_gallery_info']=$this ->admin_model-> news_gallery_info_list();

		$data['content'] = 'admin_pages/gallery_list';
		$this->load->view('include/admin_template', $data);
	}

	/*****************************************************************************************/
		/*--------------------------- NEWS GALLERY EDIT AND INSERT ---------------------------*/
	/*****************************************************************************************/

	function EditGallery($img_id)
	{
		$data['user_name'] 		= $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 		= $this-> tank_auth -> get_user_type();

		// $this->form_validation->set_rules('gallery_type', 'Type', 'required|trim');
		$this->form_validation->set_rules('img_caption', 'Image Caption', 'required|trim');
		$this->form_validation->set_rules('gallery_status', 'Status', 'required|trim');
		// if(empty($_FILES['user_avatar']['name'])){ $this->form_validation->set_rules('user_avatar', 'File Upload', 'required'); }

		if($this->form_validation->run() == FALSE)
		{
			$data['status'] = '';
		}
		else
		{
			if($data['last_id']=$this ->admin_model-> news_gallery_edit_entry($img_id))
			{
				$file= $_FILES['user_avatar']['name'];
				if($file)
				{
					$last_id=$img_id;
					$tbl_name = $this -> input -> post('tbl_name'); /*-- Table Name get korse hidden form theke --*/
					$i=-10;
					$this-> test_upload($last_id,$tbl_name,$i);	// image upload korar jonno data gula niche Upload() Function a pathanu hoise //
				}
				// $data['status'] = 'edit';	
				$success_data['success_message']="Gallery Updated Succesfully";
				$this->session->set_userdata($success_data);
				redirect($_SERVER['HTTP_REFERER']);

			}
			else
			{
				$data['status'] = 'failed';
			}
		}
		$data['news_gallery_edit']	= $this -> admin_model-> news_gallery_edit($img_id);
		$data['img_id']				= $img_id;
		$data['status'] 			= '';
		
		$data['content'] ='admin_pages/gallery_setup';
		$this->load->view('include/admin_template', $data);
	}

	/****************************************************************************/
	/*------------------------------ NEWS POL  LIST ---------------------------------*/
	/***************************************************************************/
	function NewsPoll()
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		
		$data['news_pol_info']=$this ->admin_model-> news_pol_list();
		$data['news_pol_delete']='';
		
		
		$data['content'] = 'admin_pages/pol_list';
		$this -> load -> view('include/admin_template', $data);
	}

	/****************************************************************************/
		/*---------------------- START NEWS POL SETUP ----------------------------*/
	/***************************************************************************/

	function PollEntry()
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('pol_title','Pol Title', 'required|trim');
		$this->form_validation->set_rules('pol_start_date','Starting Date', 'required|trim');
		$this->form_validation->set_rules('pol_end_date','Ending Date', 'required|trim');

		$data['news_pol_edit']='';
		if ($this->form_validation->run() == FALSE)
		{
			$data['status'] = '';
		}
		else
		{
			if($data['last_id']=$this ->admin_model-> news_pol_entry())
			{
				$last_id=$data['last_id'];
				
				$data['status'] = 'successful';
				// $this -> load -> view('include/admin_template', $data);
			}
			
			else
			{
				$data['status'] = 'failed';
				// $this -> load -> view('include/admin_template', $data);
			}
		}
		$data['content'] ='admin_pages/pol_setup';
		$this -> load -> view('include/admin_template', $data);
	}

	/*****************************************************************************************/
		/*--------------------------------- NEWS POL EDIT AND INSERT ----------------------------*/
	/*****************************************************************************************/
	
	
	function EditPoll($pol_id)
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		
		$this->form_validation->set_rules('pol_title','Pol Title', 'required|trim');
		$this->form_validation->set_rules('pol_start_date','Starting Date', 'required|trim');
		$this->form_validation->set_rules('pol_end_date','Ending Date', 'required|trim');

		
		// $data['left_link'] = 'admin_panel/admin_news_pol_left_link';
		// $data['main_content'] = 'admin_panel/new_news_pol_insert';
	
		
		if($this->form_validation->run() == FALSE)
		{
			$data['status'] = '';
			// $this -> load -> view('include/admin_template', $data);
		}
		else
		{
			if($this ->admin_model-> news_pol_edit_entry($pol_id))
			{				
				$data['status'] = 'edit';
				// $this -> load -> view('include/admin_template', $data);
			}
			
			else
			{
				$data['status'] = 'failed';
				// $this -> load -> view('include/admin_template', $data);
			}
		}
		$data['news_pol_edit']=$this -> admin_model-> news_pol_edit($pol_id);
		$data['pol_id']=$pol_id;
		$data['status'] = '';

		$data['content'] = 'admin_pages/pol_setup';
		$this -> load -> view('include/admin_template', $data);
	}

	/***********************************************************************************************************************/
	/*--------------------------------------------------- Media and Event -------------------------------------------------*/
	/***********************************************************************************************************************/	
	
	
	/****************************************************************************/
		/*--------------------------- START MEDIA SETUP ------------------------------*/
	/***************************************************************************/
	
	
	function MediaEntry()
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		$this->load->library('form_validation');
		
		$this->form_validation->set_rules('media_type','Media Type', 'required|trim');
		$this->form_validation->set_rules('media_name','Media (Bangla) ', 'required|trim');
		$this->form_validation->set_rules('media_en_name','Media (English) ', 'required|trim');

		$data['media_edit']='';

		if ($this->form_validation->run() == FALSE)
		{
			$data['status'] = '';
		}
		else
		{
			if($data['last_id']=$this ->admin_model-> news_media_entry())
			{
				$last_id=$data['last_id'];
				
				$data['status'] = 'successful';
				$data['success_message'] = 'Media Added Successfully';

				$file= $_FILES['user_avatar']['name'];
				
				if($file)
				{
					$tbl_name = $this -> input -> post('tbl_name'); /**** hidden table name get korce ****/
					$i=-10; /* For Single Upload */
					$this-> test_upload($last_id,$tbl_name,$i);
				}
			}
			
			else
			{
				$data['status'] = 'failed';
			}
		}
		$data['content'] ='admin_pages/media_entry';
		$this -> load -> view('include/admin_template', $data);
	}

	function MediaList(){
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		
		$data['news_media_info']=$this ->admin_model-> news_media_info_list();
		$data['news_media_delete']='';
		
		$data['content'] = 'admin_pages/media_list';
		$this -> load -> view('include/admin_template', $data);
	}


	/****************************************************************************/
		/*-------------------------- DELETE NEWS MEDIA ------------------------------*/
	/***************************************************************************/
	
	function delete_news_media($media_id)
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		
		$data['news_media_delete']=$this -> admin_model-> news_media_delete($media_id);
		$data['news_media_info']=$this ->admin_model-> news_media_info_list();
		
		if($data['news_media_delete'])
		{
			$data['status'] = 'delete';
		}
		
		else
		{
			$data['status'] = 'failed';
		}
		
		$data['content'] = 'admin_pages/media_list';
		$this -> load -> view('include/admin_template', $data);
	}


	/***************-------- Program Entry Form -------------**************************/
		
	function EventEntry()
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		$data['prog_edit']=''; /* for edit */
		$data['status'] = '';
		
		
		$data['content'] = 'admin_pages/event_entry';
		$this -> load -> view('include/admin_template', $data);

	}

	/***************-------- Edit Program Insert -------------**************************/
	
	function EventInsert()
		{
			$data['user_name'] = $this-> tank_auth -> get_username();
			$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
			$data['user_type'] = $this-> tank_auth -> get_user_type();
			
			$this->load->library('form_validation');
			
			$this-> form_validation-> set_rules('p_title','Program Title', 'required|trim');
			$this-> form_validation-> set_rules('p_place','Place of Program', 'required|trim');
			$this-> form_validation-> set_rules('p_date','Date of Program', 'required|trim');
			$this-> form_validation-> set_rules('p_organizer','Organizer', 'required|trim');
			$this-> form_validation-> set_rules('p_des','Description', 'required|trim');

			$this -> load -> model('admin_model');
			
			
			$data['prog_edit']=''; /* for edit */
			
			
			//$p_id=$this-> input-> post('p_id');  /* Segment ar value post korse */
		
			
			if($this-> form_validation-> run() == FALSE)
			{
				$data['status'] = '';
			}
			else
			{
				if($data['last_id']= $this -> admin_model-> prog_entry())
				{
					
					$data['status'] = 'successful';
					$data['success_message']="Successfully Event stored ";
					$last_id=$data['last_id'];
					
					$tbl_name = $this -> input -> post('tbl_name'); /*-- Table Name get korse hidden form theke --*/
					$i=-10;
					
					//$this-> upload($last_id,$tbl_name,$i);	// image upload korar jonno data gula Upload Function a pathanu hoise //
					$this-> test_upload($last_id,$tbl_name,$i);	// image upload korar jonno data gula Upload Function a pathanu hoise //
				}
				else
				{
					$data['status'] = 'failed';
					
				}
			}	
			$data['content'] ='admin_pages/event_entry';
			$this -> load -> view('include/admin_template', $data);
		}
	/********************-------------- End of Program Entry Form -----------******************/



	/***********************************************************************************************************************/
	/*--------------------------------------------Wrieter Module Setup ---------------------------------------------*/
	/***********************************************************************************************************************/

	function WriterList($type)
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();
		$data['news_writer_list'] = $this->admin_model->writerListInfo($type);
		$data['content'] = 'admin_pages/writer_list';
		$this->load->view('include/admin_template', $data);
	}

	function writerSetup()
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();

		$this->form_validation->set_rules('writer_type', 'Type', 'required|trim');
		$this->form_validation->set_rules('writer_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('writer_name_en', 'Name (English)', 'required|trim');
		$this->form_validation->set_rules('writer_designation', 'Designation', 'required|trim');

		$data['get_writer_data'] = ''; /* for edit */
		$data['status'] = '';

		if ($this->form_validation->run() == FALSE) {
			$data['status'] = '';
			$data['content'] = 'admin_pages/writer_setup';
			$this->load->view('include/admin_template', $data);
		} else {
			if ($data['last_id'] = $this->admin_model->writerEntry()) {
				$data['status'] = 'successful';
				$last_id = $data['last_id'];
				$tbl_name = $this->input->post('tbl_name');
				$i = -10;
				$this->test_upload($last_id, $tbl_name, $i);
				$this->session->set_userdata("success_message", "Writer Added Successfully");
				$this->cache_optimizer('insert', $last_id);
				if($this->input->post('writer_type') == 1){
					redirect(site_url("admin/WriterList/1"));
				}
				if($this->input->post('writer_type') == 2){
					redirect(site_url("admin/WriterList/2"));
				}
				
			} else {
				$data['status'] = 'failed';
				$data['content'] = 'admin_pages/writer_setup';
				$this->load->view('include/admin_template', $data);
			}
		}
	}


	function EditWriter($id)
	{
		$data['user_name'] 		= $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] 		= $this->tank_auth->get_user_type();

		$this->form_validation->set_rules('writer_type', 'Type', 'required|trim');
		$this->form_validation->set_rules('writer_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('writer_name_en', 'Name (English)', 'required|trim');
		$this->form_validation->set_rules('writer_designation', 'Designation', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$data['status'] = '';
		} else {
			if ($data['last_id'] = $this->admin_model->writer_edit_entry($id)) {
				$file = $_FILES['user_avatar']['name'];
				if ($file) {
					$last_id = $id;
					$tbl_name = $this->input->post('tbl_name'); /*-- Table Name get korse hidden form theke --*/
					$i = -10;
					$this->test_upload($last_id, $tbl_name, $i);	// image upload korar jonno data gula niche Upload() Function a pathanu hoise //
				}
				// $data['status'] = 'edit';	
				$this->cache_optimizer('edit', $id);
				$this->session->set_userdata("success_message", "Writer Updated");
				if ($this->input->post('writer_type') == 1) {
					redirect(site_url("admin/WriterList/1"));
				}
				if ($this->input->post('writer_type') == 2) {
					redirect(site_url("admin/WriterList/2"));
				}
			} else {
				$data['status'] = 'failed';
			}
		}
		$data['get_writer_data']	= $this->admin_model->get_writer_data($id);
		$data['writer_id']				= $id;
		$data['status'] 			= '';

		$data['content'] = 'admin_pages/writer_setup';
		$this->load->view('include/admin_template', $data);
	}


	function fetch_author_by_cat()
	{

		if(!$this->input->post('cat_id')){
			echo $this->admin_model->writer_list_by_author($news_author_type = '');
		}

		$news_author_type = 1;
		if($this->input->post('cat_id') == 5)
		{
			$news_author_type = 2;
			echo $this->admin_model->writer_list_by_author($news_author_type);
		}
		else{
			echo $this->admin_model->writer_list_by_author($news_author_type);
		}


	}

	

	/***********************************************************************************************************************/
	/*--------------------------------------------Wrieter Module Setup ---------------------------------------------*/
	/***********************************************************************************************************************/






	/***********************************************************************************************************************/
	/*-------------------------------------------- UPLOAD WITH RESIZING IMAGE ---------------------------------------------*/
	/***********************************************************************************************************************/
	public function test_upload($last_id, $tbl_name, $i, $directory = '')
	{
		if ($i > 0) { /*-- For Multiple Upload Change the user file name --*/
			$_FILES['user_avatar'] = $_FILES['user_avatar' . $i . ''];
		}


		else if ($_FILES['user_avatar']['error'] == 0) {
			if ($i > 0) /*------- For Multiple Upload ----------*/ {
				$filename 				= $_FILES['user_avatar' . $i . '']['name']; /*-- Original Uploaded pic name (mad.jpg) */
				$filetype 				= $_FILES['user_avatar' . $i . '']['type'];  /*--- png|jpg|gif ---*/
				$file_content 			= $_FILES['user_avatar' . $i . '']['tmp_name'];  /*-- Xampp ar vitor tmp file ar location --*/
				$_FILES['user_avatar']	= $_FILES['user_avatar' . $i . ''];
			} else /*------- Single Image Upload ----------*/ {
				$file_name		= $_FILES['user_avatar']['name'];
				/***-- Original Uploaded pic name (mad.jpg) --*/
				$filetype 		= $_FILES['user_avatar']['type'];
				/***--- png/jpg ---*/
				$file_content 	= $_FILES['user_avatar']['tmp_name'];
			}

			if ($filetype == "image/jpeg")
			$file_type = 'jpg';
			else if ($filetype == "image/gif")
			$file_type = 'gif';
			else if ($filetype == "image/jpg")
			$file_type = 'jpg';
			else if ($filetype == "image/pjpeg")
			$file_type = 'pjpeg';
			else if ($filetype ==  "image/png")
			$file_type = 'png';
			else if ($filetype ==  "application/msword")
			$file_type = 'doc';
			else if ($filetype ==  "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
			$file_type = 'docx';
			else if ($filetype ==  "application/zip")
			$file_type = 'zip';
			else if ($filetype ==  "application/octet-stream") /* rar kaj kore na */
			$file_type = 'rar';
			else if ($filetype ==  "application/pdf")
			$file_type = 'pdf';
			else if ($filetype ==  "application/msword")
			$file_type = 'doc';
			else if ($filetype ==  "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
			$file_type = 'docx';
			else if ($filetype ==  "application/vnd.ms-excel")
			$file_type = 'xls';
			else if ($filetype ==  "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
			$file_type = 'xlsx';


			/*--------- Rename the Picture with Pic ID ---------*/
			$_FILES['user_avatar']['name']	= $last_id . '.' . $file_type;
			$filename						= $_FILES['user_avatar']['name'];
			/*--------------------- End of Rename -----------------*/

			// Uporer  curPageURL() Function teke url ta get kora hoise
			$url 			= $this->curPageURL();
			$current_url 	= str_replace("www.", "", $url);
			$response 		= $this->image_upload->upload_with_thumb($filename, $file_content, $file_type, $last_id, $tbl_name, $current_url, $directory);
		}
	}





	public function file_upload($last_id, $tbl_name, $i, $directory = '')
	{
		if ($i > 0) { /*-- For Multiple Upload Change the user file name --*/
			$_FILES['ep_file'] = $_FILES['ep_file' . $i . ''];
		}

		if ($_FILES['ep_file']['error'] == 0) {
			if ($i > 0) /*------- For Multiple Upload ----------*/ {
				$filename 				= $_FILES['ep_file' . $i . '']['name']; /*-- Original Uploaded pic name (mad.jpg) */
				$filetype 				= $_FILES['ep_file' . $i . '']['type'];  /*--- png|jpg|gif ---*/
				$file_content 			= $_FILES['ep_file' . $i . '']['tmp_name'];  /*-- Xampp ar vitor tmp file ar location --*/
				$_FILES['ep_file']	= $_FILES['ep_file' . $i . ''];
			} else /*------- Single Image Upload ----------*/ {
				$file_name		= $_FILES['ep_file']['name'];
				/***-- Original Uploaded pic name (mad.jpg) --*/
				$filetype 		= $_FILES['ep_file']['type'];
				/***--- png/jpg ---*/
				$file_content 	= $_FILES['ep_file']['tmp_name'];
			}

			if ($filetype ==  "application/pdf")
			$file_type = 'pdf';
			else if ($filetype ==  "application/msword")
			$file_type = 'doc';
			else if ($filetype ==  "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
			$file_type = 'docx';
			else if ($filetype ==  "application/vnd.ms-excel")
			$file_type = 'xls';
			else if ($filetype ==  "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet")
			$file_type = 'xlsx';


			/*--------- Rename the Picture with Pic ID ---------*/
			$_FILES['ep_file']['name']	= $last_id . '.' . $file_type;
			$filename						= $_FILES['ep_file']['name'];
			/*--------------------- End of Rename -----------------*/

			// Uporer  curPageURL() Function teke url ta get kora hoise
			// $url 			= $this->curPageURL();
			// $current_url 	= str_replace("www.", "", $url);
			$response 		= $this->image_upload->upload_with_pdf($filename, $file_content, $file_type, $last_id, $tbl_name, $directory);
		}

	}
	/********************************************************************************************/
	/*------------------------- END OF UPLOAD WITH RESIZING IMAGE ------------------------------*/
	/********************************************************************************************/






	/*-----------------------User Data --------------------------*/
	public function UsersList(){
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
	
		$data['user_list_info']=$this ->admin_model-> user_info_list($data['user_type']);
		
	

		$data['content'] = 'admin_pages/users_list';
		$this-> load-> view('include/admin_template', $data);

	}

	/***************  Delete User  **************************/
	
	function UpdateUserStatus($id, $status)
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		$data['user_delete']=$this -> admin_model-> user_delete($id, $status);
		$data['user_list_info']=$this ->admin_model-> user_info_list($data['user_type']);
		
		if($data['user_delete'])
			$data['status'] = 'delete';
		else
			$data['status'] = 'failed';
		
		$data['content'] = 'admin_pages/users_list';
		$this-> load-> view('include/admin_template', $data);
	}
	/*-----------------------User Data --------------------------*/


	/*-------------------------Member Setup------------------------*/

	function MemberSetup()
	{
		$data['user_name'] 		= $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] 		= $this->tank_auth->get_user_type();

		$this->form_validation->set_rules('mem_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('mem_designation', 'Designation', 'required|trim');
		$this->form_validation->set_rules('mem_group', 'Group', 'required|trim');

		$data['member_info'] = '';

		if ($this->form_validation->run() == FALSE) {
			$data['status'] = '';
		} 
		else {
			if ($data['last_id'] = $this->admin_model->member_entry()) {
				$last_id		= $data['last_id'];
				$file			= $_FILES['user_avatar']['name'];
				if ($file) {
					$tbl_name 	= $this->input->post('tbl_name');
					$i			= -10;
					$this->test_upload($last_id, $tbl_name, $i);
				}
				$success_data['success_message'] = 'Member Profile Successfully Uploaded';
				$this->session->set_userdata($success_data);
				redirect('Admin/MemberSetup');
			}
		}

		$data['content'] = 'admin_pages/member_setup';
		$this->load->view('include/admin_template', $data);
	}


	public function MemberList(){
		$data['user_name'] 		= $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] 		= $this->tank_auth->get_user_type();

		$data['secetary_info'] = $this->admin_model->member_list(1);
		$data['reporter_info'] = $this->admin_model->member_list(2);
		$data['photo_section_info'] = $this->admin_model->member_list(3);
		$data['office_staff_info'] = $this->admin_model->member_list(4);
 

		$data['content'] = 'admin_pages/member_list';
		$this->load->view('include/admin_template', $data);
	}



	public function updateRank(){
		$position = $this->input->post('position');
		$this->admin_model->UpdateMenu($position);
		
	}

	public function EditMember($id){
		$data['user_name'] 		= $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] 		= $this->tank_auth->get_user_type();

		$this->form_validation->set_rules('mem_name', 'Name', 'required|trim');
		$this->form_validation->set_rules('mem_designation', 'Designation', 'required|trim');
		$this->form_validation->set_rules('mem_group', 'Group', 'required|trim');

	

		

		if ($this->form_validation->run() == FALSE) {
			$data['status'] = '';
		} else {
			if ($data['last_id'] = $this->admin_model->member_update($id)) {
				$file = $_FILES['user_avatar']['name'];
				if ($file) {
					$last_id = $id;
					$tbl_name = $this->input->post('tbl_name'); /*-- Table Name get korse hidden form theke --*/
					$i = -10;
					$this->test_upload($last_id, $tbl_name, $i);	// image upload korar jonno data gula niche Upload() Function a pathanu hoise //
				}	
				$success_data['success_message'] = "Member Updated Succesfully";
				$this->session->set_userdata($success_data);
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$data['status'] = 'failed';
			}
		}

		$data['member_info']	= $this->admin_model->member_info($id);
		$data['id']				= $id;
		$data['status'] 			= '';

		$data['content'] = 'admin_pages/member_setup';
		$this->load->view('include/admin_template', $data);
	}
	/*-------------------------Member Setup------------------------*/


	/****************  E-paper *******************/
	function ePaperList()
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();

		$data['ePaper_list'] = $this->admin_model->ePaperListInfo();
		

		$data['content'] = 'admin_pages/epaper/epaper_list';
		$this->load->view('include/admin_template', $data);
	}

	public function ePaperSetup(){
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();


		$this->form_validation->set_rules('ep_subject', 'Subject', 'required|trim');
		

		$data['get_ePaper_data'] = ''; /* for edit */
		$data['status'] = '';


		
		


		if ($this->form_validation->run() == FALSE) {
			$data['status'] = '';
			$data['content'] = 'admin_pages/epaper/epaper_setup';
			$this->load->view('include/admin_template', $data);
		} else {
			
			if ($data['last_id'] = $this->admin_model->ePaperEntry()) {
				$data['status'] = 'successful';
				$last_id = $data['last_id'];
				// $tbl_name = $this->input->post('tbl_name');
				// $i = -10;
				// $this->file_upload($last_id, $tbl_name, $i);
				// $this->test_upload($last_id, $tbl_name, $i);

				$this->cache_optimizer('insert', $last_id);
				$this->session->set_userdata("success_message", "ePaper Added Successfully");
				redirect(site_url("admin/ePaperList"));
			} else {
				$data['status'] = 'failed';
				$data['content'] = 'admin_pages/epaper/epaper_setup';
				$this->load->view('include/admin_template', $data);
			}
		}
	}

	public function EditePaper($ep_id){
		$data['user_name'] 		= $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] 		= $this->tank_auth->get_user_type();

		$this->form_validation->set_rules('ep_subject', 'Subject', 'required|trim');

		if ($this->form_validation->run() == FALSE) {
			$data['status'] = '';
		} else {
			if ($data['last_id'] = $this->admin_model->ePaper_edit_entry($ep_id)) {
				// $file = $_FILES['user_avatar']['name'];

				// $data['status'] = 'edit';
				$this->cache_optimizer('edit', $ep_id);	
				$this->session->set_userdata("success_message", "ePaper Updated Successfully");
				redirect($_SERVER['HTTP_REFERER']);
			} else {
				$data['status'] = 'failed';
			}
		}
		$data['get_ePaper_data']	= $this->admin_model->get_ePaper_data($ep_id);

		// print_r($data['get_ePaper_data']); die(); 
		$data['ePaper_id']				= $ep_id;
		$data['status'] 			= '';

		$data['content'] = 'admin_pages/epaper/epaper_setup';
		$this->load->view('include/admin_template', $data);
	}
	/****************  E-paper *******************/


	// Share Image 
	public function ShareImage(){
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();
		$data['share_image_list'] = $this->admin_model->ShareImageListInfo();
		
		$data['content'] = 'admin_pages/share/share_setup';
		$this->load->view('include/admin_template', $data);
	}

	public function ShareImageSetup(){
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();
		$data['share_image_list'] = $this->admin_model->ShareImageListInfo();
		if ($_FILES['user_avatar']['name'] == ''){
			$data['status'] = 'bg-danger';
			$data['error'] = "OH SORRY ! IMAGE FIELD IS REQUIRED !"; 
			$data['content'] = 'admin_pages/share/share_setup';
			return $this->load->view('include/admin_template', $data);
		}
		if ($_FILES['user_avatar']['name'] != ''){


			$url = $_FILES['user_avatar']['tmp_name'];
			$data_image = getimagesize($url);
			$widthGet = $data_image[0];
			$heightGet = $data_image[1];

			if($widthGet != 728 ){

				
				$data['status'] = 'bg-warning';
				$data['error'] = " SORRY ! Image Width must be 728px  !"; 
				$data['content'] = 'admin_pages/share/share_setup';
				return $this->load->view('include/admin_template', $data);
			}
			if($widthGet == 728 && $heightGet < 100){
				
				if ($data['last_id'] = $this->admin_model->ShareImageEntry()) {
					$last_id = $data['last_id'];
					$tbl_name = $this->input->post('tbl_name');
					$i = -10;
					$this->test_upload($last_id, $tbl_name, $i);
					
					$this->cache_optimizer('insert', $last_id);
					$this->session->set_userdata("success_message", "Share Image Set Successfully!");
					redirect(site_url("share-footer-image"));
				} 
			}
		}	
	}

	// public function DeleteShareImage($id){
	// 	$data['share_image_remove'] = $this->admin_model->ShareImageRemove($id);
	// 	redirect($_SERVER['HTTP_REFERER']);
	// }
	// public function SetShareImage($id){
	// 	$data['share_image_active'] = $this->admin_model->ShareImageActive($id);
	// 	redirect($_SERVER['HTTP_REFERER']);
	// }


	public function edit_status_share(){
		$this->admin_model->edit_share_status($this->input->post('id'));
		redirect($_SERVER['HTTP_REFERER']);
		
	}
	// Share Image 


	// Prayer Module 


	function PrayerTime()
	{
		$data['user_name'] = $this->tank_auth->get_username();
		$data['user_full_name'] = $this->tank_auth->get_user_full_name();
		$data['user_type'] = $this->tank_auth->get_user_type();

		// $data['ePaper_list'] = $this->admin_model->ePaperListInfo();
		

		$data['content'] = 'admin_pages/prayer/prayer_table';
		$this->load->view('include/admin_template', $data);
	}

	function load_data()
	{
		$data = $this->admin_model->load_data();
		// $data['share_image_list'] = $this->admin_model->ShareImageListInfo();
		echo json_encode($data);
	}

	function update()
	{
		$data = array(
			$this->input->post('table_column') => $this->input->post('value')
		);

		$this->admin_model->update($data, $this->input->post('id'));
	}



	// Prayer Module 
	
	
	
	/********************************************************************************/
	/*---------------------------- Start NEWS Segment ------------------------------*/
	/********************************************************************************/




	function news_segment(){
		$data['user_name'] 			= $this-> tank_auth -> get_username();
		$data['user_full_name'] 	= $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 			= $this-> tank_auth -> get_user_type();
		$data['list']				= $this -> admin_model-> news_segment_info_list();
		$data['content'] 			= 'admin_pages/news_segment/index';
		$this->load->view('include/admin_template',$data);
	}
	function add_news_segment(){
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();

		$this->form_validation->set_rules('segment_title','Title', 'required|trim|is_unique[news_segment.segment_title]');
		
		if ($this->form_validation->run() == FALSE)
		{
			$data['content'] 	= 'admin_pages/news_segment/add';
			$this->load->view('include/admin_template',$data);
		}else{
			if($result_id=$this ->admin_model-> news_segment_entry())
			{
			    $this->db->cache_delete('default', 'index');
				$last_id = $result_id;
				$success_data['success_message'] = "Created Successfully.";
				$this->session->set_userdata($success_data);
				redirect('news-segment');
			}
		}
	}

	function edit_news_segment($id){
		$data['user_name'] 			= $this-> tank_auth -> get_username();
		$data['user_full_name'] 	= $this-> tank_auth -> get_user_full_name();
		$data['user_type'] 			= $this-> tank_auth -> get_user_type();

		$this->db->cache_off(); 
		$query = $this-> db-> query("SELECT * FROM `news_segment` WHERE `segment_id` = '".$id."'");
		$data['edit_data'] = $query->row(); 

		if($query->row()->segment_title != $this->input->post('segment_title')){
			$this->form_validation->set_rules('segment_title','Title', 'required|trim|is_unique[news_segment.segment_title]');
		}else{
			$this->form_validation->set_rules('segment_title','Title', 'required|trim');
		}
		 
		if ($this->form_validation->run() == FALSE)
		{
			$data['content'] 	= 'admin_pages/news_segment/edit';
			$this->load->view('include/admin_template',$data);
		}else{

			$file_tmp2 = $_FILES['user_avatar_2']['tmp_name'];
			$size2 = filesize($file_tmp2)/1024;

			$file_tmp = $_FILES['user_avatar']['tmp_name'];
			$size = filesize($file_tmp)/1024;
			if($size > 101.00){ 
				$success_data['error_message'] = "OH SORRY ! BANNER IMAGE SIZE ERROR !";
				$this->session->set_userdata($success_data);
				redirect('edit-news-segment/'.$id);
			} 
			else if($size2 > 151){
				$success_data['error_message'] = "OH SORRY ! BACKGROUND IMAGE SIZE ERROR !";
				$this->session->set_userdata($success_data);
				redirect('edit-news-segment/'.$id);
			}
			else{
				if($data['last_id']=$this ->admin_model-> news_segment_edit($id))
				{
				    $this->db->cache_delete('default', 'index');
					$last_id = $data['last_id'];
					$success_data['success_message'] = "Updated Successfully.";
					$this->session->set_userdata($success_data);
					redirect('edit-news-segment/'.$id);
				}
			}
			
		}
	}

	/********************************************************************************/
	/*----------------------------- END Segment ------------------------------------*/
	/********************************************************************************/




	
	
	  /***************************************************************************/
	 /*--------------------------------- DB CACHE SYSTEM -----------------------*/
    /***************************************************************************/
		
	function cache_optimizer($action, $newsID){
	  
	    $result = $row = $this->admin_model->cache_news_search($newsID); //print_r($row);
	    
	    if($row){
    	    $subCatID 		= ($row-> sub_cat_id != 0) ? $row-> sub_cat_id : '';
    	    $subCatName     = '';
    	
    		if($subCatID){
    			$subCatName = $this-> db-> select('sub_cat_key_name')->from('sub_category_info')->where('sub_category_id', $subCatID)->get()->row()->sub_cat_key_name;
    			$subCatName = strtolower($subCatName);
    		}
    		//echo $row-> news_id.' >>> '.$subCatID.' >>> '.$subCatName;
    		
    		$this->db->cache_delete('default', 'index');   // HOME
    		
    		if($action == 'edit'){      $this->db->cache_delete('details', $row-> news_id); }  // ARTICLE 
	        if($subCatName){            $this->db->cache_delete($row-> cat_key_name, 'index'); }     // CATEGORY
    		if($subCatID){              $this->db->cache_delete($row-> cat_key_name, $subCatName); }     // SUB CATEGORY
	    }
	    return true;
	}
	
	function clear_all_cache(){
		$user_type = $this-> tank_auth -> get_user_type();
		if($user_type == 7){
			$this->db->cache_delete_all();
			$success_data['success_message'] = "Cache Clear Successfully.";
			$this->session->set_userdata($success_data);
			redirect(base_url('panel')); 
		}
	}
    /***************************************************************************/
	/*--------------------------------- DB CACHE SYSTEM -----------------------*/
    /***************************************************************************/
}




