<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
    {
        parent::__construct();
        // Set timezone
        date_default_timezone_get('Asia/Jakarta');
        //sesion
        if($this->session->userdata('status_login') != "loginactive"){
			redirect(base_url().'login');
		}
        
    }

	public function index()
	{
		$head['title_page'] 		= 'Home';
		$head['menu']          		= 'home';

		// View
		$this->load->view('static/header_view', $head);
        $this->load->view('home/home_views');
        $this->load->view('static/footer_view');
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */