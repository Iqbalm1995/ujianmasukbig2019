<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Daftar extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_get('Asia/Jakarta');
		$this->load->model('Mo_daftar','daftar');
	}

	public function index()
	{
		$this->load->view('login/register_views');
	}

	public function proses_daftar()
	{
		$data = array(
				'nama' 				=> $this->input->post('nama'),
				'keterangan' 		=> $this->input->post('keterangan'),
				'username' 			=> $this->input->post('username'),
				'password' 			=> $this->bcrypt->hash_password($this->input->post('password')),
				'role' 				=> 'pengunjung',
				'edited' 			=> date('Y-m-d H:i:s'),
				'allowed_visit' 	=> 'NO',
				'id_konfirmator' 	=> null,
			);

		$where = array(
			'username' => $this->input->post('username')
			);

		$cek = $this->daftar->cek("sh_user", $where)->num_rows();

		if($cek == 0){
			$insert = $this->daftar->save($data);
			$this->session->set_flashdata('message1', '
				<div class="alert alert-info alert-dismissible" role="alert">
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> akun anda telah terdaftar sliahkan <strong><a href="'.base_url().'login">login<a></strong>
	            </div>
				');
			redirect(base_url().'daftar');
		}else{
			$this->session->set_flashdata('message1', '
				<div class="alert alert-danger alert-dismissible" role="alert">
	              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	              <strong>Gagal </strong> Akun sudah ada
	            </div>
				');
			redirect(base_url().'daftar');
		}

		
	}

}

/* End of file Daftar.php */
/* Location: ./application/controllers/Daftar.php */