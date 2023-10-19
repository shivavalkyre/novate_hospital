<?php 

class Model_jadwal_detail extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	
    public function saveJadwalDetail()
    {
        $data = [
            'PAM_ID' => $this->input->post('PAM_ID'),
            'JAD_ID' => $this->input->post('JAD_ID'),
            'FAS_ID' => $this->input->post('FAS_ID'),
            'JDT_NAMA' => $this->input->post('JDT_NAMA'),
            'JDT_STATUS' => $this->input->post('JDT_STATUS'),
        ];

        $this->db->insert('hms_jadwal_dtl',$data);
        $lastID = $this->db->insert_id();
        return $lastID;
        // return $this->db->insert('hms_jadwal',$data);
        // return $this->db->insert('hms_paramedis',$data);
    }

    public function updateJadwalDetail($id)
    {
        $data = [
            'PAM_ID' => $this->input->post('PAM_ID'),
            'JAD_ID' => $this->input->post('JAD_ID'),
            'FAS_ID' => $this->input->post('FAS_ID'),
            'JDT_NAMA' => $this->input->post('JDT_NAMA'),
            'JDT_STATUS' => $this->input->post('JDT_STATUS'),
        ];

        $this->db->where('JAD_ID',$id);
        $this->db->set($data);
        return $this->db->update('hms_jadwal_dtl');
    }

    public function destroyJadwalDetail($id)
    {
        $this->db->where('JAD_ID',$id);
        return $this->db->delete('hms_jadwal_dtl');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}