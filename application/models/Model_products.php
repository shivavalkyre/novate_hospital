<?php 

class Model_products extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getProducts()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('products')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from products
            where concat(product_name,'',product_description,'',product_unit)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function getProductInvoiceDetail($id)
	{
		
        $result = array();

        $sql= "SELECT count(*) as total FROM sales_order_detail_product_listed_view WHERE customer_number='$id' AND os_qty>0";
        $data_total = $this->db->query($sql)->row();
        $result['total'] = $data_total->total;

        // select data from table product
        $query = "SELECT *
            from sales_order_detail_product_listed_view
            WHERE customer_number='$id' AND os_qty>0";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function getProductInvoiceDetailSelected($id,$id_product,$id_invoice_detail)
	{
		
        $result = array();

        $sql= "SELECT count(*) as total FROM sales_order_detail_product_view WHERE customer_number='$id' AND  id_so_detail='$id_product' AND id_invoice_detail='$id_invoice_detail' ";
        $data_total = $this->db->query($sql)->row();
        $result['total'] = $data_total->total;

        // select data from table product
        $query = "SELECT *
            from sales_order_detail_product_view
            WHERE customer_number='$id' AND  id_so_detail='$id_product' AND id_invoice_detail='$id_invoice_detail'";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function getProductsAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('products')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from products";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveProduct()
    {
        $data = [
            'product_name' => $this->input->post('product_name'),
            'product_description' => $this->input->post('product_description'),
            'product_unit' => $this->input->post('product_unit'),
        ];
        $this->db->insert('products',$data);
        return $this->db->insert_id();
    }

    public function updateProduct($id)
    {
        $data =  [
            'product_name' => $this->input->post('product_name'),
            'product_description' => $this->input->post('product_description'),
            'product_unit' => $this->input->post('product_unit'),
        ];

        $this->db->where('product_number',$id);
        $this->db->set($data);
        return $this->db->update('products');
    }

    public function destroyProduct($id)
    {
        $this->db->where('product_number',$id);
        return $this->db->delete('products');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}