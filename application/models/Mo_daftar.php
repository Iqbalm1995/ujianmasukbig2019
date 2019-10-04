<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mo_daftar extends CI_Model {

	var $table = 'sh_user';
	//database for datatable searchable just firstname , lastname , address are searchable
	var $order = array('id' => 'desc'); // default order 
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

	function cek($table,$where){		

		return $this->db->get_where($table,$where);
		
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('id',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id)
	{
		$this->db->where('id', $id);
		$this->db->delete($this->table);
	}

	public function view(){
		return $this->db->get($this->table)->result(); // Tampilkan semua data yang ada di tabel siswa
	}
}
