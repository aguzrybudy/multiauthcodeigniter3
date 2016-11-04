<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class UserModel extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		
	}

	public function create_user($username,$name, $email, $password,$password_char) {
		$data = array(
			'username'   => $username,
			'name'       => $name,
			'email'      => $email,
			'password'   => $this->hash_password($password),
			'password_char'   => $password_char,
		);
		$this->db->insert('user', $data);
	}
	
	
	public function resolve_user_login($username, $password) {
		
		$this->db->select('password');
		$this->db->from('user');
		$this->db->where('username', $username);
		$hash = $this->db->get()->row('password');

		return $this->verify_password_hash($password, $hash);
		
	}
	
	public function get_user_from_username($username) {
		
		$this->db
			->select('*')
			->from('user')
			->where('user.username', $username);

		return $this->db->get()->row();
		
	}
	
	public function get_user_from_email($email) {
		
		$this->db
			->select('*')
			->from('user')
			->where('user.email', $email);

		return $this->db->get()->row();
		
	}
	
	public function get_username_from_user_id($admin_id) {
		
		$this->db->select('username');
		$this->db->from('user');
		$this->db->where('id', $admin_id);

		return $this->db->get()->row('username');
		
	}
	
	public function get_user($user_id) {
		
		$this->db
			->select('*')
			->from('user')
			->where('user.id', $user_id);
		return $this->db->get()->result();
		
	}
	

	public function get_user_count(){
		return $this->db
			->select('count(id) ctr')
			->from('user')
			->get()
			->row('ctr');
	}
	
	public function update_user($user_id, $update_data) {
		
		if (array_key_exists('password', $update_data)) {
			$update_data['password'] = $this->hash_password($update_data['password']);
		}
		
		if (!empty($update_data)) {
			
			$this->db->where('id', $user_id);
			return $this->db->update('user', $update_data);
			
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