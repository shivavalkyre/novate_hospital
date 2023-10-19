<?php 

class Model_fasilitas extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getFasilitas()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'hms_fasilitas.FAS_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_fasilitas']) ? strval($_POST['search_fasilitas']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_fasilitas')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_fasilitas
            where concat(FAS_ID,'',FAS_NAMA,'',FAS_LOKASI)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    
    public function getFasilitasAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_fasilitas')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_fasilitas";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveFasilitas()
    {
        $data = [
            'FAS_NAMA' => $this->input->post('FAS_NAMA'),
            'FAS_LOKASI' => $this->input->post('FAS_LOKASI'),
        ];
        
        return $this->db->insert('hms_fasilitas',$data);
    }

    public function updateFasilitas($id)
    {
        $data = [
            'FAS_NAMA' => $this->input->post('FAS_NAMA'),
            'FAS_LOKASI' => $this->input->post('FAS_LOKASI'),
        ];

        $this->db->where('FAS_ID',$id);
        $this->db->set($data);
        return $this->db->update('hms_fasilitas');
    }

    public function destroyFasilitas($id)
    {
        $this->db->where('FAS_ID',$id);
        return $this->db->delete('hms_fasilitas');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}