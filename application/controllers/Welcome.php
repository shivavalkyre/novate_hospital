<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_customers']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('welcome_message');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate"
			</script>';
		}
		
	}
	public function getCustomers()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_customers->getCustomers();
		echo json_encode($employee);
	}

	public function getCustomersAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_customers->getCustomersAll();
		echo json_encode($employee);
	}

	public function getCustomersInvoiceSelected($id)
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_customers->getCustomersInvoiceSelected($id);
		echo json_encode($employee);
	}

	public function getCustomersInvoice()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_customers->getCustomersInvoice();
		echo json_encode($employee);
	}

	public function saveCustomer()
	{
		$input = $this->model_customers->saveCustomer();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateCustomer($id)
	{
		$input = $this->model_customers->updateCustomer($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyCustomer()
	{
		$id = intval($_REQUEST['id']);
		$input = $this->model_customers->destroyCustomer($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
