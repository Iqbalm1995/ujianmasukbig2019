<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Komoditas extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        // Load Model
        $this->load->model('Mo_komoditas','komoditas');
        //sesion
        if(($this->session->userdata('status_login') != "loginactive") && ($this->session->userdata('role') != 'admin')){
			redirect(base_url().'login');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Komoditas';
		$head['menu']          		= 'komoditas';

		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('komoditas/komoditas_views');
        $this->load->view('static/footer_view');
	}

	public function ajax_list()
	{
		// $this->load->helper('url');

		$list = $this->komoditas->get_datatables();
		$data = array();
		$no = $_POST['start'];
		// print_r($list);
		foreach ($list as $read) {
			$no++;
			$row = array();
			$row[] = '<div class="text-center">'.$no.'</div>';

			$surveyor  		= $this->komoditas->get_id_val($read->id_pengelola,'sh_user');

			$row[] = '<strong>'.$surveyor['nama'].' <small>('.$surveyor['username'].')<small>'.
						'<strong>
						 <div class="table-links">
                            <a class="text-success" href="javascript:void(0)" 
						  	  	data-toggle="tooltip" title="Hapus"
						  	  	onclick="edit_komoditas('."'".$read->id."'".')">Konfirmasi Surveyor</a>
                            <div class="bullet"></div>
                            <a class="text-danger" href="javascript:void(0)" 
						  	  	data-toggle="tooltip" title="Hapus"
						  	  	onclick="delete_komoditas('."'".$read->id."'".')">Hapus</a>
                         </div>';
            $row[] 			= $read->komoditas;
			// $row[] = $komoditas->username;
			$row[] = $read->satuan;
			$row[] = 'Rp'.number_format($read->harga, 0 , '' , '.' );
			$row[] = $read->tanggal;
			switch ($read->konfirmasi) {
				case 'WAIT':
					$status_m = '<div class="badge badge-warning">WAIT</div>';
					break;
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
						"recordsTotal" => $this->komoditas->count_all(),
						"recordsFiltered" => $this->komoditas->count_filtered(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($id)
	{
		$data = $this->komoditas->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_detail($id)
	{
		$data = $this->komoditas->get_by_detail($id);
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();
			$data = array(
				'konfirmasi' 		=> $this->input->post('konfirmasi'),
				'id_konfirmasi' 	=> $this->session->userdata('id'),
			);
		$this->komoditas->update(array('id' => $this->input->post('id')), $data);
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
		$this->komoditas->delete_by_id($id);
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
			$this->komoditas->delete_by_id($id);
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

		if($this->input->post('konfirmasi') == ''){
			$data['inputerror'][] = 'konfirmasi';
			$data['error_string'][] = 'Konfirmasi belum di pilih';
			$data['status'] = FALSE;
		}


		if($data['status'] === FALSE){
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file komoditas.php */
/* Location: ./application/controllers/komoditas.php */