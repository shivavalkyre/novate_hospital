<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Diagnosis extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_diagnosis']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('diagnosis');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getDiagnosis()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_diagnosis->getDiagnosis();
		echo json_encode($employee);
	}

	public function getDiagnosisSelected($id)
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_diagnosis->getDiagnosisSelected($id);
		echo json_encode($employee);
	}
	

	public function getDiagnosisAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_diagnosis->getDiagnosisAll();
		echo json_encode($employee);
	}

	public function saveDiagnosis()
	{
		$input = $this->model_diagnosis->saveDiagnosis();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateDiagnosis($id)
	{
		$input = $this->model_diagnosis->updateDiagnosis($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyDiagnosis()
	{
		$id = $_REQUEST['DIA_ID'];
		$input = $this->model_diagnosis->destroyDiagnosis($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
