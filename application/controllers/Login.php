<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Session $session
 */
class Login extends MY_Controller {
    public function __construct() {
        parent::__construct();
        $this->load->model('Account_model');
    }

    // Hiển thị trang login
    public function index() {
		$error = $this->session->flashdata('error');
		$this->load->view('login', ['error' => $error]);
	}

    // Xử lý xác thực đăng nhập
    public function authenticate() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        // Lấy thông tin tài khoản từ database
        $account = $this->Account_model->get_account_by_username($username);

        if ($account && password_verify($password, $account['password'])) {
            // Kiểm tra quyền và lưu thông tin vào session
            $this->session->set_userdata([
                'user_id' => $account['id'],
                'username' => $account['username'],
                'role' => $account['role'],
                'logged_in' => TRUE,
            ]);

			// Thông báo đăng nhập thành công
			$this->session->set_flashdata('message', [
				'type' => 'success', // Hoặc 'error' tùy trường hợp
				'text' => 'Đăng nhập thành công!'
			]);

            // Điều hướng theo quyền
            switch ($account['role']) {
                case 'admin':
                    redirect('dashboard');
                    break;
                case 'teacher':
                    redirect('projects');
                    break;
                case 'student':
                    redirect('projects/search');
                    break;
                default:
                    $this->session->set_flashdata('error', 'Đăng nhập thất bại !');
                    redirect('login');
            }
        } else {
            // Đăng nhập thất bại
            $this->session->set_flashdata('error', 'Tài khoản hoặc mật khẩu không chính xác!');
            redirect('login');
        }
    }

    // Đăng xuất
    public function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
}
