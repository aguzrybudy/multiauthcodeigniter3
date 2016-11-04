<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {
	
	public function index()
	{
		$this->load->view('auth/login');
	}
	
	/*** Function cek for multiple login ***/
	public function validate()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
			
		if ($this->AdminModel->resolve_admin_login($username, $password)){
			
			$admin = $this->AdminModel->get_admin_from_username($username);
			$admin_id = $admin->id;
			$this->session->set_userdata('admin_login', '1');
			$this->session->set_userdata('user', $admin);
			$this->session->set_userdata('user_id', (int)$admin->id);
			$this->session->set_userdata('username', (string)$admin->username);
			$this->session->set_userdata('logged_in', (bool)true);
			$this->session->set_userdata('email', (string)$admin->email);
			redirect ('admin','refresh');
			
		}else if($this->UserModel->resolve_user_login($username, $password)){

			$user = $this->UserModel->get_user_from_username($username);
			$user_id = $user->id;
			$this->session->set_userdata('user_login', '1');
			$this->session->set_userdata('user', $user);
			$this->session->set_userdata('user_id', (int)$user->id);
			$this->session->set_userdata('username', (string)$user->username);
			$this->session->set_userdata('logged_in', (bool)true);
			$this->session->set_userdata('email', (string)$user->email);
			redirect ('user','refresh');
			
		}else {
			redirect ('login','refresh');
			$this->session->set_userdata('error', 'Login error email or password');
		}
	}
	
	/*** Function get admin/user ***/
	public function list_user()
	{
		$data['admin'] = $this->db->get('admin')->result();
		$data['user']= $this->db->get('user')->result();
		$this->load->view('auth/list',$data);
	}
	
	public function register()
	{
		$this->load->view('auth/register');
	}
	
	/*** Function setting admin ***/
	public function register_admin_save()
	{
		$username = $this->input->post('username');
		$name = $this->input->post('username');
		$email    = $this->input->post('email');
		$password = $this->input->post('password');
		$password_char = $this->input->post('password');
		$this->AdminModel->create_admin($name, $username, $email, $password,$password_char);
		redirect ('login','refresh');

	}
	
	public function admin_edit($admin_id)
	{
		$data['admin']= $this->AdminModel->get_admin($admin_id);
		$this->load->view('auth/edit_admin',$data);
	}	
	
	public function admin_update()
	{
		$admin_id = $this->input->post('id');
		$update_data=[];
		
		if ($this->input->post('username') != '') {
			$update_data['username'] = $this->input->post('username');
		}
		if ($this->input->post('email') != '') {
			$update_data['email'] = $this->input->post('email');
		}
		if ($this->input->post('password') != '') {
			$update_data['password'] = $this->input->post('password');
		}
		if ($this->input->post('password') != '') {
			$update_data['password_char'] = $this->input->post('password');
		}
		
		$this->AdminModel->update_admin($admin_id, $update_data);
		redirect('login/list_user','refresh');
	}
	
	public function admin_delete()
	{
		$id = $this->uri->segment(3);
		$this->db->delete('admin', array('id' => $id));
	}
	
	/*** Function setting user ***/
	public function register_user_save()
	{
		$username = $this->input->post('username');
		$name = $this->input->post('username');
		$email    = $this->input->post('email');
		$password = $this->input->post('password');
		$password_char = $this->input->post('password');
		$this->UserModel->create_user($name, $username, $email, $password,$password_char);
		redirect ('login','refresh');
		

	}
	
	public function user_edit($user_id)
	{
		$data['user']= $this->UserModel->get_user($user_id);
		$this->load->view('auth/edit_user',$data);
	}	
	
	public function user_update()
	{
		$user_id = $this->input->post('id');
		$update_data=[];
		
		if ($this->input->post('username') != '') {
			$update_data['username'] = $this->input->post('username');
		}
		if ($this->input->post('email') != '') {
			$update_data['email'] = $this->input->post('email');
		}
		if ($this->input->post('password') != '') {
			$update_data['password'] = $this->input->post('password');
		}
		if ($this->input->post('password') != '') {
			$update_data['password_char'] = $this->input->post('password');
		}
		
		$this->UserModel->update_user($user_id, $update_data);
		redirect('login/list_user','refresh');
	}
	
	public function user_delete()
	{
		$id = $this->uri->segment(3);
		$this->db->delete('user', array('id' => $id));
		redirect('login/list_user','refresh');
	}
	
	/*** Function for logout ***/
	public function logout() {
		$this->session->sess_destroy();
        $this->session->set_flashdata('logout_notification', 'logged_out');
		redirect('login','refresh');
	}
	

}
