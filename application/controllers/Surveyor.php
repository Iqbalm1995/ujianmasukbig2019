<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Surveyor extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        // Load Model
        $this->load->model('Mo_surveyor','surveyor');
        //sesion
        if(($this->session->userdata('status_login') != "loginactive") && ($this->session->userdata('role') != 'admin')){
			redirect(base_url().'login');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Surveyor';
		$head['menu']          		= 'surveyor';

		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('surveyor/surveyor_views');
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->surveyor->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $surveyor) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = '<strong>'.$surveyor->username.
						'<strong>
						 <div class="table-links">
                            <a href="javascript:void(0)" 
						  	  	data-toggle="tooltip" title="Hapus"
						  	  	onclick="edit_surveyor('."'".$surveyor->id."'".')">Ubah</a>
                            <div class="bullet"></div>
                            <a class="text-danger" href="javascript:void(0)" 
						  	  	data-toggle="tooltip" title="Hapus"
						  	  	onclick="delete_surveyor('."'".$surveyor->id."'".')">Hapus</a>
                         </div>';
			// $row[] = $surveyor->username;
			$row[] = $surveyor->nama;
			$row[] = $surveyor->keterangan;
			$row[] = $surveyor->edited;
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->surveyor->count_all(),
						"recordsFiltered" => $this->surveyor->count_filtered(),
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
				'role' 				=> 'surveyor',
				'edited' 			=> date('Y-m-d H:i:s'),
				'allowed_visit' 	=> 'YES',
				'id_konfirmator' 	=> $this->session->userdata('id')
			);
		$insert = $this->surveyor->save($data);
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
		$data = $this->surveyor->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_detail($id)
	{
		$data = $this->surveyor->get_by_detail($id);
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
				'role' 				=> 'surveyor',
				'edited' 			=> date('Y-m-d H:i:s'),
				'allowed_visit' 	=> 'YES',
				'id_konfirmator' 	=> $this->session->userdata('id'),
			);
		$this->surveyor->update(array('id' => $this->input->post('id')), $data);
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
		$this->surveyor->delete_by_id($id);
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
			$this->surveyor->delete_by_id($id);
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

/* End of file Surveyor.php */
/* Location: ./application/controllers/Surveyor.php */