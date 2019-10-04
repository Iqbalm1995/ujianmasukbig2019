<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Example extends CI_Controller {

	public function index()
	{
		$password = 'surveyor123';
		$hash = $this->bcrypt->hash_password($password);
		echo $hash;
	}

}

/* End of file example.php */
/* Location: ./application/controllers/example.php */