<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_main']);
	}
	public function index()
	{
		$this->load->view('main');
	}
	
	public function loginApp()
	{
		$username = $_POST['username'];
		$password =  md5($_POST['password']);
		// echo json_encode($username);
		// echo json_encode($password);
		// $username = $this->input->post('username');
		// $password = md5($this->input->post('password'));

		$data = array("username"=>$username, "password"=>$password);

		$cek = $this->model_main->cek_login("users",$data)->num_rows();

		if($cek > 0){
			$result = $this->model_main->get_userid("users",$data);
			$id = $result->id;
			$data_session = array(
				'nama' => $username,
				'status' => "login",
				'id' => $id
				);
 
			$this->session->set_userdata($data_session);

			$data = array("success" => true,"data" => $data_session);
			echo json_encode($data);
			// redirect(base_url("home"));
 
		}else{
			$message = "Username dan password salah !";
			$data = array("success" => false,"data" => $message);
			echo json_encode($data);
		}
		

	}
	public function logged(){
		redirect(base_url("home"));
	}
}

