<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class AdminModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function create_admin($username,$name, $email, $password,$password_char) {
		$data = array(
			'username'   => $username,
			'name'       => $name,
			'email'      => $email,
			'password'   => $this->hash_password($password),
			'password_char'   => $password_char,
		);
		$this->db->insert('admin', $data);
	}
	
	
	public function resolve_admin_login($username, $password) {
		
		$this->db->select('password');
		$this->db->from('admin');
		$this->db->where('username', $username);
		$hash = $this->db->get()->row('password');

		return $this->verify_password_hash($password, $hash);
		
	}
	
	public function get_admin_from_username($username) {
		
		$this->db
			->select('*')
			->from('admin')
			->where('admin.username', $username);

		return $this->db->get()->row();
		
	}
	
	public function get_admin_from_email($email) {
		
		$this->db
			->select('*')
			->from('admin')
			->where('admin.email', $email);

		return $this->db->get()->row();
		
	}
	
	public function get_username_from_admin_id($admin_id) {
		
		$this->db->select('username');
		$this->db->from('admin');
		$this->db->where('id', $admin_id);

		return $this->db->get()->row('username');
		
	}
	
	public function get_admin($admin_id) {
		
		$this->db
			->select('*')
			->from('admin')
			->where('admin.id', $admin_id);
		return $this->db->get()->result();
		
	}
	

	public function get_admin_count(){
		return $this->db
			->select('count(id) ctr')
			->from('admin')
			->get()
			->row('ctr');
	}
	
	public function update_admin($admin_id, $update_data) {
		
		if (array_key_exists('password', $update_data)) {
			$update_data['password'] = $this->hash_password($update_data['password']);
		}
		
		if (!empty($update_data)) {
			
			$this->db->where('id', $admin_id);
			return $this->db->update('admin', $update_data);
			
		}
		return false;
		
	}
	
	
	private function hash_password($password) {
		return password_hash($password, PASSWORD_BCRYPT);
	}
	
	private function verify_password_hash($password, $hash) {
		return password_verify($password, $hash);
	}

}

/* End of file UserModel.php */
/* Location: ./application/models/UserModel.php */