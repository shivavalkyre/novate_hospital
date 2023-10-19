<?php 

class Model_main extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function cek_login($table,$where){		
		return $this->db->get_where($table,$where);
	}	

	function get_userid($table,$where){
		return $this->db->get_where($table,$where)->row();
	}
}