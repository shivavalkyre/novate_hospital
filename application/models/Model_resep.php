<?php 

class Model_resep extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getResep()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'RES_NO';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_resep']) ? strval($_POST['search_resep']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rmd_resep')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_rmd_resep
            where concat(RES_NO,'',RES_OBAT)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function getResepSelected($id)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'RES_NO';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_resep']) ? strval($_POST['search_resep']) : '';
        $offset = ($page-1)*$rows;

        $result = array();

        $query = "SELECT count(*) as total from hms_resep_view where LYN_ID = '$id'";
        $data_total = $this->db->query($query)->row();
        $result['total'] = $data_total->total;
        $row = array();

        // select data from table product
        // $query = "SELECT *
        //     from sales_order_details_view
        //     where concat(product_name,'',id)  like '%$search%' order by $sort $order limit $offset, $rows";

        $query = "SELECT * from hms_resep_view
        where LYN_ID = '$id' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

   
    public function getResepAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rmd_resep')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_rmd_resep";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveResep()
    {
        $data = [
            'RES_OBAT' => $this->input->post('RES_OBAT'),
            'RES_ATURAN_PAKAI' => $this->input->post('RES_ATURAN_PAKAI'),
            'RES_DOSIS' => $this->input->post('RES_DOSIS'),
            'RES_SATUAN' => $this->input->post('RES_SATUAN'),
            'LYN_ID' => $this->input->post('LYN_ID'),
            'PAM_ID' => $this->input->post('PAM_ID'),
        ];
        // $this->db->insert('hms_Resep',$data);
        return $this->db->insert('hms_rmd_Resep',$data);
    }

    public function updateResep($id)
    {
        $data = [
            'RES_OBAT' => $this->input->post('RES_OBAT'),
            'RES_ATURAN_PAKAI' => $this->input->post('RES_ATURAN_PAKAI'),
            'RES_DOSIS' => $this->input->post('RES_DOSIS'),
            'RES_SATUAN' => $this->input->post('RES_SATUAN'),
            'LYN_ID' => $this->input->post('LYN_ID'),
            'PAM_ID' => $this->input->post('PAM_ID'),
        ];
        $this->db->where('RES_NO',$id);
        $this->db->set($data);
        return $this->db->update('hms_rmd_resep');
    }

    public function destroyResep($id)
    {
        $this->db->where('RES_NO',$id);
        return $this->db->delete('hms_rmd_resep');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}