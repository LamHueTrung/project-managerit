<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Projects extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Project_model');
		$this->load->model('Teacher_model');
		$this->load->model('Classroom_model');
		$this->load->model('Info_model');
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['title'] = 'Danh sách đồ án';
		$data['view'] = 'projects/index';
		$data['projects'] = $this->Project_model->get_all();
		$this->load->view('layouts/main', $data);
	}

	public function add()
	{
		$data['title'] = 'Thêm đồ án';
		$data['view'] = 'projects/add';
		$data['teachers'] = $this->Teacher_model->get_all();
		$data['classrooms'] = $this->Classroom_model->get_all();
		$this->load->view('layouts/main', $data);
	}

	public function store()
	{
		$mssv = $this->input->post('mssv');

		// Kiểm tra MSSV trong bảng infos
		$this->load->model('Info_model');
		$student = $this->Info_model->get_by_mssv($mssv);

		if (!$student) {
			$this->session->set_flashdata('error', 'MSSV không tồn tại trong hệ thống!');
			redirect('projects/add');
		}

		$totalscore = $this->input->post('totalscore');
		$rating = $this->get_classification($totalscore);
		$status = $totalscore > 4.1 ? 'completed' : 'notcompleted';

		$data = [
			'projectname' => $this->input->post('projectname'),
			'projecttype' => $this->input->post('projecttype'),
			'mssv' => $mssv,
			'teacherid' => $this->input->post('teacherid'),
			'totalscore' => $totalscore,
			'rating' => $rating,
			'status' => $status,
		];

		$this->Project_model->insert($data);

		$this->session->set_flashdata('message', ['type' => 'success', 'text' => 'Thêm đồ án thành công!']);
		redirect('projects');
	}

	public function update($id)
	{
		$mssv = $this->input->post('mssv');

		// Kiểm tra MSSV trong bảng infos
		$this->load->model('Info_model');
		$student = $this->Info_model->get_by_mssv($mssv);

		if (!$student) {
			$this->session->set_flashdata('error', 'MSSV không tồn tại trong hệ thống!');
			redirect('projects/edit/' . $id);
		}

		$totalscore = $this->input->post('totalscore');
		$rating = $this->get_classification($totalscore);
		$status = $totalscore > 4.1 ? 'completed' : 'notcompleted';

		$data = [
			'projectname' => $this->input->post('projectname'),
			'projecttype' => $this->input->post('projecttype'),
			'mssv' => $mssv,
			'teacherid' => $this->input->post('teacherid'),
			'totalscore' => $totalscore,
			'rating' => $rating,
			'status' => $status,
		];

		$this->Project_model->update($id, $data);

		$this->session->set_flashdata('message', ['type' => 'success', 'text' => 'Cập nhật đồ án thành công!']);
		redirect('projects');
	}

	private function get_classification($score)
	{
		if ($score >= 85) {
			return 'Excellent';
		} elseif ($score >= 70) {
			return 'Good';
		} elseif ($score >= 50) {
			return 'Fair';
		} else {
			return 'Poor';
		}
	}


	public function edit($id)
	{
		$data['title'] = 'Sửa đồ án';
		$data['view'] = 'projects/edit';
		$data['project'] = $this->Project_model->get($id);
		$data['teachers'] = $this->Teacher_model->get_all();
		$data['classrooms'] = $this->Classroom_model->get_all();
		$this->load->view('layouts/main', $data);
	}



	public function delete($id)
	{
		$this->Project_model->delete($id);
		$this->session->set_flashdata('message', 'Xóa đồ án thành công!');
		redirect('projects');
	}

	public function detail($id)
	{
		$data['title'] = 'Chi tiết đồ án';
		$data['view'] = 'projects/detail';
		$data['project'] = $this->Project_model->get($id);
		$this->load->view('layouts/main', $data);
	}

	public function search()
	{
		$query = $this->input->get('query');
		$data['title'] = 'Tra cứu đồ án';
		$data['view'] = 'projects/search';
		$data['projects'] = $this->Project_model->search($query);
		$this->load->view('layouts/main', $data);
	}

	public function view($id) {
		$data['title'] = 'Chi tiết đồ án';
		$data['view'] = 'projects/view';
		$data['project'] = $this->Project_model->get($id);
		$this->load->view('layouts/main', $data);
	}
	public function statistics()
	{
		$data['title'] = 'Thống kê đồ án';
		$data['view'] = 'projects/statistics';
		$data['project_stats'] = $this->Project_model->get_project_statistics();
		$data['rating_stats'] = $this->Project_model->count_by_rating();
		$data['statistics'] = $this->Project_model->get_statistics();
		$this->load->view('layouts/main', $data);
	}
}
