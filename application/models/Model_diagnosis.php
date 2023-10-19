<?php 

class Model_diagnosis extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getDiagnosis()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'DIA_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_diagnosis']) ? strval($_POST['search_diagnosis']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rmd_diagnosis')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_rmd_diagnosis
            where concat(DIA_ID,'',DIA_TYPE,'',DIA_KETERANGAN)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function getDiagnosisSelected($id)
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'DIA_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_Diagnosis']) ? strval($_POST['search_Diagnosis']) : '';
        $offset = ($page-1)*$rows;

        $result = array();

        $query = "SELECT count(*) as total from hms_diagnosis_view where LYN_ID = '$id'";
        $data_total = $this->db->query($query)->row();
        $result['total'] = $data_total->total;
        $row = array();

        // select data from table product
        // $query = "SELECT *
        //     from sales_order_details_view
        //     where concat(product_name,'',id)  like '%$search%' order by $sort $order limit $offset, $rows";

        $query = "SELECT * from hms_diagnosis_view
        where LYN_ID = '$id' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

   
    public function getDiagnosisAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_rmd_diagnosis')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_rmd_diagnosis";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveDiagnosis()
    {
        $data = [
            'DIA_TYPE' => $this->input->post('DIA_TYPE'),
            'DIA_KETERANGAN' => $this->input->post('DIA_KETERANGAN'),
            'LYN_ID' => $this->input->post('LYN_ID'),
            'USER_ID' => $this->input->post('USER_ID'),
            'NAMA_USER' => $this->input->post('NAMA_USER'),
            'PAM_ID' => $this->input->post('PAM_ID'),
        ];
        // $this->db->insert('hms_Diagnosis',$data);
        return $this->db->insert('hms_rmd_Diagnosis',$data);
    }

    public function updateDiagnosis($id)
    {
        $data = [
            'DIA_TYPE' => $this->input->post('DIA_TYPE'),
            'DIA_KETERANGAN' => $this->input->post('DIA_KETERANGAN'),
            'LYN_ID' => $this->input->post('LYN_ID'),
            'USER_ID' => $this->input->post('USER_ID'),
            'NAMA_USER' => $this->input->post('NAMA_USER'),
            'PAM_ID' => $this->input->post('PAM_ID'),
        ];
        $this->db->where('DIA_ID',$id);
        $this->db->set($data);
        return $this->db->update('hms_rmd_Diagnosis');
    }

    public function destroyDiagnosis($id)
    {
        $this->db->where('DIA_ID',$id);
        return $this->db->delete('hms_rmd_Diagnosis');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}