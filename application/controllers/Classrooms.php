<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Classrooms extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('Classroom_model');
	}

	// Danh sách lớp học
	public function index()
	{
		$data['title'] = 'Danh sách lớp học';
		$data['view'] = 'classrooms/index';
		$data['classrooms'] = $this->Classroom_model->get_all();
		$this->load->view('layouts/main', $data);
	}

	// Thêm lớp học
	public function add()
	{
		$data['title'] = 'Thêm lớp học';
		$data['view'] = 'classrooms/add';
		$this->load->view('layouts/main', $data);
	}

	public function store()
	{
		$classname = $this->input->post('classname');
		$classid = $this->input->post('classid');
		$courseyear = $this->input->post('courseyear');

		// Kiểm tra trùng lặp tên lớp và mã lớp
		$exists = $this->Classroom_model->check_duplicate($classname, $classid, $courseyear);

		if ($exists) {
			// Trả về lỗi nếu trùng
			$this->session->set_flashdata('error', 'Tên lớp hoặc mã lớp đã tồn tại trong khóa học này!');
			redirect('classrooms/add');
		} else {
			// Thêm mới lớp học
			$classroom = [
				'classname' => $classname,
				'classid' => $classid,
				'courseyear' => $courseyear,
			];
			$this->Classroom_model->insert($classroom);

			$this->session->set_flashdata('message', [
				'type' => 'success',
				'text' => 'Thêm lớp học thành công!'
			]);
			redirect('classrooms');
		}
	}

	public function edit($id) {
        $data['title'] = 'Sửa thông tin lớp học';
        $data['view'] = 'classrooms/edit';
        $data['classroom'] = $this->Classroom_model->get($id);
        $this->load->view('layouts/main', $data);
    }

	// Sửa lớp học
	public function update($id)
	{
		$classname = $this->input->post('classname') ?: $this->Classroom_model->get($id)['classname'];
		$classid = $this->input->post('classid') ?: $this->Classroom_model->get($id)['classid'];
		$courseyear = $this->input->post('courseyear') ?: $this->Classroom_model->get($id)['courseyear'];

		// Kiểm tra trùng lặp tên lớp và mã lớp
		$exists = $this->Classroom_model->check_duplicate($classname, $classid, $courseyear, $id);

		if ($exists) {
			// Trả về lỗi nếu trùng
			$this->session->set_flashdata('error', 'Tên lớp hoặc mã lớp đã tồn tại trong khóa học này!');
			redirect('classrooms/edit/' . $id);
		} else {
			// Cập nhật lớp học
			$classroom = [
				'classname' => $classname,
				'classid' => $classid,
				'courseyear' => $courseyear,
			];
			$this->Classroom_model->update($id, $classroom);

			$this->session->set_flashdata('message', [
				'type' => 'success',
				'text' => 'Cập nhật lớp học thành công!'
			]);
			redirect('classrooms');
		}
	}

	// Xóa lớp học
	public function delete($id) {
    // Kiểm tra số lượng sinh viên trong lớp
    $students_in_class = $this->Classroom_model->count_students($id);

    if ($students_in_class > 0) {
        // Kiểm tra sinh viên trong lớp có tham gia đồ án hay không
        $students_in_projects = $this->Classroom_model->check_students_in_projects($id);

        if ($students_in_projects > 0) {
            // Thông báo lỗi nếu có sinh viên tham gia đồ án
            $this->session->set_flashdata('error', 'Không thể xóa lớp vì có sinh viên đang tham gia đồ án!');
            redirect('classrooms');
        } else {
            // Hiển thị xác nhận xóa sinh viên trước khi xóa lớp
            $this->session->set_flashdata('confirm_delete', [
                'text' => "Lớp này có $students_in_class sinh viên. Bạn có muốn xóa tất cả sinh viên không?",
                'classroom_id' => $id
            ]);
            redirect('classrooms');
        }
    } else {
        // Xóa lớp nếu không có sinh viên
        $this->Classroom_model->delete($id);
        $this->session->set_flashdata('message', [
            'type' => 'success',
            'text' => 'Xóa lớp học thành công!'
        ]);
        redirect('classrooms');
    }
}



	public function confirm_delete_students($id)
	{
		// Xóa tất cả sinh viên trong lớp và sau đó xóa lớp
		$this->Classroom_model->delete_students($id);
		$this->Classroom_model->delete($id);

		$this->session->set_flashdata('message', [
			'type' => 'success',
			'text' => 'Xóa lớp học và tất cả sinh viên thành công!'
		]);
		redirect('classrooms');
	}
}
