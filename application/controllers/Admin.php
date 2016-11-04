<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	
	public function index()
	{
		if ($this->session->userdata('admin_login') != 1)
            redirect('login', 'refresh');
		echo "Welcome ".$this->session->userdata('email')."<br>";
		echo 'Success Login username or password.';
	}
}
