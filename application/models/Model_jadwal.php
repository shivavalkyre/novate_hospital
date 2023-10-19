<?php 

class Model_jadwal extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getJadwal()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'PAM_ID';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_jadwal']) ? strval($_POST['search_jadwal']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_jadwal_view')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_jadwal_view
            where concat(PAM_ID,'',PAM_NAMA,'',FAS_NAMA)  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

   
    public function getJadwalAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('hms_jadwal_view')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from hms_jadwal_view";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveJadwal()
    {
        $data = [
            'FAS_ID' => $this->input->post('FAS_ID'),
            'JAD_FAS_NAMA' => $this->input->post('JAD_FAS_NAMA'),
            'JAD_JAM_MULAI' => $this->input->post('JAD_JAM_MULAI'),
            'JAD_JAM_SELESAI' => $this->input->post('JAD_JAM_SELESAI'),
        ];

        $fas_id = $this->input->post('FAS_ID');
        $fas_nama =  $this->input->post('JAD_FAS_NAMA');
        $jad_mulai = $this->input->post('JAD_JAM_MULAI');
        $jad_selesai = $this->input->post('JAD_JAM_SELESAI');

        $pam_id = $this->input->post('PAM_ID');
        $jdt_nama = $this->input->post('JDT_NAMA');
        $jdt_status = $this->input->post('JDT_STATUS');

        $this->db->insert('hms_jadwal',$data);

        $query = $this->db->query("SELECT JAD_ID FROM hms_jadwal WHERE FAS_ID= '$fas_id' AND JAD_FAS_NAMA = '$fas_nama'  AND JAD_JAM_MULAI = '$jad_mulai' AND JAD_JAM_SELESAI = '$jad_selesai' LIMIT 1");
        
        foreach ($query->result() as $row)
        {
                $country = $row->JAD_ID;
        }
        
        $jad_id = $country;
        
        $data = array(
            'PAM_ID' => $pam_id,
            'JAD_ID' => $jad_id,
            'FAS_ID' => $fas_id,
            'JDT_NAMA'=> $jdt_nama,
            'JDT_STATUS' => $jdt_status,
        );
    
       
        
        return  $this->db->insert('hms_jadwal_dtl', $data);
        // return $this->db->insert('hms_jadwal',$data);
        // return $this->db->insert('hms_paramedis',$data);
        // return $this->db->insert('hms_jadwal',$data);
    }

    public function updateJadwal($id)
    {
        $data = [
            'FAS_ID' => $this->input->post('FAS_ID'),
            'JAD_FAS_NAMA' => $this->input->post('JAD_FAS_NAMA'),
            'JAD_JAM_MULAI' => $this->input->post('JAD_JAM_MULAI'),
            'JAD_JAM_SELESAI' => $this->input->post('JAD_JAM_SELESAI'),
        ];

        $pam_id = $this->input->post('PAM_ID');
        $jad_id= $id;
        $jdt_nama = $this->input->post('JDT_NAMA');
        $jdt_status = $this->input->post('JDT_STATUS');

        $fas_id = $this->input->post('FAS_ID');
        $fas_nama =  $this->input->post('JAD_FAS_NAMA');
        $jad_mulai = $this->input->post('JAD_JAM_MULAI');
        $jad_selesai = $this->input->post('JAD_JAM_SELESAI');

        

        $this->db->where('JAD_ID',$id);
        $this->db->set($data);
        $this->db->update('hms_jadwal');

        $data = array(
            'PAM_ID' => $pam_id,
            'JAD_ID' => $jad_id,
            'FAS_ID' => $fas_id,
            'JDT_NAMA'=> $jdt_nama,
            'JDT_STATUS' => $jdt_status,
        );

        $this->db->where('JAD_ID',$id);
        $this->db->set($data);
        return $this->db->update('hms_jadwal_dtl');
        // return $this->db->update('hms_jadwal');
    }

    public function destroyJadwal($id)
    {
        $this->db->where('JAD_ID',$id);
        $this->db->delete('hms_jadwal_dtl');
      

        $this->db->where('JAD_ID',$id);
        return $this->db->delete('hms_jadwal');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}