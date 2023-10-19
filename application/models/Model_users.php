<?php 

class Model_users extends CI_Model
{
	
	function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	public function getUsers()
	{
		$page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'users.username';
        $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        $search = isset($_POST['search_user']) ? strval($_POST['search_user']) : '';
        $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('users')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from users
            where concat(username,'')  like '%$search%' order by $sort $order limit $offset, $rows";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function getUsersAll()
	{
		// $page = isset($_POST['page']) ? intval($_POST['page']) : 1;
        // $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 10;
        // $sort = isset($_POST['sort']) ? strval($_POST['sort']) : 'products.product_number';
        // $order = isset($_POST['order']) ? strval($_POST['order']) : 'asc';
        // $search = isset($_POST['search_product']) ? strval($_POST['search_product']) : '';
        // $offset = ($page-1)*$rows;

        $result = array();
        $result['total'] = $this->db->get('users')->num_rows();
        $row = array();

        // select data from table product
        $query = "SELECT *
            from users";

        // $query = "SELECT * from products order by $sort $order limit $offset, $rows";

        $country = $this->db->query($query)->result_array();    
        $result = array_merge($result, ['rows' => $country]);
        return $result;
	}

    public function saveUser()
    {
        $data = [
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'level' => $this->input->post('level'),
        ];
        $this->db->insert('users',$data);
        return $this->db->insert_id();
    }

    public function updateUser($id)
    {
        $data = [
            'username' => $this->input->post('username'),
            'level' => $this->input->post('level'),
        ];

        $this->db->where('id',$id);
        $this->db->set($data);
        return $this->db->update('users');
    }

    public function updatePassword($id,$password){

        $data = [
            'password' => $password,
        ];

        $password = array('password' => $password);  

        $this->db->where('id', $id);
        $this->db->set($data);
        
        return $this->db->update('users'); 
    }

    public function destroyProduct($id)
    {
        $this->db->where('id',$id);
        return $this->db->delete('users');
        // return $this->db->delete($this->table,['id' => $id]);
    }
}