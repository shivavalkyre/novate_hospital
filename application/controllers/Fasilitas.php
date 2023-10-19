<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fasilitas extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_fasilitas']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('fasilitas');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getFasilitas()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_fasilitas->getFasilitas();
		echo json_encode($employee);
	}

	

	public function getFasilitasAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_fasilitas->getFasilitasAll();
		echo json_encode($employee);
	}

	public function saveFasilitas()
	{
		$input = $this->model_fasilitas->saveFasilitas();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateFasilitas($id)
	{
		$input = $this->model_fasilitas->updateFasilitas($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyFasilitas()
	{
		$id = $_REQUEST['FAS_ID'];
		$input = $this->model_fasilitas->destroyFasilitas($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
