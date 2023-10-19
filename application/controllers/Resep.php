<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Resep extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_resep']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('resep');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getResep()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_resep->getResep();
		echo json_encode($employee);
	}

	public function getResepSelected($id)
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_resep->getResepSelected($id);
		echo json_encode($employee);
	}
	

	public function getResepAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_resep->getResepAll();
		echo json_encode($employee);
	}

	public function saveResep()
	{
		$input = $this->model_resep->saveResep();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateResep($id)
	{
		$input = $this->model_resep->updateResep($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyResep()
	{
		$id = $_REQUEST['RES_NO'];
		$input = $this->model_resep->destroyResep($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
