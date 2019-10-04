<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cekdata extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        // Load Model
        $this->load->model('Mo_data_komoditas','komoditas');
        //sesion
        if(($this->session->userdata('status_login') != "loginactive") && ($this->session->userdata('role') != 'pengunjung')){
			redirect(base_url().'login');
		}
        
    }

	public function index()
	{
		if ($this->session->userdata('allowed_visit') == "NO") {

			$this->session->set_flashdata('message1', '
			<div class="alert alert-warning alert-dismissible" role="alert">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h3>Peringatan</h3> Akun anda belum disetujui pihak admin
            </div>
			');
			redirect(base_url().'home');
		}else{

			$head['title_page'] 		= 'Cek Survey Komoditas';
			$head['menu']          		= 'komoditas';

			// View
			$this->load->view('static/header_view', $head);
	        $this->load->view('komoditas/komoditas_data');
	        $this->load->view('static/footer_view');
		}
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
            $row[] = $read->komoditas;
			// $row[] = $komoditas->username;
			$row[] = $read->satuan;
			$row[] = 'Rp'.number_format($read->harga, 0 , '' , '.' );
			$row[] = $read->tanggal;
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

}

/* End of file Survey.php */
/* Location: ./application/controllers/Survey.php */