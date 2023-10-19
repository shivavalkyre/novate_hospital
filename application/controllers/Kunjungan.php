<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kunjungan extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_kunjungan']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('kunjungan');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getKunjungan()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_kunjungan->getKunjungan();
		echo json_encode($employee);
	}

	

	public function getKunjunganAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_kunjungan->getKunjunganAll();
		echo json_encode($employee);
	}

	public function saveKunjungan()
	{
		$input = $this->model_kunjungan->saveKunjungan();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateKunjungan($id)
	{
		$input = $this->model_kunjungan->updateKunjungan($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyKunjungan()
	{
		$id = $_REQUEST['KUN_NO_ANTRI'];
		$input = $this->model_kunjungan->destroyKunjungan($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
