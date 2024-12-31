<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Accounts extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Account_model');
		$this->load->model('Info_model');
		$this->load->model('Classroom_model');
		$this->load->model('Teacher_model');
	}

	// Danh sách tài khoản
	public function index()
	{
		$data['title'] = 'Danh sách tài khoản';
		$data['view'] = 'accounts/index';
		$data['accounts'] = $this->Account_model->get_all();
		$this->load->view('layouts/main', $data);
	}

	// Thêm tài khoản (Form)
	public function add()
	{
		$data['title'] = 'Thêm tài khoản';
		$data['view'] = 'accounts/add';
		$data['classrooms'] = $this->Classroom_model->get_all();
		$this->load->view('layouts/main', $data);
	}

	// Lưu tài khoản mới
	public function store()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$role = $this->input->post('role');
		$fullname = $this->input->post('fullname');
		$email = $this->input->post('mail');
		$mssv = $this->input->post('mssv');

		// Kiểm tra trùng lặp username
		if ($this->Account_model->check_duplicate($username)) {
			$this->session->set_flashdata('error', 'Tên tài khoản đã tồn tại!');
			redirect('accounts/add');
		}

		// Upload avatar nếu có
		$config['upload_path'] = './uploads/avatars/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);

		$avt_path = '';
		if (!empty($_FILES['avt']['name']) && $this->upload->do_upload('avt')) {
			$upload_data = $this->upload->data();
			$avt_path = 'uploads/avatars/' . $upload_data['file_name'];
		}

		// Lưu tài khoản
		$account_data = [
			'username' => $username,
			'password' => password_hash($password, PASSWORD_DEFAULT),
			'role' => $role,
			'avt' => $avt_path,
		];
		$account_id = $this->Account_model->insert($account_data);

		if ($role === 'student') {
			// Lưu thông tin sinh viên
			$info_data = [
				'mssv' => $mssv,
				'accountid' => $account_id,
				'fullname' => $fullname,
				'birthday' => $this->input->post('birthday'),
				'classid' => $this->input->post('classid'),
				'mail' => $email,
			];
			$this->Info_model->insert($info_data);
		} elseif ($role === 'teacher') {
			// Lưu thông tin giảng viên
			$teacher_data = [
				'accountid' => $account_id,
				'fullname' => $fullname,
				'qualification' => $this->input->post('qualification'),
				'teacher_code' => $this->input->post('teacher_code'),
			];
			$this->Teacher_model->insert($teacher_data);
		}

		$this->session->set_flashdata('message', ['type' => 'success', 'text' => 'Thêm tài khoản thành công!']);
		redirect('accounts');
	}

	// Sửa tài khoản (Form)
	public function edit($id)
	{
		$data['title'] = 'Sửa tài khoản';
		$data['view'] = 'accounts/edit';
		$data['account'] = $this->Account_model->get($id);
		$data['info'] = $this->Info_model->get_by_account($id);
		$data['classrooms'] = $this->Classroom_model->get_all();
		$data['teacher'] = $this->Teacher_model->get_by_account($id); // Lấy thông tin teacher nếu có
		$this->load->view('layouts/main', $data);
	}

	// Lưu cập nhật tài khoản
	public function update($id)
	{
		$username = $this->input->post('username');
		$role = $this->input->post('role');
		$fullname = $this->input->post('fullname');
		$email = $this->input->post('mail');
		$mssv = $this->input->post('mssv');

		// Kiểm tra trùng lặp username
		if ($this->Account_model->check_duplicate($username, $id)) {
			$this->session->set_flashdata('error', 'Tên tài khoản đã tồn tại!');
			redirect('accounts/edit/' . $id);
		}

		// Upload avatar nếu có
		$config['upload_path'] = './uploads/avatars/';
		$config['allowed_types'] = 'jpg|jpeg|png|gif';
		$config['max_size'] = 2048;
		$this->load->library('upload', $config);

		$account_data = [
			'username' => $username,
			'role' => $role,
		];

		if (!empty($_FILES['avt']['name']) && $this->upload->do_upload('avt')) {
			$upload_data = $this->upload->data();
			$account_data['avt'] = 'uploads/avatars/' . $upload_data['file_name'];
		}

		$this->Account_model->update($id, $account_data);

		if ($role === 'student') {
			// Cập nhật thông tin sinh viên
			$info_data = [
				'mssv' => $mssv,
				'fullname' => $fullname,
				'birthday' => $this->input->post('birthday'),
				'classid' => $this->input->post('classid'),
				'mail' => $email,
			];
			$this->Info_model->update_by_account($id, $info_data);
		} elseif ($role === 'teacher') {
			// Cập nhật thông tin giảng viên
			$teacher_data = [
				'fullname' => $fullname,
				'qualification' => $this->input->post('qualification'),
				'teacher_code' => $this->input->post('teacher_code'),
			];
			$this->Teacher_model->update_by_account($id, $teacher_data);
		}

		$this->session->set_flashdata('message', ['type' => 'success', 'text' => 'Cập nhật tài khoản thành công!']);
		redirect('accounts');
	}

	// Xóa tài khoản
	// Xóa tài khoản
	public function delete($id)
	{
		// Lấy thông tin tài khoản để kiểm tra vai trò
		$account = $this->Account_model->get($id);

		if (!$account) {
			$this->session->set_flashdata('error', 'Tài khoản không tồn tại!');
			redirect('accounts');
		}

		// Xử lý xóa theo vai trò
		if ($account['role'] === 'student') {
			// Xóa thông tin sinh viên
			$this->Info_model->delete_by_account($id);
		} elseif ($account['role'] === 'teacher') {
			// Xóa thông tin giảng viên
			$this->Teacher_model->delete_by_account($id);
		}

		// Xóa tài khoản
		$this->Account_model->delete($id);

		$this->session->set_flashdata('message', ['type' => 'success', 'text' => 'Xóa tài khoản thành công!']);
		redirect('accounts');
	}


	// Xem chi tiết tài khoản
	public function detail($id)
	{
		$data['title'] = 'Chi Tiết Tài Khoản';
		$data['view'] = 'accounts/detail';
		$data['account'] = $this->Account_model->get($id);
		$data['info'] = $this->Info_model->get_by_account($id);
		$data['teacher'] = $this->Teacher_model->get_by_account($id);
		$this->load->view('layouts/main', $data);
	}
}
