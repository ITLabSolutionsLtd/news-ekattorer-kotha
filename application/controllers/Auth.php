<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Auth extends CI_Controller
{
	function __construct()
	{
		parent::__construct();

		$this->load->helper(array('form', 'url'));
		$this->output->set_header("Cache-Control: no-store, no-cache, must-revalidate");
		$this->load->library('form_validation');
		$this->load->helper('security');
		$this->load->library('tank_auth');
		$this->lang->load('tank_auth');
	}

	function index()
	{
		if ($message = $this->session->flashdata('message')) {
			$this->load->view('auth/general_message', array('message' => $message));
		} else {
			redirect('/auth/login/');
		}
	}

	/**
	 * Login user on the site
	 *
	 * @return void
	 */

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

	function login()
	{

		$this->db->cache_off(); 
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		$data['selected'] = 'sign_in';
		

	
		/*if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} else if ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {*/
		
			$data['login_by_username'] = ($this->config->item('login_by_username', 'tank_auth') AND
					$this->config->item('use_username', 'tank_auth'));
			$data['login_by_email'] = $this->config->item('login_by_email', 'tank_auth');

			$this->form_validation->set_rules('login', 'Username/Email', 'trim|required|xss_clean');
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('remember', 'Remember me', 'integer');

			// Get login for counting attempts to login
			if ($this->config->item('login_count_attempts', 'tank_auth') AND
					($login = $this->input->post('login'))) {
				$login = $this->security->xss_clean($login);
			} else {
				$login = '';
			}

			$data['errors'] = array();
			if ($this->form_validation->run()) {
				if ($this->tank_auth->login(
					$this->form_validation->set_value('login'),
					$this->form_validation->set_value('password'),
					$this->form_validation->set_value('remember'),
					$data['login_by_username'],
					$data['login_by_email'])) {
					redirect(base_url('panel'));

				} else {
					$errors = $this->tank_auth->get_error_message();
					if (isset($errors['banned'])) {								// banned user
						$this->_show_message($this->lang->line('auth_message_banned').' '.$errors['banned']);

					} elseif (isset($errors['not_activated'])) {				// not activated user
						redirect('/auth/send_again/');

					} else {													// fail
						foreach ($errors as $k => $v)	$data['errors'][$k] = '<p>'.$this->lang->line($v).'</p>';

						// echo $this->lang->line($v); die(); 
					}
					
				}
			}
			// $data['show_captcha'] = FALSE;
			// if ($this->tank_auth->is_max_login_attempts_exceeded($login)) {
			// 	$data['show_captcha'] = TRUE;
			// 	if ($data['use_recaptcha']) {
			// 		$data['recaptcha_html'] = $this->_create_recaptcha();
			// 	} else {
			// 		$data['captcha_html'] = $this->_create_captcha();
			// 	}
			// }
			//$this->load->view('auth/login_form', $data);
			
			// $data['main_content']= 'auth/login_form';
		
			$this -> load -> view('auth/login_form',$data);
			//$this -> load -> view('include/template',$data);
		//}
	}

	/**
	 * Logout user
	 *
	 * @return void
	 */
	function logout()
	{
		$this->tank_auth->logout();
		
		redirect('auth/login');
		//$this->_show_message($this->lang->line('auth_message_logged_out'));
	}

	/**
	 * Register user on the site
	 *
	 * @return void
	 */
	
	function register()
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		$data['selected'] = '';
		
		/*
		if($data['user_type']== 5 || $data['user_type'] == 7)
		{
			//if(!$this->tank_auth->is_logged_in())
			redirect('');
			
		}
		else
		*/
			//if(!$this->tank_auth->is_logged_in()) {									// Not logged in then redirect to home 
			if($this->tank_auth->is_logged_in() && $data['user_type']==1) {									// Not logged in then redirect to home 
				redirect('');

			} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
				redirect('/auth/send_again/');

			} elseif (!$this->config->item('allow_registration', 'tank_auth')) {	// registration is off
				$this->_show_message($this->lang->line('auth_message_registration_disabled'));

			} else {
				$use_username = $this->config->item('use_username', 'tank_auth');
				if ($use_username) {
					$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean|is_unique[users.username]|min_length['.$this->config->item('username_min_length', 'tank_auth').']|max_length['.$this->config->item('username_max_length', 'tank_auth').']');
				}
				
				$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email|is_unique[users.email]');
				$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']');
				$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|xss_clean|matches[password]');
				$this->form_validation->set_rules('user_full_name', 'Name', 'trim|required|xss_clean');
				$this->form_validation->set_rules('user_type2', 'Type', 'trim|required|xss_clean');
				$this->form_validation->set_rules('user_address', 'Address', 'trim|required|xss_clean');
				
				$captcha_registration	= $this->config->item('captcha_registration', 'tank_auth');
				$use_recaptcha			= $this->config->item('use_recaptcha', 'tank_auth');
				if ($captcha_registration) {
					if ($use_recaptcha) {
						$this->form_validation->set_rules('recaptcha_response_field', 'Confirmation Code', 'trim|xss_clean|required|callback__check_recaptcha');
					} else {
						$this->form_validation->set_rules('captcha', 'Confirmation Code', 'trim|xss_clean|required|callback__check_captcha');
					}
				}
				$data['errors'] = array();

				$email_activation = $this->config->item('email_activation', 'tank_auth');

				

				if ($this->form_validation->run()) {
					
					if (!is_null($data = $this->tank_auth->create_user(
							$use_username ? $this->form_validation->set_value('username') : '',
							$this->form_validation->set_value('user_full_name'),
							$this->form_validation->set_value('user_address'),
							$this->input->post('user_status'),
							$this->input->post('contact_no'),
							$this->form_validation->set_value('email'),
							$this->form_validation->set_value('password'),
							$this->form_validation->set_value('user_type2'),
							
							$email_activation))) {									// success

						$data['site_name'] = $this->config->item('website_name', 'tank_auth');

						// echo $data['user_id']; die(); 
						// Image Upload  
							
							$file= $_FILES['user_avatar']['name'];
							if($file)
							{
								$last_id   	=	$data['user_id'];
								$tbl_name 	= 	'users'; 
								$i			=	-10;
								$directory  =   "./images/users/";
								$this-> test_upload($last_id,$tbl_name,$i,$directory);
							}

						// Image Upload  

						if ($email_activation) {									// send "activate" email
							$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

							$this->_send_email('activate', $data['email'], $data);

							unset($data['password']); // Clear password (just for any case)
							$success_data['success_message'] = "User Added Successfully";
							$this->session->set_userdata($success_data);

							redirect('Admin/UsersList'); 

							// $this->_show_message($this->lang->line('auth_message_registration_completed_1'));

						} else {
							if ($this->config->item('email_account_details', 'tank_auth')) {	// send "welcome" email

								$this->_send_email('welcome', $data['email'], $data);
							}
							unset($data['password']); // Clear password (just for any case)

							$this->_show_message($this->lang->line('auth_message_registration_completed_2').' '.anchor('/auth/login/', 'Login'));
						}
					} else {
						$errors = $this->tank_auth->get_error_message();
						foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
					}
					
				}
				if ($captcha_registration) {
					// if ($use_recaptcha) {
					// 	$data['recaptcha_html'] = $this->_create_recaptcha();
					// } else {
					// 	$data['captcha_html'] = $this->_create_captcha();
					// }
				}
				
				$data['user_type'] = $this-> tank_auth -> get_user_type();
				$data['use_username'] = $use_username;
				$data['captcha_registration'] = $captcha_registration;
				$data['use_recaptcha'] = $use_recaptcha;

				/*
				$data['main_content']= 'auth/register_form';
				$this -> load -> view('include/template',$data);
				****/
				
				
				
				
				if($data['user_type']=='')
				{
					$data['main_content'] = 'user_registration';
					$this->load->view('include/template', $data);
				}
				else
				{			
					$data['status']='null';
					// $data['left_link'] = 'admin_panel/admin_registration_left_link';
					$data['content']= 'admin_pages/user_entry';
					$this -> load -> view('include/admin_template',$data);
				}
			}
		//}
		//else
			//redirect('it_lab/index');
	}

	/**
	 * Send activation email again, to the same or new email address
	 *
	 * @return void
	 */
	function send_again()
	{
		if (!$this->tank_auth->is_logged_in(FALSE)) {							// not logged in or activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->change_email(
						$this->form_validation->set_value('email')))) {			// success

					$data['site_name']	= $this->config->item('website_name', 'tank_auth');
					$data['activation_period'] = $this->config->item('email_activation_expire', 'tank_auth') / 3600;

					$this->_send_email('activate', $data['email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_activation_email_sent'), $data['email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/send_again_form', $data);
		}
	}

	/**
	 * Activate user account.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function activate()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Activate user
		if ($this->tank_auth->activate_user($user_id, $new_email_key)) {		// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_activation_completed').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_activation_failed'));
		}
	}

	/**
	 * Generate reset code (to change password) and send it to user
	 *
	 * @return void
	 */
	function forgot_password()
	{
		if ($this->tank_auth->is_logged_in()) {									// logged in
			redirect('');

		} elseif ($this->tank_auth->is_logged_in(FALSE)) {						// logged in, not activated
			redirect('/auth/send_again/');

		} else {
			$this->form_validation->set_rules('login', 'Email or login', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->forgot_password(
						$this->form_validation->set_value('login')))) {

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with password activation link
					$this->_send_email('forgot_password', $data['email'], $data);

					$this->_show_message($this->lang->line('auth_message_new_password_sent'));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/forgot_password_form', $data);
		}
	}

	/**
	 * Replace user password (forgotten) with a new one (set by user).
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_password()
	{
		$user_id		= $this->uri->segment(3);
		$new_pass_key	= $this->uri->segment(4);

		$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

		$data['errors'] = array();

		if ($this->form_validation->run()) {								// validation ok
			if (!is_null($data = $this->tank_auth->reset_password(
					$user_id, $new_pass_key,
					$this->form_validation->set_value('new_password')))) {	// success

				$data['site_name'] = $this->config->item('website_name', 'tank_auth');

				// Send email with new password
				$this->_send_email('reset_password', $data['email'], $data);

				$this->_show_message($this->lang->line('auth_message_new_password_activated').' '.anchor('/auth/login/', 'Login'));

			} else {														// fail
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		} else {
			// Try to activate user by password key (if not activated yet)
			if ($this->config->item('email_activation', 'tank_auth')) {
				$this->tank_auth->activate_user($user_id, $new_pass_key, FALSE);
			}

			if (!$this->tank_auth->can_reset_password($user_id, $new_pass_key)) {
				$this->_show_message($this->lang->line('auth_message_new_password_failed'));
			}
		}
		$this->load->view('auth/reset_password_form', $data);
	}

	/**
	 * Change user password
	 *
	 * @return void
	 */

	function change_user_data($id){
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();

		$this->load->model('admin_model');
		$data['spc_user_data'] = $this->admin_model->specific_user_data($id);

		$data['this_user'] = $data['spc_user_data'][0]->username; 
		

		$data['content']= 'admin_pages/user_edit';
		$this -> load -> view('include/admin_template',$data);

	}
	function edit_user_data($id){
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		

		$this->form_validation->set_rules('new_password', 'New Password', 'xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
		$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'xss_clean|matches[new_password]');

		if($this->form_validation->run() == FALSE){
			// $this->load->model('admin_model');
			// $data['spc_user_data'] = $this->admin_model->specific_user_data($id);
			// $data['content'] = 'admin_pages/user_edit';
			// $this->load->view('include/admin_template',$data);
			
		}
		else{
			$success_data['success_message'] = "User Profile Updated";
			$this->session->set_userdata($success_data);
			$data['success_message'] = "User Profile Updated Successfully";
		}
		if ($this->tank_auth->change_user_password($id,
			$this->form_validation->set_value('new_password'))) {
		}

		/******** Image Upload *******/  				
		$file= $_FILES['user_avatar']['name'];
		if($file)
		{
			$last_id   	=	$id;
			$tbl_name 	= 	"users"; 
			$i			=	'';
			$directory  =   "./images/users/";
			$this-> test_upload($last_id,$tbl_name,$i,$directory);
		}
		/******** Image Upload *******/ 
		
		$this->load->model('admin_model');
		$this->admin_model->edit_data($id);
		$this->cache_optimizer('edit', $id);	
		// $this->admin_model->edit_data($id, $this->form_validation->set_value('new_password'));
		$data['spc_user_data'] = $this->admin_model->specific_user_data($id);
		$data['this_user'] = $data['spc_user_data'][0]->username;
		$data['content']= 'admin_pages/user_edit';
		$this -> load -> view('include/admin_template',$data);
		


		
		
		

	}

	function change_password()
	{
		$data['user_name'] = $this-> tank_auth -> get_username();
		$data['user_full_name'] = $this-> tank_auth -> get_user_full_name();
		$data['user_type'] = $this-> tank_auth -> get_user_type();
		
		
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('old_password', 'Old Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('new_password', 'New Password', 'trim|required|xss_clean|min_length['.$this->config->item('password_min_length', 'tank_auth').']|max_length['.$this->config->item('password_max_length', 'tank_auth').']|alpha_dash');
			$this->form_validation->set_rules('confirm_new_password', 'Confirm new Password', 'trim|required|xss_clean|matches[new_password]');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->change_password(
						$this->form_validation->set_value('old_password'),
						$this->form_validation->set_value('new_password'))) {	// success
					$this->_show_message($this->lang->line('auth_message_password_changed'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			//$this->load->view('auth/change_password_form', $data);
			
			$data['status']='null';
			// $data['left_link'] = 'admin_panel/admin_user_password_link';
			$data['content']= 'auth/change_password_form';
			$this -> load -> view('include/admin_template',$data);
			// $this->load-view('auth/change_email_form');
		}
	}

	/**
	 * Change user email
	 *
	 * @return void
	 */
	function change_email()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|xss_clean|valid_email');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if (!is_null($data = $this->tank_auth->set_new_email(
						$this->form_validation->set_value('email'),
						$this->form_validation->set_value('password')))) {			// success

					$data['site_name'] = $this->config->item('website_name', 'tank_auth');

					// Send email with new email address and its activation link
					$this->_send_email('change_email', $data['new_email'], $data);

					$this->_show_message(sprintf($this->lang->line('auth_message_new_email_sent'), $data['new_email']));

				} else {
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/change_email_form', $data);
		}
	}

	/**
	 * Replace user email with a new one.
	 * User is verified by user_id and authentication code in the URL.
	 * Can be called by clicking on link in mail.
	 *
	 * @return void
	 */
	function reset_email()
	{
		$user_id		= $this->uri->segment(3);
		$new_email_key	= $this->uri->segment(4);

		// Reset email
		if ($this->tank_auth->activate_new_email($user_id, $new_email_key)) {	// success
			$this->tank_auth->logout();
			$this->_show_message($this->lang->line('auth_message_new_email_activated').' '.anchor('/auth/login/', 'Login'));

		} else {																// fail
			$this->_show_message($this->lang->line('auth_message_new_email_failed'));
		}
	}

	/**
	 * Delete user from the site (only when user is logged in)
	 *
	 * @return void
	 */
	function unregister()
	{
		if (!$this->tank_auth->is_logged_in()) {								// not logged in or not activated
			redirect('/auth/login/');

		} else {
			$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean');

			$data['errors'] = array();

			if ($this->form_validation->run()) {								// validation ok
				if ($this->tank_auth->delete_user(
						$this->form_validation->set_value('password'))) {		// success
					$this->_show_message($this->lang->line('auth_message_unregistered'));

				} else {														// fail
					$errors = $this->tank_auth->get_error_message();
					foreach ($errors as $k => $v)	$data['errors'][$k] = $this->lang->line($v);
				}
			}
			$this->load->view('auth/unregister_form', $data);
		}
	}

	/**
	 * Show info message
	 *
	 * @param	string
	 * @return	void
	 */
	function _show_message($message)
	{
		$this->session->set_flashdata('message', $message);
		redirect('/auth/');
	}

	/**
	 * Send email message of given type (activate, forgot_password, etc.)
	 *
	 * @param	string
	 * @param	string
	 * @param	array
	 * @return	void
	 */
	function _send_email($type, $email, &$data)
	{
		$this->load->library('email');
		$this->email->from($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->reply_to($this->config->item('webmaster_email', 'tank_auth'), $this->config->item('website_name', 'tank_auth'));
		$this->email->to($email);
		$this->email->subject(sprintf($this->lang->line('auth_subject_'.$type), $this->config->item('website_name', 'tank_auth')));
		$this->email->message($this->load->view('email/'.$type.'-html', $data, TRUE));
		$this->email->set_alt_message($this->load->view('email/'.$type.'-txt', $data, TRUE));
		$this->email->send();
	}

	/**
	 * Create CAPTCHA image to verify user as a human
	 *
	 * @return	string
	 */
	function _create_captcha()
	{
		$this->load->helper('captcha');

		$cap = create_captcha(array(
			'img_path'		=> './'.$this->config->item('captcha_path', 'tank_auth'),
			'img_url'		=> base_url().$this->config->item('captcha_path', 'tank_auth'),
			'font_path'		=> './'.$this->config->item('captcha_fonts_path', 'tank_auth'),
			'font_size'		=> $this->config->item('captcha_font_size', 'tank_auth'),
			'img_width'		=> $this->config->item('captcha_width', 'tank_auth'),
			'img_height'	=> $this->config->item('captcha_height', 'tank_auth'),
			'show_grid'		=> $this->config->item('captcha_grid', 'tank_auth'),
			'expiration'	=> $this->config->item('captcha_expire', 'tank_auth'),
		));

		// Save captcha params in session
		$this->session->set_flashdata(array(
				'captcha_word' => $cap['word'],
				'captcha_time' => $cap['time'],
		));

		return $cap['image'];
	}

	/**
	 * Callback function. Check if CAPTCHA test is passed.
	 *
	 * @param	string
	 * @return	bool
	 */
	function _check_captcha($code)
	{
		$time = $this->session->flashdata('captcha_time');
		$word = $this->session->flashdata('captcha_word');

		list($usec, $sec) = explode(" ", microtime());
		$now = ((float)$usec + (float)$sec);

		if ($now - $time > $this->config->item('captcha_expire', 'tank_auth')) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_captcha_expired'));
			return FALSE;

		} elseif (($this->config->item('captcha_case_sensitive', 'tank_auth') AND
				$code != $word) OR
				strtolower($code) != strtolower($word)) {
			$this->form_validation->set_message('_check_captcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}

	/**
	 * Create reCAPTCHA JS and non-JS HTML to verify user as a human
	 *
	 * @return	string
	 */
	function _create_recaptcha()
	{
		$this->load->helper('recaptcha');

		// Add custom theme so we can get only image
		$options = "<script>var RecaptchaOptions = {theme: 'custom', custom_theme_widget: 'recaptcha_widget'};</script>\n";

		// Get reCAPTCHA JS and non-JS HTML
		// $html = recaptcha_get_html($this->config->item('recaptcha_public_key', 'tank_auth'));

		// return $options.$html;
	}

	/**
	 * Callback function. Check if reCAPTCHA test is passed.
	 *
	 * @return	bool
	 */
	function _check_recaptcha()
	{
		$this->load->helper('recaptcha');

		$resp = recaptcha_check_answer($this->config->item('recaptcha_private_key', 'tank_auth'),
				$_SERVER['REMOTE_ADDR'],
				$_POST['recaptcha_challenge_field'],
				$_POST['recaptcha_response_field']);

		if (!$resp->is_valid) {
			$this->form_validation->set_message('_check_recaptcha', $this->lang->line('auth_incorrect_captcha'));
			return FALSE;
		}
		return TRUE;
	}


	// Test Upload 
	public function test_upload($last_id, $tbl_name, $i, $directory = '')
	{
	    $this->load->model('image_upload');
		if ($i > 0) {
			$_FILES['user_avatar'] = $_FILES['user_avatar' . $i . ''];
		}
		else if ($_FILES['user_avatar']['error'] == 0) {
			if ($i > 0) {
				$filename 				= $_FILES['user_avatar' . $i . '']['name']; /*-- Original Uploaded pic name (mad.jpg) */
				$filetype 				= $_FILES['user_avatar' . $i . '']['type'];  /*--- png|jpg|gif ---*/
				$file_content 			= $_FILES['user_avatar' . $i . '']['tmp_name'];  /*-- Xampp ar vitor tmp file ar location --*/
				$_FILES['user_avatar']	= $_FILES['user_avatar' . $i . ''];
			} else {
				$file_name		= $_FILES['user_avatar']['name'];
				$filetype 		= $_FILES['user_avatar']['type'];
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
	// Test Upload 

	/***************************************************************************/
	/*--------------------------------- DB CACHE SYSTEM -----------------------*/
	/***************************************************************************/

	function cache_optimizer($action, $newsID)
	{

		$result = $row = $this->admin_model->cache_news_search($newsID); //print_r($row);

		if ($row) {
			$subCatID 		= ($row->sub_cat_id != 0) ? $row->sub_cat_id : '';
			$subCatName     = '';

			if ($subCatID) {
				$subCatName = $this->db->select('sub_cat_key_name')->from('sub_category_info')->where('sub_category_id', $subCatID)->get()->row()->sub_cat_key_name;
				$subCatName = strtolower($subCatName);
			}
			//echo $row-> news_id.' >>> '.$subCatID.' >>> '.$subCatName;

			$this->db->cache_delete('default', 'index');   // HOME

			if ($action == 'edit') {
				$this->db->cache_delete('news', $row->news_id);
			}  // ARTICLE 
			if ($subCatName) {
				$this->db->cache_delete($row->cat_key_name, 'index');
			}     // CATEGORY
			if ($subCatID) {
				$this->db->cache_delete($row->cat_key_name, $subCatName);
			}     // SUB CATEGORY
		}
		return true;
	}

	function clear_all_cache()
	{
		$this->db->cache_delete_all();
	}

}

/* End of file auth.php */
/* Location: ./application/controllers/auth.php */