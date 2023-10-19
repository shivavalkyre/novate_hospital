<?php 

class Model_kunjungan extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getKunjungan()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'KUN_NO_ANTRI';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_kunjungan']) ? strval($_POST['search_kunjungan']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_kunjungan')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_kunjungan_view
            where concat(KUN_NO_ANTRI,'',PAS_NAMA_AWAL,'',FAS_NAMA,'',PAM_NAMA,'',PAM_KATEGORI)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

   
    public function getKunjunganAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_kunjungan')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_kunjungan";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveKunjungan()
    {
        $data = [
            'KUN_TGL' => $this->input->post('KUN_TGL'),
            'PAS_NO_REG' => $this->input->post('PAS_NO_REG'),
            'FAS_ID' => $this->input->post('FAS_ID'),
            'JAD_ID' => $this->input->post('JAD_ID'),
        ];
        // $this->db->insert('hms_kunjungan',$data);
        return $this->db->insert('hms_kunjungan',$data);
    }

    public function updateKunjungan($id)
    {
        $data = [
            'KUN_TGL' => $this->input->post('KUN_TGL'),
            'PAS_NO_REG' => $this->input->post('PAS_NO_REG'),
            'FAS_ID' => $this->input->post('FAS_ID'),
            'JAD_ID' => $this->input->post('JAD_ID'),
        ];
        $this->db->where('KUN_NO_ANTRI',$id);
        $this->db->set($data);
        return $this->db->update('hms_kunjungan');
    }

    public function destroyKunjungan($id)
    {
        $this->db->where('KUN_NO_ANTRI',$id);
        return $this->db->delete('hms_kunjungan');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}