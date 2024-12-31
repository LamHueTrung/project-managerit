<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Teacher_model extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
	}

	// Thêm giáo viên mới
	public function insert($data)
	{
		return $this->db->insert('teachers', $data);
	}

	// Lấy danh sách tất cả giáo viên
	public function get_all()
	{
		return $this->db->get('teachers')->result_array();
	}

	// Lấy thông tin giáo viên theo ID
	public function get($id)
	{
		$this->db->where('id', $id);
		return $this->db->get('teachers')->row_array();
	}

	// Lấy thông tin giáo viên theo account ID
	public function get_by_account($account_id)
	{
		$this->db->where('accountid', $account_id);
		return $this->db->get('teachers')->row_array();
	}

	// Cập nhật thông tin giáo viên theo ID
	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('teachers', $data);
	}

	// Cập nhật thông tin giáo viên theo account ID
	public function update_by_account($account_id, $data)
	{
		$this->db->where('accountid', $account_id);
		return $this->db->update('teachers', $data);
	}

	// Xóa giáo viên theo ID
	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('teachers');
	}

	// Xóa giáo viên theo account ID
	public function delete_by_account($account_id)
	{
		$this->db->where('accountid', $account_id);
		return $this->db->delete('teachers');
	}

	public function count_all()
	{
		return $this->db->count_all('teachers');
	}

}
