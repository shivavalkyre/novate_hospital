<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tindakan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_tindakan']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('tindakan');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getTindakan()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_tindakan->getTindakan();
		echo json_encode($employee);
	}

	public function getTindakanSelected($id)
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_tindakan->getTindakanSelected($id);
		echo json_encode($employee);
	}
	

	public function getTindakanAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_tindakan->getTindakanAll();
		echo json_encode($employee);
	}

	public function saveTindakan()
	{
		$input = $this->model_tindakan->saveTindakan();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateTindakan($id)
	{
		$input = $this->model_tindakan->updateTindakan($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyTindakan()
	{
		$id = $_REQUEST['TIN_ID'];
		$input = $this->model_tindakan->destroyTindakan($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
