<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Rekam extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_rekam']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('rekam');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getRekam()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_rekam->getRekam();
		echo json_encode($employee);
	}

	

	public function getRekamAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_rekam->getRekamAll();
		echo json_encode($employee);
	}

	public function saveRekam()
	{
		$input = $this->model_rekam->saveRekam();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateRekam($id)
	{
		$input = $this->model_rekam->updateRekam($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyRekam()
	{
		$id = $_REQUEST['RMD_ID'];
		$input = $this->model_rekam->destroyRekam($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
