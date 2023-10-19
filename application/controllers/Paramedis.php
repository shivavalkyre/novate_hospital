<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Paramedis extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_paramedis']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('paramedis');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getParamedis()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_paramedis->getParamedis();
		echo json_encode($employee);
	}

	

	public function getParamedisAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_paramedis->getParamedisAll();
		echo json_encode($employee);
	}

	public function saveParamedis()
	{
		$input = $this->model_paramedis->saveParamedis();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateParamedis($id)
	{
		$input = $this->model_paramedis->updateParamedis($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyParamedis()
	{
		$id = $_REQUEST['PAM_ID'];
		$input = $this->model_paramedis->destroyParamedis($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
