<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pengunjung extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        // Load Model
        $this->load->model('Mo_pengunjung','pengunjung');
        //sesion
        if(($this->session->userdata('status_login') != "loginactive") && ($this->session->userdata('role') != 'admin')){
			redirect(base_url().'login');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Pengunjung';
		$head['menu']          		= 'pengunjung';

		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('pengunjung/pengunjung_views');
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');
		$list = $this->pengunjung->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $pengunjung) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';
			$row[] = '<strong>'.$pengunjung->username.
						'<strong>
						 <div class="table-links">
						 	<a class="text-success"  href="javascript:void(0)" 
						  	  	data-toggle="tooltip" title="Konfirmasi"
						  	  	onclick="konfirmasi_pengunjung('."'".$pengunjung->id."'".')">Konfirmasi Pengunjung</a>
						  	<div class="bullet"></div>
                            <a href="javascript:void(0)" 
						  	  	data-toggle="tooltip" title="Hapus"
						  	  	onclick="edit_pengunjung('."'".$pengunjung->id."'".')">Ubah</a>
                            <div class="bullet"></div>
                            <a class="text-danger" href="javascript:void(0)" 
						  	  	data-toggle="tooltip" title="Hapus"
						  	  	onclick="delete_pengunjung('."'".$pengunjung->id."'".')">Hapus</a>
                         </div>';
			// $row[] = $pengunjung->username;
			$row[] = $pengunjung->nama;
			$row[] = $pengunjung->keterangan;
			$row[] = $pengunjung->edited;
			switch ($pengunjung->allowed_visit) {
				case 'YES':
					$status_m = '<div class="badge badge-success">ACCEPTED</div>';
					break;
				default:
					$status_m = '<div class="badge badge-danger">DECLINE</div>';
					break;
			}
			$row[] = '<div class="text-center">'.$status_m.'</div>';
			$data[] = $row;
		}

		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->pengunjung->count_all(),
						"recordsFiltered" => $this->pengunjung->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->pengunjung->get_by_id($id);
		echo json_encode($data);
	}

	public function allowed_update()
	{
		$this->_validate2();
			$data = array(
				'allowed_visit' 	=> $this->input->post('allowed_visit'),
				'id_konfirmator' 	=> $this->session->userdata('id'),
			);
		$this->pengunjung->update(array('id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di update
            </div>
			');
	}

	private function _validate2()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('allowed_visit') == ''){
			$data['inputerror'][] = 'allowed_visit';
			$data['error_string'][] = 'Password Masih Masih Kosong';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE){
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file pengunjung.php */
/* Location: ./application/controllers/pengunjung.php */