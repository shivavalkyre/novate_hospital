<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model(['model_products']);
	}
	public function index()
	{
		$id = $this->session->userdata("id");
		
		if ($id){
			$this->load->view('product');
		}else{
			echo '<script type="text/javascript">
				top.window.location= "/novate"
			</script>';
		}
		
	}
	public function getProducts()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_products->getProducts();
		echo json_encode($employee);
	}

	public function getProductInvoiceDetail($id)
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_products->getProductInvoiceDetail($id);
		echo json_encode($employee);
	}

	public function getProductInvoiceDetailSelected($id,$id_product,$id_invoice_detail)
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_products->getProductInvoiceDetailSelected($id,$id_product,$id_invoice_detail);
		echo json_encode($employee);
	}

	public function getProductsAll()
	{
		$this->output->set_content_type('application/json');
		$employee = $this->model_products->getProductsAll();
		echo json_encode($employee);
	}

	public function saveProduct()
	{
		$input = $this->model_products->saveProduct();
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}

	public function updateProduct($id)
	{
		$input = $this->model_products->updateProduct($id);
		if ($input) {
			echo json_encode(['success' => true]);
		}else {
			echo json_encode(['Msg'=>'Some Error occured!.']);
		}
	}
	public function destroyProduct()
	{
		$id = intval($_REQUEST['id']);
		$input = $this->model_products->destroyProduct($id);
		if ($input) {
			echo json_encode(array('success'=>true));
		}else {
			echo json_encode(array('errorMsg'=>'Some errors occured.'));
		}
	}
}
