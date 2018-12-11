<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Post extends CI_Controller {
	
	public function index()
	{
		if($this->uri->segment(3) == "") {
			redirect('home');
		}

		else {
    		$link = $this->uri->segment(3);
		}


		$post_query = $this->db->query("SELECT * FROM blog_posts WHERE link='$link';");

		$theQuery = $post_query->row();

		if (!isset($theQuery)) {

			redirect('home');
		}

		else{

	        $postTitle = $theQuery->title;
	        $data['title'] = $postTitle;

	        $data['content'] = $theQuery->content;
	        $data['comments_num'] = $theQuery->comments;
	        $data['author'] = $theQuery->author;
	        $edate = strtotime($theQuery->updated);
			$edate = date('d-m-Y h:i a', $edate);
	        $data['updated'] =  $edate;
	        $post_id = $theQuery->id;
	        $data['post_id'] = $post_id;

		}
		

		$this->db->select('option_value');
    	$this->db->from('site_settings');
   		$this->db->where('option_name', "allow_comment");
    	$data['allow_comment'] = $this->db->get()->row('option_value');

		$this->db->select('*');
  		$this->db->from('comments');
    	$this->db->where('post_id', $post_id);
    	$this->db->order_by('id', 'DESC');
    	$data['comments'] = $this->db->get()->result();

		$this->db->select('option_value');
    	$this->db->from('site_settings');
   		$this->db->where('option_name', "site_name");
    	$site_name = $this->db->get()->row('option_value');
    	$data["site_name"] = $site_name;
    	$data['pageTitle'] = $postTitle." - ".$site_name;
		$this->load->view('header',$data);
		$this->load->view('post-index',$data);
		
	}

	public function comment()
	{
		if($this->input->post('post_id') AND $this->input->post('name') AND $this->input->post('comment_body')) {
		
			//Name
	        $this->form_validation->set_rules('name','Name','trim|alpha|strip_tags',array('alpha' => 'Name must be alphabet only!'));

	        //Comment Body
	        $this->form_validation->set_rules('comment_body','Comment Body','required|strip_tags');

	        if ($this->form_validation->run() == TRUE) {

	        	$post_id = $this->input->post('post_id');
	        	$author = $this->input->post('name');
	        	$content = $this->input->post('comment_body');

	        	$comment['post_id'] = $post_id;
	        	$comment['author'] = $author;
	        	$comment['content'] = $content;
				$comment['created'] = date('Y-m-j H:i:s');

				//Add the comment to database
				$this->db->insert('comments', $comment);

				//Get the number of comments of the post
				$this->db->select('comments');
	    		$this->db->from('blog_posts');
	   			$this->db->where('id', $post_id);
	    		$comm = $this->db->get()->row('comments');

	    		//Update the number of comments of the post
	    		$this->db->set('comments',$comm + 1);
				$this->db->where("id",$post_id);
				$this->db->update("blog_posts");

				$this->session->set_flashdata("success_alert","Comment added successfully!");
				redirect('home');

			}
		}

		else{
			redirect('home');
		}

	}


	

}
