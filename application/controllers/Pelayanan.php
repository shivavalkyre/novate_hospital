<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pelayanan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_pelayanan']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('pelayanan');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getPelayanan()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_pelayanan->getPelayanan();
		echo json_encode($employee);
	}

	

	public function getPelayananAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_pelayanan->getPelayananAll();
		echo json_encode($employee);
	}

	public function savePelayanan()
	{
		$input = $this->model_pelayanan->savePelayanan();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updatePelayanan($id)
	{
		$input = $this->model_pelayanan->updatePelayanan($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyPelayanan()
	{
		$id = $_REQUEST['LYN_ID'];
		$input = $this->model_pelayanan->destroyPelayanan($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
