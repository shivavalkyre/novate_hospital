<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Keluhan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_keluhan']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('keluhan');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getKeluhan()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_keluhan->getKeluhan();
		echo json_encode($employee);
	}

	public function getKeluhanSelected($id)
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_keluhan->getKeluhanSelected($id);
		echo json_encode($employee);
	}
	

	public function getKeluhanAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_keluhan->getKeluhanAll();
		echo json_encode($employee);
	}

	public function saveKeluhan()
	{
		$input = $this->model_keluhan->saveKeluhan();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateKeluhan($id)
	{
		$input = $this->model_keluhan->updateKeluhan($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyKeluhan()
	{
		$id = $_REQUEST['KEL_ID'];
		$input = $this->model_keluhan->destroyKeluhan($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
