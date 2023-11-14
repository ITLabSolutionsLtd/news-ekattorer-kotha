<?php
/****************
News Status
0 - Inactive News
1 - Headline
2 - Top News
3 - Breaking 
4 - Hide
5 - Normal
6 - Selective News
10 - Live Update
*******************/


/********************
POL_INFO
  1 => 'Normal'
  0 => 'Inactive',
  2 => 'Hide'
*******************/


/********************
ADVERTISE INFO
 1 => 'Normal',
 0 => 'Inactive',
 2 => 'Hide'
*******************/


class Query_model extends CI_Model{

	/*-------- Banner info --------*/
	function banner_info()
	{
		$query=$this->db->query("SELECT * FROM banner_info ORDER BY ban_id asc");
								
								
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	/*-----------------This Function Control Text Limit in several page -----------------------*/
	
	function limit_text($text, $limit)
	{
		if(strlen($text)>$limit)
		{
			$text = substr( $text,0,$limit );
			$text = substr( $text,0,-(strlen(strrchr($text,' '))) );
		}
		return $text;
	}
	
	/*-----------------End of Function Control Text Limit.-----------------------*/	
	
	
	
	/*----------------- REDUNDANCY CHECK -----------------------*/
	
	function redundancy_check($table, $field, $item)
	{
		$query = $this -> db -> select($field)
							 -> from($table)
							 -> where(''.$field." = '".$item."'")
							 -> get();							 
		return $query -> num_rows();
	}
		
	/*----------------- END OF REDUNDANCY CHECK -----------------------*/
	
	
	
	
	
	
	/*----------------- FETCH ALL PROJECT NAME -----------------------*/
	
	function fetch_project_info()		
	{
		$query = $this->db->select("project_id,project_name")				
				->from("project_info")
				->get();
			
		if($query->num_rows()>0)
		{
			$data[''] =  'Select Project From the List';

			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$name=$row -> project_name;
					
					$base_url_pagination=base_url();
					$data[$base_url_pagination.'site/booking/'.$row-> project_id]= $name;
				}
				return $data;
			}
		}
	}
	
	
	/*----------------- FETCH ALL SECTOR NAME -----------------------*/
	
	function fetch_sector_info($project_id)		
	{
		$query = $this->db->select("sector_id,sector_name")				
				->from("sector_info")
				->where('project_id', $project_id)
				->get();
			
		if($query->num_rows()>0)
		{
			$data[''] =  'Select Sector From the List';

			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$name=$row -> sector_name;
					
					$base_url_pagination=base_url();
					$data[$base_url_pagination.'site/booking/'.$project_id.'/'.$row-> sector_id]= $name;
				}
				return $data;
			}
		}
	}
	
	
	/*----------------- FETCH ALL PLOT NAME -----------------------*/
	
	function fetch_plot_number($project_id, $sector_id)		
	{
		$query = $this->db->select("plot_id,plot_title")				
				->from("plot_info")
				->where('sector_id', $sector_id)
				->get();
			
		if($query->num_rows()>0)
		{
			$data[''] =  'Select Plot From the List';

			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$name=$row -> plot_title;
					
					$base_url_pagination=base_url();
					$data[$base_url_pagination.'site/booking/'.$project_id.'/'.$sector_id.'/'.$row-> plot_id]= $name;
				}
				return $data;
			}
		}
	}
	
	
	/*----------------- FETCH ALL PLOT INFORMATION -----------------------*/
	
	function fetch_plot_info_details($plot_id)		
	{
		$query = $this->db->select("*")				
				->from("plot_info")
				->where("plot_id",$plot_id)
				->get();
			
		if($query->num_rows()>0)
		{
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]=$row;
				}
				return $data;
			}
		}
	}
	
	/*----------------- FETCH ALL OFFICERS INFORMATION -----------------------*/
	
	function fetch_officer_info($project_id, $sector_id, $plot_id)		
	{
		$query = $this->db->select("officer_id,officer_name,officer_des")				
				->from("officer_info")
				->get();
		
		$data[''] =  'Select By Whom you feel interested?';

		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$name=$row -> officer_name.' ('.$row -> officer_des.')';
				
				$base_url_pagination=base_url();
				$data[$base_url_pagination.'site/booking/'.$project_id.'/'.$sector_id.'/'.$plot_id.'/'.$row-> officer_id]= $name;
			}
			return $data;
		}
	}
	
	
	/*----------------- FETCH OFFICERS INFORMATION -----------------------*/
	
	function officer_info()		
	{
		$query = $this->db->select("*")				
				->from("officer_info")
				->get();
		
		//$data[''] =  'Select By Whom you feel interested?';

		if($query->num_rows()>0)
		{
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]=$row;
				}
				return $data;
			}
		}
	}
	
	
	/*----------------- FETCH A OFFICER FULL INFORMATION -----------------------*/
	
	function officer_info_full($id)		
	{
		$query = $this->db->select("*")				
				->from("officer_info")
				->where('officer_id', $id)
				->get();
		
		//$data[''] =  'Select By Whom you feel interested?';

		if($query->num_rows()>0)
		{
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]=$row;
				}
				return $data;
			}
		}
	}
	
	
	
	/*---------------------------- Biography ------------------------*/
	function about_info()
	{
		$query=$this->db->query("SELECT * FROM common_details WHERE news_type='about me'");
								
								
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	/*---------------------------- organization Info ------------------------*/
	function org_info()
	{
		$query=$this->db->query("SELECT * FROM common_details WHERE news_type='org info'");			
								
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	

	
	/*---------------------------- HISTORY ------------------------*/
	function history_info()
	{
		$query=$this-> db-> query("SELECT * FROM common_details WHERE news_type='history'");
								
								
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	
	/*---------------------------- Notice ------------------------*/
	
	function notice_info()
	{
		$query=$this->db->query("SELECT * FROM common_details WHERE news_type='notice'");
								
								
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	
	/*------------------------------------ Gallery Information ---------------------------------------*/
	
	function gal_info()
	{
		$query=$this->db->query("SELECT gal_name,gal_id FROM gal_info LIMIT 10");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	function single_gal_info($gal_id)
	{
		$query=$this->db->query("SELECT gal_name FROM gal_info WHERE gal_id='".$gal_id."'");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	function gal_id()
	{
		$query=$this->db->query("SELECT gal_id FROM gal_info");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	function gal_count()
	{
		$query=$this->db->query("SELECT COUNT(gal_id) as count FROM gal_info");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data = $row -> count;
			}
			return $data;
		}
	}
	
	/***------------------------ For Gallery wise Album Radomisely -------------------------***/
	
	function random_gal_album($gal_id)
	{
		$query=$this->db->query("SELECT gal_info.gal_id,gal_name,pic_id,img_ext
								FROM gal_info,album_info,album_details 
								WHERE gal_info.gal_id=album_info.gal_id
								
								AND album_info.a_id=album_details.a_id");
								
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	
	/***------ Function for Gallery where all the albums are shown (Returns all information about Album) ***/
	
	function query_gallery($gal_id)
	{
		$query=$this->db->query("SELECT * FROM album_info WHERE gal_id='".$gal_id."'");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	/***	Function for Gallery where all the albums are shown  (Returns all information about Picture) ***/
	
	function query_gallery2($gal_id)
	{
		$query=$this->db->query("SELECT album_info.a_id,album_details.pic_id,album_details.img_ext
								FROM album_info, album_details
								WHERE album_info.a_id = album_details.a_id
								AND album_info.gal_id ='".$gal_id."'");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	
	/***	Function for Gallery Details Page where all the pictures of a specific album are shown ***/
	function query_gallery_details($a_id)
	{
		$query=$this->db->query("SELECT DISTINCT * 
								FROM album_info, album_details
								WHERE album_info.a_id = album_details.a_id
								AND album_details.a_id ='".$a_id."'");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
		
	}
	
	
	/****--------------------- Last Album Finding Function ---------------------***/
	
	function last_album()
	{
		$query=$this->db->query("SELECT MAX(a_id) as max FROM album_info");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data = $row -> max;
			}
			return $data;
		}
	}
	
	
	function last_album_pic($max_a_id)
	{
		$query=$this->db->query("SELECT pic_id,img_ext FROM  album_details WHERE a_id='".$max_a_id."' ORDER BY RAND() limit 1"); /***------ Using Rand() to get randomize record
																																& for 1 random record or data fetching use LIMIT 1 -------***/
		
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				//$data = $row -> a_des ; /* For single data fetching */
				$data[] = $row;
			}
			return $data;
		}
	}
	
	
	function last_album_des($max_a_id)
	{
		$query=$this->db->query("SELECT a_title,a_des,a_doc FROM album_info WHERE a_id='".$max_a_id."'");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				//$data = $row -> a_des ;
				$data[] = $row;
			}
			return $data;
		}
	}
	
	/****--------------------- End of Last Album Finding Function ---------------------***/
	
	
	
	/****--------------------- Randomize Album Finding Function ---------------------***/
	
	function random_last_album()
	{
		$query=$this->db->query("SELECT a_id as max FROM album_info ORDER BY RAND() limit 1");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data = $row -> max;
			}
			return $data;
		}
	}
	
	/****--------------------- End of Randomize Album Finding Function ---------------------***/
	
	/*-------- Archievement info --------*/
	function achieve_info()
	{
		$query=$this->db->query("SELECT * FROM common_details WHERE news_type='achievements' ORDER BY news_id desc");
								
								
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]=$row;
			}
			return $data;
		}
	}
	
	function service_info()
	{
		$query=$this-> db-> query("SELECT * FROM service_info ORDER BY s_id asc");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]= $row;
			}
			
			return $data;
		}	
	}
	
	function last_service()
	{
		$query=$this-> db-> query("SELECT MAX(s_id) as max FROM service_info");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data = $row -> max; /* Because we get Max d_id as max, So $row-> max; */
			}
			return $data;
		}
	}
	
	
	function last_service_details($max_s_id)
	{
		$query=$this-> db-> query("SELECT * FROM  service_info WHERE s_id='".$max_s_id."' ORDER BY RAND() limit 1");
		if($query->num_rows()>0){
			foreach ($query->result() as $row){
				$data[] = $row;
			}
			return $data;
		}
	}
	
	
	function service_details($s_id)
	{
		$query=$this-> db-> query("SELECT * FROM  service_info WHERE s_id=".$s_id);
		
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	
	/***** ------------------------------------------------------ End of Service Info ------------------------------------------------ *****/
	
	
	
	
	/***** ------------------------------------------------------ Programs Info ------------------------------------------------ *****/
			
	function prog_info()
	{
		$query=$this-> db-> query("SELECT * FROM prog_info ORDER BY p_id desc");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]= $row;
			}
			
			return $data;
		}	
	}
	
	function last_prog()
	{
		$query=$this-> db-> query("SELECT MAX(p_id) as max FROM prog_info");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data = $row -> max; /* Because we get Max p_id as max, So $row-> max; */
			}
			return $data;
		}
	}
	
	
	function last_prog_details($max_p_id)
	{
		$query=$this-> db-> query("SELECT * FROM  prog_info WHERE p_id='".$max_p_id."' ORDER BY RAND() limit 1"); /***------ Using Rand() to get randomize record
																													& for 1 random record or data fetching use LIMIT 1 -------***/
		
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	
	
	function prog_details($p_id)
	{
		$query=$this-> db-> query("SELECT * FROM  prog_info WHERE p_id=".$p_id);
		
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	
	/***** ------------------------------------------------------ End of Programs Info ------------------------------------------------ *****/
	
	
	
	
	
	
	
	/***** Documentary Info Showing *****/
			
	function doc_info()
	{
		$query=$this-> db-> query("SELECT * FROM doc_info ORDER BY d_id desc");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]= $row;
			}
			
			return $data;
		}	
	}
	
	function last_doc()
	{
		$query=$this-> db-> query("SELECT MAX(d_id) as max FROM doc_info");
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data = $row -> max; /* Because we get Max d_id as max, So $row-> max; */
			}
			return $data;
		}
	}
	
	
	function last_doc_details($max_d_id)
	{
		$query=$this-> db-> query("SELECT * FROM  doc_info WHERE d_id='".$max_d_id."' ORDER BY RAND() limit 1"); /***------ Using Rand() to get randomize record
																																& for 1 random record or data fetching use LIMIT 1 -------***/
		
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	
	function doc_details($d_id)
	{
		$query=$this-> db-> query("SELECT * FROM  doc_info WHERE d_id=".$d_id);
		
		
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[] = $row;
			}
			return $data;
		}
	}
	
	
	
	/********---------------------------- Pagination in Doc Page ----------------------------------**********/
	
	function doc_show_num_row()   
	{
		$query = $this->db->select("COUNT('d_id') as show_num_row")	// pagination korar jonno total number of row ta controller a pathanu hoise
						->from('doc_info')
						->get(); 
				
		foreach ($query->result() as $field):
		{
			$data = $field -> show_num_row;
		}
		endforeach;
		  
		return $data;
	
	}
	
	
	
	/*-------------------------------- Doc Show --------------------------------*/
	function documentary_show($per_page)
	{
		$this-> db-> order_by("d_id", "desc");
		
		$query = $this-> db-> select('*')	
						   -> from('doc_info')
						   -> limit($per_page, $this -> uri -> segment(3)) /*-- Segment 3 theke per page a data show korbe --*/
						   -> get(); 
						
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]= $row;
			}
			return $data;
		}
	}
	
	/*************---------------------------- End of Pagination in Doc Page ----------------------------------**********/
	
	
	
	
	/********---------------------------- Pagination in Service Page ----------------------------------**********/
	
	function service_show_num_row()   
	{
		$query = $this->db->select("COUNT('s_id') as show_num_row")	// pagination korar jonno total number of row ta controller a pathanu hoise
						->from('service_info')
						->get(); 
				
		foreach ($query->result() as $field):
		{
			$data = $field -> show_num_row;
		}
		endforeach;
		  
		return $data;
	
	}
	
	
	
	/*-------------------------------- Service Show --------------------------------*/
	function service_show($per_page)
	{
		$this-> db-> order_by("s_id", "asc");
		
		$query = $this-> db-> select('*')	
						   -> from('service_info')
						   -> limit($per_page, $this -> uri -> segment(3)) /*-- Segment 3 theke per page a data show korbe --*/
						   -> get(); 
						
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]= $row;
			}
			return $data;
		}
	}
	
	/*************---------------------------- End of Pagination in Service Page ----------------------------------**********/
	
	
	
	
	/********---------------------------- Pagination in Program Page ----------------------------------**********/
	
	function prog_show_num_row()   
	{
		$query = $this->db->select("COUNT('p_id') as show_num_row")	// pagination korar jonno total number of row ta controller a pathanu hoise
						->from('prog_info')
						->get(); 
				
		foreach ($query->result() as $field):
		{
			$data = $field -> show_num_row;
		}
		endforeach;
		  
		return $data;
	
	}
	
	
	
	/*-------------------------------- Program Show --------------------------------*/
	function prog_show($per_page)
	{
		$this-> db-> order_by("p_id", "asc");
		
		$query = $this-> db-> select('*')	
						   -> from('prog_info')
						   -> limit($per_page, $this -> uri -> segment(3)) /*-- Segment 3 theke per page a data show korbe --*/
						   -> get(); 
						
		if($query->num_rows()>0)
		{
			foreach ($query->result() as $row)
			{
				$data[]= $row;
			}
			return $data;
		}
	}
	
	/*************---------------------------- End of Pagination in Program Page ----------------------------------**********/
	
	
	
	
	  /*------------------------------------------------------------------------------------------------------------------/ 
	 /------------------------------------------------- NEWS INFORMATION  ------------------------------/
	/------------------------------------------------------------------------------------------------------------------*/
	
		
		  /**************************************************************************/
		 /****************** NEWS ADVERTISE INFO **************************/
		/*************************************************************************/
		
		
		function news_advertise_info()
		{
			$timezone = "Asia/Dhaka";
			date_default_timezone_set($timezone);
			$bd_date=date('Y-m-d'); /* Like 2013-12-25 */
			
			$query=$this-> db-> query("SELECT add_id, add_title, add_link, cat_id, add_status, add_start_date, ad_size, position, add_end_date, img_ext
										FROM add_info
										WHERE add_status=1 AND (add_start_date<='".$bd_date."' AND add_end_date>='".$bd_date." ')");
														
			if($query->num_rows() > 0) return $query-> result();
			else return false;		
		}

		function news_advertise_count_catagorywise()
		{
			$this->db->cache_off();
			$timezone = "Asia/Dhaka";
			date_default_timezone_set($timezone);
			$bd_date=date('Y-m-d'); /* Like 2013-12-25 */
			
			$query=$this-> db-> query("SELECT add_id, add_title, add_link, cat_id, add_status, add_start_date, add_end_date, img_ext
										FROM add_info
										WHERE add_status=1 AND (add_start_date<='".$bd_date."' AND add_end_date>='".$bd_date." ')");
														
			if($query->num_rows() > 0) return $query-> result();
			else return false;		
		}
		
		
		  /*************************************************************************/
		 /************ NEWS ADVERTISE INFO (HOME PAGE) ****************/
		/*************************************************************************/
		
		
		function news_advertise_home_page($category_id, $limit)
		{
			$timezone = "America/Los_Angeles";
			date_default_timezone_set($timezone);
			$bd_date=date('Y-m-d'); /* Like 2013-12-25 */
			
			$query=$this-> db-> query("SELECT add_id, add_title, add_link, add_status, add_start_date, add_end_date, img_ext
														FROM add_info
														WHERE add_status=1 AND cat_id=".$category_id." AND (add_start_date<='".$bd_date."' AND add_end_date>='".$bd_date."')
														limit ".$limit."
													");
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				
				return $data;
			}		
		}
		
		
		 /**************************************************************************/
		 /****************** NEWS CATEGORY ID ******************************/
		/*************************************************************************/
		
		
		function news_category_id($category)
		{
			$query=$this-> db-> query("SELECT cat_id, cat_key_name
										FROM category_info
										WHERE cat_key_name='".$category."'");
														
			if($query->num_rows()>0){
				foreach ($query->result() as $row){
					$data= $row-> cat_id;
				}
				return $data;
			}		
		}
		
		
		  /*************************************************************************/
		 /*********************** NEWS POL ALL INFO ************************/
		/*************************************************************************/
		
		
		function news_pol_all_info()
		{
			/*------- Date function in CI --------------*/
			$timezone = "America/Los_Angeles";
			date_default_timezone_set($timezone);
			$bd_date=date('Y-m-d'); /* Like 2013-12-25 */
			/***-------- End of Date function in CI -------------***/
			
			$query = $this-> db-> query("SELECT * FROM pol_info WHERE pol_status=1 ORDER BY pol_id DESC LIMIT 10");
												
			if($query->num_rows()>0){
				foreach ($query->result() as $row){
					$data[]= $row;
				}
				return $data;
			}		
		}

		
		  /**************************************************************************/
		 /************************ HEADLINE ALL INFO *************************/
		/*************************************************************************/
		
		
		function head_line_all_info()
		{
			$query=$this-> db-> query("SELECT news_info.news_id, news_info.news_headline, news_info.news_status, category_info.cat_key_name
														FROM news_info, category_info
														WHERE (category_info.cat_id=news_info.cat_id AND (news_info.news_status=1 OR news_info.news_status=2 OR news_info.news_status=6))
														ORDER BY news_info.news_id DESC LIMIT 10");
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;		
		}
		
		
		  /**************************************************************************/
		 /************************** GALLERY INFO ***************************/
		/*************************************************************************/
		
		
		function gallery_news_info($limit)
		{
			$query=$this-> db-> query("SELECT img_id, img_ext, img_caption
									FROM news_gallery_info
									WHERE img_ext!=''
									ORDER BY img_id DESC LIMIT ".$limit."");
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}

		
		  /**************************************************************************/
		 /************************************ JOB INFO ****************************/
		/**************************************************************************/
		
		
		function jobInfoList($type,$limit)
		{
			if($type==0)
			{
				$query=$this-> db-> query("SELECT *
										FROM job_info
										ORDER BY job_id DESC LIMIT ".$limit." ");
			}
			else
			{
				$query=$this-> db-> query("SELECT *
										FROM job_info
										WHERE job_info.job_id=".$type."
										");
			
			}
			
			
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				
				return $data;
			}		
		}
		
		
		  /**************************************************************************/
		 /****************** OTHER MEDIA NEWS  INFO **********************/
		/*************************************************************************/
		
		
		function other_media_news_info($type,$limit)
		{
			$query=$this-> db-> query("SELECT media_news_headline, media_news_link, media_news_info.media_id, img_ext, media_name
															FROM media_info, media_news_info
															WHERE media_info.media_id=media_news_info.media_id
															AND media_info.media_type=".$type."
															ORDER BY media_news_id DESC LIMIT ".$limit." ");
			
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				
				return $data;
			}		
		}
		
		
		  /**************************************************************************/
		 /********************* RUNNING POL INFORMATION *****************/
		/*************************************************************************/
		
		
		function running_pol_info()
		{
			/*------- Date function in CI --------------*/
			$timezone = "America/Los_Angeles";
			date_default_timezone_set($timezone);
			$bd_date=date('Y-m-d'); /* Like 2013-12-25 */
			/***-------- End of Date function in CI -------------***/
			
			
			$query=$this-> db-> query("SELECT pol_id, pol_title, pol_start_date, pol_end_date, pol_status,yes,no,no_com
														FROM pol_info
														WHERE pol_status=1 AND (pol_start_date<='".$bd_date."' AND pol_end_date>='".$bd_date."')
														ORDER BY pol_id DESC LIMIT 1");
			
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				
				return $data;
			}		
		}
		
		
		  /**************************************************************************/
		 /*********************** POPULAR 7 NEWS INFO *******************/
		/*************************************************************************/
		
		
		function popular_seven_news_info($limit)
		{
			$date1=date('Y-m-d', strtotime('-5 days')); /* DATE OF 5 DAYS AGO */
			$bd_date=date('Y-m-d'); /* Like 2013-12-25 */

			$query=$this-> db-> query("
										SELECT news_info.news_id, news_info.news_headline,news_info.news_status, category_info.cat_key_name,news_info.news_reader,news_info.img_ext		         
										FROM news_info,category_info
										WHERE news_info.news_status!=0 
										AND news_info.news_status!=4 
										AND category_info.cat_id=news_info.cat_id 
										AND (cast(news_pub_date as date)>='".$date1."')
										ORDER BY news_info.news_reader DESC LIMIT ".$limit."
									");						
		
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}
				
				
		  /**************************************************************************/
		 /*********************** SINGLE NEWS INFO ************************/
		/*************************************************************************/
		
		
		function single_news_info($news_id)
		{
			// $query=$this-> db-> query("SELECT * FROM news_common_info, category_info WHERE category_info.cat_id=news_common_info.cat_id AND news_common_info.news_id='".$news_id."'");
			$this->db->select('news_info.*, news_common_info.*, category_info.cat_key_name, category_info.cat_name, news_common_info.author_id, writer_info.writer_name,writer_info.writer_bio,writer_info.writer_email, writer_info.img_ext AS writerImage, seo_title, seo_keyword, seo_description, news_tag');
			$this->db->from('news_info, news_common_info, category_info');
			$this->db->where('news_info.news_id = news_common_info.news_id');
			$this->db->where('category_info.cat_id = news_common_info.cat_id');
			$this->db->where('news_info.news_id', $news_id);
			$this->db->where('news_common_info.news_status != ', 0);
			$this->db->where('news_common_info.news_status != ', 4);
			$this->db->where('news_common_info.news_status != ', 10);
			$this->db->join('news_seo_info', 'news_common_info.news_id = news_seo_info.news_id', 'left');
			$this->db->join('writer_info', 'news_common_info.author_id = writer_info.writer_id', 'left');
			$this->db->join('news_tag_info', 'news_common_info.news_id = news_tag_info.news_id', 'left');
			$query = $this->db->get();

			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}

		function single_news_info_updated($news_id)
		{
			$this->db->select('news_info.*, news_common_info.*, category_info.cat_key_name, category_info.cat_name, news_common_info.author_id, news_info.video_link, news_info.video_caption, news_info.news_source, news_info.news_source_link, writer_info.writer_name,writer_info.writer_bio,writer_info.writer_email, writer_info.img_ext AS writerImage, seo_title, seo_keyword, seo_description, news_tag');
			$this->db->from('news_info, news_common_info, category_info');
			$this->db->where('news_info.news_id = news_common_info.news_id');
			$this->db->where('category_info.cat_id = news_common_info.cat_id');
			$this->db->where('news_info.news_id', $news_id);
			$this->db->where('news_common_info.news_status != ', 0);
			$this->db->where('news_common_info.news_status != ', 4);
			$this->db->where('news_common_info.news_status != ', 10);
			$this->db->join('news_seo_info', 'news_common_info.news_id = news_seo_info.news_id', 'left');
			$this->db->join('writer_info', 'news_common_info.author_id = writer_info.writer_id', 'left');
			$this->db->join('news_tag_info', 'news_common_info.news_id = news_tag_info.news_id', 'left');
			$query = $this->db->get();
							
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}

		// function author_info_by_id($id)
		// {
		// 	$this->db->select('writer_info.writer_id, writer_info.writer_name,writer_info.writer_name_en,writer_info.img_ext');
		// 	$this->db->from('writer_info');
		// 	$this->db->where('writer_info.writer_id', $id);
		// 	$query = $this->db->get();

		// 	if($query->num_rows() > 0) return $query->row();
		// 	else return false;
			
		// }

		function writerInfo($news_id, $type){
			$this->db->cache_off();

			if($type == 1){
				$this->db->select('writer_info.writer_id, writer_info.writer_name,writer_info.writer_name_en, writer_info.writer_designation, writer_info.img_ext');
				$this->db->from('news_writer_info');
				$this->db->where('news_writer_info.news_id', $news_id);
				$this->db->where('news_writer_info.writer_type', 1);
				$this->db->join('writer_info', 'news_writer_info.author_ids = writer_info.writer_id', 'left');
				$query = $this->db->get();
				
				// return $query->result() ;

				if($query->num_rows() > 0) return $query->result();
				else return false;
				
			}
			
			if($type == 2){
				$this->db->select('reporter_ids');
				$this->db->from('news_writer_info');
				$this->db->where('news_writer_info.news_id', $news_id);
				$this->db->where('news_writer_info.writer_type', 2);

				$this->db->join('writer_info', 'news_writer_info.author_ids = writer_info.writer_id', 'left');
				$query = $this->db->get();

				return $query->row();
				

			}
			
			
			// $book_subject = DB::table('tbl_book_subject')->where('book_id',$id)->get();
		}



		
		  /**************************************************************************/
		 /***************** CATEGORY WISE NEWS INFO *****************/
		/*************************************************************************/

		// function category_wise_news_load_info($category, $news_id, $limit)
		// {
		// 	$query = $this->db->query("SELECT news_common_info.news_id, news_common_info.news_headline, news_common_info.news_status, news_common_info.img_ext, category_info.cat_key_name, category_info.cat_name, news_common_info.news_pub_date,news_common_info.news_pub_time
		// 												FROM news_common_info, category_info
		// 												WHERE news_common_info.news_status!=0 AND news_common_info.news_status!=4 AND category_info.cat_id=news_common_info.cat_id AND category_info.cat_key_name='" . $category . "' AND news_common_info.news_id!='" . $news_id . "'
		// 													ORDER BY news_id DESC LIMIT " . $limit . "");

		// 	if ($query->num_rows() > 0) return $query->result();
		// 	else return false;
		// }

		function category_wise_news_info($category, $news_id, $limit)
		{
			$query=$this-> db-> query("SELECT news_common_info.news_id, news_common_info.news_headline,news_common_info.news_details_brief, news_common_info.news_status, news_common_info.img_ext, category_info.cat_key_name, category_info.cat_name, news_common_info.news_pub_date,news_common_info.news_pub_time
													FROM news_common_info, category_info
													WHERE news_common_info.news_status!=0 AND news_common_info.news_status!=4 AND category_info.cat_id=news_common_info.cat_id AND category_info.cat_key_name='".$category."' AND news_common_info.news_id!='".$news_id."'
														ORDER BY news_id DESC LIMIT ".$limit."");
														
			if($query->num_rows() > 0) return $query-> result();
			else return false;		
		}

		function print_news($news_id){
			$query=$this-> db-> query("SELECT news_common_info.news_id, news_info.news_details, news_common_info.news_headline, news_common_info.news_status, news_common_info.img_ext, news_common_info.news_pub_date,news_common_info.news_pub_time
										FROM news_common_info, news_info
										WHERE news_common_info.news_id = news_info.news_id AND   news_common_info.news_id ='".$news_id."' ");				
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}
		
		
		  /**************************************************************************/
		 /***************** CATEGORY WISE NEWS INFO *****************/
		/*************************************************************************/

		function get_cat_name($category){
			$this->db->select('cat_name');
			$this->db->from('category_info');
			$this->db->where("category_info.cat_key_name='" . $category . "'");
			$this->db->limit(1);
			$query = $this->db->get();

			if ($query->num_rows() > 0) return $query->result();
			else return false;
		}
		function get_subcategory($subcategory){
			$this->db->select('sub_cat_name');
			$this->db->from('sub_category_info');
			$this->db->where("sub_category_info.sub_cat_key_name='" . $subcategory . "'");
			$this->db->limit(1);
			$query = $this->db->get();

			if ($query->num_rows() > 0) return $query->result();
			else return false;
		}

		function category_wise_news_all_info($category, $limit)
		{
			$this->db->cache_off(); 
			$segment_name = "";
			$segment_name = $this -> uri -> segment(4);

			if($segment_name){
				$query=$this-> db-> query("SELECT news_common_info.news_id,news_common_info.cat_id, news_common_info.news_headline, news_common_info.news_status, category_info.cat_key_name, category_info.cat_name, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_details_brief, news_common_info.catStatus, news_common_info.news_pub_date,news_common_info.news_pub_time, news_common_info.news_mod_date,writer_info.writer_id,writer_info.writer_name
											FROM news_common_info, category_info,writer_info
											WHERE news_common_info.news_status != 10 AND news_common_info.news_status != 0 AND news_common_info.news_status != 4 AND category_info.cat_id=news_common_info.cat_id AND category_info.cat_key_name='".$category."' 
											ORDER BY news_id DESC LIMIT ".$segment_name.",".$limit."");
			}
			else{
				$this->db->select('news_common_info.news_id,news_common_info.headline_tag,news_common_info.cat_id, news_common_info.news_headline, news_common_info.news_status,news_common_info.author_id, category_info.cat_key_name, category_info.cat_name, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_details_brief, news_common_info.catStatus, news_common_info.news_pub_date,news_common_info.news_pub_time, news_common_info.news_mod_date,writer_info.writer_id,writer_info.writer_name');
				$this->db->from('news_common_info');
				$this->db->join('writer_info','news_common_info.author_id = writer_info.writer_id', 'left');
				$this->db->join('category_info','category_info.cat_id = news_common_info.cat_id');
				// $this->db->where('category_info.cat_id=news_common_info.cat_id');
				$this->db->where('news_common_info.news_status != 10');
				$this->db->where('news_common_info.news_status != 0');
				$this->db->where('news_common_info.news_status != 4');
				$this->db->where("category_info.cat_key_name='".$category."'");
				$this->db->order_by('news_id', 'DESC');
				$this->db->limit($limit);
				$query = $this->db->get();

				// $query=$this-> db-> query("SELECT news_common_info.news_id, news_common_info.news_headline, news_common_info.news_status,news_common_info.author_id, category_info.cat_key_name, category_info.cat_name, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_details_brief, news_common_info.catStatus, news_common_info.news_pub_date,news_common_info.news_pub_time, news_common_info.news_mod_date,writer_info.writer_id,writer_info.writer_name
				// 							FROM news_common_info, category_info ,writer_info
				// 							WHERE news_common_info.news_status != 10 AND news_common_info.news_status != 0 AND news_common_info.news_status != 4 AND category_info.cat_id=news_common_info.cat_id AND category_info.cat_key_name='".$category."'
				// 							ORDER BY news_id DESC LIMIT ".$limit."");
			}
		
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}

		function category_wise_sylhet_news_all_info($category, $limit)
		{
			
			$this->db->select('news_common_info.news_id,news_common_info.cat_id, news_common_info.news_headline, news_common_info.news_status,news_common_info.author_id, category_info.cat_key_name, category_info.cat_name, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_details_brief, news_common_info.catStatus, news_common_info.news_pub_date,news_common_info.news_pub_time, news_common_info.news_mod_date,writer_info.writer_id,writer_info.writer_name');
			$this->db->from('news_common_info');
			$this->db->join('writer_info','news_common_info.author_id = writer_info.writer_id', 'left');
			$this->db->join('category_info','category_info.cat_id = news_common_info.cat_id');
			$this->db->join('sub_category_info', 'sub_category_info.sub_category_id = news_common_info.sub_cat_id');
			// $this->db->where('category_info.cat_id=news_common_info.cat_id');
			$this->db->where('news_common_info.news_status != 10');
			$this->db->where('news_common_info.news_status != 0');
			$this->db->where('news_common_info.news_status != 4');
			$this->db->where("category_info.cat_key_name='".$category."'");
			$this->db->where("news_common_info.sub_cat_id",0);
			$this->db->order_by('news_id', 'DESC');
			$this->db->limit($limit);
			$query = $this->db->get();

				
		
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}

		public function load_category($category,$subcat, $news_id)
		{
			$this->db->cache_off(); 
			$output = '';
			sleep(1);

			if ($this->uri->segment(1) == 'opinion') {
				$url_1 = 'opinion/';
			} else {
				$url_1 = 'news/';
			}

			function bn_date($str)
			{
				$en = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
				$bn = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
				$str = str_replace($en, $bn, $str);
				$en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
				$en_short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
				$bn = array('জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
				$str = str_replace($en, $bn, $str);
				$str = str_replace($en_short, $bn, $str);
				return $str;
			}
			function seoURL($str)
			{
				$from = array(' ', '!', '’', '‘', ':', '.', '?', ',', 'ঃ', "'", '%');
				$to   = array('-', '-', '', '', '', '', '-', '-', '-', '','');
				return str_replace($from, $to, $str);
			}

			$this->db->select('news_common_info.news_id,news_common_info.cat_id, news_common_info.sub_cat_id ,news_common_info.news_headline,news_common_info.news_status,news_common_info.author_id, news_common_info.img_ext');			
			$this->db->join('writer_info', 'news_common_info.author_id = writer_info.writer_id', 'left');
			$this->db->where('news_common_info.news_status != 10');
			$this->db->where('news_common_info.news_status != 0');
			$this->db->where('news_common_info.news_status != 4');
			$this->db->where('news_id <', $news_id);

			if($subcat){
				$this->db->where("sub_cat_id", $subcat);
			}

			$this->db->where("cat_id", $category);
			$this->db->limit(12);
			$this->db->order_by('news_id', 'DESC');
			$query = $this->db->get('news_common_info');

			?> <script>
				$(function() {
					$('.lazy').lazy({
						chainable: false, // tell lazy to return its own instance
						placeholder: "data:image/gif;base64,R0lGODlhEALAPQAPzl5uLr9Nrl8e7...",
						effect: "fadeIn",
						effectTime: 100,
						threshold: 400
					});
				});
			</script> <?php

			if ($query->result()) {
				$count = 0;
				foreach ($query->result() as $row) {
					$count++;
					$folder_name = ceil($row->news_id / 1000);
					

					$output .= '

						<div class="col-xl-3 col-lg-3 col-md-6 col-6 mt-3 rowCount">
							<div class="child-div-two">
							<a href="'. base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)).'" >
									<div class="">
										' . (($row->img_ext) ?
											'<img  src=" ' . base_url() . 'images/news/' . $folder_name . '/thumb' . '/' . $row->news_id . $row->img_ext . '" width="100%" alt="'. stripslashes($row->news_headline) .'" style="aspect-ratio: 16/9">'
											:
											'<img src="' . base_url() . 'images/default-ekattorer-kotha.jpg" width="100%" style="aspect-ratio: 16/9" > 
										') . '
									</div>
								</a>
								<div class="content-box">
									<a href="'. base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)).'" >
										<h1 class="lead-headding">'. stripslashes($row->news_headline) .'</h1>
									</a>
								</div>
							</div>
						</div>

						<input type="hidden" value="'. $row->cat_id .'" id="fetch_cat_id">

					

					';

			
				}
				$output .= '  
					<div class="more-btn" id="remove_row">
						<button type="button" name="btn_more" data-vid="' . $row->news_id . '" id="btn_more" class="btn  more-btn-load" >আরো</button>
					</div>
				';
				echo $output;
				
			}

		}

		function page_info()
		{
			$query = $this->db->select('page_id,name, name_bn')
			->from('news_page_info')
			->where('status', 1)
			->order_by('rank', 'ASC')
			->get();

			return $query->result();

		}
		
		


		public function load_category_author($category, $news_id)
		{
			$this->db->cache_off(); 
			$output = '';
			sleep(1);

			if ($this->uri->segment(1) == 'opinion') {
				$url_1 = 'opinion/';
			} else {
				$url_1 = 'news/';
			}

			function bn_date2($str)
			{
				$en = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
				$bn = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
				$str = str_replace($en, $bn, $str);
				$en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
				$en_short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
				$bn = array('জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
				$str = str_replace($en, $bn, $str);
				$str = str_replace($en_short, $bn, $str);
				return $str;
			}

			

			$this->db->select('news_common_info.news_id,news_common_info.cat_id, news_common_info.news_headline, news_common_info.news_status,news_common_info.author_id, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_details_brief, news_common_info.catStatus, news_common_info.news_pub_date,news_common_info.news_pub_time, news_common_info.news_mod_date,writer_info.writer_id,writer_info.writer_name');			
			$this->db->join('writer_info', 'news_common_info.author_id = writer_info.writer_id', 'left');
			$this->db->where('news_common_info.news_status != 10');
			$this->db->where('news_common_info.news_status != 0');
			$this->db->where('news_common_info.news_status != 4');
			$this->db->where('news_id <', $news_id);
			
			$this->db->where("author_id", $category);
			$this->db->limit(10);
			$this->db->order_by('news_id', 'DESC');
			$query = $this->db->get('news_common_info');

			if ($query->result()) {
				foreach ($query->result() as $row) {
					$folder_name = ceil($row->news_id / 1000);
					$content =  stripslashes($row->news_details_brief);

					$output .= '
						<div class="news-more">
                                <div class="news-content">
                                    <h2 class="m-h2"><a href="' . base_url() . $url_1 . $row->news_id . '">' . stripslashes($row->news_headline) . '</a></h2>
                                    <p>'. word_limiter($content, 25) . '</p>
                                    <div class="news-time">
                                        <p class="mb-0">'. bn_date2(date("d M Y H:i", strtotime($row->news_pub_date . $row->news_pub_time))).'</p>
                                    </div>
                                </div>
                                <div class="news-image">
									' . (($row->img_ext) ?
										'<img class="m-img cat-thumb-img" src=" ' . base_url() . 'images/news/' . $folder_name . '/thumb' . '/' . $row->news_id . $row->img_ext . '" alt="">'
										:
										'<img class="m-img cat-thumb-img" src="' . base_url() . 'images/default.jpg" alt=""> 
									') . '
                                </div>
                                <input type="hidden" value="<?php echo $row->cat_id; ?>" id="fetch_cat_id">
                            </div>
                            <hr>
						
					';
				}
				$output .= '  
					<div id="remove_row">
						<button type="button" name="btn_more" data-segment="author" data-vid="' . $row->news_id . '" id="btn_more" class="btn btn-primary form-control more-btn-load" style="width: 20%; margin: 0 40%;">আরো</button>
					</div>
				';
				echo $output;
			}

		}


		/***<div class="news-post article-post">
			<div class="row category-bottom">
				<div class="col-sm-4 col-xs-4">
					<div class="post-gallery">
						'.(($row->img_ext) ? 
							'<img class="m-img cat-thumb-img" src=" '. base_url().'images/news/'. $folder_name . '/thumb' . '/' . $row->news_id . $row->img_ext.'" alt="">'
							:
							'<img class="m-img cat-thumb-img" src="'. base_url().'images/news/small/demo.jpg" alt=""> 
						').'
					</div>
				</div>
				<div class="col-sm-8 col-xs-8">
					<div class="post-content">
						<h2 class="m-h2"><a href="'.base_url().'news/'.$row-> news_id.'">'.$row->news_headline.'</a></h2>
						<p class="cat-details">' . word_limiter($content,25) . '</p>
						<ul class="post-tags">																																																		
							<li class="single-post-tag"><i class="fa fa-clock-o single-article-fa"></i>'. bn_date(date('d M, Y', strtotime($row->news_pub_date))).'</li>
						</ul>
					</div>
				</div>
			</div>
		</div> ***/
		
		
		function num_rows_category($catID)
		{
			$query = $this->db->query("SELECT news_common_info.news_id
										FROM news_common_info
										WHERE news_common_info.news_status != 10 AND news_common_info.news_status != 0 AND news_common_info.news_status != 4 AND news_common_info.cat_id ='".$catID."'
										");
		
			return $query->num_rows();
		}

		function num_rows_archive($news_keyword)
		{	
			$query=$this-> db-> query("SELECT news_common_info.news_id, news_common_info.news_headline, news_common_info.img_ext
						FROM news_common_info
						WHERE news_common_info.news_headline LIKE '%".$news_keyword."%' ");

			// $query = $this->db->query("SELECT news_common_info.news_id
			// 							FROM news_common_info
			// 							WHERE news_common_info.news_status != 10 AND news_common_info.news_status != 0 AND news_common_info.news_status != 4 
			// 						");
		
			return $query->num_rows();
		}

		  /**************************************************************************/
		 /******************** COMMON NEWS INFO ************************/
		/*************************************************************************/
		
		
		function common_news_info($category, $limit)	
		{
			$query=$this-> db-> query("SELECT news_info.news_id, news_info.news_headline, news_info.news_sub_headline, news_info.news_details, news_info.news_pub_date, news_info.news_reporter, news_info.img_ext,category_info.cat_key_name,news_info.news_status, news_info.cat_id
										FROM category_info, news_info
										WHERE news_info.news_status=5 AND category_info.cat_id=news_info.cat_id AND category_info.cat_key_name= '".$category."'
										ORDER BY news_id DESC LIMIT ".$limit."");
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;		
		}
		
		
		/******************** Writer Setup ************************/
		function fetch_opinion_news($category, $limit){
			$query = $this->db->query("SELECT view_news_common_info.news_id,view_news_common_info.news_headline,category_info.cat_key_name,view_news_common_info.news_status, view_news_common_info.cat_id, category_info.cat_name, view_news_common_info.news_pub_date, view_news_common_info.news_pub_time,writer_info.writer_id,writer_info.writer_name,writer_info.img_ext
								FROM category_info, view_news_common_info,news_info,writer_info
								WHERE view_news_common_info.news_id = news_info.news_id AND view_news_common_info.author_id = writer_info.writer_id AND view_news_common_info.news_status != 0 AND category_info.cat_id=view_news_common_info.cat_id AND category_info.cat_key_name= '" . $category . "'
								ORDER BY news_id DESC LIMIT " . $limit . "");
			if ($query->num_rows() > 0) return $query->result();
			else return false;
		}
		
		
		  /*************************************************************************/
		 /******************** SUB CATEGORY WISE NEWS INFO ************************/
		/*************************************************************************/
	
		function subCategoryWiseNews($subCategory, $limit)	
		{

			$query=$this-> db-> query("SELECT news_common_info.news_id, news_common_info.news_headline, news_common_info.news_reporter, news_common_info.news_details_brief, news_common_info.img_ext,category_info.cat_key_name,news_common_info.news_status, news_common_info.cat_id, news_common_info.news_pub_date, news_common_info.news_mod_date
										FROM category_info, news_common_info
										WHERE news_common_info.news_status=5 AND category_info.cat_id=news_common_info.cat_id AND 
										news_common_info.sub_cat_id= ".$subCategory."
										ORDER BY news_id DESC LIMIT ".$limit."");
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}

		
		
		function subCategoryWiseNewsUpdated($subCategory, $limit)	
		{
			$this->db->select('news_common_info.news_id, news_common_info.news_headline,news_common_info.sub_cat_id,news_common_info.author_id,writer_info.writer_name, news_common_info.news_pub_time, news_common_info.news_reporter,category_info.cat_key_name,category_info.cat_name, news_common_info.news_details_brief, news_common_info.img_ext,category_info.cat_key_name,news_common_info.news_status, news_common_info.cat_id, sub_category_info.sub_cat_name, news_common_info.news_pub_date, news_common_info.news_mod_date');
			$this->db->from('category_info, news_common_info, sub_category_info');
			$this->db->where('category_info.cat_id = sub_category_info.category_id');
			$this->db->where('sub_category_info.sub_category_id = news_common_info.sub_cat_id');
			$this->db->join('writer_info', 'news_common_info.author_id = writer_info.writer_id', 'left');
			$this->db->where('news_common_info.news_status != ', 0);
			$this->db->where('news_common_info.news_status != ', 4);
			$this->db->where('news_common_info.news_status != ', 10);
			$this->db->where('sub_category_info.sub_cat_key_name', $subCategory);
			$this->db->order_by('news_common_info.news_id', 'DESC');
			$this->db->limit($limit);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}
		
		  /**************************************************************************/
		 /******************** NEWS READER NUMBER ********************/
		/*************************************************************************/
		
		function news_reader_number($news_id)	
		{
			$this->db->cache_off();
			$query=$this-> db-> query("SELECT news_info.news_reader
										FROM  news_info
										WHERE news_info.news_id='".$news_id."'");
			
			if($query->num_rows()>0){
				foreach ($query->result() as $row){
					$data = $row-> news_reader;
				}
				return $data;
			}
		}
		
		
	      /**************************************************************************/
		 /****************** NEWS READER INCREMENT ******************/
		/*************************************************************************/
		
		function news_reader_increment($news_id, $news_reader_number)
		{
			$news_reader=$news_reader_number+1;
			$query=$this->db->query("UPDATE news_info SET news_reader='".$news_reader."' WHERE news_id='".$news_id."'");
			return $query;
		}
		
		
		 /**************************************************************************/
		 /************************ ONLINE POL INFO ***************************/
		/*************************************************************************/
		
		function news_pol_info($vote_option, $pol_id)
		{
			if($vote_option=='no')
			{
				$query=$this-> db-> query("SELECT no FROM  pol_info WHERE pol_id='".$pol_id."'");
				if($query->num_rows()>0)
				{
					foreach ($query->result() as $row)
					{
						$data = $row-> no;
					}
					
					return $data;
				}
			}
			
			else if($vote_option=='yes')
			{
				$query=$this-> db-> query("SELECT yes FROM  pol_info WHERE pol_id='".$pol_id."'");
				if($query->num_rows()>0)
				{
					foreach ($query->result() as $row)
					{
						$data = $row-> yes;
					}
					
					return $data;
				}
			}
			
			else if($vote_option=='no_com')
			{
				$query=$this-> db-> query("SELECT no_com FROM  pol_info WHERE pol_id='".$pol_id."'");
				if($query->num_rows()>0)
				{
					foreach ($query->result() as $row)
					{
						$data = $row-> no_com;
					}
					
					return $data;
				}
			}
		}
		
		
		
		 /**************************************************************************/
		 /************************ ONLINE POL INCREMENT ******************/
		/*************************************************************************/
		
		function news_pol_increment($vote_option, $pol_id, $online_pol_info)
		{
			$num_vote_option=$online_pol_info+1;
			$query=$this->db->query("UPDATE pol_info SET ".$vote_option."=".$num_vote_option." WHERE pol_id=".$pol_id." ");

			return $query;
		}
	

	  /*------------------------------------------------------------------------------------------------------------------/ 
	 /----------------------------------- END OF NEWS INFORMATION  -------------------------------/
	/------------------------------------------------------------------------------------------------------------------*/
	
	
	  /*-----------------------------------------------------------------------------------------------------------------/ 
	 /------------------------------------------------ VIDEO SETUP  ---------------------------------------------/
	/------------------------------------------------------------------------------------------------------------------*/
	

	function achievement_info($limit){
		$query = $this->db->query("SELECT * FROM achievement_info ORDER BY a_id desc LIMIT ".$limit." ");	
		return $query->result();
	}
	
	function single_video_info($videoID){
		$query = $this->db->select("*")				
						->from("achievement_info")
						->where('a_id', $videoID)
						->get();
						
		return $query->result();
	}


	/*------------------------------------------------------------------------------------------------------------------------------/ 
	 /------------------------------------------------ END OF VIDEO SETUP  ---------------------------------------------/
	/------------------------------------------------------------------------------------------------------------------------------*/



		/***********************************************************/
		/*************** ARCHIVE DATE WISE NEWS INFO ***************/
		/***********************************************************/

		function date_wise_news_list($date)
		{
			$date = date('Y-m-d', strtotime($date)); 
			$query = $this->db->query("SELECT `news_info`.`news_id`, `news_common_info`.`news_headline`,`news_common_info`.`news_details_brief`, `category_info`.`cat_key_name`, `category_info`.`cat_name`, `news_common_info`.`img_ext`, `news_common_info`.`news_reporter`, `news_common_info`.`news_pub_date`,`news_common_info`.`news_pub_time`
										FROM `news_info`,`category_info`,`news_common_info`
										WHERE `news_common_info`.`news_status` != 10 AND `news_common_info`.`news_status`!=0 AND `news_common_info`.`news_status`!=4 AND `news_info`.`news_id` = `news_common_info`.`news_id` AND `category_info`.`cat_id`=`news_common_info`.`cat_id` AND cast(`news_pub_date` as date)='" . $date . "'
										ORDER BY `news_info`.`news_id` DESC");
			if ($query->num_rows() > 0) return $query->result();
			else return false;
		}


		// News Filter Needed Query 
		function category_list()
		{
			$query = $this->db->select('cat_id, cat_key_name, cat_name')
			->from('category_info')
			->where('cat_status', 1)
			->get();

			return $query->result(); 
		}
		// News Filter Needed Query 
		
		
		/*******************************************************/
		/*********** ARCHIVE KEYWORD WISE NEWS INFO ************/
		/*******************************************************/

		// function keyword_wise_news_list($news_keyword = '', $date = '')
		// {
		// 	$query = $this->db->query("SELECT `news_info`.`news_id`, `news_common_info`.`news_headline`,`news_common_info`.`headline_tag`,`news_common_info`.`cat_id`, `news_common_info`.`news_details_brief`, `category_info`.`cat_key_name`, `category_info`.`cat_name`, `news_common_info`.`img_ext`, `news_common_info`.`news_pub_date`,`news_common_info`.`news_pub_time`
		// 					FROM `news_info`,`category_info`,`news_common_info` LEFT JOIN `news_tag_info` ON `news_common_info`.`news_id` = `news_tag_info`.`news_id`
		// 					WHERE `news_common_info`.`news_status` != 10 AND `news_common_info`.`news_status`!=0 AND `category_info`.`cat_id`=`news_common_info`.`cat_id` AND `news_info`.`news_id` = `news_common_info`.`news_id`
		// 					OR (`news_common_info`.`news_headline` LIKE '%" . $news_keyword . "%' OR `news_info`.`news_sub_headline` LIKE '%" . $news_keyword ."%' OR `news_tag_info`.`news_tag` LIKE '%" . $news_keyword . "%' ) 
		// 					OR `news_common_info`.`news_pub_date` = '".$date."'
		// 					ORDER BY news_common_info.news_id DESC LIMIT 10");

		// 	if ($query->num_rows() > 0) return $query->result();
		// 	else return false;
		// }
		function keyword_wise_news_list($news_keyword)
		{
			$query = $this->db->query("SELECT news_info.news_id, news_common_info.news_headline,news_common_info.headline_tag,news_common_info.cat_id, news_common_info.news_details_brief, news_common_info.news_status, category_info.cat_key_name, category_info.cat_name, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_pub_date,news_common_info.news_pub_time
							FROM news_info,category_info,news_common_info LEFT JOIN news_tag_info ON news_common_info.news_id = news_tag_info.news_id
							WHERE news_common_info.news_status != 10 AND news_common_info.news_status!=0 AND category_info.cat_id=news_common_info.cat_id AND news_info.news_id = news_common_info.news_id
							AND (news_common_info.news_headline LIKE '%" . $news_keyword . "%' OR news_info.news_sub_headline LIKE '%" . $news_keyword ."%' OR news_tag_info.news_tag LIKE '%" . $news_keyword . "%' )
							ORDER BY news_common_info.news_id DESC LIMIT 25");

			if ($query->num_rows() > 0) return $query->result();
			else return false;
		}



		public function load_news_all_filter($src_item, $news_id)
		{
			$this->db->cache_off();
			$output = '';
			sleep(1);

			if ($this->uri->segment(1) == 'opinion') {
				$url_1 = 'opinion/';
			} else {
				$url_1 = 'news/';
			}

			function bn_date3($str)
			{
				$en = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
				$bn = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
				$str = str_replace($en, $bn, $str);
				$en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
				$en_short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
				$bn = array('জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
				$str = str_replace($en, $bn, $str);
				$str = str_replace($en_short, $bn, $str);
				return $str;
			}

			function seoURL($str)
			{
				$from = array(' ', '!', '’', '‘', ':', '.', '?', ',', 'ঃ', "'", '%');
				$to   = array('-', '-', '', '', '', '', '-', '-', '-', '','');
				return str_replace($from, $to, $str);
			}

			$query = $this->db->query("SELECT news_info.news_id, news_common_info.news_headline,news_common_info.headline_tag,news_common_info.cat_id, news_common_info.news_details_brief, news_common_info.news_status, category_info.cat_key_name, category_info.cat_name, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_pub_date,news_common_info.news_pub_time
								FROM news_info,category_info,news_common_info LEFT JOIN news_tag_info ON news_common_info.news_id = news_tag_info.news_id WHERE news_common_info.news_id < $news_id
								AND news_common_info.news_status != 10 AND news_common_info.news_status!=0 AND category_info.cat_id=news_common_info.cat_id AND news_info.news_id = news_common_info.news_id
								AND (news_common_info.news_headline LIKE '%" . $src_item . "%' OR news_info.news_sub_headline LIKE '%" . $src_item . "%' OR news_tag_info.news_tag LIKE '%" . $src_item . "%' )
								ORDER BY news_common_info.news_id DESC LIMIT 5");


			if ($query->result()) {
				foreach ($query->result() as $row) {
					$folder_name = ceil($row->news_id / 1000);
					$content =  stripslashes($row->news_details_brief);

					$output .= '
						<div class="col-xl-6 rowCount">
							<div class="latest-child-news-box mb-2 binodon-news-box d-flex justify-content-between align-items-centere  p-2">
								<div class="image-box">
									<a href="'. base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)).'" class="image-link">
										<div class="ratio ratio-16x9">
											' . (($row->img_ext) ?
												'<img  src=" ' . base_url() . 'images/news/' . $folder_name . '/small' . '/' . $row->news_id . $row->img_ext . '" width="100%" alt="'. stripslashes($row->news_headline) .'">'
												:
												'<img  src="' . base_url() . 'images/default-uttorpurbo.png" width="100%" > 
											') . '
										</div>
									</a>
								</div>
								<div class="content-box">
									<a href="'.base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)).'" class="text-dark">
										<h1 class=" fw-bold lead-headline">'. stripslashes($row->news_headline) .'</h1>
									</a>
								</div>
							</div>
						</div>';
				}
				$output .= '  
						<div id="remove_row">
							<button type="button" name="btn_filter_more" data-search="'.$src_item.'" data-vid="' . $row->news_id . '" id="btn_filter_more" class="btn btn-primary form-control more-btn-load" style="width: 20%; margin: 0 40%;">আরো</button>
						</div>
					';
				echo $output;
			}
		}



		public function load_news_all_filter_avd($src_item, $date, $news_id)
		{
			$this->db->cache_off();
			$output = '';
			sleep(1);

			if ($this->uri->segment(1) == 'opinion') {
				$url_1 = 'opinion/';
			} else {
				$url_1 = 'news/';
			}

			function bn_date4($str)
			{
				$en = array(1, 2, 3, 4, 5, 6, 7, 8, 9, 0);
				$bn = array('১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯', '০');
				$str = str_replace($en, $bn, $str);
				$en = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
				$en_short = array('Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec');
				$bn = array('জানুয়ারী', 'ফেব্রুয়ারী', 'মার্চ', 'এপ্রিল', 'মে', 'জুন', 'জুলাই', 'আগস্ট', 'সেপ্টেম্বর', 'অক্টোবর', 'নভেম্বর', 'ডিসেম্বর');
				$str = str_replace($en, $bn, $str);
				$str = str_replace($en_short, $bn, $str);
				return $str;
			}
			function seoURL($str)
			{
				$from = array(' ', '!', '’', '‘', ':', '.', '?', ',', 'ঃ', "'", '%');
				$to   = array('-', '-', '', '', '', '', '-', '-', '-', '','');
				return str_replace($from, $to, $str);
			}

			$query = '';
			$this->db->select('news_info.news_id, news_common_info.news_headline,news_common_info.headline_tag,news_common_info.cat_id, news_common_info.news_details_brief, news_common_info.news_status, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_pub_date,news_common_info.news_pub_time, category_info.cat_name, category_info.cat_key_name');
			$this->db->from('news_common_info, news_info', 'category_info');
			$this->db->join('category_info', 'news_common_info.cat_id = category_info.cat_id', 'left');
			$this->db->join('news_tag_info', 'news_common_info.news_id = news_tag_info.news_id', 'left');
			$this->db->where('news_info.news_id = news_common_info.news_id');
			

			if ($src_item) {
				$this->db->group_start();  //group start
				$this->db->like('news_headline', $src_item);
				$this->db->or_like('news_sub_headline', $src_item);
				$this->db->or_like('news_tag', $src_item);
				$this->db->group_end();  //group ed
			}



			if ($date) {
				$new_date = date('Y-m-d', strtotime($date1));
				$this->db->where('news_common_info.news_pub_date = ', $new_date1);
			}


			$this->db->where('news_common_info.news_id <', $news_id);
			$this->db->order_by('news_common_info.news_id', 'DESC');
			$this->db->limit(10);
			$query = $this->db->get();


			if ($query->result()) {
				$count = 0;
				foreach ($query->result() as $row) {
					$count++; 
					$folder_name = ceil($row->news_id / 1000);
					$content =  stripslashes($row->news_details_brief);

					$output .= '
						<div class="col-xl-6 rowCount">
							<div class="latest-child-news-box mb-2 binodon-news-box d-flex justify-content-between align-items-centere  p-2">
								<div class="image-box">
									<a href="'. base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)).'" class="image-link">
										<div class="ratio ratio-16x9">
											' . (($row->img_ext) ?
												'<img  src=" ' . base_url() . 'images/news/' . $folder_name . '/small' . '/' . $row->news_id . $row->img_ext . '" width="100%" alt="'. stripslashes($row->news_headline) .'">'
												:
												'<img  src="' . base_url() . 'images/default-uttorpurbo.png" width="100%" > 
											') . '
										</div>
									</a>
								</div>
								<div class="content-box">
									<a href="'.base_url('details/'.$row->news_id.'/'.seoURL($row->news_headline)).'" class="text-dark">
										<h1 class=" fw-bold lead-headline">'. stripslashes($row->news_headline) .'</h1>
									</a>
								</div>
							</div>
						</div>';

				}
				$output .= '  
						<div class="more-btn" id="remove_row">
							<button type="button" name="btn_filter_more" data-search="'.$src_item.'"   data-date="' . $date . '"  data-vid="' . $row->news_id . '" id="btn_filter_more_avd" class="btn btn-primary form-control more-btn-load" >আরো</button>
						</div>
					';
				echo $output;
			}
		}




		function news_list_report($subject='',$category='', $date1 = '', $date2 = '', $sortType = '')
		{
			$this->db->cache_off();
			$query = '';

			$this->db->select('news_info.news_id, news_common_info.news_headline,news_common_info.headline_tag,news_common_info.cat_id, news_common_info.news_details_brief, news_common_info.news_status, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_pub_date,news_common_info.news_pub_time');
			$this->db->from('news_common_info, news_info','category_info');
			$this->db->join('news_tag_info', 'news_common_info.news_id = news_tag_info.news_id', 'left');
			$this->db->where('news_info.news_id = news_common_info.news_id');

			if($subject){

				$this->db->group_start();  //group start
				$this->db->like('news_headline', $subject);
				$this->db->or_like('news_sub_headline', $subject);
				$this->db->or_like('news_tag', $subject);
				$this->db->group_end();  //group ed
			}



			if ($category) {
				$this->db->where('news_common_info.cat_id', $category);
			}

			if ($date1 && $date2) {
				$new_date1 = date('Y-m-d', strtotime($date1));
				$new_date2 = date('Y-m-d', strtotime($date2));
				if ($date1 == $date2) {
					$new_date2 = date('Y-m-d', strtotime("+1 day", strtotime($date1)));
				}

				$this->db->where('news_common_info.news_pub_date >= ', $new_date1);
				$this->db->where('news_common_info.news_pub_date <= ', $new_date2);
			}

			if ($date1) {
				$new_date1 = date('Y-m-d', strtotime($date1));
				$this->db->where('news_common_info.news_pub_date >=', $new_date1);
			}
			if ($date2) {
				$new_date2 = date('Y-m-d', strtotime($date2));
				$this->db->where('news_common_info.news_pub_date <=', $new_date2);
			}

			if ($sortType) {
				if ($sortType == 'date-new')
				$this->db->order_by('news_common_info.news_id', 'DESC');
				else if ($sortType == 'date-old')
				$this->db->order_by('news_common_info.news_id', 'ASC');
			} else {
				$this->db->order_by('news_common_info.news_id', 'DESC');
			}

			$this->db->limit(10);
			$query = $this->db->get();

			// return $query->result(); 

			if ($query) {
				if ($query->num_rows() > 0) {
					foreach ($query->result() as $row) {
						$data[] = $row;
					}
					return $data;
				}
			}
		}


		
		
		
		 /**************************************************************************/
		 /********* ARCHIVE DATE AND KEYWORD WISE NEWS *******/
		/*************************************************************************/
		
		
		function date_key_wise_news_list($date,$news_keyword)
		{
			$query=$this-> db-> query("SELECT `news_common_info`.`news_id`, `news_common_info`.`news_headline`,`news_common_info`.`news_brief_info`, `category_info`.`cat_key_name`, `category_info`.`cat_name`, `news_common_info`.`img_ext`, `news_common_info`.`news_mod_date`, `news_common_info`.`news_mod_time`
										FROM `news_info`,`category_info`,`news_common_info`
										WHERE `news_common_info`.`news_status` !=0 AND `news_common_info`.`news_status` !=4 
										AND `category_info`.`cat_id`=`news_common_info`.`cat_id` 
										AND `news_info`.`news_id`=`news_common_info`.`news_id` 
										
										AND cast(news_pub_date as date)='".$date."' 
										AND (news_common_info.news_headline LIKE '%".$news_keyword."%' OR news_info.news_sub_headline LIKE '%".$news_keyword."%' ) 
										LIMIT 25");

			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}

		/*******************************************************/
		/*********** ARCHIVE KEYWORD WISE NEWS INFO ************/
		/*******************************************************/

		function tag_wise_news_list($news_keyword)
		{
			$this->db->cache_off(); 
			$query = $this->db->query("SELECT news_info.news_id, news_common_info.news_headline,news_common_info.headline_tag,news_common_info.cat_id, news_common_info.news_details_brief, news_common_info.news_status, category_info.cat_key_name, category_info.cat_name, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_pub_date,news_common_info.news_pub_time
								FROM news_info,category_info,news_common_info LEFT JOIN news_tag_info ON news_common_info.news_id = news_tag_info.news_id
								WHERE news_common_info.news_status != 10 AND news_common_info.news_status!=0 AND category_info.cat_id=news_common_info.cat_id AND news_info.news_id = news_common_info.news_id
								AND (news_common_info.news_headline LIKE '%" . $news_keyword . "%' OR news_info.news_sub_headline LIKE '%" . $news_keyword . "%' OR news_tag_info.news_tag LIKE '%" . $news_keyword . "%' )
								ORDER BY news_common_info.news_pub_date DESC LIMIT 50");

			if ($query->num_rows() > 0) return $query->result();
			else return false;
		}
				
		
		  /*************************************************************************************************/
		 /********************************* EMAIL SUBSCRIBTION SETUP ***************************/
		/************************************************************************************************/
		
		function emailSubscriptionSetup($userEmail)
		{
			/*------- Date function in CI --------------*/
			$timezone = "America/Los_Angeles";
			date_default_timezone_set($timezone);
			$pub_date=date('Y-m-d H:i:s');
			/***-------- End of Date function in CI -------------***/

			
			$emailSubscription= array(
			   'sub_email' => $userEmail,
			   'sub_status' => 1,
			   'sub_doc' => $pub_date
			);
			
			$insert=$this-> db-> insert('email_subscriber_info', $emailSubscription);
			
			$last_id = $this-> db-> insert_id(); /* get the last id of img */
			
			return $last_id;
		}
		
		
		  /*************************************************************************************************/
		 /************************************* VISITOR COUNTER INFO ****************************/
		/************************************************************************************************/
		
		
		function visitor_counter_info()
		{
			$this->db->cache_off();
			$query=$this-> db-> query("SELECT * FROM visitor_counter_info WHERE counter_id=1");
			
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				
				return $data;
			}		
		}
		
	
		  /**************************************************************************/
		 /************************ DAILY VISITOR UPDATE *******************/
		/*************************************************************************/
		

		
		function daily_visitor_update()
		{
			$my_data = array(
			'today' => date('d'),
			'day_visitor' => 1
			);
			
			$this->db->where('counter_id', 1);
			$this->db->update('visitor_counter_info', $my_data);
		}
		
		
		function weekly_visitor_update()
		{
			$my_data = array(
			'week' => date("W"),
			'week_visitor' => 1
			);
			
			$this->db->where('counter_id', 1);
			$this->db->update('visitor_counter_info', $my_data);
		}
		
		
		function monthly_visitor_update($monthly_visitor)
		{
			$my_data = array(
			'month' => date('m'),
			'month_visitor' => 1
			);
			
			$this->db->where('counter_id', 1);
			$this->db->update('visitor_counter_info', $my_data);
		}
		
		
		function yearly_visitor_update($yearly_visitor)
		{
			$my_data = array(
			'year' => date('Y'),
			'year_visitor' => 1
			);
			
			$this->db->where('counter_id', 1);
			$this->db->update('visitor_counter_info', $my_data);
		}
		
		
		function total_visitor_update($day_visitor, $weekly_visitor, $monthly_visitor, $yearly_visitor, $total_visitor)
		{
			$my_data = array(
			'day_visitor' => $day_visitor+1,
			'week_visitor' => $weekly_visitor+1,
			'month_visitor' => $monthly_visitor+1,
			'year_visitor' => $yearly_visitor+1,
			'total_visitor' => $total_visitor+1
			);
			
			$this->db->where('counter_id', 1);
			$this->db->update('visitor_counter_info', $my_data);
		}
		
		
		
		 /*************************************************************************************************/
		 /********************************** END OF VISITOR COUNTER ***************************/
		/************************************************************************************************/
		
		
		
		  /*************************************************************************************/
		 /************************************** CACHING SYSTEM *******************************/
		/*************************************************************************************/  

		function fetch_menu($category){
		$query = $this->db->query("SELECT sub_category_info.sub_cat_name, sub_category_info.sub_cat_key_name
							FROM category_info, sub_category_info
							WHERE category_info.cat_id=sub_category_info.category_id AND category_info.cat_key_name= '" . $category . "'
							");
		if ($query->num_rows() > 0) return $query->result();
		else return false;
		}

		function common_news_info_updated($category, $limit)	
		{
			$query=$this-> db-> query("SELECT `view_news_common_info`.`news_id`,`view_news_common_info`.`headline_tag`,`view_news_common_info`.`news_details_brief`,`view_news_common_info`.`news_headline`, `view_news_common_info`.`img_ext`, `view_news_common_info`.`news_pub_date`, `view_news_common_info`.`news_pub_time`
							FROM category_info, view_news_common_info
							WHERE `view_news_common_info`.`news_status` != 0 AND `category_info`.`cat_id`=`view_news_common_info`.`cat_id` AND `category_info`.`cat_key_name`= '".$category."'
							ORDER BY `news_id` DESC LIMIT ".$limit."");
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}


		function common_news_info_updated_opinion($category, $limit)	
		{
			$query=$this-> db-> query("SELECT `view_news_common_info`.`news_id`,`view_news_common_info`.`news_headline`, `view_news_common_info`.`news_pub_date`, `view_news_common_info`.`news_pub_time`,`view_news_common_info`.`img_ext`,`news_writer_info`.`author_ids`, `news_writer_info`.`reporter_ids`,`writer_info`.`writer_id`,`writer_info`.`writer_name`, `writer_info`.`img_ext` as `writer_image` 
							FROM `view_news_common_info`,`category_info`, `news_writer_info` LEFT JOIN `writer_info` ON `news_writer_info`.`author_ids` = `writer_info`.`writer_id`
							WHERE `view_news_common_info`.`news_id` = `news_writer_info`.`news_id` AND `view_news_common_info`.`news_status` != 0 AND `category_info`.`cat_id`=`view_news_common_info`.`cat_id` AND `category_info`.`cat_key_name`= '".$category."'
							ORDER BY news_id DESC LIMIT ".$limit."");
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}
		
		function common_news_info_updated_sylhet($category, $limit)	
		{
			$query=$this-> db-> query("SELECT `view_news_common_info`.`news_id`,`view_news_common_info`.`news_headline`,`view_news_common_info`.`news_details_brief`, `view_news_common_info`.`img_ext`,`view_news_common_info`.`news_pub_date` ,`view_news_common_info`.`news_pub_time`,`sub_category_info`.`sub_cat_name`
							FROM `category_info`, `view_news_common_info` LEFT JOIN `sub_category_info` ON `view_news_common_info`.`sub_cat_id` = `sub_category_info`.`sub_category_id`
							WHERE `view_news_common_info`.`news_status` != 0 AND `category_info`.`cat_id`=`view_news_common_info`.`cat_id` AND `category_info`.`cat_key_name`= '".$category."'
							ORDER BY `news_id` DESC LIMIT ".$limit."");
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}

		// function common_news_info_updated_video($category, $limit)	
		// {
		// 	$query=$this-> db-> query("SELECT view_news_common_info.news_id,view_news_common_info.headline_tag,news_info.video_link,view_news_common_info.news_details_brief,view_news_common_info.news_headline, view_news_common_info.news_reporter, view_news_common_info.img_ext,category_info.cat_key_name,view_news_common_info.news_status, view_news_common_info.cat_id, category_info.cat_name, view_news_common_info.news_pub_date, view_news_common_info.news_pub_time, view_news_common_info.news_mod_date, view_news_common_info.news_details_brief
		// 					FROM category_info, view_news_common_info, news_info
		// 					WHERE view_news_common_info.news_id = news_info.news_id AND view_news_common_info.news_status=5 AND category_info.cat_id=view_news_common_info.cat_id AND category_info.cat_key_name= '".$category."'
		// 					ORDER BY news_id DESC LIMIT ".$limit."");
			
		// 	if($query->num_rows() > 0) return $query-> result();
		// 	else return false;	
		// }

		function common_news_info_updated_by_subcategory($category, $sub_category, $limit)	
		{
			$query=$this-> db-> query("SELECT `view_news_common_info`.`news_id`,`view_news_common_info`.`news_details_brief`,`view_news_common_info`.`news_headline`,`view_news_common_info`.`headline_tag`, `view_news_common_info`.`img_ext`, `view_news_common_info`.`news_pub_date`, `view_news_common_info`.`news_pub_time`
							FROM `category_info`, `view_news_common_info`, `sub_category_info`
							WHERE `view_news_common_info`.`news_status` != 0 AND `category_info`.`cat_id`=`view_news_common_info`.`cat_id` AND `sub_category_info`.`sub_category_id`=`view_news_common_info`.`sub_cat_id` AND `category_info`.`cat_key_name`= '".$category."' AND `sub_category_info`.`sub_cat_key_name` = '".$sub_category."'
							ORDER BY `news_id` DESC LIMIT ".$limit."");
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}
		
		function common_news_info_details_updated($category, $limit)	
		{
			$query=$this-> db-> query("SELECT news_common_info.news_id, news_common_info.news_headline, news_common_info.news_details_brief, news_common_info.news_reporter, news_common_info.img_ext,category_info.cat_key_name,news_common_info.news_status, news_common_info.cat_id, category_info.cat_name, news_common_info.news_pub_date, news_common_info.news_mod_date
										FROM category_info, news_common_info
										WHERE news_common_info.news_status=5 AND category_info.cat_id=news_common_info.cat_id AND category_info.cat_key_name= '".$category."'
										ORDER BY news_id DESC LIMIT ".$limit."");
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}
		
		
		function popular_seven_news_info_updated($limit)
		{
			$LastNewsID = '';
			$NewsRange  = '';
			$query      = $this-> db-> query("SELECT news_id FROM news_reader_info ORDER BY news_id DESC LIMIT 1");	
			
			if($query->num_rows() > 0){
				foreach ($query->result() as $row)
					$LastNewsID = $row->news_id;
					
				if($LastNewsID > 300)
					$NewsRange = $LastNewsID-200;
				else	
					$NewsRange = $LastNewsID - ($LastNewsID/2);
			}
			
			$query=$this-> db-> query("SELECT news_reader_info.news_id, news_headline, img_ext, view_news_common_info.cat_id, news_reader_info.news_reader, category_info.cat_key_name, category_info.cat_name,view_news_common_info.news_pub_date,view_news_common_info.news_pub_time	         
										FROM view_news_common_info, category_info, news_reader_info
										WHERE view_news_common_info.news_status != 0 
										AND view_news_common_info.news_status != 4 
										AND view_news_common_info.news_status != 10 
										AND category_info.cat_id=view_news_common_info.cat_id
										AND view_news_common_info.news_id=news_reader_info.news_id 
										AND news_reader_info.news_id>='".$NewsRange."'
										ORDER BY news_reader_info.news_reader DESC LIMIT ".$limit."
									");						
		
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}

		
		
		/***************************************************************************/
		/************************* Video News Info Update **************************/
		/***************************************************************************/

		function video_news($category, $limit)	
		{
			$query=$this-> db-> query("SELECT `view_news_common_info`.`news_id`,`view_news_common_info`.`headline_tag`, `view_news_common_info`.`news_headline`,`view_news_common_info`.`img_ext`, `view_news_common_info`.`news_pub_date`, `view_news_common_info`.`news_pub_time`,`news_info`.`video_link`
							FROM category_info, view_news_common_info LEFT JOIN `news_info` ON `news_info`.`news_id` = `view_news_common_info`.`news_id`
							WHERE `view_news_common_info`.`news_status` != 0 AND `category_info`.`cat_id`=`view_news_common_info`.`cat_id` AND `category_info`.`cat_key_name` = '".$category."'
							ORDER BY `view_news_common_info`.`news_id` DESC LIMIT ".$limit."");
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}





		 /**************************************************************************/
		 /*************************** HEADLINE INFO *************************/
		/*************************************************************************/
		function head_line_info($limit)
		{
			$this->db->select('view_news_common_info.news_id,view_news_common_info.headline_tag, view_news_common_info.news_headline, view_news_common_info.news_details_brief, view_news_common_info.img_ext, category_info.cat_key_name, category_info.cat_name,view_news_common_info.news_pub_date,view_news_common_info.news_pub_time');
			$this->db->from('view_news_common_info, category_info');
			$this->db->where('view_news_common_info.cat_id = category_info.cat_id');
			$this->db->where('view_news_common_info.news_status', 1);
			$this->db->order_by('view_news_common_info.news_id', 'DESC');
			$this->db->limit($limit);
			$query = $this->db->get();
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}
		
		
		  /**************************************************************************/
		 /******************** BREAKING NEWS INFO *************************/
		/*************************************************************************/
		
		
		function breaking_news_info()
		{
			$DateTime = new DateTime();
			$DateTime->modify('-5 hours');
			$last_hours = $DateTime->format("Y-m-d H:i:s");

			// $my_date_time = date("Y-m-d H:i:s", strtotime("+1 hours"));

		

			$query=$this-> db-> query("SELECT `news_common_info`.`news_id`, `news_common_info`.`news_headline`, `news_common_info`.`news_status`, `category_info`.`cat_key_name`
										FROM `news_common_info`, `category_info`
										WHERE `news_common_info`.`news_status`=7 AND CONCAT(`news_pub_date`,' ',`news_pub_time`) > '".$last_hours."' AND `category_info`.`cat_id`=`news_common_info`.`cat_id`
										ORDER BY `news_id` DESC LIMIT 3");
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}
		
		
		  /**************************************************************************/
		 /************************** TOP NEWS INFO *************************/
		/*************************************************************************/
		
		function top_news_info($limit)
		{
			$query=$this-> db-> query("SELECT `view_news_common_info`.`headline_tag`, `view_news_common_info`.`news_id`, `view_news_common_info`.`news_headline`, `view_news_common_info`.`img_ext`, `view_news_common_info`.`news_pub_date`,`view_news_common_info`.`news_pub_time`, `category_info`.`cat_name`,`category_info`.`cat_key_name`
										FROM `view_news_common_info`,`category_info`
										WHERE `view_news_common_info`.`cat_id` = `category_info`.`cat_id`
										AND `view_news_common_info`.`news_status`=2 
										ORDER BY `news_id` DESC LIMIT ".$limit."");
										
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}


		/**************************************************************************/
		/************************** All news info except Sylhet *************************/
		/*************************************************************************/
		function all_news_info_except_sylhet($limit)
		{
			$query=$this-> db-> query("SELECT view_news_common_info.news_id, view_news_common_info.news_headline, view_news_common_info.img_ext,category_info.cat_key_name, view_news_common_info.cat_id, category_info.cat_name, view_news_common_info.news_pub_date,view_news_common_info.news_pub_time
										FROM view_news_common_info,category_info
										WHERE view_news_common_info.cat_id != 40 AND view_news_common_info.news_status != 0 AND category_info.cat_id=view_news_common_info.cat_id
										ORDER BY news_id DESC LIMIT ".$limit."");
										
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}
		
		  /**************************************************************************/
		 /********************* SELECTIVE NEWS INFO ***********************/
		/*************************************************************************/
		
		function selective_news_info($limit)
		{
			$query=$this-> db-> query("SELECT view_news_common_info.news_id, view_news_common_info.news_headline, view_news_common_info.news_reporter, view_news_common_info.img_ext,category_info.cat_key_name,view_news_common_info.news_status, view_news_common_info.cat_id, category_info.cat_name, view_news_common_info.news_pub_date,view_news_common_info.news_pub_time, view_news_common_info.news_mod_date
										FROM view_news_common_info,category_info
										WHERE view_news_common_info.news_status=6 AND category_info.cat_id=view_news_common_info.cat_id
										ORDER BY news_id DESC LIMIT ".$limit." ");
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}
		
		
		  /**************************************************************************/
		 /************************** LATEST NEWS INFO *******************/
		/*************************************************************************/

		function latest_news_info($limit, $latestStatus='')
		{
			//$this->db->cache_off();
			$this->db->select('view_news_common_info.news_id, view_news_common_info.news_headline,view_news_common_info.headline_tag, view_news_common_info.news_pub_date,view_news_common_info.news_pub_time , view_news_common_info.img_ext');
			$this->db->from('view_news_common_info,category_info');
			if($latestStatus) {$this->db->where('news_common_info.latestStatus !=', 1);}
			
			$this->db->where('view_news_common_info.news_status !=', 0);
			$this->db->where('view_news_common_info.news_status !=', 4);
			$this->db->where('view_news_common_info.news_status !=', 10);
			$this->db->where('view_news_common_info.cat_id !=', 5);
			$this->db->where('category_info.cat_id = view_news_common_info.cat_id');
			$this->db->order_by('news_id','DESC');
			$this->db->limit($limit);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;			
		}
		
		
		  /**************************************************************************/
		 /************************** Newspaper INFO *************************/
		/*************************************************************************/
		
		function newspaper_news($page_id, $date)
		{
			$this->db->cache_off(); 
			$query=$this-> db-> query("SELECT `view_news_common_info`.`headline_tag`, `view_news_common_info`.`news_id`, `view_news_common_info`.`news_headline`, `view_news_common_info`.`img_ext`, `view_news_common_info`.`news_pub_date`,`view_news_common_info`.`news_pub_time`, `news_page_info`.`page_id`,`news_page_info`.`name_bn`
										FROM `view_news_common_info`, `news_page_info`
										WHERE `view_news_common_info`.`news_status` != 0 
										AND `view_news_common_info`.`page_id` = `news_page_info`.`page_id`
										AND `view_news_common_info`.`page_id` = '".$page_id."'
										AND `view_news_common_info`.`news_pub_date` = '".$date."'
										ORDER BY `news_id` DESC ");
										
			if($query->num_rows() > 0) return $query-> result();
			else return false;	
		}
		
		
		  /**************************************************************************/
		 /******************************* DAY WISE VISITOR INFO ********************/
		/**************************************************************************/

		public function gallery_photo($limit){
			$this->db->select('*');
			$this->db->from('news_gallery_info');

			$this->db->where('news_gallery_info.gallery_status', 1);
			// $this->db->where('view_news_common_info.news_status !=', 4);
			// $this->db->where('view_news_common_info.news_status !=', 10);
			// $this->db->where('category_info.cat_id = view_news_common_info.cat_id');
			$this->db->order_by('img_id','DESC');
			$this->db->limit($limit);
			$query = $this->db->get();
			
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}
		
		
		function visitor_current_date()
		{
			$this->db->cache_off();
			$query=$this-> db-> query("SELECT day_date FROM daily_visitor_info ORDER BY day_id DESC LIMIT 1");
			
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data= $row->day_date;
				}
				
				return $data;
			}		
		}
		
		
		function create_daily_visitor_row($DateToday)
		{

			$timezone = "Asia/Dhaka";
			date_default_timezone_set($timezone);
			$pub_date=date('Y-m-d H:i:s');

			$addNewRow	= 0;
			$query 		= $this-> db-> query("SELECT `day_date` FROM `daily_visitor_info` ORDER BY `day_id` DESC LIMIT 1");

			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data=$row->day_date;
					if($data!=$DateToday){
						$addNewRow=1;
					}
				}
				//return $data;
			}

			if($addNewRow==1)
			{
				$daily_visitor_row = array(
				   'day_date' => $DateToday,
				   'day_visitor' => 1,
				   'day_doc' => $pub_date
				);
				
				$insert=$this-> db-> insert('daily_visitor_info', $daily_visitor_row);
				
				$last_id = $this-> db-> insert_id(); /* get the last id of img */
				
				return $last_id;	
			}
			else
				return FALSE;
		}

		function daily_visitor_today()
		{
			$query=$this-> db-> query("SELECT * FROM daily_visitor_info ORDER BY day_id DESC LIMIT 1");
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				return $data;
			}		
		}
		
		function updateDailyVisitor($dayID, $todayVisitor)
		{
			$my_data = array(
			'day_visitor' => $todayVisitor+1
			);
			
			$this->db->where('day_id', $dayID);
			$this->db->update('daily_visitor_info', $my_data);
		}
		
		 /*************************************************************************************************/
		 /********************************** END OF VISITOR COUNTER ***************************/
		/************************************************************************************************/
		
		
		function news_reader_number_updated($news_id)	
		{
			$this->db->cache_off();
			$query=$this-> db-> query("SELECT news_reader_info.news_reader
										FROM  news_reader_info
										WHERE news_reader_info.news_id='".$news_id."'");
			
			if($query->num_rows()>0){
				foreach ($query->result() as $row){
					$data = $row-> news_reader;
				}
				return $data;
			}	
		}
		
		function news_reader_increment_updated($news_id, $news_reader_number)
		{
			$news_reader=$news_reader_number+1;
			$query=$this->db->query("UPDATE news_reader_info SET news_reader='".$news_reader."' WHERE news_id='".$news_id."'");
			return $query;
		}
		
		
		  /************************************************************************************/
		 /********************************** END OF CACHING SYSTEM ***************************/
		/************************************************************************************/
	
	function writer_list($limit)
	{
		$this->db->select('writer_id,writer_name, writer_name_en, img_ext');
		$this->db->from('writer_info');
		$this->db->where('writer_info.writer_status',1);
		$this->db->order_by('writer_info.writer_id', 'DESC');
		$this->db->limit($limit);
		$query = $this->db->get();
		if($query->num_rows() > 0) return $query-> result();
		else return false;
	}
	
	function get_author_wise_news($authorID, $limit, $start)
	{
		$this->db->select('news_common_info.news_id, news_common_info.news_headline,news_common_info.headline_tag,news_common_info.cat_id,news_common_info.author_id, news_common_info.news_status, category_info.cat_key_name, category_info.cat_name, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_details_brief, news_common_info.news_pub_date, news_common_info.news_pub_time, news_common_info.catStatus');
		$this->db->from('news_common_info, category_info');
		$this->db->where('news_common_info.cat_id = category_info.cat_id');
		$this->db->where('news_writer_info.author_ids', $authorID);
		$this->db->where('news_common_info.news_status != ', 0);
		$this->db->where('news_common_info.news_status != ', 4);
		$this->db->where('news_common_info.news_status != ', 10);
		$this->db->join('news_writer_info', 'news_common_info.news_id = news_writer_info.news_id');
		$this->db->order_by('news_common_info.news_id', 'DESC');
		$this->db->limit($limit, $start);
		$query = $this->db->get();

		if($query->num_rows() > 0) return $query-> result();
		else return false;
	}
	function author_info($authorID)
	{
		$this->db->cache_off(); 
		$this->db->select('writer_info.*');
		$this->db->from('writer_info');
		$this->db->where('writer_info.writer_id', $authorID);
		// $this->db->join('writer_info', 'news_common_info.author_id = writer_info.writer_id', 'left');
		$query = $this->db->get();
		return $query->row();
		
	}

	function all_news_author($author_id){
			$query = $this->db->query('SELECT news_id, author_id FROM `news_common_info` WHERE news_common_info.news_status != 10 AND news_common_info.news_status !=  4 AND news_common_info.news_status != 0 AND `author_id` = "'.$author_id.'"');
			return $query->num_rows();
	}

	
	public function count_row_for_spc_author($id) {
		$query = $this->db->query('SELECT `news_id` FROM `news_writer_info` WHERE `author_ids` = "'.$id.'"');
		return $query->num_rows();
    }

	  /******************************************************************/
	 /************************** LIVE UPDATE ***************************/
	/******************************************************************/
	
	function live_update_news_info($newsStatus, $limit)
	{
		$this->db->select('news_common_info.news_id, news_common_info.news_headline, news_common_info.news_status, category_info.cat_key_name, category_info.cat_name, news_common_info.img_ext, news_common_info.news_reporter, news_common_info.news_details_brief, news_common_info.news_pub_date, news_common_info.news_mod_date, news_info.news_source, news_info.news_source_link');
		$this->db->from('news_common_info, category_info, news_info');
		$this->db->where('news_common_info.cat_id = category_info.cat_id');
		$this->db->where('news_common_info.news_id = news_info.news_id');
		$this->db->where('news_common_info.news_status = ', $newsStatus);
		$this->db->order_by('news_common_info.news_id', 'DESC');
		$this->db->limit($limit);
		$query = $this->db->get();

		if($query->num_rows() > 0) return $query-> result();
		else return false;	
	}


	protected $table = 'epaper_info';
	public function get_count() {
        return $this->db->count_all($this->table);
    }

	function e_paper_getData($limit, $start){
		$this->db->cache_off();
		$query = $this->db->select('ep_id,ep_subject, ep_file, img_ext,ep_date')
				->from('epaper_info')
				->where('ep_status',1)
				->order_by('ep_id','DESC')
				->limit($limit, $start)
				->get();

		return $query->result(); 
	}

	function filter_ePaper($subject='' , $date=''){
		$this->db->cache_off();
		$query = '';
		$this->db->select('*');
		$this->db->from('epaper_info');
		if($subject) { $this->db->like('ep_subject', $subject); }
		if ($date) { $new_date = date('Y-m-d', strtotime($date));   $this->db->where('ep_date', $new_date); }
		$this->db->where('epaper_info.ep_status != 0');
		$this->db->limit(30);
		$query = $this->db->get();

		if ($query->num_rows() > 0) return $query->result();
		else return false;
	}

	// function filter_subject_ePaper($subject=''){
	// 	$this->db->cache_off();
	// 	$query = '';
	// 	$this->db->select('*');
	// 	$this->db->from('epaper_info');
	// 	$this->db->like('ep_subject', $subject); 
	// 	$this->db->where('epaper_info.ep_status != 0');
	// 	$this->db->limit(30);
	// 	$query = $this->db->get();

	// 	if ($query->num_rows() > 0) return $query->result();
	// 	else return false;
	// }


	// function filter_date_ePaper($new_date=''){
	// 	$this->db->cache_off();
	// 	$query = '';
	// 	$this->db->select('*');
	// 	$this->db->from('epaper_info');
	// 	if ($new_date) { $this->db->where('ep_date', $new_date); }
	// 	$this->db->where('epaper_info.ep_status != 0');
	// 	$this->db->limit(30);
	// 	$query = $this->db->get();

	// 	if ($query->num_rows() > 0) return $query->result();
	// 	else return false;
	// }



	function member_list($group)
	{
		$query = $this->db->select('*')
			->from('member_info')
			->where('member_group', $group)
			->where('status !=', 0)
			->order_by('rank')
			->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}


	// Subscription Model 
	function store_subscription($data){
		$this->db->insert('subscription_tbl', $data);
	}


	function email_verify_info($email){
		$query = $this->db->select('*')
			->from('subscription_tbl')
			->where('subscription_email', $email)
			->get();
		return $query->row(); 
	}

	function email_verify_confirm($email)
	{
		$status = array(
			'status' => 1
		);
		
		$this->db->where('subscription_email', $email);
		$this->db->update('subscription_tbl', $status);

		return 1; 
	}


	// Subscription Model 


	/***********************Newsletter**************************/


	function newsletter_news($date)	
	{
		$query=$this-> db-> query("SELECT `view_news_common_info`.`news_id`,`view_news_common_info`.`news_headline`
						FROM category_info, view_news_common_info
						WHERE `view_news_common_info`.`news_status` != 0 AND `view_news_common_info`.`cat_id` != 5 AND `category_info`.`cat_id`=`view_news_common_info`.`cat_id` AND `view_news_common_info`.`news_pub_date`= '".$date."'
						ORDER BY `news_id` DESC ");
		
		if($query->num_rows() > 0) return $query-> result();
		else return false;	
	}

	/***********************Newsletter**************************/




	// Prayer Data Inset 

	function prayer_time($date)
		{
			$this->db->cache_off();
			$query=$this-> db-> query("SELECT * FROM `prayer_table` WHERE `timing_date` = '".$date."' ");										
			if($query->num_rows() > 0) return $query-> row();
			else return false; 
		}

	function ck_prayer_date($date){
		$ql = $this->db->select('timing_date')->from('prayer_table')->where('timing_date',$date)->get();

		if( $ql->num_rows() > 0 ) {
			return false;
		} else {
			return true;
		}
	}

	function store_prayer_time($today_date, $p_f, $p_d, $p_a, $p_m, $p_i, $s_r, $s_s){
		$timezone = "Asia/Dhaka";
		$prayer_data = array(
			'timing_date' 	=> $today_date,
			'Fajr'			=> $p_f,
			'Dhuhr' 		=> $p_d,
			'Asr' 			=> $p_a,
			'Maghrib' 		=> $p_m,
			'Isha' 			=> $p_i,
			'Sunrise' 		=> $s_r,
			'Sunset' 		=> $s_s,
			'create_at'		=> date('Y-m-d H:i:s')

		);
		$this->db->insert('prayer_table', $prayer_data);
	}

	// Prayer Data Inset 
	
	/********** Segment News Query ***************/
    	function date_range_check($date){
    		$this->db->select('*');
    		$this->db->where('segment_start_date <=', $date);
    		$this->db->where('segment_end_date >=', $date);
    		$this->db->where('status', 1);
    		$query = $this->db->get('news_segment');
    		if($query->num_rows() > 0){ 
    			return $query->result();
    		}
    		else{
    			return $query->result();
    		}
    	}
    
    	function fetch_tag_news($tag, $limit){
    
    		$query = $this->db->query("SELECT view_news_common_info.headline_tag, view_news_common_info.news_details_brief, view_news_common_info.news_id,view_news_common_info.news_headline,view_news_common_info.news_status, view_news_common_info.cat_id, view_news_common_info.news_pub_date, view_news_common_info.news_pub_time, view_news_common_info.img_ext,category_info.cat_id,category_info.cat_name,category_info.cat_key_name
    							FROM category_info, news_tag_info, view_news_common_info
    							WHERE view_news_common_info.news_status != 0 AND category_info.cat_id=view_news_common_info.cat_id AND view_news_common_info.news_id = news_tag_info.news_id  AND news_tag_info.news_tag LIKE '%" . $tag . "'
    							ORDER BY news_id DESC LIMIT ".$limit);
    		if ($query->num_rows() > 0) return $query->result();
    		else return false;
    	}
    
    	function check_topic($news_keyword){
    		$this->db->select('*');
    		$this->db->where('segment_tag', $news_keyword);
    		$this->db->where('status', 1);
    		$query = $this->db->get('news_segment');
    		if($query->num_rows() > 0){ 
    			return $query->row();
    		}
    		else{
    			return false; 
    		}
    	}
	/********** Segment News Query ***************/



}
