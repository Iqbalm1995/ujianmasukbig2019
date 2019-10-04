<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_auth extends CI_Model {

	function getUserByLogin($login, $password) {        
	    $this->db->where('username',$login);

	    $result = $this->getUsers($password);

	    if (!empty($result)) {
	        return $result;
	    } else {
	        return null;
	    }
	}

	function getUsers($password) {
	    $query = $this->db->get('sh_user');
	    if ($query->num_rows() > 0) {
	        $result = $query->row_array();
	        if ($this->bcrypt->check_password($password, $result['password'])) {
	            //We're good
	            return $result;
	        } else {
	            //Wrong password
	            return array();
	        }

	    } else {
	        return array();
	    }
	}
}
