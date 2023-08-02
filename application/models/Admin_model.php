<?php
	class Admin_model extends CI_model{
		
		function __construct()
		{
			parent::__construct();
			// $this->db->cache_off();
			$timezone = "Asia/Dhaka";
			date_default_timezone_set($timezone);
			
		}
        /** DATA EXISTENCE CHECK **/
        
		function isDataExist($table, $field, $item){
			$query = $this-> db-> select($field)-> from($table)-> where($field, $item)-> get();
			if($query->num_rows()>0) return true;
			else return false;
		}




        /** DATA REDUNDANCY CHECK **/
        

		// function redundancy_check($table, $field, $item)
		// {
		// 	$query = $this-> db-> select( $field )-> from( $table )-> get();

		// 	$temp_new = strtolower( preg_replace('/\s+/', '', $item));
		// 	foreach($query -> result() as $info):
		// 		$temp_old = strtolower( preg_replace('/\s+/', '',$info -> $field));
		// 		if($temp_old == $temp_new) return true;
		// 	endforeach;
			 
		// 	return false;
		// }
		
		
		  /*----------------------------------------------------------------------/ 
		 /-------------- CUSTOMER'S PLOT ENTRY ----------------/
		/--------------------------------------------------------------------*/
		
		
		function customer_plot_entry($plot_id,$officer_id)
		{
			/*------- Date function in CI --------------*/
			$timezone = "Asia/dhaka";
			date_default_timezone_set($timezone);
			$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			/***-------- End of Date function in CI -------------***/

			$customer_plot_entry = array(
			   'customer_id' => $this-> tank_auth-> get_user_id(),
			   'plot_id' => $plot_id,
			   'officer_id' => $officer_id,
			   'booking_date' => $bd_date
			);
			
			$insert=$this-> db-> insert('customer_plot_info', $customer_plot_entry);
			$last_id = $this-> db-> insert_id(); /* get the last id of img */
			return $last_id;
		}
		
		  /*---------------------------------------------------/ 
		 /------------- PLOT BOOKING CHECKING  ---------------/
		/---------------------------------------------------*/
		
		function check_some($plot_id)
		{
			$user_id=$this-> tank_auth-> get_user_id();
			
			$query = $this -> db -> select('customer_id,plot_id,customer_plot_id')
								 -> from('customer_plot_info')
								 -> where('plot_id',$plot_id)
								 -> where('customer_id',$user_id)
								 -> get();
								 
			if($query -> num_rows() > 0)
			   return true;
		}

    	function all_news()
    	{
    		$this->db->cache_off();
    		$current_date = date('Y-m-d');
    		$query = $this->db->query('SELECT * FROM `news_common_info` WHERE `news_pub_date` = "'.$current_date.'"');
    		return $query->num_rows();
    	}
    	function all_category()
    	{
    		$query = $this->db->query('SELECT * FROM `category_info`');
    		return $query->num_rows();
    	}
    	function all_users()
    	{
    		$query = $this->db->query('SELECT * FROM `users` WHERE `user_type` != 7 ');
    		return $query->num_rows();
    	}
    	function visitors_count()
    	{
    		$this->db->cache_off(); 
    		$date = date('Y-m-d');
    		$query = $this->db->query('SELECT `day_visitor` FROM `daily_visitor_info` WHERE `day_date` = "'.$date.'"');
    		return $query->row();
    	}
    
    	function latest_news_info()
    	{
    		$query = $this->db->select('*')
    		->from('news_common_info')
    		->where('news_publisher', $this->tank_auth->get_user_id())
    		->order_by('news_id', 'DESC')
    		->limit(8)
    		->get();
    
    		return $query->result();
    
    	}
    
    
    	function user_info_by_id($type, $user_id)
    	{
    		$query = $this->db->select('*')
    		->from('users')
    		->where('id', $user_id)
    
    		->get();
    
    		if ($query->num_rows() > 0) {
    			foreach ($query->result() as $row) {
    				$data[] = $row;
    			}
    			return $data;
    		}
    	}
    	
    	/*---------------------------------------------------/ 
    	/----------------- News Statistic -------------------/
    	/---------------------------------------------------*/
    		
    	function daily_visitors_list($limit, $start)
    	{
    		$this->db->cache_off();
    
    		$first_date = date('Y-m-d', strtotime($this->input->get('from_date')));
    		$last_date  = date('Y-m-d', strtotime($this->input->get('to_date')));
    
    		if($this->input->get('from_date') && $this->input->get('to_date')){
    			$query = $this->db->select('*')				
    				->from('daily_visitor_info')
    				->where('day_date >=', $first_date)
    				->where('day_date <=', $last_date)
    				->order_by('day_id', 'DESC')
    				->limit($limit, $start)
    				->get();
    		}else{
    			$query = $this->db->select('*')				
    				->from('daily_visitor_info')
    				->order_by('day_id', 'DESC')
    				->limit($limit, $start)
    				->get();
    		}
    		return $query->result(); 	
    	}
    
    	public function daily_visitors_row() {
    	    $this->db->cache_off();	
    		$query = $this->db->query('SELECT `day_id` FROM `daily_visitor_info` ');
    		return $query->num_rows();
        }
    
    
    	function daily_news_report_by_reporter($user_type, $date){
    		$this->db->cache_off();		
    		$query 	= $this->db->query("SELECT `users`.`id` , `users`.`user_full_name`, `users`.`username`,  count( `news_common_info`.`news_publisher` ) as 'news_no'  FROM `users` LEFT  JOIN `news_common_info` ON (`users`.`id` = `news_common_info`.`news_publisher`  AND `news_pub_date` = '".$date."') WHERE `user_type` <= '".$user_type."'  GROUP BY `users`.`id` ");				
    		return $query->result(); 
    	}
    
    	function daily_news_report_by_category($date){
    		$this->db->cache_off();			
    		$query 	= $this->db->query("SELECT `category_info`.`cat_id` , `category_info`.`cat_name`,  `category_info`.`cat_key_name`, count( `news_common_info`.`cat_id` ) as 'news_no'  FROM `category_info` LEFT  JOIN `news_common_info` ON (`category_info`.`cat_id` = `news_common_info`.`cat_id`  AND `news_pub_date` = '".$date."') GROUP BY `category_info`.`cat_id` ");				
    		return $query->result(); 
    	}
    
    
    
    	/*---------------------------------------------------/ 
    	/----------------- News Statistic -------------------/
    	/---------------------------------------------------*/
		
		
	


	    /* ---------------------- CATEGORY INFO -------------------- */

		function category_info_news_setup()
		{
			$this->db->cache_off();

			$query = $this->db->select('cat_id, cat_key_name, cat_name')
			->from('category_info')
			->where('cat_status', 1)
				->where('cat_id !=', 5)
				->get();

			$data[''] = 'Select One';
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[$row->cat_id] = $row->cat_name . ' (' . $row->cat_key_name . ')';   /* name nibe but id array te rakbe */
				}
				return $data;
			}
		}

		
		function category_info()
		{
			$this->db->cache_off();
			$query = $this->db->select('cat_id, cat_key_name, cat_name')				
							->from('category_info')
							->where('cat_status',1)
							->get();
							
			$data['']='Select One';				
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[$row -> cat_id]= $row -> cat_name.' ('.$row -> cat_key_name.')';   /* name nibe but id array te rakbe */
				}
				return $data;
			}	
		}

		function category_info_opinion()
		{
			$query = $this->db->select('cat_id, cat_key_name, cat_name')
			->from('category_info')
			->where('cat_status', 1)
			->where('cat_id', 5)
			->get();

			$data[''] = 'Select One';
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[$row->cat_id] = $row->cat_name . ' (' . $row->cat_key_name . ')';   /* name nibe but id array te rakbe */
				}
				return $data;
			}
		}
		
		
		
		/***** Page Name with id *****/
		
		// function page_name()
		// {
		// 	$query=$this-> db-> query("SELECT DISTINCT news_id,news_type FROM common_details");		
			
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[$row -> news_id]= $row -> news_type;   /* name nibe but id array te rakbe */
		// 		}
		// 		return $data;
		// 	}	
		// }
		
		
		/***** Comments Info *****/
		
		// function comments_info()
		// {
			
		// 	$query = $this->db->select('*')				
		// 					->from('user_comments')
		// 					->where('user_publish = " "')
		// 					->get();
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		/***** Page Info Showing *****/
		
		// function page_info_list()
		// {
		// 	$this-> db-> order_by("news_id", "asc");
			
		// 	$query = $this->db->select('*')				
		// 					->from('common_details')
		// 					->get();
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		/***** Photo Info Showing (Album wise) *****/
		
		// function photo_info_list($a_id)
		// {
			
		// 	$query = $this-> db-> query('SELECT * From album_details WHERE a_id="'.$a_id.'"');				
							
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		
		
		/***** Gallery Info List for Showing *****/
		
		// function gallery_info_list()
		// {
			
		// 	$query = $this-> db-> select('*')				
		// 					->from('gal_info')
		// 					->get();
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		/***** Gallery Info Edit *****/
		
		// function gallery_edit($gal_id)
		// {
			
		// 	$query=$this-> db-> query("SELECT * FROM gal_info WHERE gal_id='".$gal_id."'");			
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		/***** Album Info Edit *****/
		
		// function album_edit($a_id)
		// {
			
		// 	$query=$this-> db-> query("SELECT * FROM album_info WHERE a_id='".$a_id."'");			
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		/***** Photo Info Edit *****/
		
		// function photo_edit($pic_id)
		// {		
		// 	$query=$this-> db-> query("SELECT * FROM album_details WHERE pic_id='".$pic_id."'");			
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		// function photo_edit2($pic_id)
		// {
		// 	/******************* FILE DELETE  ************************/
		// 	$table_name='album_details';
		// 	$table_id='pic_id'; 	/* Table ar kun field ar id theke delete korbe like p_id,prog_id */
		// 	$file_id=$pic_id;
		// 	$folder_name='gallery';
		// 	$this-> common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
			
		// 	/******************* FILE DELETE  ************************/
			
		
			
		// 	$query=$this-> db-> query("SELECT * FROM album_details WHERE pic_id='".$pic_id."'");			
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		/***** Page Info Edit *****/
		
		// function page_info_edit($news_id)
		// {
			
		// 	$query=$this-> db-> query("SELECT * FROM common_details WHERE news_id='".$news_id."'");			
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		/***** Album info List for Showing *****/
		
		// function album_info_list()
		// {
			
		// 	$query = $this-> db-> query('SELECT * FROM album_info ORDER BY a_id desc');				
		// 					/*->from('album_info')
		// 					->order by('a_id')
		// 					->get();
		// 					*/
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		// /***** Banner info List for Showing *****/
		
		// function banner_info_list()
		// {
			
		// 	$query = $this-> db-> query('SELECT * FROM banner_info ORDER BY ban_id asc');				
		// 					/*->from('album_info')
		// 					->order by('a_id')
		// 					->get();
		// 					*/
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		// /***** Publish Comments *****/
		
		// function comments_publish($user_id)
		// {
			
		// 	$query = $this->db->set('user_publish','yes')				
		// 					->where('user_id',$user_id)
		// 					->update('user_comments');

		// 		return $query;
		// }
		
		
		// /***** Delete Comments *****/
		
		// function comments_delete($user_id)
		// {
		// 	$query=$this->db->query("DELETE FROM user_comments WHERE user_id='".$user_id."'");

		// 	return $query;
		// }
		
		
		// /*****-------------------------------- Delete Gallery -------------------------------*****/
		
		// function gallery_delete($gal_id)
		// {
		// 	$query = $this->db->select('pic_id,album_details.a_id')					
		// 			->from('gal_info')
		// 			->join('album_info', 'gal_info.gal_id = album_info.gal_id')
		// 			->join('album_details', 'album_info.a_id = album_details.a_id')
		// 			->where('gal_info.gal_id = "'.$gal_id.'"')
		// 			->get();
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$pic_id= $row -> pic_id;
		// 			$a_id= $row -> a_id;
					
		// 			//echo $pic_id;
					
		// 			/******************* FILE DELETE  ************************/
		// 			$table_name='album_details';
		// 			$table_id='pic_id';
		// 			$file_id=$pic_id;
		// 			$folder_name='gallery';

		// 			$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'album_delete');	// common  Function for deleting file from folder pathanu hoise //
		// 			/******************* FILE DELETE  ************************/
		// 		}
		// 	}
			
		// 	$query2=$this->db->query("DELETE FROM gal_info WHERE gal_id='".$gal_id."'");
		// 	$query3=$this->db->query("DELETE FROM album_info WHERE gal_id='".$gal_id."'");
			
		// 	if($a_id)
		// 		$query4=$this->db->query("DELETE FROM album_details WHERE album_details.a_id='".$a_id."'");
			

		// 	return $query;	
		// }
		
		// /*****-------------------------- Delete Album ---------------------------*****/
		
		// function album_delete($a_id)
		// {
			
		// 	$query = $this->db->select('pic_id')					
		// 			->from('album_details')
		// 			->where('a_id = "'.$a_id.'"')
		// 			->get();
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$pic_id= $row -> pic_id;
					
		// 			//echo $pic_id;
					
		// 			/******************* FILE DELETE  ************************/
		// 			$table_name='album_details';
		// 			$table_id='pic_id';
		// 			$file_id=$pic_id;
		// 			$folder_name='gallery';
					  
		// 			$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'album_delete');	// common  Function for deleting file from folder pathanu hoise //
		// 			/******************* FILE DELETE  ************************/
		// 		}
		// 	}
			
		// 	$query2=$this-> db-> query("DELETE FROM album_info WHERE a_id='".$a_id."'");
		// 	$query3=$this-> db-> query("DELETE FROM album_details WHERE a_id='".$a_id."'");

		// 	return $query;
		// }
		
		// /*****---------------------- Delete Photo ---------------------*****/
		
		// function photo_delete($pic_id)
		// {
			
		// 	/******************* FILE DELETE  ************************/
		// 	$table_name='album_details';
		// 	$table_id='pic_id';
		// 	$file_id=$pic_id;
		// 	$folder_name='gallery';
		// 	$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
		// 	/******************* FILE DELETE  ************************/
			
			
		// 	$query=$this-> db-> query("DELETE FROM album_details WHERE pic_id='".$pic_id."'");
			
		// 	return $query;
		// }
		

	
		
		// /***** Delete Banner *****/
		
		// function banner_delete($ban_id)
		// {
		// 	/******************* FILE DELETE  ************************/
		// 	$table_name='banner_info';
		// 	$table_id='ban_id';
		// 	$file_id=$ban_id;
		// 	$folder_name='banner';
		// 	$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
		// 	/******************* FILE DELETE  ************************/
			
		// 	$query2=$this-> db-> query("DELETE FROM banner_info WHERE ban_id='".$ban_id."'");
		// 	return $query2;
		// }
		
		
		
		
		// /***** Delete Page Info *****/
		
		// function page_info_delete($news_id)
		// {
		// 	$query=$this-> db-> query("DELETE FROM common_details WHERE news_id='".$news_id."'");

		// 	return $query;
		// }
		
		// /***** End of Delete Page Info *****/
		
		
		
		
		
		// /*******	Insert data in db (Album Info Table)	********/
		
		// function album_entry()
		// {
		// 	/*------------ Date function in CI -------------------*/
			
		// 	$timezone = "Asia/dhaka";
		// 	date_default_timezone_set($timezone);
		// 	$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			
		// 	/***----------------- End of Date function in CI --------------------***/
			
		// 	$album_entry = array(
		// 	   'gal_id' => $this->input->post('gal_id') ,
		// 	   'a_title' => $this->input->post('a_title') ,
		// 	   'a_des' => $this->input->post('a_des') ,
		// 	   'a_doc' => $bd_date
		// 	);
			
		// 	$insert=$this->db->insert('album_info', $album_entry);
			
		// 	//$last_id = $this->db->insert_id(); /* get the last id of img */
			
		// 	return $insert;
			
		// }
		
		// /* End of Insert data in db (Album Info Table) */
		
		

		
		// /*******	Insert data in db (Gallery Info Table)	********/
		
		// function gallery_entry()
		// {
			
		// 	$gallery_entry = array(
		// 	   'gal_name' => $this-> input-> post('gal_name')
		// 	);
			
		// 	$insert=$this->db->insert('gal_info', $gallery_entry);

		// 	return $insert;
			
		// }
		
		// /*********** End of Insert data in db (Gallery Info Table) *******/
		
		
		
		// /*******	Insert Edited data in db (Gallery Info Table)	********/
		
		// function gallery_edit_entry($gal_id)
		// {
			
		// 	$gallery_entry = array(
		// 	   'gal_name' => $this->input->post('gal_name')
		// 	);
			
			
		// 	$query=$this->db->query("UPDATE gal_info SET gal_name='".$gallery_entry['gal_name']."' WHERE gal_id='".$gal_id."'");
			
		// 	return $query;
			
		// }
		
		// /*********** End of Insert Edited data in db (Gallery Info Table) *******/
		
		
		
		// /*******	Insert Edited data in db (Album Info Table)	********/
		
		// function album_edit_entry($a_id)
		// {
			
		// 	$album_entry = array(
		// 	   'gal_id' => $this->input->post('gal_id') ,
		// 	   'a_title' => $this->input->post('a_title') ,
		// 	   'a_des' => $this->input->post('a_des')
		// 	);
			
			
			
		// 	$query=$this->db->query("UPDATE album_info SET gal_id='".$album_entry['gal_id']."' WHERE a_id='".$a_id."'");
		// 	$query2=$this->db->query("UPDATE album_info SET a_title='".$album_entry['a_title']."' WHERE a_id='".$a_id."'");
		// 	$query3=$this->db->query("UPDATE album_info SET a_des='".$album_entry['a_des']."' WHERE a_id='".$a_id."'");
			
		// 	return $query;
			
		// }
		
		// /*********** End of Insert Edited data in db (Album Info Table) *******/
		
		
		
		
		// /*******	Insert Photo Edited data in db (album_details Table)	********/
		
		// function photo_edit_entry($pic_id)
		// {
			
		// 	$photo_entry = array(
		// 	   'a_id' => $this->input->post('a_id'),
		// 	   'pic_title' => $this-> input-> post('pic_title') ,
		// 	   'pic_caption' => $this-> input-> post('pic_caption') ,
		// 	   'pic_desc' => $this-> input-> post('pic_desc')
		// 	);
			
			
			
		// 	$query=$this-> db-> query("UPDATE album_details SET a_id='".$photo_entry['a_id']."' WHERE pic_id='".$pic_id."'");
		// 	$query=$this-> db-> query("UPDATE album_details SET pic_title='".$photo_entry['pic_title']."' WHERE pic_id='".$pic_id."'");
		// 	$query=$this-> db-> query("UPDATE album_details SET pic_caption='".$photo_entry['pic_caption']."' WHERE pic_id='".$pic_id."'");
		// 	$query=$this-> db-> query("UPDATE album_details SET pic_desc='".$photo_entry['pic_desc']."' WHERE pic_id='".$pic_id."'");
			
		// 	return $query;
			
		// }
		
		// /*********** End of Insert Photo Edited data in db (album_details Table) *******/
		
		
		
		/************* Common Function for delete picture from folder ***********/
		
		function common_file_delete($table_id,$table_name,$file_id,$folder_name,$album_delete)
		{
			$img_ext='';
			$query = $this->db->select("img_ext")					
					-> from($table_name)
					-> where(''.$table_id." = '".$file_id."'")
					-> get();
							
			if($query->num_rows()>0){
				foreach ($query->result() as $row){
					$img_ext= $row -> img_ext;
					$data[]= $row;
				}
			}
			
			if($img_ext)
			{
				if($img_ext!='')
				{
					if($album_delete=='album_delete')
					{
						$filestring = PUBPATH.'images/'.$folder_name.'/'.$file_id.$img_ext ;  
						$filestring_thumb = PUBPATH.'images/'.$folder_name.'/thumb/'.$file_id.$img_ext ;  
					}
					else
					{
						define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
						$filestring = PUBPATH.'images/'.$folder_name.'/'.$file_id.$img_ext ;  
						$filestring_thumb = PUBPATH.'images/'.$folder_name.'/thumb/'.$file_id.$img_ext ;  
					}
					//echo $filestring;
					//echo $filestring_thumb;
					
					if(is_file($filestring) && is_file($filestring_thumb))
					{
						unlink($filestring);
						unlink($filestring_thumb);
					}
					
					else if(is_file($filestring))
					{
						unlink($filestring);
					}
					
					else if(is_file($filestring_thumb))
					{
						unlink($filestring_thumb);
					}	
				}			
			}
			return $query;
		}
		
		// /************* End of Common Function for delete picture from folder ***********/
		
		
		
		
		// /*******	Insert Edited Page Info in db (Common Details Table)	********/
		
		// function page_info_edit_entry($news_id)
		// {
		// 	$news_details=$this->input->post('news_details');
		// 	$news_netails2=addslashes($news_details);
			
		// 	$album_entry = array(
		// 	   'news_id' => $this->input->post('news_id') ,
		// 	   //'news_details' => $this->input->post('news_details'),
		// 	   'news_details' => $news_netails2,
		// 	   //'news_date' => $this->input->post('news_date')
		// 	   'news_date' => date('F d, Y')
		// 	);
			
			
		// 	$query=$this->db->query("UPDATE common_details SET news_details='".$album_entry['news_details']."' WHERE news_id='".$news_id."'");
		// 	$query5=$this->db->query("UPDATE common_details SET news_date='".$album_entry['news_date']."' WHERE news_id='".$news_id."'");
			
			
		// 	return $query;
			
		// }
		
		// /*********** End of Insert Edited data in db (Album Info Table) *******/
		
		
		
		
		
		// /*******	Page Info Entry (Achievements) ********/
		
		// function page_info_entry()
		// {
		// 	/* Date function in CI */
			
		// 	$timezone = "Asia/dhaka";
		// 	date_default_timezone_set($timezone);
		// 	$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			
		// 	/*** End of Date function in CI ***/
			
			
			
		// 	$page='achievements';
			
		// 	$album_entry = array(
		// 	   //'news_id' => $this->input->post('news_id') ,
		// 	   'news_type' => $page,
		// 	  // 'news_award' => $this->input->post('news_award'),
		// 	   'news_details' => $this->input->post('news_details'),
		// 	   'news_date' => $bd_date
	
		// 	);
			

		// 	$insert=$this->db->insert('common_details', $album_entry);
			
		// 	return $insert;
			
		// }
		
		/* End of Page Info Entry (Achievements) */
		
		
		
		/*************************************************************************************************/
	   /*																								*/
	  /*****************----------------  Start of Program  -----------------------*****************/
	 /*																								  */
	/*************************************************************************************************/
				
				
				
			
			/*****-------------- Progam Info Showing ---------------*****/
			
			// function prog_info_list()
			// {			
			// 	$query = $this->db->select('*')				
			// 					->from('prog_info')
			// 					->get();			
								
			// 	if($query->num_rows()>0)
			// 	{
			// 		foreach ($query->result() as $row)
			// 		{
			// 			$data[]= $row;
			// 		}
					
			// 		return $data;
			// 	}	
			// }
			
			
			/*****--------------------- Program Info Edit -----------------*****/
		
			// function prog_edit($p_id)
			// {
			// 	/******************* FILE DELETE  ************************/
			// 	$table_name='prog_info';
			// 	$table_id='p_id'; 	/* Table ar kun field ar id theke delete korbe like p_id,prog_id */
			// 	$file_id=$p_id;
			// 	$folder_name='program';
			// 	$this-> common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
				
			// 	/******************* FILE DELETE  ************************/
			
			
			// 	$query=$this-> db-> query("SELECT * FROM prog_info WHERE p_id='".$p_id."'");			
								
			// 	if($query->num_rows()>0)
			// 	{
			// 		foreach ($query->result() as $row)
			// 		{
			// 			$data[]= $row;
			// 		}
					
			// 		return $data;
			// 	}	
			// }
			
			
			
			/*******-----------	 Insert Documentary Edited data in db (doc_info Table)	----------********/
			
			// function prog_edit_entry($p_id)
			// {
				
			// 	$prog_entry = array(
			// 	   'p_title' => $this-> input-> post('p_title'),
			// 	   'p_place' => $this-> input-> post('p_place'),
			// 	   'p_date' => $this-> input-> post('p_date'),
			// 	   'p_des' => $this-> input-> post('p_des'),
			// 	   'p_doc' => $this-> input-> post('p_doc')
			// 	);
				
				
				
			// 	//$query=$this-> db-> query("UPDATE doc_info SET a_id='".$doc_entry['a_id']."' WHERE pic_id='".$pic_id."'");
			// 	$query=$this-> db-> query("UPDATE prog_info SET p_title='".$prog_entry['p_title']."' WHERE p_id='".$p_id."'");
			// 	$query=$this-> db-> query("UPDATE prog_info SET p_place='".$prog_entry['p_place']."' WHERE p_id='".$p_id."'");
			// 	$query=$this-> db-> query("UPDATE prog_info SET p_date='".$prog_entry['p_date']."' WHERE p_id='".$p_id."'");
			// 	$query=$this-> db-> query("UPDATE prog_info SET p_des='".$prog_entry['p_des']."' WHERE p_id='".$p_id."'");
			// 	$query=$this-> db-> query("UPDATE prog_info SET p_doc='".$prog_entry['p_doc']."' WHERE p_id='".$p_id."'");
				
			// 	return $query;
				
			// }
			
			/*********** End of Insert Documentary Edited data in db (doc_info Table) *******/
			
			
			
			
	    /*******-------------------	New Program Insert ----------------********/
		
		function prog_entry()
		{
			/*------- Date function in CI --------------*/
			
			$timezone = "Asia/dhaka";
			date_default_timezone_set($timezone);
			$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			
			/***-------- End of Date function in CI -------------***/
			
			
			$prog_entry = array(
			   'p_title' => $this-> input-> post('p_title'),
			   'p_place' => $this->input->post('p_place'),
			   'p_date' => $this->input->post('p_date'),
			   'p_time' => $this->input->post('p_time'),
			   'p_organizer' => $this->input->post('p_organizer'),
			   'p_des' => $this->input->post('p_des'),
			   'p_doc' => $bd_date
			);
			

			$insert=$this-> db-> insert('prog_info', $prog_entry);
			
			$last_id = $this-> db-> insert_id(); /* get the last id of img */
			
			return $last_id;
			
			//return $insert;
			
		}
		
		/*--------------- End of New Program Insert -------------*/

		
		/***************** Delete Program ****************/
		
		// function prog_delete($pic_id)
		// {
			
		// 	/******************* FILE DELETE  ************************/
		// 	$table_name='prog_info';
		// 	$table_id='p_id'; 	/* Table ar kun field ar id theke delete korbe */
		// 	$file_id=$pic_id;
		// 	$folder_name='program';
		// 	$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
		// 	/******************* FILE DELETE  ************************/
			
			
		// 	$query=$this-> db-> query("DELETE FROM prog_info WHERE p_id='".$pic_id."'");
			
		// 	return $query;
		// }
			
		
			
			
			/*************************************************************************************************/
		   /*																								*/
		  /*****************----------------  End of Program -----------------------******************/
		 /*																								  */
		/*************************************************************************************************/
		
		
		
		
		
		
		/*************************************************************************************************/
	   /*																								*/
	  /*****************----------------  Start of Service  -----------------------*****************/
	 /*																								  */
	/*************************************************************************************************/
				
				
				
			
			/***** Service Info Showing *****/
			
			// function service_info_list()
			// {
				
			// 	//$query = $this-> db-> query('SELECT * From doc_info');				
			// 	$query = $this->db->select('*')				
			// 					->from('service_info')
			// 					->get();			
								
			// 	if($query->num_rows()>0)
			// 	{
			// 		foreach ($query->result() as $row)
			// 		{
			// 			$data[]= $row;
			// 		}
					
			// 		return $data;
			// 	}	
			// }
			
			
			/***** service Info Edit *****/
		
			// function service_edit($s_id)
			// {
				
			// 	$query=$this-> db-> query("SELECT * FROM service_info WHERE s_id='".$s_id."'");			
								
			// 	if($query->num_rows()>0)
			// 	{
			// 		foreach ($query->result() as $row)
			// 		{
			// 			$data[]= $row;
			// 		}
					
			// 		return $data;
			// 	}	
			// }
			
			
			
			/*******-----------	 Insert Service Edited data in db (service_info Table)	----------********/
			
			// function service_edit_entry($s_id)
			// {
				
			// 	$service_entry = array(
			// 	   's_title' => $this-> input-> post('s_title'),
			// 	   's_place' => $this-> input-> post('s_place'),
			// 	   's_date' => $this-> input-> post('s_date'),
			// 	   's_des' => $this-> input-> post('s_des'),
			// 	   's_doc' => $this-> input-> post('s_doc')
			// 	);
				
				
				
			// 	//$query=$this-> db-> query("UPDATE doc_info SET a_id='".$doc_entry['a_id']."' WHERE pic_id='".$pic_id."'");
			// 	$query=$this-> db-> query("UPDATE service_info SET s_title='".$service_entry['s_title']."' WHERE s_id='".$s_id."'");
			// 	$query=$this-> db-> query("UPDATE service_info SET s_place='".$service_entry['s_place']."' WHERE s_id='".$s_id."'");
			// 	$query=$this-> db-> query("UPDATE service_info SET s_date='".$service_entry['s_date']."' WHERE s_id='".$s_id."'");
			// 	$query=$this-> db-> query("UPDATE service_info SET s_des='".$service_entry['s_des']."' WHERE s_id='".$s_id."'");
			// 	$query=$this-> db-> query("UPDATE service_info SET s_doc='".$service_entry['s_doc']."' WHERE s_id='".$s_id."'");
				
			// 	return $query;
				
			// }
			
			/*********** End of Insert Service Edited data in db (service_info Table) *******/
			
			
			
			
	    /*******-------------------	New service Insert ----------------********/
		
		// function service_entry()
		// {
		// 	/*------- Date function in CI --------------*/
			
		// 	$timezone = "Asia/dhaka";
		// 	date_default_timezone_set($timezone);
		// 	$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			
		// 	/***-------- End of Date function in CI -------------***/
			
			
		// 	$service_entry = array(
		// 	   's_title' => $this-> input-> post('s_title'),
		// 	   's_place' => $this->input->post('s_place'),
		// 	   's_date' => $this->input->post('s_date'),
		// 	   's_des' => $this->input->post('s_des'),
		// 	   's_doc' => $bd_date
		// 	);
			

		// 	$insert=$this-> db-> insert('service_info', $service_entry);
			
		// 	$last_id = $this-> db-> insert_id(); /* get the last id of img */
			
		// 	return $last_id;
			
		// 	//return $insert;
			
		// }
		
		/*--------------- End of New service Insert -------------*/

			
			
		/***************** Delete Service ****************/
		
		// function service_delete($s_id)
		// {
			
		// 	/******************* FILE DELETE  ************************/
		// 	$table_name='service_info';
		// 	$table_id='s_id'; 	/* Table ar kun field ar id theke delete korbe */
		// 	$file_id=$s_id;
		// 	$folder_name='service';
		// 	$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
		// 	/******************* FILE DELETE  ************************/
			
			
		// 	$query=$this-> db-> query("DELETE FROM service_info WHERE s_id='".$s_id."'");
			
		// 	return $query;
		// }
		
			
			
			/*************************************************************************************************/
		   /*																								*/
		  /*****************----------------  End of Service  -----------------------******************/
		 /*																								  */
		/*************************************************************************************************/
		
		
		
		
		/*************************************************************************************************/
	   /*																								*/
	  /*****************----------------  Start of Achievement  -----------------------*****************/
	 /*																								  */
	/*************************************************************************************************/
				
				
				
			
			/***** Service Info Showing *****/
			
			// function achievement_info_list()
			// {
			// 	$query = $this->db->select('*')				
			// 					->from('achievement_info')
			// 					->get();			
								
			// 	if($query->num_rows()>0)
			// 	{
			// 		foreach ($query->result() as $row)
			// 		{
			// 			$data[]= $row;
			// 		}
					
			// 		return $data;
			// 	}	
			// }
			
			
			// /***** service Info Edit *****/
		
			// function achievement_edit($a_id)
			// {
				
			// 	$query=$this-> db-> query("SELECT * FROM achievement_info WHERE a_id='".$a_id."'");			
								
			// 	if($query->num_rows()>0)
			// 	{
			// 		foreach ($query->result() as $row)
			// 		{
			// 			$data[]= $row;
			// 		}
					
			// 		return $data;
			// 	}	
			// }
			
			
			
			/*******-----------	 Insert Service Edited data in db (service_info Table)	----------********/
			
			// function achievement_edit_entry($a_id)
			// {
				
			// 	$achievement_entry = array(
			// 	   'a_title' => $this-> input-> post('a_title'),
			// 	   'a_des' => $this-> input-> post('a_des'),
			// 	   'a_doc' => $this-> input-> post('a_doc')
			// 	);
				
				
				
			// 	//$query=$this-> db-> query("UPDATE doc_info SET a_id='".$doc_entry['a_id']."' WHERE pic_id='".$pic_id."'");
			// 	$query=$this-> db-> query("UPDATE achievement_info SET a_title='".$achievement_entry['a_title']."' WHERE a_id='".$a_id."'");
			// 	$query=$this-> db-> query("UPDATE achievement_info SET a_des='".$achievement_entry['a_des']."' WHERE a_id='".$a_id."'");
			// 	$query=$this-> db-> query("UPDATE achievement_info SET a_doc='".$achievement_entry['a_doc']."' WHERE a_id='".$a_id."'");
				
			// 	return $query;
				
			// }
			
			/*********** End of Insert Service Edited data in db (service_info Table) *******/
			
			
			
			
	    /*******-------------------	New service Insert ----------------********/
		
		// function achievement_entry()
		// {
		// 	/*------- Date function in CI --------------*/
			
		// 	$timezone = "Asia/dhaka";
		// 	date_default_timezone_set($timezone);
		// 	$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			
		// 	/***-------- End of Date function in CI -------------***/
			
			
		// 	$achievement_entry = array(
		// 	   'a_title' => $this-> input-> post('a_title'),
		// 	   'a_des' => $this->input->post('a_des'),
		// 	   'a_doc' => $bd_date
		// 	);
			

		// 	$insert=$this-> db-> insert('achievement_info', $achievement_entry);
			
		// 	$last_id = $this-> db-> insert_id(); /* get the last id of img */
			
		// 	return $last_id;
			
		// 	//return $insert;
			
		// }
		
		/*--------------- End of New service Insert -------------*/

			
			
		/***************** Delete Service ****************/
		
		// function achievement_delete($a_id)
		// {
			
		// 	/******************* FILE DELETE  ************************/
		// 	$table_name='achievement_info';
		// 	$table_id='a_id'; 	/* Table ar kun field ar id theke delete korbe */
		// 	$file_id=$a_id;
		// 	$folder_name='achievement';
		// 	$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
		// 	/******************* FILE DELETE  ************************/
			
			
		// 	$query=$this-> db-> query("DELETE FROM achievement_info WHERE a_id='".$a_id."'");
			
		// 	return $query;
		// }
		
			
			
			/*************************************************************************************************/
		   /*																								*/
		  /*****************----------------  End of Achievement  -----------------------******************/
		 /*																								  */
		/*************************************************************************************************/
		
		
		
		
		    /***************************************************************************************************/
		   /*																														  */
		  /*************----------------  START NEWS INFORMATION -----------------------****************/
		 /*																														   */
		/*************************************************************************************************/
		
		
		/* ---------------------------------- NEWS ENTRY --------------------------------------- */
		
		function news_entry()
		{
			

			$timezone = "Asia/Dhaka";
			date_default_timezone_set($timezone);
			// $bd_date				= date('F d, Y'); /* Like November 29, 2012 */
			// $pub_date			= date('Y-m-d H:i:s');
			$pub_date				= date('Y-m-d');
			$pub_time				= date('H:i');

			$newsHeadline			= addslashes($this->input->post('news_headline'));
			$newsSubHeadline		= addslashes($this->input->post('news_sub_headline'));
			$news_details_brief2	= addslashes($this->input->post('news_details_brief'));
			$news_details2			= addslashes($this->input->post('news_details'));
			$news_seo_description	= addslashes($this->input->post('news_seo_description'));
			$last_id 				= $news_id = '';
			/***----------------- End of Date function in CI --------------------***/

			$news_entry = array(
				'news_sub_headline' => $newsSubHeadline,
				'news_details' 		=> $news_details2,
				'img_caption' 		=> addslashes($this->input->post('img_caption')),
				'video_link' 		=> $this->input->post('video_link') ,
				'video_caption' 	=> addslashes($this->input->post('video_caption')),
				'news_source' 		=> $this->input->post('news_source'),
				'news_source_link' 	=> $this->input->post('news_source_link') ,
				'news_area' 		=> $this->input->post('news_area') ,
				'news_zone' 		=> $this->input->post('news_zone') ,
			);
			
			$this->db-> insert('news_info', $news_entry);
			$news_id	= $this->db-> insert_id(); /* get the last id of img */


			if($news_id)
			{
				if($this->input->post('news_tag') != ''){
					$news_tag = $this->input->post('news_tag');
					$news_tag_info = array(
						'news_id' 				=> $news_id,
						'news_tag' 				=> $this->input->post('news_tag'),
					);
					$this->db-> insert('news_tag_info', $news_tag_info);
				}

				if($this->input->post('news_seo_title') != ''){
					$news_seo_info = array(
						'news_id' 				=> $news_id,
						'seo_title' 			=> addslashes($this->input->post('news_seo_title')),
						'seo_keyword' 			=> $this->input->post('news_seo_keyword'),
						'seo_description' 		=> $news_seo_description
					);
					$this->db-> insert('news_seo_info', $news_seo_info);
				}

				if($this->input->post('news_author') != ''){
					$author_data = array();
					$author_data['news_id'] = $news_id;
					$author_data['writer_type'] = '1';
					$author_ids = $this->input->post('news_author');
					foreach ($author_ids as $row) {
						$author_data['author_ids']        = $row;
						// DB::table('tbl_book_subject')->insert($sub_data);
						$this->db-> insert('news_writer_info', $author_data);
					}
				}

				if($this->input->post('news_reporter') != ''){
					$rep_data = array();
					$rep_data['news_id'] 			= $news_id;
					$rep_data['writer_type'] 		= '2';
					$rep_data['reporter_ids'] 		= $this->input->post('news_reporter');
					
					$this->db-> insert('news_writer_info', $rep_data);
					
				}

				if($this->input->post('user_type') == 2){
					$news_sts = '';
					$news_approver = '';
				}
				if($this->input->post('user_type') != 2){
					$news_sts = $this->input->post('news_status');
					$news_approver = $this->tank_auth->get_user_id();
				}
				
				$news_common_entry = array(
					'news_id' 				=> $news_id, 
					'cat_id' 				=> $this->input->post('cat_id'),
					'sub_cat_id' 			=> $this->input->post('sub_cat_id'),
					'page_id' 				=> $this->input->post('page_id'),
					'news_status' 			=> $news_sts,
					'news_type' 			=> $this->input->post('news_type'),
					'news_headline' 		=> $newsHeadline,
					'headline_tag' 			=> addslashes($this->input->post('news_caption')),
					'news_details_brief'	=> $news_details_brief2,
					'catStatus' 			=> $this->input->post('catLead'),
					'latestStatus' 			=> $this->input->post('latestStatus'),
					'news_pub_date' 		=> $pub_date,
					'news_pub_time' 		=> $pub_time,
			   		'news_mod_date' 		=> $pub_date,
					'news_mod_time' 		=> $pub_time,
					'news_publisher' 		=> $this-> tank_auth -> get_user_id(),
					'news_approver'			=> $news_approver
				);
				
				$insertInfo			= $this->db->insert('news_common_info', $news_common_entry);
				$news_reader_entry 	= array('news_id' => $news_id, 'news_reader' => 1);
				$insertReader		= $this->db->insert('news_reader_info', $news_reader_entry);
				return $news_id;
			}
			else
				return FALSE;
		}

		// function upload_relevant($news_id,$news_keyword,$limit){
		// 	$query = $this->db->query("SELECT news_info.news_id, news_info.news_headline, news_info.news_status, category_info.cat_key_name, category_info.cat_name, news_info.img_ext, news_info.news_reporter
		// 					FROM news_info,category_info 
		// 					WHERE news_info.news_status != 10 AND news_info.news_status!=0 AND news_info.news_status!=4 AND category_info.cat_id=news_info.cat_id
		// 					AND (news_info.news_headline LIKE '%" . $news_keyword . "%' OR news_info.news_sub_headline LIKE '%" . $news_keyword . "%'  OR news_info.news_keyword LIKE '%" . $news_keyword . "%')
		// 					LIMIT $limit ");

		// 	if ($query->num_rows() > 0) return $query->result();
		// 	else return false;
		// }




		function update_news($news_id){
			/*------------ Date function in CI -------------------*/
			$timezone = "Asia/Dhaka";
			date_default_timezone_set($timezone);
			$bd_date				= date('F d, Y'); /* Like November 29, 2012 */
			// $pub_date				= date('Y-m-d H:i:s');
			$pub_date				= date('Y-m-d');
			$pub_time				= date('H:i');

			$news_update = array(
				'news_status'		=> $this->input->post('news_status'),
				'news_mod_date' 	=> $pub_date,
				'news_mod_time' 	=> $pub_time,
				'news_approver'		=> $this-> tank_auth -> get_user_id()
			);
			$this->db->where('news_id', $news_id);
			$query = $this->db->update('news_common_info', $news_update);

			if($query){
				return $query;
			}
			else{
				return false;
			}
		}



		function fetch_subcat($cat_id)
		{
			$this->db->where('category_id', $cat_id);
			$this->db->where('sub_cat_status',1);
			$this->db->order_by('sub_cat_key_name', 'DESC');
			$query = $this->db->get('sub_category_info');
			
			$output = '<option value="">Select One</option>';
			if($query->result()){
				foreach($query->result() as $row)
				{
					$output .= '<option value="'.$row->sub_category_id.'">'.$row->sub_cat_name.' ('.$row->sub_cat_key_name.')</option>';
				}
			}
			return $output;
		}

		// function fetch_relevant($news_tag)
		// {
		// 	$news_tag = explode(",", $news_tag);
		// 	$query = $this-> db-> query("SELECT * FROM `news_tag_info` WHERE `news_tag` LIKE '%".$news_tag."%'");
		// 	$output = '';
			
		// 	if($query->result()){
		// 		foreach($query->result() as $key=> $row)
		// 		if($key < 5){
		// 			{
		// 				$output .= '<option value="'.$row->news_id.'" selected="selected">'.$row->news_id.'</option>';
		// 				// $output .= '<input type="text" value="'.$row->news_id.'" name="relevant_article" >';

		// 			}
		// 		}
		// 	}
		// 	else{
		// 		// $output .= '<input type="text" value="No artcle Available" placeholder="No Article Available" >';
		// 		$output .= '<option value="">No article avaolable</option>';
		// 	}
			
		// 	return $output;
		// }

	/**********	NEWS EDIT BY CATEGORY ***********/

	// Writer Info 
	function writerInfo($news_id, $type){
		$this->db->cache_off();

		if($type == 1){
			$this->db->select('writer_info.writer_id, writer_info.writer_name');
			$this->db->from('news_writer_info, news_common_info');
			$this->db->where('news_writer_info.news_id = news_common_info.news_id');
			$this->db->where('news_writer_info.news_id', $news_id);
			$this->db->where('news_writer_info.writer_type', 1);

			$this->db->join('writer_info', 'news_writer_info.author_ids = writer_info.writer_id', 'left');
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row->writer_id;
				}
				return $data;
			}
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
	// Writer Info 

	function news_edit($news_id)
	{
		//$query=$this-> db-> query("SELECT * FROM news_info WHERE news_id='".$news_id."'");
        $this->db->cache_off();
		$this->db->select('news_info.*, news_common_info.*, seo_title, seo_keyword, seo_description, news_tag, relevant_article');
		$this->db->from('news_info, news_common_info');
		$this->db->where('news_info.news_id = news_common_info.news_id');
		$this->db->where('news_info.news_id', $news_id);
		$this->db->join('news_seo_info', 'news_common_info.news_id = news_seo_info.news_id', 'left');
		$this->db->join('news_tag_info', 'news_common_info.news_id = news_tag_info.news_id', 'left');
		$this->db->join('writer_info', 'news_common_info.author_id = writer_info.writer_id', 'left');
		$query = $this->db->get();

		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	/* --------------------------------------------- NEWS EDIT ENTRY ----------------------------------- */

	function news_edit_entry($news_id)
	{
		/*------------ Date function in CI -------------------*/
		$timezone 	= "Asia/Dhaka";
		date_default_timezone_set($timezone);
		$bd_date	= date('F d, Y'); /* Like November 29, 2012 */
		$mod_date	= date('Y-m-d');
		$mod_time	= date('H:i');
		/***----------------- End of Date function in CI --------------------***/

		$newsHeadline			= addslashes($this->input->post('news_headline'));
		$newsSubHeadline		= addslashes($this->input->post('news_sub_headline'));
		//$news_details			= $this->input->post('news_details');
		$news_details_brief2	= addslashes($this->input->post('news_details_brief'));
		$news_details2			= addslashes($this->input->post('news_details'));
		$news_seo_description	= addslashes($this->input->post('news_seo_description'));

		if ($this->input->post('catLead') == "accept") {
			$catValue = 1;
		} else {
			$catValue = 0;
		}
		if ($this->input->post('latestStatus') == "accept") {
			$latestValue = 1;
		} else {
			$latestValue = 0;
		}

		$news_entry = array(
			'news_sub_headline' 	=> $newsSubHeadline,
			'news_details' 			=> $news_details2,
			'img_caption' 			=> addslashes($this->input->post('img_caption')),
			'video_link' 			=> $this->input->post('video_link'),
			'video_caption' 		=> addslashes($this->input->post('video_caption')),
			'news_source' 			=> $this->input->post('news_source'),
			'news_source_link' 		=> $this->input->post('news_source_link'),
			'news_area' 			=> $this->input->post('news_area'),
			'news_zone' 			=> $this->input->post('news_zone'),
		);

		$this->db->where('news_id', $news_id);
		$query = $this->db->update('news_info', $news_entry);

		if ($news_id) {
			if ($this->input->post('news_tag') != '') {

				
				$news_tag_info = array(
					'news_id' 				=> $news_id,
					'news_tag' 				=> $this->input->post('news_tag'),
				);

				$isExist = $this->isDataExist('news_tag_info', 'news_id', $news_id);

				if ($isExist) {
					$this->db->where('news_id', $news_id);
					$this->db->update('news_tag_info', $news_tag_info);
				} else {
					$this->db->insert('news_tag_info', $news_tag_info);
				}
			}

			if ($this->input->post('news_seo_title') != '') {
				$news_seo_info = array(
					'news_id' 			=> $news_id,
					'seo_title' 		=> addslashes($this->input->post('news_seo_title')),
					'seo_keyword' 		=> $this->input->post('news_seo_keyword'),
					'seo_description' 	=> $news_seo_description
				);
				$isExist = $this->isDataExist('news_seo_info', 'news_id', $news_id);
				if ($isExist) {
					$this->db->where('news_id', $news_id);
					$this->db->update('news_seo_info', $news_seo_info);
				} else {
					$this->db->insert('news_seo_info', $news_seo_info);
				}
			}

			$author_input = $this->input->post('news_author');
            if ($author_input) {
			
                $author_data_by_id = $this->db->select('author_ids')	
									->from('news_writer_info')
									->where('news_id', $news_id)
									->where('writer_type', 1)
									->get();
                $aut_values = [];
				// print_r($aut_values); die();
                foreach ($author_data_by_id->result() as $aut_row) {
                    $aut_values[] = $aut_row->author_ids;
                }

                // Insert newly added Data 
                foreach ($author_input as $input_val) {
                    if (!in_array($input_val, $aut_values)) {
                        $aut_data_insert['author_ids'] 	= $input_val;
                        $aut_data_insert['news_id'] 	= $news_id;
                        $aut_data_insert['writer_type'] = 1;
                        $this->db->insert('news_writer_info', $aut_data_insert);
                    }
                }
				// print_r($author_input);
                foreach ($aut_values as $aut_values_row) {
                    if (!in_array($aut_values_row, $author_input)) {
						$this-> db-> query("DELETE FROM news_writer_info WHERE news_id='".$news_id."' AND author_ids = '".$aut_values_row."' AND writer_type = '1' ");
                    }
                }	
            }
			if(empty($this->input->post('news_author'))){
				$this-> db-> query("DELETE FROM news_writer_info WHERE news_id='".$news_id."' AND writer_type = '1' ");
			}

			if($this->input->post('news_reporter') != ''){
				$news_rep_info = array(
					'news_id' 				=> $news_id,
					'reporter_ids' 			=> $this->input->post('news_reporter'),
					'writer_type' 			=> 2,
				);
				$ql = $this->db->select('news_writer_id')->from('news_writer_info')->where('news_id',$news_id)->where('writer_type',2)->get();
				if( $ql->num_rows() > 0 ) {
					$this->db->where('news_id', $news_id);
					$this->db->where('writer_type', 2);
					$this->db->update('news_writer_info', $news_rep_info);
				} 
				else {
					$this->db->insert('news_writer_info', $news_rep_info);
				}	
			}
			if($this->input->post('news_reporter') == ''){
				$ql = $this->db->select('news_writer_id')->from('news_writer_info')->where('news_id',$news_id)->where('writer_type',2)->get();
				if( $ql->num_rows() > 0 ) {
					$this-> db-> query("DELETE FROM news_writer_info WHERE news_id='".$news_id."'  AND writer_type = '2' ");
				} 	
			}
			


			if ($this->input->post('user_type') == 2) {
				$news_sts = '';
				$news_approver = '';
			}
			if ($this->input->post('user_type') != 2) {
				$news_sts = addslashes($this->input->post('news_status'));
				$news_approver = $this->tank_auth->get_user_id();
			}

			$news_common_entry = array(
				'news_id' 				=> $news_id,
				'cat_id' 				=> $this->input->post('cat_id'),
				'sub_cat_id' 			=> $this->input->post('sub_cat_id'),
				'page_id' 				=> $this->input->post('page_id'),
				'news_status' 			=> $news_sts,
				'news_type' 			=> $this->input->post('news_type'),
				'news_headline' 		=> $newsHeadline,
				'headline_tag' 			=> addslashes($this->input->post('news_caption')),
				'news_details_brief'	=> $news_details_brief2,
				'catStatus' 			=> $this->input->post('catLead'),
				'latestStatus' 			=> $this->input->post('latestStatus'),

				'news_mod_date' 		=> $mod_date,
				'news_mod_time' 		=> $mod_time,

				'news_approver'			=> $news_approver,
			);

			$this->db->where('news_id', $news_id);
			$query2 = $this->db->update('news_common_info', $news_common_entry);
			return $query2;
		} else
			return FALSE;
	}
	function opinion_edit_entry($news_id)
	{
		/*------------ Date function in CI -------------------*/
		$timezone 	= "Asia/Dhaka";
		date_default_timezone_set($timezone);
		$bd_date	= date('F d, Y'); /* Like November 29, 2012 */
		$mod_date	= date('Y-m-d');
		$mod_time	= date('H:i');
		/***----------------- End of Date function in CI --------------------***/

		$newsHeadline			= addslashes($this->input->post('news_headline'));
		$newsSubHeadline		= addslashes($this->input->post('news_sub_headline'));
		//$news_details			= $this->input->post('news_details');
		$news_details_brief2	= addslashes($this->input->post('news_details_brief'));
		$news_details2			= addslashes($this->input->post('news_details'));
		$news_seo_description	= addslashes($this->input->post('news_seo_description'));

		if ($this->input->post('catLead') == "accept") {
			$catValue = 1;
		} else {
			$catValue = 0;
		}
		if ($this->input->post('latestStatus') == "accept") {
			$latestValue = 1;
		} else {
			$latestValue = 0;
		}

		$news_entry = array(
			'news_sub_headline' 	=> $newsSubHeadline,
			'news_details' 			=> $news_details2,
			'img_caption' 			=> addslashes($this->input->post('img_caption')),
			'video_link' 			=> $this->input->post('video_link'),
			'video_caption' 		=> addslashes($this->input->post('video_caption')),
			'news_source' 			=> $this->input->post('news_source'),
			'news_source_link' 		=> $this->input->post('news_source_link'),
			'news_area' 			=> $this->input->post('news_area'),
			'news_zone' 			=> $this->input->post('news_zone'),
		);

		$this->db->where('news_id', $news_id);
		$query = $this->db->update('news_info', $news_entry);

		if ($news_id) {
			if ($this->input->post('news_tag') != '') {

				
				$news_tag_info = array(
					'news_id' 				=> $news_id,
					'news_tag' 				=> $this->input->post('news_tag'),
				);

				$isExist = $this->isDataExist('news_tag_info', 'news_id', $news_id);

				if ($isExist) {
					$this->db->where('news_id', $news_id);
					$this->db->update('news_tag_info', $news_tag_info);
				} else {
					$this->db->insert('news_tag_info', $news_tag_info);
				}
			}

			if ($this->input->post('news_seo_title') != '') {
				$news_seo_info = array(
					'news_id' 			=> $news_id,
					'seo_title' 		=> addslashes($this->input->post('news_seo_title')),
					'seo_keyword' 		=> $this->input->post('news_seo_keyword'),
					'seo_description' 	=> $news_seo_description
				);
				$isExist = $this->isDataExist('news_seo_info', 'news_id', $news_id);
				if ($isExist) {
					$this->db->where('news_id', $news_id);
					$this->db->update('news_seo_info', $news_seo_info);
				} else {
					$this->db->insert('news_seo_info', $news_seo_info);
				}
			}


			if ($this->input->post('news_author') != '') {
			    $this-> db-> query("DELETE FROM `news_writer_info` WHERE `news_id`='".$news_id."' AND `writer_type` = '2' ");
				$news_author_info = array(
					'news_id' 			=> $news_id,
					'writer_type'		=> 1,
					'author_ids' 		=> $this->input->post('news_author'),
				);
				$isExist = $this->isDataExist('news_writer_info', 'news_id', $news_id);
				if ($isExist) {
					$this->db->where('news_id', $news_id);
					$this->db->update('news_writer_info', $news_author_info);
				} else {
					$this->db->insert('news_writer_info', $news_author_info);
				}
			}
			if ($this->input->post('news_reporter') != '') {
			    $this-> db-> query("DELETE FROM `news_writer_info` WHERE `news_id`='".$news_id."' AND `writer_type` = '1' ");
				$news_reporter_info = array(
					'news_id' 			=> $news_id,
					'writer_type'		=> 2,
					'reporter_ids' 		=> $this->input->post('news_reporter'),
				);
				$isExist = $this->isDataExist('news_writer_info', 'news_id', $news_id);
				if ($isExist) {
					$this->db->where('news_id', $news_id);
					$this->db->update('news_writer_info', $news_reporter_info);
				} else {
					$this->db->insert('news_writer_info', $news_reporter_info);
				}
			}

			if($this->input->post('news_reporter') == ''){
				$ql = $this->db->select('news_writer_id')->from('news_writer_info')->where('news_id',$news_id)->where('writer_type',2)->get();
				if( $ql->num_rows() > 0 ) {
					$this-> db-> query("DELETE FROM news_writer_info WHERE news_id='".$news_id."'  AND writer_type = '2' ");
				} 	
			}
			


			if ($this->input->post('user_type') == 2) {
				$news_sts = '';
				$news_approver = '';
			}
			if ($this->input->post('user_type') != 2) {
				$news_sts = addslashes($this->input->post('news_status'));
				$news_approver = $this->tank_auth->get_user_id();
			}

			$news_common_entry = array(
				'news_id' 				=> $news_id,
				'cat_id' 				=> $this->input->post('cat_id'),
				'sub_cat_id' 			=> $this->input->post('sub_cat_id'),
				'news_status' 			=> $news_sts,
				'news_headline' 		=> $newsHeadline,
				'headline_tag' 			=> addslashes($this->input->post('news_caption')),
				'news_details_brief'	=> $news_details_brief2,
				// 'news_reporter' 		=> $this->input->post('news_reporter'),
				// 'author_id' 			=> $this->input->post('news_author'),
				'catStatus' 			=> $this->input->post('catLead'),
				'latestStatus' 			=> $this->input->post('latestStatus'),

				'news_mod_date' 		=> $mod_date,
				'news_mod_time' 		=> $mod_time,

				'news_approver'			=> $news_approver,
			);

			$this->db->where('news_id', $news_id);
			$query2 = $this->db->update('news_common_info', $news_common_entry);
			return $query2;
		} else
			return FALSE;
	}

		
		
		
		/* ---------------------------------- NEWS MEDIA ENTRY --------------------------------------- */
		
		function news_media_entry()
		{
			/*------------ Date function in CI -------------------*/
			
			$timezone = "Asia/dhaka";
			date_default_timezone_set($timezone);
			$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			
			/***----------------- End of Date function in CI --------------------***/
			
			$news_media_entry = array(
			   'media_type' => $this->input->post('media_type'),
			   'media_name' => $this->input->post('media_name'),
			   'media_en_name' => $this->input->post('media_en_name')
			);
			
			$insert=$this->db->insert('media_info', $news_media_entry);
			
			$last_id = $this-> db-> insert_id(); /* get the last id of img */
			
			return $last_id;
		}
		
		
		
		
		/* ---------------------------------- MEDIA WISE NEWS ENTRY --------------------------------------- */
		// function media_wise_news_entry()
		// {
			
		// 	$media_wise_news_entry = array(
		// 	   'media_id' => $this->input->post('media_id') ,
		// 	   'media_news_headline' => $this->input->post('media_news_headline') ,
		// 	   'media_news_link' => $this->input->post('media_news_link')
		// 	);
			
		// 	$insert=$this->db->insert('media_news_info', $media_wise_news_entry);
			
		// 	$last_id = $this-> db-> insert_id(); /* get the last id of img */
			
		// 	return $last_id;
		// }
		
		
		/**********	NEWS LIST BY CATEGORY ***********/
		
		// function news_list_by_category($category_id)
		// {
		// 	$query = $this-> db-> query('SELECT * From news_info WHERE cat_id="'.$category_id.'" ORDER BY news_id desc');				
							
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		
		// function news_list_by_category_updated($category_id)
		// {
		// 	$query = $this-> db-> query('SELECT news_common_info.news_id,news_common_info.news_headline, news_common_info.cat_id, news_common_info.img_ext,news_reader_info.news_reader 
		// 									From news_common_info,news_reader_info  
		// 									WHERE news_common_info.cat_id="'.$category_id.'"
		// 									AND news_common_info.news_id=news_reader_info.news_id
		// 									ORDER BY news_common_info.news_id DESC');
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		
		/**********	NEWS LIST BY ADVANCED SEARCH ***********/
		
		// function news_list_search($category_id, $newsStatus)
		// {
		// 	$this->db->cache_off();
			
		// 	if($category_id && $newsStatus)
		// 	{
		// 		$query = $this-> db-> query('SELECT * From news_info WHERE cat_id="'.$category_id.'" AND news_info.news_status="'.$newsStatus.'"
		// 			ORDER BY news_id DESC');			
		// 	}
		// 	else if ($category_id)
		// 	{
		// 		$query = $this-> db-> query('SELECT * From news_info WHERE cat_id="'.$category_id.'"
		// 			ORDER BY news_id DESC');			
		// 	}
		// 	else if ($newsStatus)
		// 	{
		// 		$query = $this-> db-> query('SELECT * From news_info WHERE news_info.news_status="'.$newsStatus.'"
		// 			ORDER BY news_id DESC');			
		// 	}
			
		// 	if($query->num_rows() > 0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		// function news_list_search_updated($category_id, $newsStatus)
		// {
		// 	$this->db->cache_off();
		// 	$query = '';
			
		// 	if($category_id && $newsStatus)
		// 	{
		// 		$query = $this-> db-> query('SELECT news_common_info.news_id,news_common_info.news_headline, news_common_info.cat_id, news_common_info.img_ext,news_reader_info.news_reader 
		// 										From news_common_info,news_reader_info  
		// 										WHERE news_common_info.cat_id="'.$category_id.'" 
		// 										AND news_common_info.news_status="'.$newsStatus.'"
		// 										AND news_common_info.news_id=news_reader_info.news_id
		// 										ORDER BY news_common_info.news_id DESC');			
		// 	}
		// 	else if($category_id)
		// 	{
		// 		$query = $this-> db-> query('SELECT news_common_info.news_id,news_common_info.news_headline, news_common_info.cat_id, news_common_info.img_ext,news_reader_info.news_reader 
		// 									From news_common_info,news_reader_info 
		// 									WHERE news_common_info.cat_id="'.$category_id.'" 
		// 									AND news_common_info.news_id=news_reader_info.news_id
		// 									ORDER BY news_common_info.news_id DESC');			
		// 	}
		// 	else if($newsStatus)
		// 	{
		// 		$query = $this-> db-> query('SELECT news_common_info.news_id,news_common_info.news_headline, news_common_info.cat_id, news_common_info.img_ext,news_reader_info.news_reader 
		// 									From news_common_info,news_reader_info  
		// 									WHERE news_common_info.news_status="'.$newsStatus.'"
		// 									AND news_common_info.news_id=news_reader_info.news_id
		// 									ORDER BY news_common_info.news_id DESC');		
		// 	}

		// 	if($query){		
		// 		if($query-> num_rows() > 0){
		// 			foreach($query-> result() as $row){
		// 				$data[] = $row;
		// 			}
		// 			return $data;
		// 		}	
		// 	}
		// }
		
		/**********	NEWS LIST BY MEDIA ***********/
		
		// function news_list_by_media($media_id)
		// {
			
		// 	$query = $this-> db-> query('SELECT * From media_news_info, media_info WHERE media_info.media_id="'.$media_id.'" AND media_news_info.media_id="'.$media_id.'" ORDER BY media_news_info.media_news_id DESC');				
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		/**********	NEWS LIST BY ID ***********/
		
		// function news_list_by_id($news_id)
		// {
		// 	$this->db->cache_off();
			
		// 	$query = $this-> db-> query('SELECT news_common_info.news_id,news_common_info.news_headline, news_common_info.cat_id, news_common_info.img_ext,news_reader_info.news_reader 
		// 										From news_common_info,news_reader_info  
		// 										WHERE news_common_info.news_id="'.$news_id.'" 
		// 										AND news_common_info.news_id=news_reader_info.news_id
		// 										');		
					
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		
		
		
		/* --------------------------------------------- NEWS DELETE ----------------------------------- */
		
		// function news_delete($news_id)
		// {
		// 	/*******
		// 	$table_name='news_info';
		// 	$table_id='news_id';
		// 	$file_id=$news_id;
		// 	$folder_name='news';
		// 	$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');
			
		// 	$query=$this-> db-> query("DELETE FROM news_info WHERE news_id='".$news_id."'");
		// 	$query2=$this-> db-> query("DELETE FROM news_common_info WHERE news_id='".$news_id."'");
		// 	$query3=$this-> db-> query("DELETE FROM news_reader_info WHERE news_id='".$news_id."'");
		// 	********/

		// 	$data_update = array(
		// 	   'news_status' 	=> 0, /* INACTIVE */
		// 	   'news_publisher' => $this-> tank_auth-> get_user_id()
		// 	);
			
		// 	$data_update2 = array(
		// 	   'news_status' 	=> 0 /* INACTIVE */
		// 	);
			
		// 	$this-> db-> where('news_id', $news_id);
		// 	$query = $this-> db-> update('news_info', $data_update);
			
		// 	$this-> db-> where('news_id', $news_id);
		// 	return $query = $this-> db-> update('news_common_info', $data_update2);
		// }
		
		
		
		    /***************************************************************************************************/
		   /*																														  */
		  /************----------------  END OF  NEWS INFORMATION ----------------------****************/
		 /*																														   */
		/*************************************************************************************************/
		


		function news_page_entry()
		{
			$timezone = "Asia/dhaka";
			date_default_timezone_set($timezone);
			$current_time = date('Y-m-d H:i:s');
			
			
			$news_page_entry = array(
			   'name' 			=> url_title($this->input->post('page_name'), 'dash', true)  ,
			   'name_bn' 		=> $this->input->post('page_name_bn') ,
			   'status' 		=> 1,
			   'last_modify'	=> $current_time
			);
			$this->db->insert('news_page_info', $news_page_entry);
			$id  = $this-> db-> insert_id();
			if($id){
				$news_page_update = array(
					'rank' 			=> $id ,
				 );
				$this-> db-> where('page_id', $id);
				return $this-> db-> update('news_page_info', $news_page_update);
			}
		}


		function news_page_info_list(){
			$this->db->cache_off();
			$query = $this->db->select('*')				
					->from('news_page_info')
					->order_by('rank', 'ASC')
					->get();		

			return $query->result();
		}


		function page_info_news_setup()
		{
			$this->db->cache_off();
			$query = $this->db->select('page_id, name_bn')
			->from('news_page_info')
			->where('status', 1)
			->order_by('rank', 'ASC')
			->get();

			$data[''] = 'Select One';
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[$row->page_id] = $row->name_bn ;   /* name nibe but id array te rakbe */
				}
				return $data;
			}
		}

		function page_edit_entry($page_id)
		{
			$current_time = date('Y-m-d H:i:s');

			$news_page_update = array(
				'name' 			=> $this->input->post('page_name') ,
				'name_bn' 		=> $this->input->post('page_name_bn') ,
				'rank' 			=> $this->input->post('page_position'),
				'status' 		=> $this->input->post('status'),
				'last_modify'	=> $current_time
			 );

			$this-> db-> where('page_id', $page_id);
			return $this-> db-> update('news_page_info', $news_page_update);
		}

		function updatePagePosition($data = array())
		{
			$i = 1;
			foreach ($data as $key => $value) {
				$sql = "UPDATE `news_page_info` SET `rank` ='.$i.' WHERE `page_id`='".$value."' ";
				$query = $this->db->query($sql);
				$i++;
			}
			return true; 
		}






		/*------------------------------------------News Type Entry---------------------------------*/
		function news_type_entry()
		{
			$timezone = "Asia/dhaka";
			date_default_timezone_set($timezone);
			$current_time = date('Y-m-d H:i:s');
	
			$news_type_entry = array(
			   'type_name' 			=> $this->input->post('type_name') ,
			   'type_status' 			=> 1,
			   'last_modify'		=> $current_time,
			   'creator'			=> $this-> tank_auth -> get_user_id(),
			);
			$this->db->insert('news_type_info', $news_type_entry);
			return true; 
		}
		function news_type_edit($id)
		{
			$timezone = "Asia/dhaka";
			date_default_timezone_set($timezone);
			$current_time = date('Y-m-d H:i:s');
	
			$news_type_edit = array(
			   'type_name' 			=> $this->input->post('type_name') ,
			   'type_status' 		=> $this->input->post('type_status'),
			   'last_modify'		=> $current_time,
			   'creator'			=> $this-> tank_auth -> get_user_id(),
			);
			$this->db->where('news_type_id', $id); 
			$this->db->update('news_type_info', $news_type_edit);
			return true; 
		}


		function news_type_info_list(){
			$this->db->cache_off();
			$query = $this->db->select('*')				
					->from('news_type_info')
					->order_by('news_type_id', 'ASC')
					->get();		

			return $query->result();
		}

		function type_info()
		{
			$this->db->cache_off();
			$query = $this->db->select('news_type_id,type_name')				
							->from('news_type_info')
							->where('type_status',1)
							->get();	

			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[$row -> news_type_id]= $row -> type_name ; 
				}
				return $data;
			}	
		}




		/*------------------------------------------News Type Entry---------------------------------*/
		
		
		    /***************************************************************************************************/
		   /*																														  */
		  /**********----------------  NEWS CATEGORY INFORMATION ----------------------**************/
		 /*																														   */
		/*************************************************************************************************/
		
		

		/* ---------------------------------- NEWS CATEGORY ENTRY -------------------------------- */
		function news_category_entry()
		{
			/*------------ Date function in CI -------------------*/
			$timezone = "Asia/dhaka";
			date_default_timezone_set($timezone);
			$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			/***----------------- End of Date function in CI --------------------***/
			
			$news_category_entry = array(
			   'cat_name' => $this->input->post('cat_name') ,
			   'cat_key_name' => $this->input->post('cat_key_name') ,
			   'cat_status' => 1,
			   'cat_creator' => $this-> tank_auth -> get_user_id()
			);
			$insert=$this->db->insert('category_info', $news_category_entry);
			return $insert;
		}

		/* ---------------------------------- CATEGORY LIST INFO -------------------------------- */

		function category_info_list()
		{
			$this->db->cache_off();
			$query = $this->db->select('*')				
					->from('category_info')
					->get();		
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				return $data;
			}	
		}

		public function update_cat_status($id,$sts)
        {
			$this->db->cache_off(); 
			if($sts == 1){
					$status = 0;
			}
			else{
					$status = 1;
			}
			$data = array('cat_status' => $status);
			$this->db->where('cat_id',$id);
			return $this->db->update('category_info',$data);

        }
		
		/**********	CATEGORY EDIT  ***********/
		
		function category_edit($cat_id)
		{		
			$query=$this-> db-> query("SELECT * FROM category_info WHERE cat_id='".$cat_id."'");						
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				return $data;
			}	
		}

		
		
		/* --------------------------------------------- CATEGORY EDIT ENTRY ----------------------------------- */
		
		function category_edit_entry($cat_id)
		{
			$update_data = array(
			   'cat_name' 		=> $this->input->post('cat_name'),
			   'cat_key_name' 	=> $this->input->post('cat_key_name'),
			//    'cat_status' 	=> $this->input->post('cat_status'),
			   'cat_creator' 	=> $this->tank_auth-> get_user_id()
			);

			$this-> db-> where('cat_id', $cat_id);
			return $this-> db-> update('category_info', $update_data);
		}


		
		
		/**********	CATEGORY DELETE ***********/
				
		// function category_delete($cat_id)
		// {
		// 	$query = $this->db->select('news_id,category_info.cat_id')					
		// 			->from('category_info')
		// 			->join('news_info', 'category_info.cat_id = news_info.cat_id')
		// 			->where('category_info.cat_id = "'.$cat_id.'"')
		// 			->get();
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		define('PUBPATH',str_replace(SELF,'',FCPATH)); // added
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$news_id= $row -> news_id;
		// 			//$a_id= $row -> a_id;
					
		// 			//echo $pic_id;
					
		// 			/******************* FILE DELETE  ************************/
		// 			$table_name='news_info';
		// 			$table_id='news_id';
		// 			$file_id=$news_id;
		// 			$folder_name='news';

		// 			$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'album_delete');	// common  Function for deleting file from folder pathanu hoise //
		// 			/******************* FILE DELETE  ************************/
		// 		}
		// 	}
			
		// 	$query2=$this->db->query("DELETE FROM category_info WHERE cat_id='".$cat_id."'");
		// 	$query3=$this->db->query("DELETE FROM news_info WHERE cat_id='".$cat_id."'");
			
			
		// 	return $query;	
		// }


		/*-------------------------^^^^^^^^^^^^^^^^^ ----------------------------*/
		/*-------------------------News Sub Category ----------------------------*/
		/*-------------------------^^^^^^^^^^^^^^^^^ ----------------------------*/


		// Entry 

		function news_subcategory_entry()
		{
			$timezone 	= "Asia/Dhaka";
			date_default_timezone_set($timezone);
			$date	= date('Y-m-d');
			$news_sub_category_entry = array(
			   'sub_cat_name' => $this->input->post('subcat_name') ,
			   'sub_cat_key_name' => $this->input->post('subcat_key_name') ,
			   'category_id' => $this->input->post('cat_name') ,
			   'sub_cat_status' => 1,
			   'doc' => $date,
			   'creator' => $this-> tank_auth -> get_user_id()
			);
			$insert=$this->db->insert('sub_category_info', $news_sub_category_entry);
			return $insert;
		}


		// Sub category Listing 
		function sub_category_info_list()
		{
			$this->db->cache_off();
			$query = $this->db->select('*')				
					->from('sub_category_info')
					// ->where('sub_category_info.category_id' == 'category_info.cat_id')
					->join('category_info', 'category_info.cat_id = sub_category_info.category_id')
					->get();	
					
			// $query=$this-> db-> query("SELECT * FROM category_info WHERE cat_id='".$cat_id."'");
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				return $data;
			}	
		}


		// Status Changing 
		public function update_subcat_status($id,$sts)
        {
			
			if($sts == 1){
					$status = 0;
			}
			else{
					$status = 1;
			}
			$data = array('sub_cat_status' => $status);
			$this->db->where('sub_category_id',$id);
			return $this->db->update('sub_category_info',$data);
        }

		// Edit 
		function sub_category_edit($subcat_id)
		{		
			$query=$this-> db-> query("SELECT * FROM sub_category_info WHERE sub_category_id='".$subcat_id."'");			
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				return $data;
			}	
		}

		function subcategory_edit_entry($subcat_id)
		{
			$timezone 	= "Asia/Dhaka";
			date_default_timezone_set($timezone);
			$date	= date('Y-m-d');			

			$update_data = array(
			   'sub_cat_name' => $this->input->post('subcat_name') ,
			   'sub_cat_key_name' => $this->input->post('subcat_key_name') ,
			   'category_id' => $this->input->post('cat_name') ,
			   'dom' => $date,
			);

			$this-> db-> where('sub_category_id', $subcat_id);
			return $this-> db-> update('sub_category_info', $update_data);
		}

		/*-------------------------^^^^^^^^^^^^^^^^^ ----------------------------*/
		/*-------------------------News Sub Category ----------------------------*/
		/*-------------------------^^^^^^^^^^^^^^^^^ ----------------------------*/
		
		
		/* ---------------------- NEWS MEDIA INFO -------------------- */
		
		// function news_media_info()
		// {
		// 	$query = $this->db->select('*')				
		// 					->from('media_info')
		// 					->order_by('media_en_name','asc')
		// 					->get();
							
		// 	$data['']='Select One';	
			
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			if($row->media_type==1)
		// 				$type="TV";
		// 			else if($row->media_type==2)
		// 				$type="Print";
		// 			else if($row->media_type==3)
		// 				$type="Paper Link";
		// 			else if($row->media_type==4)
		// 				$type="Organization Link";
					
					
		// 			$data[$row -> media_id]= $row -> media_name.' ('.$row -> media_en_name.')'.' --- '.$type;   /* name nibe but id array te rakbe */
		// 		}
		// 		return $data;
		// 	}	
		// }
		
		
		/* ---------------------------------- NEWS MEDIA LIST INFO -------------------------------- */

		function news_media_info_list()
		{
			$query = $this->db->select('*')				
										->from('media_info')
										->get();	
							
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				
				return $data;
			}	
		}
		
		
		/* --------------------------------------------- MEDIA NEWS DELETE ----------------------------------- */
		
		// function media_news_delete($media_news_id)
		// {		
		// 	$query=$this-> db-> query("DELETE FROM media_news_info WHERE media_news_id='".$media_news_id."'");
		// 	return $query;
		// }

		/* ---------------------------------- NEWS GALLERY ENTRY --------------------------------------- */
		
		/*function news_gallery_entry()
		{
			
			$timezone 	= "Asia/dhaka";
			date_default_timezone_set($timezone);
			$pub_date	= date('F d, Y'); 
			$mod_date	= date('Y-m-d H:i:s');
			
			$news_gallery_entry = array(
			   'title' 	    	=> $this-> input-> post('title'),
			   'sub_title' 		=> $this-> input-> post('sub_title'),
			   'file' 			=> $_FILES['file']['name'],
			   'caption' 		=> $this-> input-> post('image_caption'),
			   'description' 	=> $this-> input-> post('image_des'),
			   'creator' 		=> $this-> tank_auth-> get_user_id(),
			   'pub_date'       => $pub_date,
			);

			print_r($news_gallery_entry);
			
			$insert		=   $this-> db-> insert('news_gallery_info', $news_gallery_entry);
			$last_id 	=   $this-> db-> insert_id();
			return $last_id;
		} */

		function news_gallery_entry()
		{
			/*------------ Date function in CI -------------------*/
			$timezone 	= "Asia/dhaka";
			date_default_timezone_set($timezone);
			$pub_date	= date('F d, Y'); /* Like November 29, 2012 */
			$mod_date	= date('Y-m-d H:i:s');
			
			$news_gallery_entry = array(
			   'img_caption' 	    => $this-> input-> post('img_caption'),
			   'gallery_status' 	=> $this-> input-> post('gallery_status'),
			   'creator' 		    => $this-> tank_auth-> get_user_id(),
			   'pub_date'           => $pub_date,
			);
			
			$insert		=   $this-> db-> insert('news_gallery_info', $news_gallery_entry);
			$last_id 	=   $this-> db-> insert_id();
			return $last_id;
		}

		/* ---------------------------------- NEWS GALLERY LIST INFO -------------------------------- */

		function news_gallery_info_list()
		{
			$this->db->cache_off();
			$query = $this-> db -> select('*')				
								-> from('news_gallery_info')
								-> order_by('img_id', 'DESC')
								-> get();	

			if($query-> num_rows() > 0){
				foreach ($query-> result() as $row){
					$data[]= $row;
				}
				return $data;
			}	
		}
		
		
		/**********	NEWS GALLERY EDIT  ***********/
		
		function news_gallery_edit($img_id)
		{
			$this->db->cache_off();
			$query=$this-> db-> query("SELECT * FROM news_gallery_info WHERE img_id='".$img_id."'");			
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				return $data;
			}	
		}
		
		
		/* --------------------------------------------- NEWS GALLERY EDIT ENTRY ----------------------------------- */
		
		function news_gallery_edit_entry($img_id)
		{
			/*------------ Date function in CI -------------------*/
			$timezone 	= "Asia/dhaka";
			date_default_timezone_set($timezone);
			// $pub_date	= date('F d, Y'); /* Like November 29, 2012 */
			$mod_date	= date('Y-m-d H:i:s');
			$news_gallery_update = array(
			   'img_caption' 	=> $this-> input-> post('img_caption'),
			   'gallery_status' 		=> $this-> input-> post('gallery_status'),
			   'pub_date'		=> $mod_date,

			);
			
			$this-> db-> where('img_id', $img_id);
			return $query = $this-> db-> update('news_gallery_info', $news_gallery_update);
		}
		
		
		/* --------------------------------------------- NEWS GALLERY DELETE ----------------------------------- */
		
		// function news_gallery_delete($img_id)
		// {
		// 	/*******************  FILE DELETE  ************************/
			
		// 	$table_name='news_gallery_info';
		// 	$table_id='img_id';
		// 	$file_id=$img_id;
		// 	$folder_name='news_gallery';
		// 	$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
			
		// 	/*******************  FILE DELETE  ************************/
			
			
		// 	$query=$this-> db-> query("DELETE FROM news_gallery_info WHERE img_id='".$img_id."'");
		// 	return $query;
		// }
		
		
		/* --------------------------------------------- Start Member Setup ----------------------------------- */

		public function member_entry(){
			$timezone 	= "Asia/Dhaka";
			date_default_timezone_set($timezone);

			$member_entry = array(
				'member_name' 	    => $this->input->post('mem_name'),
				'member_designation' 	=> $this->input->post('mem_designation'),
				'member_email' 	=> $this->input->post('mem_email'),
				'member_phone' 	=> $this->input->post('mem_phone'),
				'member_group' 	=> $this->input->post('mem_group'),
				'creator' 		    => $this->tank_auth->get_user_id(),
				'status' 		    => 1
			);

			$insert		=   $this->db->insert('member_info', $member_entry);
			$last_id 	=   $this->db->insert_id();
			if ($last_id) {
				$member_rank = array(
					'rank' 	=> $last_id
				);
				$this->db->where('id', $last_id);
				$this->db->update('member_info', $member_rank);
			}
			return $last_id;
			
		}

		public function member_update($id){
			$timezone 	= "Asia/dhaka";
			date_default_timezone_set($timezone);
			$mod_date	= date('Y-m-d H:i:s');

			$member_info = array(
				'member_name' 	    	=> $this->input->post('mem_name'),
				'member_designation' 	=> $this->input->post('mem_designation'),
				'member_email' 			=> $this->input->post('mem_email'),
				'member_phone' 			=> $this->input->post('mem_phone'),
				'member_group' 			=> $this->input->post('mem_group'),
				'status' 		   		=> $this->input->post('mem_status'),
				'dom'					=> $mod_date

			);

			$this->db->where('id', $id);
			return $query = $this->db->update('member_info', $member_info);
		}


		function member_list($group)
		{
			$query = $this->db->select('*')
				->from('member_info')
				->where('member_group', $group)
				->order_by('rank')
				->get();

			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
		}

		function UpdateMenu($data = array())
		{
			$i = 1;
			foreach ($data as $key => $value) {
				$sql = "Update member_info SET rank=" . $i . " WHERE id=" . $value;
				$query = $this->db->query($sql);
				$i++;
			}
			$result = $query->result();
			return $result;
		}


		public function member_info($id){
			
			$query = $this->db->query("SELECT * FROM member_info WHERE id='" . $id . "'");
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
			
		}

		

		/* --------------------------------------------- End Member Setup ----------------------------------- */




		/* --------------------------------------------- NEWS MEDIA DELETE ----------------------------------- */
		
		function news_media_delete($media_id)
		{
			/*******************  FILE DELETE  ************************/
			
			$table_name='media_info';
			$table_id='media_id';
			$file_id=$media_id;
			$folder_name='paper';
			$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
			
		// 	/*******************  FILE DELETE  ************************/

			$query=$this-> db-> query("DELETE FROM media_info WHERE media_id='".$media_id."'");
			return $query;
		}
		
		    /**************************************************************************************************/
		   /*																																			     */
		  /********----------------  END OF  NEWS CATEGORY INFORMATION ----------------***********/
		 /*																																			  */
		/*************************************************************************************************/
		
		
		    /**************************************************************************************************/
		   /*																																			     */
		  /********-------------------------------  NEWS POL INFORMATION  -----------------------***********/
		 /*																																			  */
		/*************************************************************************************************/
		
		
			/* ---------------------------------- NEWS POL ENTRY --------------------------------------- */
		
		function news_pol_entry()
		{
			/*------------ Date function in CI -------------------*/
			
			$timezone = "Asia/dhaka";
			date_default_timezone_set($timezone);
			$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			$pub_date=date('Y-m-d H:i:s');
			
			/***----------------- End of Date function in CI --------------------***/
			
			$news_pol_entry = array(
			   'pol_title' => $this->input->post('pol_title') ,
			   'pol_pub_date' => $pub_date,
			   'pol_status' => $this->input->post('pol_status'),
			   'pol_start_date' => $this->input->post('pol_start_date') ,
			   'pol_end_date' => $this->input->post('pol_end_date') ,
			   'yes' => 0,
			   'no' => 0,
			   'no_com' => 0,
			   'pol_publisher' => $this-> tank_auth -> get_user_id()
			);
			
			$insert=$this->db->insert('pol_info', $news_pol_entry);
			
			$last_id = $this-> db-> insert_id(); /* get the last id of img */
			
			return $last_id;
		}
		

		/* ---------------------------------- NEWS POL LIST INFO -------------------------------- */

		function news_pol_list()
		{
			$query = $this->db->select('*')				
										->from('pol_info')
										->order_by('pol_id', 'DESC')
										->get();

			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				return $data;
			}	
		}

		/**********	NEWS POL EDIT  ***********/
		
		function news_pol_edit($pol_id)
		{		
			$query=$this-> db-> query("SELECT * FROM pol_info WHERE pol_id='".$pol_id."'");
							
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				
				return $data;
			}	
		}
		
		
		/* --------------------------------------------- NEWS POL EDIT ENTRY ----------------------------------- */
		
		function news_pol_edit_entry($pol_id)
		{
			/*------------ Date function in CI -------------------*/
			
			$timezone = "Asia/dhaka";
			date_default_timezone_set($timezone);
			$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			$pub_date=date('Y-m-d H:i:s');
			
			/***----------------- End of Date function in CI --------------------***/
			
			$news_pol_edit_entry = array(
			   'pol_title' => $this->input->post('pol_title') ,
			   'pol_status' => $this->input->post('pol_status'),
			   'pol_mod_date' => $pub_date,
			   'pol_start_date' => $this->input->post('pol_start_date') ,
			   'pol_end_date' => $this->input->post('pol_end_date') ,
			);
			
			$query=$this->db->query("UPDATE pol_info SET pol_title='".$news_pol_edit_entry['pol_title']."' WHERE pol_id='".$pol_id."'");
			$query1=$this->db->query("UPDATE pol_info SET pol_status='".$news_pol_edit_entry['pol_status']."' WHERE pol_id='".$pol_id."'");
			$query2=$this->db->query("UPDATE pol_info SET pol_mod_date='".$news_pol_edit_entry['pol_mod_date']."' WHERE pol_id='".$pol_id."'");
			$query3=$this->db->query("UPDATE pol_info SET pol_start_date='".$news_pol_edit_entry['pol_start_date']."' WHERE pol_id='".$pol_id."'");
			$query4=$this->db->query("UPDATE pol_info SET pol_end_date='".$news_pol_edit_entry['pol_end_date']."' WHERE pol_id='".$pol_id."'");

			return $query;
		}
		
		
		/* --------------------------------------------- NEWS POL DELETE ----------------------------------- */
		
				
		// function news_pol_delete($pol_id)
		// {
		// 	$query=$this->db->query("DELETE FROM pol_info WHERE pol_id='".$pol_id."'");
			
		// 	return $query;	
		// }
		
		
		    /**************************************************************************************************/
		   /*																																			     */
		  /********-----------------------  END OF  NEWS POL INFORMATION -------------------***********/
		 /*																																			  */
		/*************************************************************************************************/
		
		
		
		
		 /**************************************************************************************************/
		   /*																																			     */
		  /********-------------------------------  NEWS ADD INFORMATION  -----------------------***********/
		 /*																																			  */
		/*************************************************************************************************/
		
		
		/* ---------------------------------- NEWS ADD ENTRY --------------------------------------- */
		
		function news_add_entry()
		{
			/*------------ Date function in CI -------------------*/
			$timezone = "Asia/dhaka";
			date_default_timezone_set($timezone);
			$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			$pub_date=date('Y-m-d H:i:s');
			/***----------------- End of Date function in CI --------------------***/
			$news_add_entry = array(
			   'cat_id' 		=> $this->input->post('cat_id') ,
			   'add_title' 		=> $this->input->post('add_title'),
			   'add_link' 		=> $this->input->post('add_link'),
			   'ad_size' 		=> $this->input->post('add_size'),
			   'position' 		=> $this->input->post('position'),
			   'add_start_date' => $this->input->post('add_start_date') ,
			   'add_end_date' 	=> $this->input->post('add_end_date') ,
			   'add_pub_date' 	=> $pub_date,
			   'add_status' 	=> $this->input->post('add_status'),
			   'add_publisher' 	=> $this-> tank_auth -> get_user_id()
			);
			$insert=$this->db->insert('add_info', $news_add_entry);
			$last_id = $this-> db-> insert_id(); /* get the last id of img */
			return $last_id;
		}
		
		/* ---------------------------------- ADVERTISE LIST INFO -------------------------------- */


		function advertise_info_list($ad_size)
		{
			$this->db->cache_off();
			$this->db->select('*');
			$this->db->from('add_info');
			$this->db->join('category_info', 'add_info.cat_id = category_info.cat_id', 'left');

			$this->db->where('position >', 0); 
			$this->db->where('ad_size', $ad_size);


			$this->db->order_by('add_info.position', "ASC");
			$this->db->order_by('add_info.cat_id', "ASC");
			// $this->db->order_by('add_info.ad_size', "ASC");
			$query = $this->db->get();

			if ($query->num_rows() > 0) {
				return $query->result();
			}	
		}
		

		public function prev_ad_id() {
			$cat_id = $this->input->post('cat_id'); 
			$this->db->select('cat_id');
			$this->db->where('cat_id',$cat_id);
			$query = $this->db->get('add_info');
			$data = $query->row();
			if($query->num_rows() == 1) {
				return $data->cat_id;
			} else {
				return false;
			}
		}
		
		/**********	ADVERTISE EDIT  ***********/
		
		function news_advertise_edit($add_id)
		{		
			$this->db->cache_off();
			$query=$this-> db-> query("SELECT * FROM add_info WHERE add_id='".$add_id."'");		
			if($query->num_rows()>0)
			{
				return $query->result();
			}	
		}


		
		function get_add_id($position)
		{
			$get_prev_id =  $this-> db-> query("SELECT `add_id` FROM `add_info` WHERE position='".$position."'");
			return $get_prev_id->row(); 
		}
		
		/* --------------------------------------------- ADVERTISE EDIT ENTRY ----------------------------------- */
		
		function news_advertise_edit_entry($add_id)
		{

			$news_advertise_edit_entry = array(
			   'cat_id' 		=> $this->input->post('cat_id') ,
			   'add_title' 		=> $this->input->post('add_title') ,
			   'add_link' 		=> $this->input->post('add_link') ,
			   'ad_size' 		=> $this->input->post('add_size') ,
			   'add_start_date' => $this->input->post('add_start_date') ,
			   'add_end_date' 	=> $this->input->post('add_end_date') ,
			   'add_status' 	=> $this->input->post('add_status')
			);
			
			$query=$this->db->query("UPDATE add_info SET cat_id='".$news_advertise_edit_entry['cat_id']."' WHERE add_id='".$add_id."'");
			$query=$this->db->query("UPDATE add_info SET add_title='".$news_advertise_edit_entry['add_title']."' WHERE add_id='".$add_id."'");
			$query1=$this->db->query("UPDATE add_info SET add_link='".$news_advertise_edit_entry['add_link']."' WHERE add_id='".$add_id."'");
			$query1=$this->db->query("UPDATE add_info SET ad_size='".$news_advertise_edit_entry['ad_size']."' WHERE add_id='".$add_id."'");
			$query2=$this->db->query("UPDATE add_info SET add_start_date='".$news_advertise_edit_entry['add_start_date']."' WHERE add_id='".$add_id."'");
			$query3=$this->db->query("UPDATE add_info SET add_end_date='".$news_advertise_edit_entry['add_end_date']."' WHERE add_id='".$add_id."'");
			$query4=$this->db->query("UPDATE add_info SET add_status='".$news_advertise_edit_entry['add_status']."' WHERE add_id='".$add_id."'");

			return $query;
		}


		function news_advertise_edit_entry_with_file($add_id , $position)
		{
			$current_datetime = date("Y-m-d H:i:s");

			/** Remove Existing Position **/
			$remove_position = array(
				'position'			=> '0',
				'last_modify'		=> $current_datetime,
				'add_publisher' 	=> $this-> tank_auth -> get_user_id()

			);
			$this-> db-> where('add_id', $add_id);
			$this-> db-> update('add_info', $remove_position);
			/** Remove Existing Position **/


			/** New Add Entry with Position **/
			$news_add_entry = array(
				'cat_id' 			=> $this->input->post('cat_id') ,
				'position' 			=> $position ,
				'add_title' 		=> $this->input->post('add_title'),
				'add_link' 			=> $this->input->post('add_link'),
				'ad_size' 			=> $this->input->post('add_size'),
				'add_start_date' 	=> $this->input->post('add_start_date') ,
				'add_end_date' 		=> $this->input->post('add_end_date') ,
				'add_pub_date' 		=> $current_datetime,
				'last_modify' 		=> $current_datetime,
				'add_status' 		=> $this->input->post('add_status'),
				'add_publisher' 	=> $this-> tank_auth -> get_user_id()
			 );
			 $insert=$this->db->insert('add_info', $news_add_entry);
			 $last_id = $this-> db-> insert_id(); 
			 return $last_id;

			/** New Add Entry with Position **/
		}


		
		    /**************************************************************************************************/
		   /*																																			     */
		  /********-----------------------  END OF  NEWS ADD INFORMATION -------------------***********/
		 /*																																			  */
		/*************************************************************************************************/
		
		
		
		
		/*************************************************************************************************/
	   /*																								*/
	  /*****************-------------  WEBSITE VISITOR INFO   ---------------------*********************/
	 /*																								  */
	/*************************************************************************************************/
	
	
		// function website_visitor_info()
		// {
		// 	$query = $this->db->select('*')				
		// 								->from('visitor_counter_info')
		// 								->where('counter_id', 1)
		// 								->get();	
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }

		// function dateWiseWebsiteVisitor($starting_date='',$ending_date='')
		// {
		// 	$this->db->cache_off();
			
		// 	if($starting_date && $ending_date)
		// 	{
		// 		$query = $this->db->query("SELECT *
		// 									FROM daily_visitor_info
		// 									WHERE daily_visitor_info.day_date>='".$starting_date."' AND daily_visitor_info.day_date<='".$ending_date."'
		// 									ORDER BY daily_visitor_info.day_id ASC
		// 								");
		// 	}
			

		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
		// 		return $data;
		// 	}
		// }

		// User Panel 
			public function specific_user_data($id){

				$this->db->cache_off(); 
				$query=$this-> db-> query("SELECT * FROM users WHERE users.id = '".$id."'");
															
				if($query->num_rows() > 0) return $query-> result();
				else return false;
			}

			public function edit_data($id){

				$this->db->cache_off(); 
				$update_data = array(
					'username'			=> $this->input->post('username'),
					'user_full_name' 	=> $this->input->post('user_full_name'),
					'email' 			=> $this->input->post('email'),
					'user_mobile' 		=> $this->input->post('contact_no'),
					'user_address' 		=> $this->input->post('user_address'),
					'user_type' 		=> $this->input->post('user_type2'),
				);
				$this-> db-> where('id', $id);
				return $this-> db-> update('users', $update_data);
			}

		// User Panel 
		
		
		
		
		/*************************************************************************************************/
	   /*																								*/
	  /*****************----------------  JOB INFORMATION   ---------------------***********************/
	 /*																								  */
	/*************************************************************************************************/
	
	
		
		/****************** JOB SETUP ********************/
		
		
		// function job_entry()
		// {
		// 	/*------- Date function in CI --------------*/
		// 	$timezone = "Asia/dhaka";
		// 	date_default_timezone_set($timezone);
		// 	$bd_date=date('F d, Y'); /* Like November 29, 2012 */
		// 	$pub_date=date('Y-m-d H:i:s');
		// 	/***-------- End of Date function in CI -------------***/
			
		// 	$job_entry = array(
		// 	   'job_title' => $this-> input-> post('job_title'),
		// 	   'job_org' => $this->input->post('job_org'),
		// 	   'job_total_post' => $this->input->post('job_total_post'),
		// 	   'job_experience' => $this->input->post('job_experience'),
		// 	   'job_requirement' => $this->input->post('job_requirement'),
		// 	   'job_last_date' => $this->input->post('ending_date'),
		// 	   'job_doc' => $pub_date,
		// 	   'creator_id' => $this-> tank_auth -> get_user_id()
		// 	);
			

		// 	$insert=$this-> db-> insert('job_info', $job_entry);
			
		// 	$last_id = $this-> db-> insert_id(); /* get the last id of img */
			
		// 	return $last_id;
		// }
		
		
		
		// function job_info_list()
		// {
		// 	$query = $this-> db-> select('*')				
		// 					   -> from('job_info')
		// 					   -> order_by('job_id','desc')
		// 					   -> get();			
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
		// 		return $data;
		// 	}	
		// }
		
		
		// function job_delete($job_id)
		// {	
		// 	$query=$this-> db-> query("DELETE FROM job_info WHERE job_id='".$job_id."'");
			
		// 	return $query;
		// }
		
		
		
		/*************************************************************************************************/
	   /*																								*/
	  /*****************---------------  START OF OPINION  ----------------------------*****************/
	 /*																								  */
	/*************************************************************************************************/
		
		
		/****************** WRITER SETUP ********************/


	function writerEntry()
	{
		/*------- Date function in CI --------------*/
		$timezone = "Asia/Dhaka";
		date_default_timezone_set($timezone);
		$bd_date = date('F d, Y'); /* Like November 29, 2012 */
		$pub_date = date('Y-m-d H:i:s');
		/***-------- End of Date function in CI -------------***/

		$writer_bio2 = addslashes($this->input->post('writer_bio'));

		$writerEntry = array(
			'writer_type' => $this->input->post('writer_type'),
			'writer_name' => $this->input->post('writer_name'),
			'writer_name_en' => $this->input->post('writer_name_en'),
			'writer_designation' => $this->input->post('writer_designation'),
			'writer_contact' => $this->input->post('writer_contact'),
			'writer_email' => $this->input->post('writer_email'),
			'writer_web' => $this->input->post('writer_web'),
			'writer_bio' => $writer_bio2,
			'writer_status' => 1,
			'doc' => $pub_date,
			'dom' => $pub_date,
			'creator_id' => $this->tank_auth->get_user_id()
		);

		$insert = $this->db->insert('writer_info', $writerEntry);
		$last_id = $this->db->insert_id();
		return $last_id;
	}

		function writerListInfo($type)
		{
			$this->db->cache_off(); 
			$query = $this->db->select('*')
				->from('writer_info')
				->where('writer_type',$type)
				->order_by('writer_id','DESC')
				->get();
			return $query->result(); 
		}


	function get_writer_data($id)
	{
		$this->db->cache_off(); 
		$query = $this->db->query("SELECT * FROM writer_info WHERE writer_id='" . $id . "'");
		if ($query->num_rows() > 0) {
			foreach ($query->result() as $row) {
				$data[] = $row;
			}
			return $data;
		}
	}

	function writer_edit_entry($id){
		$timezone = "Asia/Dhaka";
		date_default_timezone_set($timezone);
		$bd_date = date('F d, Y'); /* Like November 29, 2012 */
		$mod_date = date('Y-m-d H:i:s');
		/***-------- End of Date function in CI -------------***/

		$writer_bio2 = addslashes($this->input->post('writer_bio'));

		$writerEntry = array(
			'writer_type' => $this->input->post('writer_type'),
			'writer_name' => $this->input->post('writer_name'),
			'writer_name_en' => $this->input->post('writer_name_en'),
			'writer_designation' => $this->input->post('writer_designation'),
			'writer_contact' => $this->input->post('writer_contact'),
			'writer_email' => $this->input->post('writer_email'),
			'writer_web' => $this->input->post('writer_web'),
			'writer_status' => $this->input->post('writer_status'),
			'writer_bio' => $writer_bio2,
			'dom' => $mod_date,
		);
		$this->db->where('writer_id', $id);
		return $this->db->update('writer_info', $writerEntry);
	}


	/***************************Epaper**************************** */

	function ePaperEntry()
	{
		/*------- Date function in CI --------------*/
		$timezone = "America/New_York";
		date_default_timezone_set($timezone);
		$bd_date = date('F d, Y'); /* Like November 29, 2012 */
		$pub_date = date('Y-m-d H:i:s');
		/***-------- End of Date function in CI -------------***/

		$ep_subject = addslashes($this->input->post('ep_subject'));

		$ePaperEntry = array(
			'ep_subject' => $ep_subject,
			'ep_date' => $this->input->post('ep_date'),
	
			'ep_doc' => $pub_date,
			'ep_dom' => $pub_date,
			'ep_creator' => $this->tank_auth->get_user_id(),
			'ep_status' => 1
		);

		$insert = $this->db->insert('epaper_info', $ePaperEntry);
		$last_id = $this->db->insert_id();
		

		$file_data = array();
		$image_data = array();
		$config_image = array();

		$this->load->library('image_lib');

		$config["file_name"] = $last_id;
		$config['upload_path'] = './images/epaper';
		$config['allowed_types'] = 'gif|jpg|png';
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('user_avatar')) {
			echo "error";
		} else {
			$image_data =   $this->upload->data();
			$image = $image_data['file_name'];

			$configer =  array(
				'image_library'   => 'gd2',
				'source_image'    =>  $image_data['full_path'],
				'maintain_ratio'  =>  TRUE,
				'width'           =>  250,
				'height'          =>  250,
			);
			$this->image_lib->clear();
			$this->image_lib->initialize($configer);
			$this->image_lib->resize();

			$fileExtention = pathinfo($_FILES["user_avatar"]["name"], PATHINFO_EXTENSION);
			$this->db->set('img_ext', '.' . $fileExtention);
			$this->db->where('ep_id', $last_id);
			$this->db->update('epaper_info');
		}



		// pdf and ppt upload       
		$config_file['file_name'] = $last_id;
		$config_file['upload_path'] = './file/epaper/';
		$config_file['overwrite'] = TRUE;
		$config_file['allowed_types'] = 'pdf';
		

		$fileExtention = pathinfo($_FILES["ep_file"]["name"], PATHINFO_EXTENSION);

		$this->load->library('upload', $config_file);
		$this->upload->initialize($config_file);
		$upload_pdf = $this->upload->do_upload('ep_file');

		

		if ($upload_pdf) {
			$file_data = $this->upload->data();
			$content = $file_data["file_name"];

			$this->db->set('ep_file', '.'.$fileExtention);
			$this->db->where('ep_id', $last_id);
			$this->db->update('epaper_info');
		}
	
		return true;
		
	}


	function ePaperListInfo()
	{
		$this->db->cache_off(); 
		$query = $this->db->select('*')
			->from('epaper_info')
			->order_by('ep_id', 'DESC')
			->get();

		return $query->result(); 
	}
	

	function get_ePaper_data($ep_id)
	{
		$this->db->cache_off(); 
		$query = $this->db->select('*')
			->from('epaper_info')
			->where('ep_id',$ep_id)
			->get();
		return $query->result(); 
	}

	public function ePaper_edit_entry($ep_id){
		$timezone = "America/New_York";
		date_default_timezone_set($timezone);
		$bd_date = date('F d, Y'); /* Like November 29, 2012 */
		$mod_date = date('Y-m-d H:i:s');
		/***-------- End of Date function in CI -------------***/

		$subject = addslashes($this->input->post('ep_subject'));

		$ePaperEditEntry = array(
			'ep_subject' 	=> $subject,
			'ep_date' 		=> $this->input->post('ep_date'),
			'ep_status' 	=> $this->input->post('ep_status')
		);
		$this->db->where('ep_id', $ep_id);
		$this->db->update('epaper_info', $ePaperEditEntry);


		$file_data = array();
		$image_data = array();
		$config_image = array();

		$this->load->library('image_lib');

		$config["file_name"] = $ep_id;
		$config['upload_path'] = './images/epaper';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['overwrite'] = TRUE;
		$this->load->library('upload', $config);

		if (!$this->upload->do_upload('user_avatar')) {
			echo "error";
		} else {
			$image_data =   $this->upload->data();
			$image = $image_data['file_name'];

			$configer =  array(
				'image_library'   => 'gd2',
				'source_image'    =>  $image_data['full_path'],
				'maintain_ratio'  =>  TRUE,
				'width'           =>  250,
				'height'          =>  250,
			);
			$this->image_lib->clear();
			$this->image_lib->initialize($configer);
			$this->image_lib->resize();

			$fileExtention = pathinfo($_FILES["user_avatar"]["name"], PATHINFO_EXTENSION);
			$this->db->set('img_ext', '.' . $fileExtention);
			$this->db->where('ep_id', $ep_id);
			$this->db->update('epaper_info');
		}



		// pdf and ppt upload       
		$config_file['file_name'] = $ep_id;
		$config_file['upload_path'] = './file/epaper/';
		$config_file['overwrite'] = TRUE;
		$config_file['allowed_types'] = 'pdf';
		$config_file['overwrite'] = TRUE;


		$fileExtention = pathinfo($_FILES["ep_file"]["name"], PATHINFO_EXTENSION);
		$this->load->library('upload', $config_file);
		$this->upload->initialize($config_file);
		$upload_pdf = $this->upload->do_upload('ep_file');

		if ($upload_pdf) {
			$file_data = $this->upload->data();
			$content = $file_data["file_name"];

			$this->db->set('ep_file', '.' . $fileExtention);
			$this->db->where('ep_id', $ep_id);
			$this->db->update('epaper_info');
		}

		return true;
	}
	/***************************Epaper**************************** */
		
		
		
		/*********************** WRITER EDIT *******************/
		
		// function writerEdit($writerID)
		// {
		// 	$query = $this-> db-> select('*')				
		// 					   -> from('writer_info')
		// 					   -> where('writer_id',$writerID)
		// 					   -> get();
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
	
		/* ------------------- WRITER EDIT ENTRY -------------------- */
		
		// function writerEditEntry($writerID)
		// {
		// 	/*------------ Date function in CI -------------------*/
			
		// 	$timezone = "Asia/dhaka";
		// 	date_default_timezone_set($timezone);
		// 	$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			
		// 	$mod_date=date('Y-m-d H:i:s');
		// 	/***----------------- End of Date function in CI --------------------***/
			
			
		// 	$writer_bio2=addslashes($this->input->post('writer_bio'));
			
		// 	$writerEntry = array(
		// 	   'writer_type' => $this-> input-> post('writer_type'),
		// 	   'writer_name' => $this->input->post('writer_name'),
		// 	   'writer_name_en' => $this->input->post('writer_name_en'),
		// 	   'writer_designation' => $this->input->post('writer_designation'),
		// 	   'writer_contact' => $this->input->post('writer_contact'),
		// 	   'writer_email' => $this->input->post('writer_email'),
		// 	   'writer_web' => $this->input->post('writer_web'),
		// 	   'writer_bio' => $writer_bio2,
		// 	   'writer_status' => $this->input->post('writer_status'),
		// 	   'dom' => $mod_date,
		// 	   'creator_id' => $this-> tank_auth -> get_user_id()
		// 	);
			
			
		// 	$query=$this->db->query("UPDATE writer_info SET writer_type='".$writerEntry['writer_type']."' WHERE writer_id='".$writerID."'");
		// 	$query=$this->db->query("UPDATE writer_info SET writer_name='".$writerEntry['writer_name']."' WHERE writer_id='".$writerID."'");
		// 	$query=$this->db->query("UPDATE writer_info SET writer_name_en='".$writerEntry['writer_name_en']."' WHERE writer_id='".$writerID."'");
		// 	$query=$this->db->query("UPDATE writer_info SET writer_designation='".$writerEntry['writer_designation']."' WHERE writer_id='".$writerID."'");
		// 	$query=$this->db->query("UPDATE writer_info SET writer_contact='".$writerEntry['writer_contact']."' WHERE writer_id='".$writerID."'");
		// 	$query=$this->db->query("UPDATE writer_info SET writer_email='".$writerEntry['writer_email']."' WHERE writer_id='".$writerID."'");
		// 	$query=$this->db->query("UPDATE writer_info SET writer_web='".$writerEntry['writer_web']."' WHERE writer_id='".$writerID."'");
		// 	$query=$this->db->query("UPDATE writer_info SET writer_bio='".$writerEntry['writer_bio']."' WHERE writer_id='".$writerID."'");
		// 	$query=$this->db->query("UPDATE writer_info SET writer_status='".$writerEntry['writer_status']."' WHERE writer_id='".$writerID."'");
		// 	$query=$this->db->query("UPDATE writer_info SET dom='".$writerEntry['dom']."' WHERE writer_id='".$writerID."'");
		// 	$query=$this->db->query("UPDATE writer_info SET creator_id='".$writerEntry['creator_id']."' WHERE writer_id='".$writerID."'");
			
			
		// 	return $query;
		// }
		
		
		
		/* ---------------------- WRITER LIST INFO (DROPDOWN) -------------------- */


		function WriterListInfoAll()
		{
			$this->db->cache_off();
			$query = $this->db->select('writer_id,writer_name')				
							->from('writer_info')
							->where('writer_status',1)
							->order_by('writer_name_en')
							->get();			
			$data[''] = 'Select One';
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[$row->writer_id] = $row->writer_name ;
				}
				return $data;
			}
		}
	

		function writer_list_by_author($type)
		{
			if($type){
				$this->db->where('writer_type', $type);
			}
			$this->db->where('writer_status', 1);
			$this->db->order_by('writer_name_en', 'ASC');
			$query = $this->db->get('writer_info');
			
			$output = '<option value="">Select One</option>';
			if($query->result()){
				foreach($query->result() as $row)
				{
					$output .= '<option value="'.$row->writer_id.'">'.$row->writer_name .'</option>';
				}
			}
			return $output;
		}
		
		
		function writerList()
		{
			$this->db->cache_off();
			$query = $this->db->select('writer_id,writer_name')				
							->from('writer_info')
							->where('writer_status',1)
							->where('writer_type',1)
							->order_by('writer_name_en')
							->get();			
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}	
		}

		function OpinionWriterList()
		{
			$this->db->cache_off(); 
			$query = $this->db->select('writer_id,writer_name')
			->from('writer_info')
			->where('writer_status', 1)
			->where('writer_type', 2)
			->order_by('writer_name_en')
			->get();

			// $data[''] = 'Select One';
			if ($query->num_rows() > 0) {
				foreach ($query->result() as $row) {
					$data[] = $row;
				}
				return $data;
			}
		}
		
		
		
		/***************** DELETE WRITER ****************/
		
		// function writerDelete($id)
		// {
			
		// 	/******************* FILE DELETE  ************************/
		// 	$table_name='writer_info';
		// 	$table_id='writer_id'; 	/* Table ar kun field ar id theke delete korbe */
		// 	$file_id=$id;
		// 	$folder_name='writer';
		// 	$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');
		// 	/******************* FILE DELETE  ************************/
			
			
		// 	$query=$this-> db-> query("DELETE FROM writer_info WHERE writer_id='".$id."'");
			
		// 	return $query;
		// }
		
		
		
		
		
		/****************** OPINION SETUP ********************/
		
		
		// function opinionEntry()
		// {
		// 	/*------- Date function in CI --------------*/
		// 	$timezone = "Asia/dhaka";
		// 	date_default_timezone_set($timezone);
		// 	$bd_date=date('F d, Y'); /* Like November 29, 2012 */
		// 	$pub_date=date('Y-m-d H:i:s');
		// 	/***-------- End of Date function in CI -------------***/
			
		// 	$opinionTitle=addslashes($this->input->post('opinion_title'));
		// 	$opinionSubTitle=addslashes($this->input->post('opinion_sub_title'));
		// 	$opinion_details=addslashes($this->input->post('opinion_details'));
			
			
			
		// 	$opinionEntry = array(
		// 	   'opinion_category' => $this-> input-> post('opinion_category'),
		// 	   'writer_id' => $this->input->post('writer_id'),
		// 	   'opinion_title' => $opinionTitle,
		// 	   'opinion_sub_title' => $opinionSubTitle,
		// 	   'opinion_status' => $this->input->post('opinion_status'),
		// 	   'opinion_tag' => $this->input->post('opinion_tag'),
		// 	   'opinion_details' => $opinion_details,
		// 	   'opinion_reader' => 1,
		// 	   'doc' => $pub_date,
		// 	   'dom' => $pub_date,
		// 	   'publisher_id' => $this-> tank_auth -> get_user_id()
		// 	);
			

		// 	$insert=$this-> db-> insert('opinion_info', $opinionEntry);
			
		// 	$last_id = $this-> db-> insert_id(); /* get the last id of img */
			
		// 	return $last_id;
		// }
		
		
		
		
		// function opinionListCategory($ID)
		// {
		// 	$query = $this-> db-> select('*')				
		// 					   -> from('opinion_info')
		// 					   -> order_by('opinion_id','DESC')
		// 					   -> where('opinion_category',$ID)
		// 					   -> get();		
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
		// 		return $data;
		// 	}	
		// }
		
		
		
		/***************** DELETE OPINION ****************/
		
		// function opinionDelete($id)
		// {
			
		// 	/******************* FILE DELETE  ************************/
		// 	$table_name='opinion_info';
		// 	$table_id='opinion_id'; 	/* Table ar kun field ar id theke delete korbe */
		// 	$file_id=$id;
		// 	$folder_name='opinion';
		// 	$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
		// 	/******************* FILE DELETE  ************************/
			
			
		// 	$query=$this-> db-> query("DELETE FROM opinion_info WHERE opinion_id='".$id."'");
			
		// 	return $query;
		// }
		
		
		
		/*********************** OPINION EDIT *******************/
		
		// function opinionEdit($opinionID)
		// {
		// 	$query = $this-> db-> select('*')				
		// 					   -> from('opinion_info')
		// 					   -> where('opinion_id',$opinionID)
		// 					   -> get();
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		
		
		
		/* ------------------- OPINION EDIT ENTRY -------------------- */
		
		// function opinionEditEntry($opinionID)
		// {
		// 	/*------------ Date function in CI -------------------*/
			
		// 	$timezone = "Asia/dhaka";
		// 	date_default_timezone_set($timezone);
		// 	$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			
		// 	$mod_date=date('Y-m-d H:i:s');
		// 	/***----------------- End of Date function in CI --------------------***/
			
			
		// 	$opinionTitle=addslashes($this->input->post('opinion_title'));
		// 	$opinionSubTitle=addslashes($this->input->post('opinion_sub_title'));
		// 	$opinion_details=addslashes($this->input->post('opinion_details'));
			
			
		// 	$opinionEntry = array(
		// 	   'opinion_category' => $this-> input-> post('opinion_category'),
		// 	   'writer_id' => $this->input->post('writer_id'),
		// 	   'opinion_title' => $opinionTitle,
		// 	   'opinion_sub_title' => $opinionSubTitle,
		// 	   'opinion_status' => $this->input->post('opinion_status'),
		// 	   'opinion_tag' => $this->input->post('opinion_tag'),
		// 	   'opinion_details' => $opinion_details,
		// 	   'dom' => $mod_date,
		// 	   'publisher_id' => $this-> tank_auth -> get_user_id()
		// 	);
			
			
		// 	$query=$this->db->query("UPDATE opinion_info SET opinion_category='".$opinionEntry['opinion_category']."' WHERE opinion_id='".$opinionID."'");
		// 	$query=$this->db->query("UPDATE opinion_info SET writer_id='".$opinionEntry['writer_id']."' WHERE opinion_id='".$opinionID."'");
		// 	$query=$this->db->query("UPDATE opinion_info SET opinion_title='".$opinionEntry['opinion_title']."' WHERE opinion_id='".$opinionID."'");
		// 	$query=$this->db->query("UPDATE opinion_info SET opinion_sub_title='".$opinionEntry['opinion_sub_title']."' WHERE opinion_id='".$opinionID."'");
		// 	$query=$this->db->query("UPDATE opinion_info SET opinion_status='".$opinionEntry['opinion_status']."' WHERE opinion_id='".$opinionID."'");
		// 	$query=$this->db->query("UPDATE opinion_info SET opinion_tag='".$opinionEntry['opinion_tag']."' WHERE opinion_id='".$opinionID."'");
		// 	$query=$this->db->query("UPDATE opinion_info SET opinion_details='".$opinionEntry['opinion_details']."' WHERE opinion_id='".$opinionID."'");
		// 	$query=$this->db->query("UPDATE opinion_info SET dom='".$opinionEntry['dom']."' WHERE opinion_id='".$opinionID."'");
		// 	$query=$this->db->query("UPDATE opinion_info SET publisher_id='".$opinionEntry['publisher_id']."' WHERE opinion_id='".$opinionID."'");
			
			
			
		// 	return $query;
		// }
		
		
		
		/*************************************************************************************************/
	   /*																								*/
	  /*****************----------------  END OF OPINION  -----------------------------*****************/
	 /*																								  */
	/*************************************************************************************************/
		
		
		
		
		
		/*************************************************************************************************/
	   /*																								*/
	  /*****************----------------  Start of USER  ------------------------------*****************/
	 /*																								  */
	/*************************************************************************************************/
				
		function user_info_list($type)
		{
			$this->db->cache_off();
			$query = $this->db->select('*')				
				->from('users')
				->where('user_type <=',$type)
				->order_by('user_type', 'DESC')
				->get();			
							
			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				return $data;
			}	
		}
		
		// /***************** Delete User ****************/
		
		function user_delete($id, $status)
		{
			$this->db->cache_off(); 
			if($status == 1)		/* Active */
				$new_status = 0;
			else					/* In Active */
				$new_status = 1;
			
			$update_data = array(
				'activated' => $new_status 
			);

			$this-> db-> where('id', $id);
			return $this-> db-> update('users', $update_data);
		}
		
		
		/***** User Info return User Full Name with user id *****/
		
		// function user_info()
		// {
		// 	$user_id=$this-> tank_auth -> get_user_id();
		// 	$this-> db-> order_by('user_full_name', 'asc');
			
		// 	$query = $this->db->select('*')				
		// 					->from('users')
		// 					->where('id !=',$user_id)
		// 					->get();
							
		// 	$data['']='Select One';				
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[$row -> id]= $row -> user_full_name;   /* name nibe but id array te rakbe */
		// 		}
		// 		return $data;
		// 	}	
		// }
		
		/*--------------------- INSERT USER FILE INFO -----------------*/
		
		// function user_file_entry()
		// {
		// 	/*------------ Date function in CI -------------------*/
			
		// 	$timezone = "Asia/dhaka";
		// 	date_default_timezone_set($timezone);
		// 	$bd_date=date('F d, Y'); /* Like November 29, 2012 */
			
		// 	/***----------------- End of Date function in CI --------------------***/
			
		// 	$user_file_entry = array(
		// 	   'user_id' => $this->input-> post('id'),
		// 	   'file_name' => $this->input-> post('file_name') ,
		// 	   'file_des' => $this->input-> post('file_des') ,
		// 	   'file_doc' => $bd_date
		// 	);
			
		// 	$insert=$this->db->insert('user_file_info', $user_file_entry);
			
		// 	$last_id = $this-> db-> insert_id(); /* get the last id of img */
		// 	return $last_id;
		// }
		
		
		// function user_doc_info_list($user_id)
		// {
			
		// 	$query = $this->db->select('*')				
		// 					->from('user_file_info')
		// 					->where('user_id', $user_id)
		// 					->get();			
							
		// 	if($query->num_rows()>0)
		// 	{
		// 		foreach ($query->result() as $row)
		// 		{
		// 			$data[]= $row;
		// 		}
				
		// 		return $data;
		// 	}	
		// }
		
		/***************** Delete USER FILE  ****************/
		
		// function delete_user_file($file_id)
		// {
			
		// 	/******************* FILE DELETE  ************************/
		// 	$table_name='user_file_info';
		// 	$table_id='file_id'; 	/* Table ar kun field ar id theke delete korbe */
		// 	$file_id=$file_id;
		// 	$folder_name='download';
		// 	$this->common_file_delete($table_id,$table_name,$file_id,$folder_name,'');	// common  Function for deleting file from folder pathanu hoise //
		// 	/******************* FILE DELETE  ************************/
			
			
		// 	$query=$this-> db-> query("DELETE FROM user_file_info WHERE file_id='".$file_id."'");
			
		// 	return $query;
		// }

		
			
	/*************************************************************************************************/
	/*																								*/
	/*****************------------------  END of USER  ------------------------------*****************/
	/*																								  */
	/*************************************************************************************************/
	
		/* ---------------------- SUB CATEGORY INFO -------------------- */
		
		function sub_category_info()
		{
			$this-> db-> select('*');			
			$this-> db-> from('sub_category_info');
			$this-> db-> where('sub_cat_status', 1);
			$query = $this-> db-> get();
			
			$data[''] = 'Select One';			
			if($query-> num_rows() > 0){
				foreach ($query-> result() as $row){
					$data[$row-> sub_category_id]= $row-> sub_cat_name.' ('.$row-> sub_cat_key_name.')';
				}
				return $data;
			}	
		}

		function sub_category_info_by_cat($cat_id)
		{
			$this-> db-> select('*');			
			$this-> db-> from('sub_category_info');
			$this-> db-> where('sub_cat_status', 1);
			$this-> db-> where('category_id', $cat_id);
			$query = $this-> db-> get();
			
			$data[''] = 'Select One';			
			if($query-> num_rows() > 0){
				foreach ($query-> result() as $row){
					$data[$row-> sub_category_id]= $row-> sub_cat_name.' ('.$row-> sub_cat_key_name.')';
				}
			}	
			return $data;
		}
		
		
		/* ---------------------------------- USER LIST INFO -------------------------------- */

		function get_user_list()
		{
			$this-> db-> select('id, user_full_name, user_type, activated');
			$this-> db-> from('users');
			$this-> db-> where('user_type !=', 7);  /* Except Super Admin */
			$query = $this-> db-> get();
			
			$data[''] = 'Select One';			
			if($query-> num_rows() > 0){
				foreach ($query-> result() as $row){
					$data[$row-> id] = $row-> user_full_name;
				}
			}
			return $data;
		}

		// public function get_subcategories(){
		// 	$catid = $this->input->post('category_id');
		// 	$this->db->WHERE('category_id', $catid)->get('sub_category_info')->result_array();
		// }


		
		
		/***************************************************************************/
		/*----------------------------- NEWLY ADDED FEATURE -----------------------*/
		/***************************************************************************/
		
		function news_list_search_new($newsID = '', $category_id = '', $subCategoryID = '' , $newsStatus = '', $author_id = '', $page_id = '', $publisherID = '', $publisherType = '', $start_date = '', $end_date = '', $sortType = '', $limit = '')
		{
			$this-> db-> cache_off();
			$query = '';
			
			$this-> db-> select('news_common_info.news_id,news_common_info.news_headline, news_common_info.cat_id, news_common_info.img_ext,news_reader_info.news_reader, users.user_full_name, news_common_info.news_pub_date, news_common_info.news_mod_date, category_info.cat_name,news_common_info.news_approver, news_common_info.news_status');
			$this-> db-> from('users, news_common_info, news_reader_info, news_info, category_info');
			$this-> db-> join('news_writer_info', 'news_common_info.news_id = news_writer_info.news_id', 'left');
			$this-> db-> where('news_info.news_id = news_common_info.news_id');
			$this-> db-> where('news_common_info.news_id = news_reader_info.news_id');
			$this-> db-> where('news_common_info.cat_id = category_info.cat_id');
			$this-> db-> where('news_common_info.news_publisher = users.id');
			
			
			if($newsID){ 								$this-> db-> where('news_common_info.news_id', $newsID); }
			if(is_numeric($category_id)){ 				$this-> db-> where('news_common_info.cat_id', $category_id); }
			if(is_numeric($subCategoryID)){ 			$this-> db-> where('news_common_info.sub_cat_id', $subCategoryID); }
			if(is_numeric($newsStatus)){ 				$this-> db-> where('news_common_info.news_status', $newsStatus); }
			if(is_numeric($author_id)){ 				$this-> db-> where('news_writer_info.author_ids', $author_id); }
			if(is_numeric($page_id)){ 					$this-> db-> where('news_common_info.page_id', $page_id); }
			

			if($publisherID){
				$this-> db-> where('news_common_info.news_publisher', $publisherID);
			}
			
			// if($publisherType < 5){
			// 	if($publisherID && $publisherType != 7 && $publisherType != 5){ $this-> db-> where('news_common_info.news_publisher', $publisherID); }  /* Not Super Admin or Admin */
			// }
			

			if($start_date && $end_date){
				$this-> db-> where('news_common_info.news_pub_date >= ', $start_date);
				$this-> db-> where('news_common_info.news_pub_date <= ', $end_date);
			}
			if($start_date && $end_date == ''){
				$this-> db-> where('news_common_info.news_pub_date >= ', $start_date);
			}
			if($start_date == '' && $end_date){
				$this-> db-> where('news_common_info.news_pub_date <= ', $end_date);
			}
			
			if($sortType){
				if($sortType == 'date-new')
					$this-> db-> order_by('news_common_info.news_id', 'DESC');
				if($sortType == 'date-old')
					$this-> db-> order_by('news_common_info.news_id', 'ASC');
				else if($sortType == 'reader-high')
					$this-> db-> order_by('news_reader_info.news_reader', 'DESC');
				else if($sortType == 'reader-low')
					$this-> db-> order_by('news_reader_info.news_reader', 'ASC');
				else if($sortType == 'publisher')
					$this-> db-> order_by('news_common_info.news_publisher', 'DESC');
			}
			else{
				$this-> db-> order_by('news_common_info.news_id', 'DESC');
			}

			if($limit){
				$this-> db-> limit($limit);
			}
			
			$query = $this-> db-> get();
			if($query->num_rows() > 0) return $query-> result();
			else return false;
		}


		// function news_list_search_new($newsID = '', $category_id = '', $subCategoryID = '' , $newsStatus = '', $publisherID = '', $publisherType = '', $date1 = '', $date2 = '', $sortType = '')
		// {
		// 	$this-> db-> cache_off();
		// 	$query = '';
			
		// 	$this-> db-> select('news_common_info.news_id,news_common_info.news_headline, news_common_info.cat_id, news_common_info.img_ext,news_reader_info.news_reader, users.user_full_name, news_common_info.news_pub_date, news_common_info.news_mod_date, category_info.cat_name,news_common_info.news_approver, news_common_info.news_status');
		// 	$this-> db-> from('users, news_common_info, news_reader_info, news_info, category_info');
		// 	$this-> db-> where('news_info.news_id = news_common_info.news_id');
		// 	$this-> db-> where('news_common_info.news_id = news_reader_info.news_id');
		// 	$this-> db-> where('news_common_info.cat_id = category_info.cat_id');
		// 	$this-> db-> where('news_common_info.news_publisher = users.id');
			
		// 	if($newsID){ 								$this-> db-> where('news_common_info.news_id', $newsID); }
		// 	if(is_numeric($category_id)){ 				$this-> db-> where('news_common_info.cat_id', $category_id); }
		// 	if(is_numeric($subCategoryID)){ 			$this-> db-> where('news_common_info.sub_cat_id', $subCategoryID); }
		// 	if(is_numeric($newsStatus)){ 				$this-> db-> where('news_common_info.news_status', $newsStatus); }
		// 	if($this->input->post('subCategoryID')){ 	$this-> db-> where('news_common_info.sub_cat_id', $this->input->post('subCategoryID')); }

		// 	if($publisherID && $publisherType != 7 && $publisherType != 5){ $this-> db-> where('news_common_info.news_publisher', $publisherID); }  /* Not Super Admin or Admin */

		// 	if($date1 && $date2){
		// 		$this-> db-> where('news_common_info.news_pub_date >= ', $date1);
		// 		$this-> db-> where('news_common_info.news_pub_date <= ', $date2);
		// 	}
			
		// 	if($sortType){
		// 		if($sortType == 'date-new')
		// 			$this-> db-> order_by('news_common_info.news_id', 'DESC');
		// 		if($sortType == 'date-old')
		// 			$this-> db-> order_by('news_common_info.news_id', 'ASC');
		// 		else if($sortType == 'reader-high')
		// 			$this-> db-> order_by('news_reader_info.news_reader', 'DESC');
		// 		else if($sortType == 'reader-low')
		// 			$this-> db-> order_by('news_reader_info.news_reader', 'ASC');
		// 		else if($sortType == 'publisher')
		// 			$this-> db-> order_by('news_common_info.news_publisher', 'DESC');
		// 	}
		// 	else{
		// 		$this-> db-> order_by('news_common_info.news_id', 'DESC');
		// 	}
			
		// 	$this-> db-> limit(100);
		// 	$query = $this-> db-> get();

		// 	if($query->num_rows() > 0) return $query-> result();
		// 	else return false;
		// }
		
		function news_list_report($publisherID = '', $date1 = '', $date2 = '', $sortType = '')
		{
			$this-> db-> cache_off();
			$query = '';
			
			$this-> db-> select('news_common_info.news_id,news_common_info.news_publisher, news_common_info.news_approver,news_common_info.news_headline, news_common_info.cat_id, news_common_info.img_ext,news_reader_info.news_reader,pub.user_full_name as publisher_name ,app.user_full_name as approver_name , news_common_info.news_pub_date, news_common_info.news_pub_time, news_common_info.news_mod_date, news_common_info.news_mod_time, category_info.cat_name, news_common_info.news_status');
			$this-> db-> from('users as pub,users as app,news_common_info, news_reader_info, news_info, category_info');

			// $this->db->join('users', 'news_common_info.news_publisher = users.id', 'left');

			
			$this-> db-> where('news_info.news_id = news_common_info.news_id');
			$this-> db-> where('news_common_info.news_id = news_reader_info.news_id');
			$this-> db-> where('news_common_info.cat_id = category_info.cat_id');
			$this-> db-> where('news_common_info.news_approver = app.id');
			$this-> db-> where('news_common_info.news_publisher = pub.id');
			
			$this-> db-> where('news_common_info.news_approver != "" ');

			
			
			
			
			if($publisherID){
				$this-> db-> where('news_common_info.news_publisher', $publisherID);
			}
			
			if($date1 && $date2){
				if($date1 == $date2){ $date2 = date('Y-m-d', strtotime("+1 day", strtotime($date1))); }
				
				$this-> db-> where('news_common_info.news_pub_date >= ', $date1);
				$this-> db-> where('news_common_info.news_pub_date <= ', $date2);
			}
			
			if($sortType){
				if($sortType == 'date-new')
					$this-> db-> order_by('news_common_info.news_id', 'DESC');
				else if($sortType == 'date-old')
					$this-> db-> order_by('news_common_info.news_id', 'ASC');
				else if($sortType == 'reader-high')
					$this-> db-> order_by('news_reader_info.news_reader', 'DESC');
				else if($sortType == 'reader-low')
					$this-> db-> order_by('news_reader_info.news_reader', 'ASC');
				else if($sortType == 'publisher')
					$this-> db-> order_by('news_common_info.news_publisher', 'DESC');
			}
			else{
				$this-> db-> order_by('news_common_info.news_id', 'DESC');
			}
			
			$this-> db-> limit(200);
			$query = $this-> db-> get();

			if($query){		
				if($query-> num_rows() > 0){
					foreach($query-> result() as $row){
						$data[] = $row;
					}
					return $data;
				}	
			}
		}
		/***************************************************************************/
		/*-------------------------- END OF NEWLY ADDED FEATURE -------------------*/
		/***************************************************************************/

		public function requested_news(){
			$this->db->cache_off();
			$query=$this-> db-> query("SELECT *
				FROM  news_common_info, category_info, news_reader_info, users
				WHERE `news_common_info`.`news_publisher` = `users`.`id` AND `news_common_info`.`news_id` = `news_reader_info`.`news_id` AND 
				`news_common_info`.`cat_id` = `category_info`.`cat_id` AND `news_common_info`.`news_approver` = 0 ORDER BY `news_common_info`.`news_id` DESC LIMIT 100");

			if($query->num_rows()>0)
			{
				foreach ($query->result() as $row)
				{
					$data[]= $row;
				}
				return $data;
			}
		}

		public function count_pending_news(){
			$this->db->SELECT('*');
			$this->db->FROM('news_common_info');
			$this->db->WHERE('news_approver', 0);
			$query_result = $this->db->get();
			$news_count =$query_result->num_rows();
			return $news_count;
		}
		/***************************************************************************/
		/*-------------------------- END OF NEWLY ADDED FEATURE -------------------*/
		/***************************************************************************/

		
		  /***************************************************************************/
		 /*-------------------------- END OF NEWLY ADDED FEATURE -------------------*/
		/***************************************************************************/

		/**********	NEWS LIST FOR NEWS TABLE REFORM ***********/
		
		// function db_news_list_reform($start, $end)
		// {
		// 	if($start && $end){
		// 		$query = $this-> db-> query('SELECT * From news_info 
		// 							WHERE news_info.news_id >= "'.$start.'" AND news_info.news_id <= "'.$end.'"
		// 							ORDER BY news_id ASC');
		// 	}
						
		// 	if($query->num_rows() > 0){
		// 		foreach ($query->result() as $row){
		// 			$news_common_entry = array(
		// 				'news_id' 				=> $row->news_id,
		// 				'cat_id' 				=> $row->cat_id,
		// 				'sub_cat_id' 			=> $row->sub_cat_id,
		// 				'news_status' 			=> $row->news_status,
		// 				'news_headline' 		=> $row->news_headline,
		// 				'news_details_brief' 	=> $row->news_details_brief,
		// 				'news_reporter' 		=> $row-> news_reporter,
		// 				'img_ext'		 		=> $row-> img_ext,
		// 				'catStatus' 			=> $row->catStatus,
		// 				'latestStatus' 			=> $row->latestStatus,

		// 				'author_id' 			=> 0,
		// 				'page_id' 				=> $row-> page_id,
		// 				'news_pub_date' 		=> $row-> news_pub_date,
		// 				'news_mod_date' 		=> $row-> news_mod_date
		// 			);

		// 			$news_reader_entry = array(
		// 				'news_id' 				=> $row->news_id,
		// 				'news_reader' 			=> $row->news_reader
		// 			);
		// 			$insertInfo1 = $this->db->insert('news_common_info', $news_common_entry);
		// 			$insertInfo2 = $this->db->insert('news_reader_info', $news_reader_entry);
		// 		}
		// 		if($insertInfo1 && $insertInfo2)
		// 			return TRUE;
		// 	}
		// }


		
		/***************************************************************************/
		/*--------------------------------- Share Image ---------------------------*/
		/***************************************************************************/

		public function ShareImageEntry(){
			$this->db->cache_off(); 
			$timezone = "Asia/Dhaka";
			date_default_timezone_set($timezone);
			$pub_date = date('Y-m-d H:i:s');
			$ShareImageEntry = array(
				'status' 		=> 1,
				'doc' => $pub_date,
				'dom' => $pub_date,
				'creator' => $this->tank_auth->get_user_id()
			);
			$this->db->where('share_id=', 1)->update('tbl_share', $ShareImageEntry);
			return 1;
		}

		function ShareImageListInfo()
		{
			$this->db->cache_off(); 
			$query = $this->db->select('*')
				->from('tbl_share')
				->where('share_id',1)
				->get();

			return $query->row(); 
		}

		// public function ShareImageRemove($id){
		// 	unlink(FCPATH.'images/share/'.$id.'.png');
		// 	$query=$this-> db-> query("DELETE FROM tbl_share WHERE share_id='".$id."'");
			
		// }

		// public function ShareImageActive($id){
		// 	$activeStatus = array(
		// 		'status' => '1'
		// 	);
		// 	$query_active = $this->db->where('share_id', $id)->update('tbl_share', $activeStatus);
		// 	$updateStatus = array(
		// 		'status' => '0'
		// 	);
		// 	$query = $this->db->where('share_id !=', $id)->update('tbl_share', $updateStatus);
		// 	return $id; 
		// }

		public function edit_share_status($id){
			if($id == 0){
				$updateStatus = array(
					'status' => '1'
				);
			}
			else{
				$updateStatus = array(
					'status' => '0'
				);
			}
			$query = $this->db->where('share_id',1)->update('tbl_share', $updateStatus);
			return $id; 
		}

		
		/***************************************************************************/
		/*--------------------------------- Share Image ---------------------------*/
		/***************************************************************************/



		/***************************************************************************/
		/*--------------------------------- Prayer Time ---------------------------*/
		/***************************************************************************/

		function load_data()
		{
			$this->db->cache_off(); 
			// $this->db->select('today_p1,today_p2,today_p3,today_p4,today_p5');
			$this->db->order_by('prayer_id', 'DESC');
			$query = $this->db->get('tbl_prayer');
			return $query->result_array();
		}

		function update($data, $id)
		{
			$this->db->where('prayer_id', $id);
			$this->db->update('tbl_prayer', $data);
		}
		


		/***************************************************************************/
		/*--------------------------------- Prayer Time ---------------------------*/
		/***************************************************************************/
		
		
		/***************************************************************************/
		/*--------------------------- Start News Segment --------------------------*/
		/***************************************************************************/

		function news_segment_info_list(){
			$this->db->cache_off();
			$query = $this->db->select('*')				
					->from('news_segment')
					->order_by('segment_id', 'DESC')
					->get();		

			return $query->result();
		}

		function news_segment_entry()
		{


			$segment_title_show = $news_subheadline_status = $news_time_status 	= 0; 
			$subheadline_color = $news_time										= '';
			
			


			$segment_title 				= $this->input->post('segment_title');
			if($this->input->post('segment_title_show'))
				$segment_title_show 	= 1;
			$segment_tag 		= $this->input->post('segment_tag');

			if($this->input->post('segment_seo_title'))
				$segment_seo_title 		= $this->input->post('segment_seo_title');
			else
				$segment_seo_title 		= $this->input->post('segment_title');
			$segment_seo_keyword 		= $this->input->post('segment_seo_keyword');
			$segment_seo_details 		= $this->input->post('segment_seo_details');
			$segment_start_date 		= $this->input->post('start_date');
			$segment_end_date 			= $this->input->post('end_date');
			if($this->input->post('banner_show'))
				$banner_show 		= 1;
			else
				$banner_show 		= 0; 

			if($this->input->post('segment_bg_status')){
				$segment_bg_status 		= 1;
				$segment_bg_type 		= $this->input->post('bg_type');
				$segment_title_color 	= $this->input->post('title_color');
				$segment_headline_color = $this->input->post('headline_color');
				$hover_color 			= $this->input->post('hover_color');
				if($this->input->post('news_subheadline_status')){
					$news_subheadline_status = 1;
					$subheadline_color =  $this->input->post('subheadline_color');
				}
				else{
					$news_subheadline_status 	= 0;
					$subheadline_color 			= '';
				}
				if($this->input->post('news_time_status')){
					$news_time_status = 1;
					$news_time =  $this->input->post('news_time');
				}
				else{
					$news_time_status 	= 0;
					$news_time 			= '';
				}

				if($this->input->post('bg_type') == 2){
					$bg_color = $this->input->post('bg_color');
					$bg_bottom_color = $this->input->post('bg_bottom_color');
				}
				else{
					$bg_color 			= '';
					$bg_bottom_color = $this->input->post('bg_bottom_color_img');
				}
			}
			else{
				$segment_bg_status		= 0;
				$segment_bg_type		= '';
				$segment_bg_color		= '';
				$segment_bg_border		= '';
				$segment_title_color	= '';
				$segment_headline_color	= '';
				$segment_details_status	= 0;
				$segment_details_color	= '';
				$segment_time_status	= 0;
				$segment_time_color		= '';
				$hover_color			= '';
				$bg_color				= '';
				$bg_bottom_color			= '';
			}
			$current_time = date('Y-m-d H:i:s');
	
			$data = array(
			   'segment_title' 				=> $segment_title,
			   'segment_title_show' 		=> $segment_title_show,
			   'segment_tag' 				=> $segment_tag,
			   'segment_seo_title' 			=> $segment_seo_title,
			   'segment_seo_details' 		=> $segment_seo_details,
			   'segment_seo_keywords' 		=> $segment_seo_keyword,
			   'segment_start_date' 		=> $segment_start_date,
			   'segment_end_date' 			=> $segment_end_date,
			   'banner_show'				=> $banner_show, 
			   'segment_bg_status' 			=> $segment_bg_status,
			   'segment_bg_type' 			=> $segment_bg_type,
			   'segment_bg_color' 			=> $bg_color,
			   'segment_bg_border' 			=> $bg_bottom_color,
			   'segment_title_color' 		=> $segment_title_color,
			   'segment_headline_color' 	=> $segment_headline_color,
			   'segment_details_status' 	=> $news_subheadline_status,
			   'segment_details_color' 		=> $subheadline_color,
			   'segment_time_status' 		=> $news_time_status,
			   'segment_time_color' 		=> $news_time,
			   'segment_link_hover'			=> $hover_color,
			   'created_at'					=> $current_time,
			   'created_by'					=> $this-> tank_auth -> get_user_id(),
			   'status'						=> 1
			);
			$this->db->insert('news_segment', $data);
			$last_id = $this-> db-> insert_id();

			$file_data 		= array();
			$image_data 	= array();
			$config_image 	= array();
			
			$file = $_FILES['user_avatar']['name'];
			$file2 = $_FILES['user_avatar_2']['name'];
			
			

			$this->load->library('image_lib');
			
			if($file){
			    $config["file_name"] 		= $last_id;
    			$config['upload_path'] 		= './images/segment/banner/';
    			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
    			$config['overwrite'] 		= TRUE;
    			$this->load->library('upload', $config);
    			if (!$this->upload->do_upload('user_avatar')) {
    			    
    				echo "error";
    			} else {
    				$image_data =   $this->upload->data();
    				$image = $image_data['file_name'];
    
    				$configer =  array(
    					'image_library'   => 'gd2',
    					'source_image'    =>  $image_data['full_path'],
    				);
    				$this->image_lib->clear();
    				$this->image_lib->initialize($configer);
    				$this->image_lib->resize();
    
    				$fileExtention = pathinfo($_FILES["user_avatar"]["name"], PATHINFO_EXTENSION);
    				$this->db->set('segment_banner_img', '.' . $fileExtention);
    				$this->db->where('segment_id', $last_id);
    				$this->db->update('news_segment');
    			}
			}

			

			// User Avatar 2     
			if($file2){
			    $config_file['file_name'] 		= $last_id;
    			$config_file['upload_path'] 	= './images/segment/bg/';
    			$config_file['overwrite'] 		= TRUE;
    			$config_file['allowed_types'] 	= 'gif|jpg|png|jpeg';
    
    			$fileExtention = pathinfo($_FILES["user_avatar_2"]["name"], PATHINFO_EXTENSION);
    
    			$this->load->library('upload', $config_file);
    			$this->upload->initialize($config_file);
    			$upload_pdf = $this->upload->do_upload('user_avatar_2');
    
    			if ($upload_pdf) {
    				$file_data = $this->upload->data();
    				$content = $file_data["file_name"];
    
    				$this->db->set('segment_bg_img', '.'.$fileExtention);
    				$this->db->where('segment_id', $last_id);
    				$this->db->update('news_segment');
    			}
			}

			return $last_id;
		}

		function news_segment_edit($id){

			$segment_title_show = $news_subheadline_status = $news_time_status 	= 0; 
			$subheadline_color = $news_time										= '';
			
			


			$segment_title 				= $this->input->post('segment_title');
			if($this->input->post('segment_title_show'))
				$segment_title_show 	= 1;
			$segment_tag 		= $this->input->post('segment_tag');

			if($this->input->post('segment_seo_title'))
				$segment_seo_title 		= $this->input->post('segment_seo_title');
			else
				$segment_seo_title 		= $this->input->post('segment_title');
			$segment_seo_keyword 		= $this->input->post('segment_seo_keyword');
			$segment_seo_details 		= $this->input->post('segment_seo_details');
			$segment_start_date 		= $this->input->post('start_date');
			$segment_end_date 			= $this->input->post('end_date');

			if($this->input->post('banner_show'))
				$banner_show 		= 1;
			else
				$banner_show 		= 0; 

			if($this->input->post('segment_bg_status')){
				$segment_bg_status 		= 1;
				$segment_bg_type 		= $this->input->post('bg_type');
				$segment_title_color 	= $this->input->post('title_color');
				$segment_headline_color = $this->input->post('headline_color');
				$hover_color 			= $this->input->post('hover_color');
				if($this->input->post('news_subheadline_status')){
					$news_subheadline_status = 1;
					$subheadline_color =  $this->input->post('subheadline_color');
				}
				else{
					$news_subheadline_status 	= 0;
					$subheadline_color 			= '';
				}
				if($this->input->post('news_time_status')){
					$news_time_status = 1;
					$news_time =  $this->input->post('news_time');
				}
				else{
					$news_time_status 	= 0;
					$news_time 			= '';
				}

				if($this->input->post('bg_type') == 2){
					$bg_color = $this->input->post('bg_color');
					$bg_bottom_color = $this->input->post('bg_bottom_color');
				}
				else{ 
					$bg_color 			= '';
					$bg_bottom_color = $this->input->post('bg_bottom_color_img');
				}
			}
			else{
				$segment_bg_status		= 0;
				$segment_bg_type		= '';
				$segment_bg_color		= '';
				$segment_bg_border		= '';
				$segment_title_color	= '';
				$hover_color			= '';
				$segment_headline_color	= '';
				$segment_details_status	= 0;
				$segment_details_color	= '';
				$segment_time_status	= 0;
				$segment_time_color		= '';
				$bg_color				= '';
				$bg_bottom_color		= '';
			}
			$current_time = date('Y-m-d H:i:s');
	
			$data = array(
			   'segment_title' 				=> $segment_title,
			   'segment_title_show' 		=> $segment_title_show,
			   'segment_tag' 				=> $segment_tag,
			   'segment_seo_title' 			=> $segment_seo_title,
			   'segment_seo_details' 		=> $segment_seo_details,
			   'segment_seo_keywords' 		=> $segment_seo_keyword,
			   'segment_start_date' 		=> $segment_start_date,
			   'segment_end_date' 			=> $segment_end_date,
			   'banner_show'				=> $banner_show, 
			   'segment_bg_status' 			=> $segment_bg_status,
			   'segment_bg_type' 			=> $segment_bg_type,
			   'segment_bg_color' 			=> $bg_color,
			   'segment_bg_border' 			=> $bg_bottom_color,
			   'segment_title_color' 		=> $segment_title_color,
			   'segment_headline_color' 	=> $segment_headline_color,
			   'segment_details_status' 	=> $news_subheadline_status,
			   'segment_details_color' 		=> $subheadline_color,
			   'segment_time_status' 		=> $news_time_status,
			   'segment_time_color' 		=> $news_time,
			   'segment_link_hover'			=> $hover_color,
			   'updated_at'					=> $current_time,
			   'updated_by'					=> $this-> tank_auth -> get_user_id(),
			   'status'						=> $this->input->post('status')
			);
			$this->db->where('segment_id', $id); 
			$this->db->update('news_segment', $data);

			$last_id = $id; 
			
			

			$file_data 		= array();
			$image_data 	= array();
			$config_image 	= array();
			
			$file = $_FILES['user_avatar']['name'];
			$file2 = $_FILES['user_avatar_2']['name'];
			
			

			$this->load->library('image_lib');
			
			if($file){
			    $config["file_name"] 		= $last_id;
    			$config['upload_path'] 		= './images/segment/banner/';
    			$config['allowed_types'] 	= 'gif|jpg|png|jpeg';
    			$config['overwrite'] 		= TRUE;
    			$this->load->library('upload', $config);
    			if (!$this->upload->do_upload('user_avatar')) {
    			    
    				echo "error";
    			} else {
    				$image_data =   $this->upload->data();
    				$image = $image_data['file_name'];
    
    				$configer =  array(
    					'image_library'   => 'gd2',
    					'source_image'    =>  $image_data['full_path'],
    				);
    				$this->image_lib->clear();
    				$this->image_lib->initialize($configer);
    				$this->image_lib->resize();
    
    				$fileExtention = pathinfo($_FILES["user_avatar"]["name"], PATHINFO_EXTENSION);
    				$this->db->set('segment_banner_img', '.' . $fileExtention);
    				$this->db->where('segment_id', $last_id);
    				$this->db->update('news_segment');
    			}
			}

			

			// User Avatar 2     
			if($file2){
			    $config_file['file_name'] 		= $last_id;
    			$config_file['upload_path'] 	= './images/segment/bg/';
    			$config_file['overwrite'] 		= TRUE;
    			$config_file['allowed_types'] 	= 'gif|jpg|png|jpeg';
    
    			$fileExtention = pathinfo($_FILES["user_avatar_2"]["name"], PATHINFO_EXTENSION);
    
    			$this->load->library('upload', $config_file);
    			$this->upload->initialize($config_file);
    			$upload_pdf = $this->upload->do_upload('user_avatar_2');
    
    			if ($upload_pdf) {
    				$file_data = $this->upload->data();
    				$content = $file_data["file_name"];
    
    				$this->db->set('segment_bg_img', '.'.$fileExtention);
    				$this->db->where('segment_id', $last_id);
    				$this->db->update('news_segment');
    			}
			}
			
			return $last_id;
		}


		/***************************************************************************/
		/*---------------------------  End News Segment  --------------------------*/
		/***************************************************************************/





		  /***************************************************************************/
		 /*--------------------------------- DB CACHE SYSTEM -----------------------*/
		/***************************************************************************/
		
		function cache_news_search($newsID)
    	{
    		$this-> db-> cache_off();
    		$query = '';
    		
    		$this-> db-> select('news_common_info.news_id, news_common_info.cat_id, news_common_info.sub_cat_id, category_info.cat_key_name, news_common_info.news_status');
    		$this-> db-> from('news_common_info, category_info');
    		$this-> db-> where('news_common_info.cat_id = category_info.cat_id');
    		if($newsID){ $this-> db-> where('news_common_info.news_id', $newsID); }
    		$query = $this-> db-> get();
    
    		if($query->num_rows() > 0) return $query-> row();
    		else return false;
    	}
	}
	