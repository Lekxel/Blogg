<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model('user_model');

		$this->load->helper('form');
		$this->load->helper('email');
		$this->load->library('email');
		$this->load->library('form_validation');

	}
	
	public function index()
	{
		if(!$this->session->userdata('loggedin') == TRUE) {
			redirect('home');
		}

		if($this->input->post('site-settings')) {
			$this->form_validation->set_rules('site_name','Site Name','trim|required|strip_tags');
			$this->form_validation->set_rules('allow_comment','Allow Comment','trim|required|strip_tags');

			if($this->form_validation->run() == TRUE) {
				$site_name = $this->input->post('site_name',TRUE);
				$allow_comment = $this->input->post('allow_comment',TRUE);

				$this->db->set('option_value',$site_name);
				$this->db->where("option_name","site_name");
				$this->db->update("site_settings");

				$this->db->set('option_value',$allow_comment);
				$this->db->where("option_name","allow_comment");
				$this->db->update("site_settings");

				$this->session->set_flashdata('success_alert', "Site settings updated!");
				redirect('admin');
			}



		}

		//Get posts
		$this->db->select('*');
		$this->db->from('blog_posts');
		$this->db->where('author',$this->session->userdata('name'));
		$this->db->order_by('id', 'DESC');
		$data['posts'] = $this->db->get()->result();
		
		$this->db->select('option_value');
    	$this->db->from('site_settings');
   		$this->db->where('option_name', "site_name");
    	$site_name = $this->db->get()->row('option_value');
    	$data["site_name"] = $site_name;
    	$data['pageTitle'] = "Admin Dashboard - ".$site_name;
		$this->load->view('header',$data);
		$this->load->view('admin-index',$data);
		
	}

	public function create()
	{
		if(!$this->session->userdata('loggedin') == TRUE) {
			redirect('home');
		}

		//When the form is submitted		
		if ($this->input->post('title') AND $this->input->post('content')) {

			$this->form_validation->set_rules('title','Post Title','trim|required|strip_tags');

			$this->form_validation->set_rules('content','Post Content','trim|required');


			if($this->form_validation->run() == TRUE) {
				$title = $this->input->post('title',TRUE);
				$content = $this->input->post('content',TRUE);

				function random_string($length) {
	    			$key = '';
	    			$keys = array_merge(range(0, 9), range('a', 'z'));

	 		   		for ($i = 0; $i < $length; $i++) {
	        			$key .= $keys[array_rand($keys)];
	    			}

	    			return $key;
				}
				
				$link = random_string(10);

				$postt['title'] = $title;
				$postt['content'] = $content;
				$postt['comments'] = 0;
				$postt['author'] = $this->session->userdata('name');
				$postt['link'] = $link;
				$postt['created'] = date('Y-m-j H:i:s');
				$postt['updated'] = date('Y-m-j H:i:s');

				$this->db->insert('blog_posts', $postt);

				$this->session->set_flashdata('success_alert', "New Post has been created!");
				redirect('admin');
			}
		}


		$this->db->select('option_value');
    	$this->db->from('site_settings');
   		$this->db->where('option_name', "site_name");
    	$site_name = $this->db->get()->row('option_value');
    	$data["site_name"] = $site_name;
    	$data['pageTitle'] = "Create New Post - ".$site_name;
		$this->load->view('header',$data);
		$this->load->view('admin-create',$data);

	}

	public function edit()
	{
		if(!$this->session->userdata('loggedin') == TRUE) {
			redirect('home');
		}

		if($this->uri->segment(3) == "") {
			redirect('admin');
		}

		else {
    		$link = $this->uri->segment(3);
		}


		$post_query = $this->db->query("SELECT * FROM blog_posts WHERE link='$link';");

		$theQuery = $post_query->row();

		if (!isset($theQuery)) {

			$this->session->set_flashdata("error_alert","Post does not exist!");
			redirect('admin');
		}

		else{

	        $data['title'] = $theQuery->title;

	        $data['content'] = $theQuery->content;

    	}

    	//When the form is submitted		
		if ($this->input->post('title') AND $this->input->post('content')) {

			$this->form_validation->set_rules('title','Post Title','trim|required|strip_tags');

			$this->form_validation->set_rules('content','Post Content','trim|required');


			if($this->form_validation->run() == TRUE) {
				$title = $this->input->post('title',TRUE);
				$content = $this->input->post('content',TRUE);

				$this->db->set('title',$title);
				$this->db->set('content',$content);
				$this->db->set('updated',date('Y-m-j H:i:s'));
				$this->db->where("link",$link);
				$this->db->update("blog_posts");

				$this->session->set_flashdata('success_alert', "Post Updated!");
				redirect('admin');
			}
		}


    	$this->db->select('option_value');
    	$this->db->from('site_settings');
   		$this->db->where('option_name', "site_name");
    	$site_name = $this->db->get()->row('option_value');
    	$data["site_name"] = $site_name;
    	$data['pageTitle'] = "Edit Post - ".$site_name;
		$this->load->view('header',$data);
		$this->load->view('admin-edit',$data);
	}

	public function remove()
	{
		if(!$this->session->userdata('loggedin') == TRUE) {
			redirect('home');
		}

		if($this->uri->segment(3) == "") {
			redirect('admin');
		}

		else {
    		$link = $this->uri->segment(3);
		}

	 	$this->db->select('link');
    	$this->db->from('blog_posts');
   		$this->db->where('link', $link);
    	$link = $this->db->get()->row('link');

    	if($link) {
    		$this->db->where('link', $link);
    		$this->db->delete('blog_posts');

     		$this->session->set_flashdata("success_alert","Post Deleted Successfully!");
  			redirect("admin");
    	}

    	else{
    		$this->session->set_flashdata("error_alert","Post does not exist!");
  			redirect("admin");
    	}
    }

    public function login() {

    	if($this->session->userdata('loggedin') == TRUE) {
			redirect('admin');
		}

    	$data["allAdmin"] = $this->db->count_all("admin");

		if ($this->input->post('signupBtn')) {
			if ($this->input->post('username') AND $this->input->post('password')AND $this->input->post('email')AND $this->input->post('name')) {

	        	
	        	//Username
	          	$this->form_validation->set_rules('username','Username','trim|alpha_numeric|required|is_unique[admin.username]',array('alpha_numeric' => 'Username must be alpha Numeric!'));

	          	//Email
	          	$this->form_validation->set_rules('email','Email','trim|required|valid_email|is_unique[admin.email]');

	          	//Name
	          	$this->form_validation->set_rules('name','Name','trim|required|alpha');

	        	//Password
	        	$this->form_validation->set_rules('password','Password','required|min_length[5]');

				//If form inputs are valid
	         	if ($this->form_validation->run() == TRUE) {
	       
		            $username = $this->input->post('username');
		            $email = $this->input->post('email');
		            $name = $this->input->post('name');
		            $password = $this->input->post('password');
		            $password = password_hash($password,PASSWORD_BCRYPT);
		            
					$admin['username'] = $username;
					$admin['name'] = $name;
					$admin['email'] = $email;
					$admin['password'] = $password;
					$admin['last_logged'] = date('Y-m-j H:i:s');

					//Add the details to database
	            	$this->db->insert('admin', $admin);
	            	redirect('admin/login');
	            }
	        }
	    }

		elseif ($this->input->post('loginBtn')) {
			if ($this->input->post('username') AND $this->input->post('password')) {

        	
        		//Username
          		$this->form_validation->set_rules('username','Username','trim|alpha_numeric|required',array('alpha_numeric' => 'Username must be alpha Numeric!'));

           		//Password
          		$this->form_validation->set_rules('password','Password','required|min_length[5]');

				//If form inputs are valid
         		if ($this->form_validation->run() == TRUE) {
       
		            $username = $this->input->post('username');
		            $password = $this->input->post('password');

		            if($this->user_model->can_login($username, $password)) {

		            	$this->db->set('last_logged',date('Y-m-j H:i:s'));
						$this->db->where("username",$username);
						$this->db->update("admin");

						//Get name of admin
						$this->db->select('name');
    					$this->db->from('admin');
   						$this->db->where('username', $username);
    					$name = $this->db->get()->row('name');

    					//Set login session
             	  		$this->session->set_userdata('username',$username);
             	  		$this->session->set_userdata('name',$name);
						$this->session->set_userdata('loggedin', TRUE);

						redirect('admin');

					}
				}
			}
		}

		$this->db->select('option_value');
    	$this->db->from('site_settings');
   		$this->db->where('option_name', "site_name");
    	$site_name = $this->db->get()->row('option_value');
    	$data["site_name"] = $site_name;
    	$data['pageTitle'] = "Admin Login - ".$site_name;
		$this->load->view('header',$data);
		$this->load->view('admin-login',$data);
	}
}
