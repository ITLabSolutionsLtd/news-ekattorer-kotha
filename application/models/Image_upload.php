<?php
	class Image_upload extends CI_Model{

		public function upload_with_thumb($filename,$file_content,$file_type,$last_id,$tbl_name,$current_url, $directory = '')
		{
			if($file_type!=''){
				$img_ext = $file_type;    /* png or jpg */
				$img_ext = '.'.$img_ext; /* .png  */

				$share_img_query = '';
				$this->db->cache_off(); 
				$this-> db-> select('share_id, img_ext');
				$this-> db-> from('tbl_share');
				$this-> db-> where('tbl_share.status',1);
				$share_img_query = $this->db->get();
				$ret = $share_img_query->row();

				if($tbl_name=='news_common_info' && isset($ret->share_id)){
				
					    $imgSrc = $file_content;
						//getting the image dimensions
						list($width, $height) = getimagesize($imgSrc);

						//saving the image into memory (for manipulation with GD Library)
						// $myImage = imagecreatefromjpeg($imgSrc);
						
					
						
						$myImage = ImageCreateFromString(file_get_contents($imgSrc));

						// calculating the part of the image to use for thumbnail
						if ($width > $height) {
						$y = 0;
						$x = ($width - $height) / 2;
						$smallestSide = $height;
						} else {
							$x = 0;
							$y = ($height - $width) / 2;
							$smallestSide = $width;
						}

						// copying the part into thumbnail
						$thumbSize = 728;
						$thumbHeight = 380;
						$thumb = imagecreatetruecolor($thumbSize, $thumbHeight);
						imagecopyresampled($thumb, $myImage, 0,0, 0, 0, $thumbSize, $thumbHeight, $width, $smallestSide);

					// save image
					// ImageJPEG($output, 'resize.png'); 

					function watermark_image($target, $wtrmrk_file, $newcopy) {
						$watermark = imagecreatefrompng($wtrmrk_file);
						imagealphablending($watermark, false);
						imagesavealpha($watermark, true);
						// $img = imagecreatefromjpeg($target);

						$img = $target;
						$img_w = imagesx($img);
						$img_h = imagesy($img);
						$wtrmrk_w = imagesx($watermark);
						$wtrmrk_h = imagesy($watermark);
						
						imagecopy($img, $watermark, 0, $img_h - $wtrmrk_h, 0, 0, $wtrmrk_w, $wtrmrk_h);
					
						// header('Content-Type: image/jpg');
						// imagejpeg($img);
						imagejpeg($img,$newcopy,100);
						imagedestroy($img);
						imagedestroy($watermark);
					}

					$ft_img = base_url('images/share/'.$ret->share_id.$ret->img_ext);
					watermark_image($thumb,$ft_img, $directory.'share/'.$last_id.'.jpg');
					// watermark_image($output,'image/image2.png', $dir.$last_id.'.jpg');
					// exit();

				}
			}



			$config = array();
			/****** ----------- upload and update the file --------------***/
			if($tbl_name=='prog_info')
				$config['upload_path'] = './images/program/';
			else if($tbl_name=='writer_info')
				$config['upload_path'] = './images/writer/';
			else if($tbl_name=='opinion_info')
				$config['upload_path'] = './images/opinion/';
			else if($tbl_name=='service_info')
				$config['upload_path'] = './images/service/';
			else if($tbl_name=='banner_info')
				$config['upload_path'] = './images/banner/';
			else if($tbl_name=='user_file_info')
				$config['upload_path'] = './images/download/';
			else if($tbl_name=='officer_info')
				$config['upload_path'] = './images/member/';

			else if($tbl_name=='news_common_info')
				$config['upload_path'] = $directory; //$config['upload_path'] = './images/news/';

			else if($tbl_name=='media_info')
				$config['upload_path'] = './images/paper/';
			else if($tbl_name=='news_gallery_info')
				$config['upload_path'] = './images/news_gallery/';
			else if ($tbl_name == 'member_info')
				$config['upload_path'] = './images/member/';
			else if($tbl_name=='add_info')
				$config['upload_path'] = './images/add/';
			else if($tbl_name=='users')
				$config['upload_path'] = './images/users/';
			else if($tbl_name=='tbl_share')
				$config['upload_path'] = './images/share/';
			
			else
				$config['upload_path'] = './images/gallery/';

			$config['image_library'] = 'gd2';
			$config['maintain_ratio'] = TRUE;
    		$config['create_thumb'] = TRUE;
			
			
			$config['allowed_types'] = 'gif|jpg|png|jpeg|docx|doc|rar|zip';
			$config['overwrite']     = true;
			$config['remove_spaces'] = true;
// 			$config['maintain_ratio'] = TRUE;
			// $config['max_size']     = '100';
			// $config['max_size']      = 100;
			// $config['max_width']     = 100;
			// $config['max_height']    = 60;
			//$config['max_size']    = '100';// in KB

			// $this->image_lib->initialize($config);
			// $this->image_lib->resize();
			
			$this-> load-> library('upload', $config);
			// $this->image_lib->clear(); // added this line
			$this->upload->do_upload('user_avatar');
			$fInfo = $this->upload->data();

			// $img_array = array();
			// $img_array['image_library'] = 'gd2';
			// $img_array['overwrite']     = true;
			// $img_array['maintain_ratio'] = TRUE;
			// $img_array['create_thumb'] = FALSE;
			// //you need this setting to tell the image lib which image to process
			// $img_array['source_image'] = $fInfo['full_path'];
			// $img_array['width'] = 113;
			// $img_array['height'] = 75;

			// $this->image_lib->clear(); // added this line
			// $this->image_lib->initialize($img_array); // added this line
			// if (!$this->image_lib->resize())
			
			
			
			if(! $this->upload->do_upload('user_avatar')){
				$this->session->set_flashdata('message', $this->upload->display_errors('<p class="error">', '</p>'));
			}  
			else{
				//Image Resizing
				$config['source_image'] = $this->upload->upload_path.$this->upload->file_name;
				$config['image_library'] = 'gd2';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 75;
				$config['height'] = 10;
				$config['create_thumb'] = TRUE;
				// $config['new_image'] = '/images/gallery/new_image.jpg';
				$this-> load-> library('image_lib', $config);
				$this-> image_lib-> resize();
		 
				if ( ! $this->image_lib->resize()){             
					echo $this->image_lib->display_errors();
				}
				$uploaddata = $this->upload->data();

				/*------------------------ Create Thumb -----------------------------*/
				$config = array();
				$config['image_library'] = 'GD2';
				$config['source_image']  = $uploaddata['full_path'];
				//$config['new_image']   = 'images/profile/thumb';
				
				if($tbl_name=='prog_info')
					$config['new_image'] = 'images/program/thumb';
				else if($tbl_name=='writer_info')
					$config['new_image'] = 'images/writer/thumb';
				else if($tbl_name=='opinion_info')
					$config['new_image'] = 'images/opinion/thumb';
				else if($tbl_name=='service_info')
					$config['new_image'] = 'images/service/thumb';
				else if($tbl_name=='banner_info')
					$config['new_image'] = 'images/banner/thumb';
				// else if($tbl_name=='officer_info')
				// 	$config['new_image'] = 'images/member/thumb';
				else if($tbl_name=='news_common_info'){
				    $config['quality']   = '80%';
				    $config['new_image'] = $directory.'thumb';  //$config['new_image'] = 'images/news/thumb';
				}
					
				else if($tbl_name=='media_info')
					$config['new_image'] = 'images/paper/thumb';
				else if($tbl_name=='news_gallery_info')
					$config['new_image'] = 'images/news_gallery/thumb';
				else if($tbl_name=='member_info')
					$config['new_image'] = 'images/member/thumb';
				else if($tbl_name=='add_info')
					$config['new_image'] = 'images/add/thumb';
				else if($tbl_name=='users')
					$config['new_image'] = 'images/users/thumb';
				else
					$config['new_image'] = 'images/gallery/thumb';

				if($tbl_name=='news_gallery_info'){
					//$config['new_image'] 		= 'images/gallery/thumb';
					$config['create_thumb']   	= false;
					$config['maintain_ratio'] 	= false;
					$config['width']  			= 600;
					$config['height'] 			= 400;

					$this->image_lib->initialize($config);
					$this->image_lib->resize(); /*------ Create Thumb (600x400) -----*/
				}
				if($tbl_name=='member_info'){
					
					$config['create_thumb']   = false;
					$config['maintain_ratio'] = TRUE;
					$config['width']          = 300;
					$config['height']         = 250;

					$this->image_lib->initialize($config);
					$this->image_lib->resize(); /*--------- Create Thumb -------*/
				}
				else{
					//$config['new_image'] 		= 'images/gallery/thumb';
					$config['create_thumb']   	= false;
					$config['maintain_ratio'] 	= true;
					$config['width']  			= 300;
					$config['height'] 			= 200;

					$this->image_lib->initialize($config);
					$this->image_lib->resize(); /*-------- Create Thumb -------*/
				}
				
				if($tbl_name=='news_common_info'){
					$config = array();
					$config['image_library']  = 'GD2';
					$config['source_image']   = $uploaddata['full_path'];
					$config['new_image']      = $directory.'small'; //$config['new_image'] = 'images/news/small';
					$config['quality']		  = '80%';
					$config['create_thumb']   = false;
					$config['maintain_ratio'] = TRUE;
					$config['width']          = 150;
					$config['height']         = 100;
					
					$this->image_lib->initialize($config);
					$this->image_lib->resize(); /*--------- Create Thumb -------*/
				}
			}


			/********* Insert pic_type (.jpg) in db ***********/
			if($tbl_name=='banner_info') /*-------- For Banner -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('ban_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='prog_info') /*-------- For Program -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('p_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='tbl_share') /*-------- For Share Image -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('share_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='service_info') /*-------- For Service-------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('s_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='common_details') /*-------- Personal Image -------*/
			{
				$this->db->set('news_pic_type', $img_ext);       
				$this->db->where('news_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='user_file_info') /*-------- Personal Image -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('file_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='officer_info') /*-------- Member's Image -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('officer_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='news_common_info') /*-------- News Image -------*/
			{
				// $this->db->set('img_ext', $img_ext);       
				// $this->db->where('news_id',$last_id);
				// $this->db->update($tbl_name);
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('news_id',$last_id);
				$this->db->update('news_common_info');
				
				$img_array = array();
    			$img_array['image_library'] = 'gd2';
    			$img_array['overwrite']     = true;
    			$img_array['maintain_ratio'] = TRUE;
    			$img_array['create_thumb'] = FALSE;
    			//you need this setting to tell the image lib which image to process
    			$img_array['quality'] = '90%';
    			$img_array['source_image'] = $fInfo['full_path'];
    			$img_array['width'] = 720;
    			$img_array['height'] = 400;
    
    			$this->image_lib->clear(); // added this line
    			$this->image_lib->initialize($img_array); // added this line
    			if (!$this->image_lib->resize())
    			$data['status'] = 'successful';
			}
			else if($tbl_name=='media_info') /*-------- Media Image -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('media_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='news_gallery_info') /*-------- NEWS GALLERY INFO -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('img_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='member_info') /*-------- NEWS GALLERY INFO -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='add_info') /*-------- NEWS ADVERTISE INFO -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('add_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='users') /*-------- NEWS USERS INFO -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('id',$last_id);
				$this->db->update($tbl_name);
			}

			else if($tbl_name=='writer_info') /*-------- WRITER INFO -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('writer_id',$last_id);
				$this->db->update($tbl_name);
			}
			else if($tbl_name=='opinion_info') /*-------- OPINION INFO -------*/
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('opinion_id',$last_id);
				$this->db->update($tbl_name);
			}


			else
			{
				$this->db->set('img_ext', $img_ext);       
				$this->db->where('pic_id',$last_id);
				$this->db->update($tbl_name);
			}

			
			/*---------- End of Insert pic_type (.jpg) in db --------*/	
			$data['status'] = 'successful';
		}
	}
?>