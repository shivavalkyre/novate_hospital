<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pasien extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_pasien']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('pasien');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getPasien()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_pasien->getPasien();
		echo json_encode($employee);
	}

	

	public function getPasienAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_pasien->getPasienAll();
		echo json_encode($employee);
	}

	public function savePasien()
	{
		$input = $this->model_pasien->savePasien();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updatePasien($id)
	{
		$input = $this->model_pasien->updatePasien($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyPasien()
	{
		$id = $_REQUEST['PAS_NO_REG'];
		$input = $this->model_pasien->destroyPasien($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
