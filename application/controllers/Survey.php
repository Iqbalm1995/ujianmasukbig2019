<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Survey extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        // Load Model
        $this->load->model('Mo_komoditas_survey','komoditas');
        //sesion
        if(($this->session->userdata('status_login') != "loginactive") && ($this->session->userdata('role') != 'surveyor')){
			redirect(base_url().'login');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Komoditas';
		$head['menu']          		= 'komoditas';

		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('komoditas/komoditas_surveyor');
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

			$surveyor  	= $this->komoditas->get_id_val($read->id_konfirmasi,'sh_user');

            $row[] = $read->komoditas;
			// $row[] = $komoditas->username;
			$row[] = $read->satuan;
			$row[] = 'Rp'.number_format($read->harga, 0 , '' , '.' );
			$row[] = $read->tanggal;
			switch ($read->konfirmasi) {
				case 'WAIT':
					$status_m = '<div class="badge badge-warning">WAIT</div><br><small>(Tumggu dikonfirmasi oleh admin)<small>';
					break;
				case 'YES':
					$status_m = '<div class="badge badge-success">ACCEPTED</div><br><small>(Dikonfirmasi oleh '.$surveyor['username'].')<small>';
					break;
				default:
					$status_m = '<div class="badge badge-danger">DECLINE</div><br><small>(Dikonfirmasi oleh '.$surveyor['username'].')<small>';
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

	public function ajax_add()
	{
		$this->_validate();
		$data = array(
				'komoditas' 		=> $this->input->post('komoditas'),
				'satuan' 			=> $this->input->post('satuan'),
				'harga' 			=> $this->input->post('harga'),
				'id_pengelola' 		=> $this->session->userdata('id'),
				'tanggal' 			=> date('Y-m-d'),
				'konfirmasi' 		=> 'WAIT',
				'id_konfirmasi' 	=> null,
			);
		$insert = $this->komoditas->save($data);
		echo json_encode(array("status" => TRUE));
		$this->session->set_flashdata('message1', '
			<div class="alert alert-info alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <strong>Berhasil <i class="glyphicon glyphicon-ok"></i></strong> Data telah di tambahkan
            </div>
			');
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('komoditas') == ''){
			$data['inputerror'][] = 'komoditas';
			$data['error_string'][] = 'Nama komoditas belum di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('satuan') == ''){
			$data['inputerror'][] = 'satuan';
			$data['error_string'][] = 'Satuan komoditas belum di isi';
			$data['status'] = FALSE;
		}

		if($this->input->post('harga') == ''){
			$data['inputerror'][] = 'harga';
			$data['error_string'][] = 'Harga komoditas belum di isi';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE){
			echo json_encode($data);
			exit();
		}
	}

}

/* End of file Survey.php */
/* Location: ./application/controllers/Survey.php */