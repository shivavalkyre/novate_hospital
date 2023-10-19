<?php 

class Model_tindakan extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getTindakan()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'TIN_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_Tindakan']) ? strval($_POST['search_Tindakan']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rmd_tindakan')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_rmd_tindakan
            where concat(TIN_ID,'',TIN_TYPE,'',TIN_KETERANGAN)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function getTindakanSelected($id)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'TIN_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_Tindakan']) ? strval($_POST['search_Tindakan']) : '';
        $offset = ($page-1)*$rows;

        $result = array();

        $query = "SELECT count(*) as total from hms_tindakan_view where LYN_ID = '$id'";
        $data_total = $this->db->query($query)->row();
        $result['total'] = $data_total->total;
        $row = array();

        // select data from table product
        // $query = "SELECT *
        //     from sales_order_details_view
        //     where concat(product_name,'',id)  like '%$search%' order by $sort $order limit $offset, $rows";

        $query = "SELECT * from hms_tindakan_view
        where LYN_ID = '$id' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

   
    public function getTindakanAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rmd_tindakan')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_rmd_tindakan";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveTindakan()
    {
        $data = [
            'TIN_TYPE' => $this->input->post('TIN_TYPE'),
            'TIN_KETERANGAN' => $this->input->post('TIN_KETERANGAN'),
            'LYN_ID' => $this->input->post('LYN_ID'),
            'PAM_ID' => $this->input->post('PAM_ID'),
        ];
        // $this->db->insert('hms_Tindakan',$data);
        return $this->db->insert('hms_rmd_tindakan',$data);
    }

    public function updateTindakan($id)
    {
        $data = [
            'TIN_TYPE' => $this->input->post('TIN_TYPE'),
            'TIN_KETERANGAN' => $this->input->post('TIN_KETERANGAN'),
            'LYN_ID' => $this->input->post('LYN_ID'),
            'PAM_ID' => $this->input->post('PAM_ID'),
        ];
        $this->db->where('TIN_ID',$id);
        $this->db->set($data);
        return $this->db->update('hms_rmd_tindakan');
    }

    public function destroyTindakan($id)
    {
        $this->db->where('TIN_ID',$id);
        return $this->db->delete('hms_rmd_tindakan');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}