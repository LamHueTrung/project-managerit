<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classroom_model extends CI_Model
{
	public function get_all()
	{
		return $this->db->get('classrooms')->result_array();
	}

	public function get($id)
	{
		return $this->db->get_where('classrooms', ['id' => $id])->row_array();
	}

	public function insert($data)
	{
		$this->db->insert('classrooms', $data);
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id)->update('classrooms', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id)->delete('classrooms');
	}
	public function check_duplicate($classname, $classid, $courseyear, $exclude_id = null)
	{
		$this->db->where('classname', $classname);
		$this->db->where('classid', $classid);
		$this->db->where('courseyear', $courseyear);
		if ($exclude_id) {
			$this->db->where('id !=', $exclude_id);
		}
		$query = $this->db->get('classrooms');
		return $query->num_rows() > 0;
	}
	public function count_students($classroom_id)
	{
		$this->db->where('classid', $classroom_id);
		return $this->db->count_all_results('infos'); // Đếm số sinh viên trong lớp
	}

	public function count_all()
	{
		return $this->db->count_all('classrooms');
	}

	public function delete_students($classroom_id)
	{
		$this->db->where('classroom_id', $classroom_id);
		$this->db->delete('infos');
	}

	public function check_students_in_projects($classroom_id)
	{
		$this->db->select('COUNT(*) as total');
		$this->db->from('infos');
		$this->db->join('projects', 'infos.mssv = projects.mssv'); // Kết nối bảng infos và projects
		$this->db->where('infos.classid', $classroom_id); // Kiểm tra sinh viên thuộc lớp
		$query = $this->db->get();
		return $query->row()->total; // Trả về số lượng sinh viên đang tham gia đồ án
	}


}
