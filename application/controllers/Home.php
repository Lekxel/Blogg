<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	public function index()
	{
		$this->db->select('*');
		$this->db->from('blog_posts');
		$this->db->order_by('id', 'DESC');
		$data['posts'] = $this->db->get()->result();

		$this->db->select('option_value');
    	$this->db->from('site_settings');
   		$this->db->where('option_name', "site_name");
    	$site_name = $this->db->get()->row('option_value');
    	$data["site_name"] = $site_name;
    	$data['pageTitle'] = $site_name;
		$this->load->view('header',$data);
		$this->load->view('home-index',$data);
		
	}
}
