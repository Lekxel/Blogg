<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

public function __construct() {
		
		parent::__construct();
}

public function create_user($user) {
$this->db->insert('users', $user);
		return $this->db->insert_id();		
	}

public function which_users($which) {
	$this->db->where('paid', $which);

 $query = $this->db->get("users");
 
       return $query->num_rows();
}

function can_login($username, $password)  
      {  
           $this->db->select('password');
		$this->db->from('admin');
		$this->db->where('username', $username);
		$hash = $this->db->get()->row('password');
		
		return password_verify($password, $hash);
      }
	
function allAdmin() {  

 return $this->db->count_all("admin");
}

}

?>