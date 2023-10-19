<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		// $this->load->model(['model_main']);
	}
	public function index()
	{
		// check session
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('home');
		}else{
			redirect(base_url('/'));
		}
		
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect(base_url('/'));
	}
}

