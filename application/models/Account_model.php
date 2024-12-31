<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

	public function count_all() {
		return $this->db->count_all('accounts');
	}
	
    // Lấy thông tin tài khoản theo ID
    public function get_account_by_id($id) {
        $this->db->where('id', $id);
        return $this->db->get('accounts')->row_array();
    }

	// Lấy tài khoản theo username
    public function get_account_by_username($username) {
        $this->db->where('username', $username);
        return $this->db->get('accounts')->row_array();
    }

    public function get_all() {
		return $this->db->get('accounts')->result_array();
	}
	
	public function insert($data) {
		$this->db->insert('accounts', $data);
		return $this->db->insert_id();
	}
	
	public function update($id, $data) {
		$this->db->where('id', $id);
		$this->db->update('accounts', $data);
	}
	
	public function delete($id) {
		$this->db->where('id', $id);
		$this->db->delete('accounts');
	}
	
	public function get($id) {
		return $this->db->get_where('accounts', ['id' => $id])->row_array();
	}
	
	public function check_duplicate($username, $exclude_id = null) {
		$this->db->where('username', $username);
		if ($exclude_id) {
			$this->db->where('id !=', $exclude_id);
		}
		$query = $this->db->get('accounts');
		return $query->num_rows() > 0;
	}
}
