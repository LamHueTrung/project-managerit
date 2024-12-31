<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Project_model extends CI_Model
{

	public function get_all()
	{
		$this->db->select('projects.*, teachers.fullname as teacher_name, infos.fullname as student_name, classrooms.classname');
		$this->db->from('projects');
		$this->db->join('teachers', 'teachers.id = projects.teacherid', 'left');
		$this->db->join('infos', 'infos.mssv = projects.mssv', 'left');
		$this->db->join('classrooms', 'classrooms.classid = infos.classid', 'left');
		return $this->db->get()->result_array();
	}

	public function get($id)
	{
		$this->db->select('projects.*, teachers.fullname as teacher_name, infos.fullname as student_name, teachers.teacher_code as teacher_code, classrooms.classname, classrooms.courseyear as classroom_courseyear, infos.mail as student_email, infos.birthday as student_birthday');
		$this->db->from('projects');
		$this->db->join('teachers', 'teachers.id = projects.teacherid', 'left');
		$this->db->join('infos', 'infos.mssv = projects.mssv', 'left');
		$this->db->join('classrooms', 'classrooms.classid = infos.classid', 'left');
		$this->db->where('projects.id', $id);
		return $this->db->get()->row_array();
	}

	// Đếm tổng số đồ án
	public function count_all()
	{
		return $this->db->count_all('projects');
	}

	// Lấy dữ liệu thống kê loại đồ án
	public function get_project_statistics()
	{
		$this->db->select('projecttype, COUNT(*) as count');
		$this->db->group_by('projecttype');
		return $this->db->get('projects')->result_array();
	}

	public function count_by_rating() {
		$this->db->select("SUM(CASE WHEN rating = 'Excellent' THEN 1 ELSE 0 END) as excellent,
						   SUM(CASE WHEN rating = 'Good' THEN 1 ELSE 0 END) as good,
						   SUM(CASE WHEN rating = 'Fair' THEN 1 ELSE 0 END) as fair,
						   SUM(CASE WHEN rating = 'Poor' THEN 1 ELSE 0 END) as poor");
		return $this->db->get('projects')->row_array();
	}

	public function insert($data)
	{
		$this->db->insert('projects', $data);
		return $this->db->insert_id();
	}

	public function update($id, $data)
	{
		$this->db->where('id', $id);
		return $this->db->update('projects', $data);
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		return $this->db->delete('projects');
	}

	public function search($query)
	{
		$this->db->select('projects.*, teachers.fullname as teacher_name, infos.fullname as student_name, classrooms.classname');
		$this->db->from('projects');
		$this->db->join('teachers', 'teachers.id = projects.teacherid', 'left');
		$this->db->join('infos', 'infos.mssv = projects.mssv', 'left');
		$this->db->join('classrooms', 'classrooms.classid = infos.classid', 'left');

		if (!empty($query)) {
			$this->db->like('projects.projectname', $query);
			$this->db->or_like('projects.mssv', $query);
			$this->db->or_like('infos.fullname', $query);
			$this->db->or_like('classrooms.classname', $query);
		}

		return $this->db->get()->result_array();
	}


	public function get_statistics()
	{
		$this->db->select('status, COUNT(*) as total');
		$this->db->group_by('status');
		return $this->db->get('projects')->result_array();
	}
}
