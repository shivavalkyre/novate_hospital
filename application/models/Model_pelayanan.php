<?php 

class Model_pelayanan extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getPelayanan()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'LYN_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_Pelayanan']) ? strval($_POST['search_pelayanan']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rmd_pelayanan')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_pelayanan_view
            where concat(LYN_ID,'',KUN_NO_ANTRI)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

   
    public function getPelayananAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rmd_pelayanan')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_pelayanan_view";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function savePelayanan()
    {
        $data = [
            'LYN_TANGGAL' => $this->input->post('LYN_TANGGAL'),
            'KUN_NO_ANTRI' => $this->input->post('KUN_NO_ANTRI'),
            'RMD_ID' => $this->input->post('RMD_ID'),
        ];
        // $this->db->insert('hms_Pelayanan',$data);
        return $this->db->insert('hms_rmd_pelayanan',$data);
    }

    public function updatePelayanan($id)
    {
        $data = [
            'LYN_TANGGAL' => $this->input->post('LYN_TANGGAL'),
            'KUN_NO_ANTRI' => $this->input->post('KUN_NO_ANTRI'),
            'RMD_ID' => $this->input->post('RMD_ID'),
        ];
        $this->db->where('RMD_ID',$id);
        $this->db->set($data);
        return $this->db->update('hms_rmd_pelayanan');
    }

    public function destroyPelayanan($id)
    {
        $this->db->where('LYN_ID',$id);
        return $this->db->delete('hms_rmd_pelayanan');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}