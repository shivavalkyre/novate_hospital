<?php 

class Model_rekam extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getRekam()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'RMD_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_rekam']) ? strval($_POST['search_rekam']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rekam_medik')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_rekam_medik
            where concat(RMD_ID,'',PAS_NO_REG,'',RMD_PAS_NAMA,'',RMD_GOL_DARAH)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

   
    public function getRekamAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rekam_medik')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_rekam_medik";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveRekam()
    {
        $data = [
            'PAS_NO_REG' => $this->input->post('PAS_NO_REG'),
            'RMD_PAS_NAMA' => $this->input->post('RMD_PAS_NAMA'),
            'RMD_GOL_DARAH' => $this->input->post('RMD_GOL_DARAH'),
        ];
        // $this->db->insert('hms_Rekam',$data);
        return $this->db->insert('hms_rekam_medik',$data);
    }

    public function updateRekam($id)
    {
        $data = [
            'PAS_NO_REG' => $this->input->post('PAS_NO_REG'),
            'RMD_PAS_NAMA' => $this->input->post('RMD_PAS_NAMA'),
            'RMD_GOL_DARAH' => $this->input->post('RMD_GOL_DARAH'),
        ];
        $this->db->where('RMD_ID',$id);
        $this->db->set($data);
        return $this->db->update('hms_rekam_medik');
    }

    public function destroyRekam($id)
    {
        $this->db->where('RMD_ID',$id);
        return $this->db->delete('hms_rekam_medik');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}