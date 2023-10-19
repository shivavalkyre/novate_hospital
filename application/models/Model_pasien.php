<?php 

class Model_pasien extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getPasien()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'hms_pasien.PAS_NO_REG';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_pasien']) ? strval($_POST['search_pasien']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_pasien')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_pasien
            where concat(PAS_NO_REG,'',PAS_NAMA_AWAL,'',PAS_NAMA_AKHIR)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

   
    public function getPasienAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_pasien')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_pasien";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function savePasien()
    {
        $data = [
            'PAS_NAMA_AWAL' => $this->input->post('PAS_NAMA_AWAL'),
            'PAS_NAMA_AKHIR' => $this->input->post('PAS_NAMA_AKHIR'),
            'PAS_ALAMAT1' => $this->input->post('PAS_ALAMAT1'),
            'PAS_ALAMAT2' => $this->input->post('PAS_ALAMAT2'),
            'PAS_KOTA' => $this->input->post('PAS_KOTA'),
            'PAS_PROVINSI' => $this->input->post('PAS_PROVINSI'),
            'PAS_NEGARA' => $this->input->post('PAS_NEGARA'),
        ];
        // $this->db->insert('hms_pasien',$data);
        return $this->db->insert('hms_pasien',$data);
    }

    public function updatePasien($id)
    {
        $data = [
            'PAS_NAMA_AWAL' => $this->input->post('PAS_NAMA_AWAL'),
            'PAS_NAMA_AKHIR' => $this->input->post('PAS_NAMA_AKHIR'),
            'PAS_ALAMAT1' => $this->input->post('PAS_ALAMAT1'),
            'PAS_ALAMAT2' => $this->input->post('PAS_ALAMAT2'),
            'PAS_KOTA' => $this->input->post('PAS_KOTA'),
            'PAS_PROVINSI' => $this->input->post('PAS_PROVINSI'),
            'PAS_NEGARA' => $this->input->post('PAS_NEGARA'),
        ];
        $this->db->where('PAS_NO_REG',$id);
        $this->db->set($data);
        return $this->db->update('hms_pasien');
    }

    public function destroyPasien($id)
    {
        $this->db->where('PAS_NO_REG',$id);
        return $this->db->delete('hms_pasien');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}