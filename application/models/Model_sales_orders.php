<?php 

class Model_sales_orders extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getSalesOrders()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'sales_orders_view.id';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_sales']) ? strval($_POST['search_sales']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('sales_orders_view')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from sales_orders_view
            where concat(customer_name,'')  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function getLastSONumber ()
    {
        // $sql= "SELECT so_no FROM sales_orders WHERE Year(sales_orders.so_date) = year(curdate()) ORDER BY sales_orders.id DESC LIMIT 1";
        // $query = $this->db->query($sql);
        // $result = $query->row();
        // return $result;

         // select data from table so
        $result = array();
        $sql= "SELECT count(*) as total FROM (SELECT * FROM sales_orders WHERE Year(sales_orders.so_date) = year(curdate()) ORDER BY sales_orders.id DESC LIMIT 1) as table1";
        $data_total = $this->db->query($sql)->row();
        $result['total'] = $data_total->total;
        
        $row = array();
        $query = "SELECT so_no FROM sales_orders WHERE Year(sales_orders.so_date) = year(curdate()) ORDER BY sales_orders.id DESC LIMIT 1";

        $data_row = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $data_row]);
        return $result;
    }
   

    public function saveSalesOrder()
    {
        $data = [
            'customer_number' => $this->input->post('customer_number'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('customer_address'),
            'so_no' => $this->input->post('so_no'),
            'so_date' => $this->input->post('so_date'),
            'po_no' => $this->input->post('po_no'),
            'po_date' => $this->input->post('po_date'),
            'createdby' => $this->input->post('createdby'),
        ];
        $this->db->insert('sales_orders',$data);
        return $this->db->insert_id();
    }

    public function updateSalesOrder($id)
    {
        $data = [
            'customer_number' => $this->input->post('customer_number'),
            'customer_name' => $this->input->post('customer_name'),
            'customer_address' => $this->input->post('customer_address'),
            'so_no' => $this->input->post('so_no'),
            'so_date' => $this->input->post('so_date'),
            'po_no' => $this->input->post('po_no'),
            'po_date' => $this->input->post('po_date'),
            'createdby' => $this->input->post('createdby'),
            
        ];

        $this->db->where('id',$id);
        $this->db->set($data);
        return $this->db->update('sales_orders');
    }

    public function destroySalesOrder($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('sales_orders');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}