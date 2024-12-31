<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdminSeeder {
    public function seed_admin() {
        $CI =& get_instance();

        // Tải thư viện cơ sở dữ liệu nếu chưa được tải
        if (!isset($CI->db)) {
            $CI->load->database();
        }

        // Kiểm tra xem admin có tồn tại chưa
        $query = $CI->db->get_where('accounts', ['username' => 'admin@hotmail.com']);
        if ($query->num_rows() == 0) {
            // Mã hóa mật khẩu
            $hashed_password = password_hash('Admin110121255*', PASSWORD_DEFAULT);

            // Tạo tài khoản admin
            $admin_data = [
                'username' => 'admin@hotmail.com',
                'password' => $hashed_password,
                'role' => 'admin',
                'isdeleted' => 0,
            ];
            $CI->db->insert('accounts', $admin_data);
        }
    }
}
