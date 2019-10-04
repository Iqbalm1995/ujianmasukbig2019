<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_get('Asia/Jakarta');
		$this->load->model('mo_auth','auth');
	}

	public function index()
	{
		$this->load->view('login/login_views');
	}

	public function proses_login()
	{
		$uname = $_POST['username'];
		$pass = $_POST['password'];
		$role = $_POST['role'];
		// if (isset($_POST['email']) && isset($_POST['password'])) {
		if (isset($uname) && isset($pass)) {
            $login = $uname;
            $password = $pass;
            $user = $this->auth->getUserByLogin($login, $password);
            if ($role != $user['role']) {
            	$this->session->set_flashdata('pesan1', 'Akun yang anda masukan tidak terdaftar');
            	redirect(base_url().'login');
            }else{
	            if ($user) {
	            	$data_session = array(
						'id' 				=> $user['id'],
						'nama' 				=> $user['nama'],
						'keterangan' 		=> $user['keterangan'],
						'username' 			=> $user['username'],
						'password' 			=> $user['password'],
						'role' 				=> $user['role'],
						'allowed_visit' 	=> $user['allowed_visit'],
						'status_login' 		=> "loginactive"
					);
					$this->session->set_userdata($data_session);
	            	redirect(base_url().'home');
	            }else{
	            	$this->session->set_flashdata('pesan2', 'Username atau Password salah!');
	            	redirect(base_url().'login');
	            }
            }
        }

	}

	public function logout(){
		$data_session = array(
						'id' 				=> "",
						'nama' 				=> "",
						'keterangan' 		=> "",
						'username' 			=> "",
						'password' 			=> "",
						'role' 				=> "",
						'allowed_visit' 	=> "",
						'status_login' 		=> ""
					);
		$this->session->unset_userdata($data_session);
		$this->session->sess_destroy();
		redirect(base_url().'login');
	}
	
}
