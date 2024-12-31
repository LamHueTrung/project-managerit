<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends MY_Controller {
	public function index() {
		$this->load->model('Account_model');
		$this->load->model('Project_model');
		$this->load->model('Classroom_model');
		$this->load->model('Teacher_model');
	
		$data['title'] = 'Dashboard';
		$data['user_count'] = $this->Account_model->count_all();
		$data['project_count'] = $this->Project_model->count_all();
		$data['classroom_count'] = $this->Classroom_model->count_all();
		$data['teacher_count'] = $this->Teacher_model->count_all();
	
		// Lấy dữ liệu biểu đồ
		$data['project_stats'] = $this->Project_model->get_project_statistics();
		$data['rating_stats'] = $this->Project_model->count_by_rating();
		
		$data['view'] = 'dashboard/index';
		$this->load->view('layouts/main', $data);
	}
	
}
