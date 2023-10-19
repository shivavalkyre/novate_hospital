<?php 

class Model_keluhan extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getKeluhan()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'KEL_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_keluhan']) ? strval($_POST['search_keluhan']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rmd_keluhan')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_rmd_keluhan
            where concat(KEL_ID,'',KEL_TYPE,'',KEL_KETERANGAN)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function getKeluhanSelected($id)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'KEL_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_keluhan']) ? strval($_POST['search_keluhan']) : '';
        $offset = ($page-1)*$rows;

        $result = array();

        $query = "SELECT count(*) as total from hms_keluhan_view where LYN_ID = '$id'";
        $data_total = $this->db->query($query)->row();
        $result['total'] = $data_total->total;
        $row = array();

        // select data from table product
        // $query = "SELECT *
        //     from sales_order_details_view
        //     where concat(product_name,'',id)  like '%$search%' order by $sort $order limit $offset, $rows";

        $query = "SELECT * from hms_keluhan_view
        where LYN_ID = '$id' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

   
    public function getKeluhanAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rmd_keluhan')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_rmd_keluhan";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveKeluhan()
    {
        $data = [
            'KEL_TYPE' => $this->input->post('KEL_TYPE'),
            'KEL_KETERANGAN' => $this->input->post('KEL_KETERANGAN'),
            'LYN_ID' => $this->input->post('LYN_ID'),
            'USER_ID' => $this->input->post('USER_ID'),
            'NAMA_USER' => $this->input->post('NAMA_USER'),
            'PAM_ID' => $this->input->post('PAM_ID'),
        ];
        // $this->db->insert('hms_Keluhan',$data);
        return $this->db->insert('hms_rmd_keluhan',$data);
    }

    public function updateKeluhan($id)
    {
        $data = [
            'KEL_TYPE' => $this->input->post('KEL_TYPE'),
            'KEL_KETERANGAN' => $this->input->post('KEL_KETERANGAN'),
            'LYN_ID' => $this->input->post('LYN_ID'),
            'USER_ID' => $this->input->post('USER_ID'),
            'NAMA_USER' => $this->input->post('NAMA_USER'),
            'PAM_ID' => $this->input->post('PAM_ID'),
        ];
        $this->db->where('KEL_ID',$id);
        $this->db->set($data);
        return $this->db->update('hms_rmd_keluhan');
    }

    public function destroyKeluhan($id)
    {
        $this->db->where('KEL_ID',$id);
        return $this->db->delete('hms_rmd_keluhan');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}