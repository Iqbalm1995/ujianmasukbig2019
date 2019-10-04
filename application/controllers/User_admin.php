<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_admin extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        // Load Model
        $this->load->model('Mo_admin','user_admin');
        //sesion
        if(($this->session->userdata('status_login') != "loginactive") && ($this->session->userdata('role') != 'admin')){
			redirect(base_url().'login');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'User Admin';
		$head['menu']          		= 'user_admin';

		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('user_admin/user_admin_views');
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->user_admin->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $user_admin) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = '<strong>'.$user_admin->username.
						'<strong>
						 <div class="table-links">
                            <a href="javascript:void(0)" 
						  	  	data-toggle="tooltip" title="Hapus"
						  	  	onclick="edit_user_admin('."'".$user_admin->id."'".')">Ubah</a>
                            <div class="bullet"></div>
                            <a class="text-danger" href="javascript:void(0)" 
						  	  	data-toggle="tooltip" title="Hapus"
						  	  	onclick="delete_user_admin('."'".$user_admin->id."'".')">Hapus</a>
                         </div>';
			// $row[] = $user_admin->username;
			$row[] = $user_admin->nama;
			$row[] = $user_admin->keterangan;
			$row[] = $user_admin->edited;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->user_admin->count_all(),
						"recordsFiltered" => $this->user_admin->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'nama' 				=> $this->input->post('nama'),
				'keterangan' 		=> $this->input->post('keterangan'),
				'username' 			=> $this->input->post('username'),
				'password' 			=> $this->bcrypt->hash_password($this->input->post('password')),
				'role' 				=> 'admin',
				'allowed_visit' 	=> 'YES',
				'edited' 			=> date('Y-m-d H:i:s'),
				'id_konfirmator' 	=> null,
			);
		$insert = $this->user_admin->save($data);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di tambahkan
            </div>
			');
	}

	public function ajax_edit($id)
	{
		$data = $this->user_admin->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_detail($id)
	{
		$data = $this->user_admin->get_by_detail($id);
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();
			$data = array(
				'nama' 				=> $this->input->post('nama'),
				'keterangan' 		=> $this->input->post('keterangan'),
				'username' 			=> $this->input->post('username'),
				'password' 			=> $this->bcrypt->hash_password($this->input->post('password')),
				'role' 				=> 'admin',
				'edited' 			=> date('Y-m-d H:i:s'),
				'allowed_visit' 	=> 'YES',
				'id_konfirmator' 	=> null,
			);
		$this->user_admin->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di update
            </div>
			');
	}

	public function ajax_delete($id)
	{
		$this->user_admin->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di hapus
            </div>
			');
	}

	public function ajax_bulk_delete()
	{
		$list_id = $this->input->post('id');
		foreach ($list_id as $id) {
			$this->user_admin->delete_by_id($id);
		}
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di hapus
            </div>
			');
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('nama') == ''){
			$data['inputerror'][] = 'nama';
			$data['error_string'][] = 'Nama Masih Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('username') == ''){
			$data['inputerror'][] = 'username';
			$data['error_string'][] = 'Username Masih Masih Kosong';
			$data['status'] = FALSE;
		}

		if($this->input->post('password') == ''){
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Password Masih Masih Kosong';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE){
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file user_admin.php */
/* Location: ./application/controllers/user_admin.php */