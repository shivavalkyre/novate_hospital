<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_users']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('user');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate"
			</script>';
		}
		
	}
	public function getUsers()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_users->getUsers();
		echo json_encode($employee);
	}

	public function getUsersAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_users->getUsersAll();
		echo json_encode($employee);
	}

	public function saveUser()
	{
		$input = $this->model_users->saveUser();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateUser($id)
	{
		$input = $this->model_users->updateUser($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updatePassword(){
		$id = $_POST['id'];
		$password = md5($_POST['password']);
		
		$input = $this->model_users->updatePassword($id,$password);

		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function destroyUser()
	{
		$id = intval($_REQUEST['id']);
		$input = $this->model_users->destroyUser($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
