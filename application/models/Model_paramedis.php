<?php 

class Model_paramedis extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getParamedis()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'hms_paramedis.PAM_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_paramedis']) ? strval($_POST['search_paramedis']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_paramedis')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_paramedis
            where concat(PAM_ID,'',PAM_NAMA,'',PAM_KATEGORI)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

   
    public function getParamedisAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_paramedis')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_paramedis";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveParamedis()
    {
        $data = [
            'PAM_NAMA' => $this->input->post('PAM_NAMA'),
            'PAM_KATEGORI' => $this->input->post('PAM_KATEGORI'),
            'PAM_KUALIFIKASI' => $this->input->post('PAM_KUALIFIKASI'),
            'PAM_MULAI_TUGAS' => $this->input->post('PAM_MULAI_TUGAS'),
            'PAM_STATUS' => $this->input->post('PAM_STATUS'),
        ];

        
        return $this->db->insert('hms_paramedis',$data);
        // return $this->db->insert('hms_paramedis',$data);
    }

    public function updateParamedis($id)
    {
        $data = [
            'PAM_NAMA' => $this->input->post('PAM_NAMA'),
            'PAM_KATEGORI' => $this->input->post('PAM_KATEGORI'),
            'PAM_KUALIFIKASI' => $this->input->post('PAM_KUALIFIKASI'),
            'PAM_MULAI_TUGAS' => $this->input->post('PAM_MULAI_TUGAS'),
            'PAM_STATUS' => $this->input->post('PAM_STATUS'),
        ];
        $this->db->where('PAM_ID',$id);
        $this->db->set($data);
        return $this->db->update('hms_paramedis');
    }

    public function destroyParamedis($id)
    {
        $this->db->where('PAM_ID',$id);
        return $this->db->delete('hms_paramedis');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}