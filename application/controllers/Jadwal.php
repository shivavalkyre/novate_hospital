<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_jadwal']);
        $this->load->model(['model_jadwal_detail']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('jadwal');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate_hospital"
			</script>';
		}
		
	}
	public function getJadwal()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_jadwal->getJadwal();
		echo json_encode($employee);
	}

	

	public function getJadwalAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_jadwal->getJadwalAll();
		echo json_encode($employee);
	}

	public function saveJadwal()
	{
		$input = $this->model_jadwal->saveJadwal();
		if ($input) {

                echo json_encode(['success' => true]);
			
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateJadwal($id)
	{
		$input = $this->model_jadwal->updateJadwal($id);
		if ($input) {
           
                echo json_encode(['success' => true]);

			
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyJadwal()
	{
		$id = $_REQUEST['JAD_ID'];
		$input = $this->model_jadwal->destroyJadwal($id);
		if ($input) {
                echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
