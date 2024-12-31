<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Info_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_by_account($account_id) {
		return $this->db->get_where('infos', ['accountid' => $account_id])->row_array();
	}
	
	public function insert($data) {
		$this->db->insert('infos', $data);
	}
	
	public function update_by_account($account_id, $data) {
		$this->db->where('accountid', $account_id);
		$this->db->update('infos', $data);
	}
	
	public function delete_by_account($account_id) {
		$this->db->where('accountid', $account_id);
		$this->db->delete('infos');
	}

	public function has_projects($account_id) {
		$this->db->select('COUNT(*) as total');
		$this->db->from('infos');
		$this->db->join('projects', 'infos.mssv = projects.mssv');
		$this->db->where('infos.accountid', $account_id);
		$query = $this->db->get();
		return $query->row()->total > 0;
	}
	public function get_by_mssv($mssv) {
		$this->db->where('mssv', $mssv);
		return $this->db->get('infos')->row_array();
	}
	
	
}
