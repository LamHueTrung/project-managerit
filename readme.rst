# Project Manager - README

## **Mô Tả Bài Toán**
Website **Project Manager** là một hệ thống quản lý đồ án dành cho các trường đại học, phục vụ các nhóm người dùng chính: **Admin**, **Giảng viên (Teacher)** và **Sinh viên (Student)**. Hệ thống hỗ trợ quản lý tài khoản, lớp học, đồ án, cũng như các chức năng thống kê và tìm kiếm, giúp việc quản lý hiệu quả hơn.

---

## **Yêu Cầu Bài Toán**

### **1. Quản lý tài khoản**
- Tạo, sửa, xóa tài khoản.
- Phân quyền người dùng theo vai trò: **Admin**, **Teacher**, **Student**.
- Lưu thông tin chi tiết theo từng loại tài khoản (thông tin sinh viên, giảng viên).

### **2. Quản lý đồ án**
- Lưu trữ thông tin đồ án: tên, loại (cơ sở ngành/chuyên ngành), MSSV, giảng viên hướng dẫn, điểm tổng, trạng thái.
- Tự động xếp loại (**Excellent, Good, Fair, Poor**) và trạng thái (**Đậu/Rớt**) dựa trên điểm tổng.

### **3. Quản lý lớp học**
- Thêm, sửa, xóa thông tin lớp học.
- Kết nối lớp học với thông tin sinh viên.

### **4. Thống kê**
- Biểu đồ thống kê loại đồ án (Cơ sở ngành/Chuyên ngành).
- Biểu đồ xếp loại đồ án (Excellent, Good, Fair, Poor).
- Báo cáo số lượng tài khoản, lớp học, đồ án, giảng viên.

### **5. Tìm kiếm và tra cứu**
- Tìm kiếm đồ án theo MSSV, tên đồ án, lớp học hoặc trạng thái.
- Xem chi tiết thông tin đồ án, sinh viên thực hiện, giảng viên hướng dẫn.

---

## **Hướng Dẫn Cài Đặt**

### **Yêu Cầu Hệ Thống**
- **Web Server**: Apache hoặc Nginx.
- **PHP**: 7.4 hoặc cao hơn.
- **Database**: MySQL.
- **Framework**: CodeIgniter 3.x.
- **Thư viện**:
  - **Chart.js**: Hiển thị biểu đồ.
  - **SweetAlert2**: Hiển thị thông báo đẹp mắt.

### **Các Bước Cài Đặt**

1. **Clone repository**:
   ```bash
   git clone https://github.com/project-managerit.git
   ```
2. **Cấu hình cơ sở dữ liệu**:
   - Tạo database trong MySQL.
   - Nhập file SQL: `db_projectmanagerit.sql`.
   - Chỉnh sửa file `application/config/database.php` để kết nối database.
3. **Thiết lập CodeIgniter**:
   - Cập nhật URL gốc trong `application/config/config.php`:
     ```php
     $config['base_url'] = 'http://localhost/ProjectManager/';
     ```
4. **Cài đặt thư viện**:
   - Đảm bảo composer được cài đặt và chạy:
     ```bash
     composer install
     ```
5. **Khởi chạy ứng dụng**:
   - Đặt project vào thư mục `htdocs`.
   - Khởi động **XAMPP** hoặc **WAMP**.
   - Truy cập URL: `http://localhost/ProjectManager`.

---

## **Chức Năng Trên Website**

### **1. Quản lý Tài khoản**
- **Danh sách tài khoản**: Hiển thị danh sách tài khoản hiện có.
- **Thêm tài khoản**:
  - Nhập thông tin tài khoản (username, password, role).
  - Tự động lưu thông tin chi tiết vào bảng liên quan (**Student/Teacher**).
- **Sửa tài khoản**:
  - Cập nhật thông tin tài khoản, bao gồm avatar.
- **Xóa tài khoản**:
  - Kiểm tra liên kết với thông tin trước khi xóa.

### **2. Quản lý Lớp học**
- **Danh sách lớp học**: Hiển thị thông tin tất cả các lớp học.
- **Thêm lớp học**:
  - Nhập thông tin (mã lớp, tên lớp, khóa học).
  - Kiểm tra trùng lặp mã lớp.
- **Sửa lớp học**: Cập nhật thông tin lớp học.
- **Xóa lớp học**:
  - Kiểm tra liên kết với sinh viên trước khi xóa.

### **3. Quản lý Đồ án**
- **Danh sách đồ án**: Hiển thị thông tin các đồ án hiện có.
- **Thêm đồ án**:
  - Nhập thông tin đồ án (tên đồ án, loại, MSSV, giảng viên, điểm tổng).
  - Tự động xếp loại và trạng thái dựa trên điểm tổng.
- **Sửa đồ án**: Cập nhật thông tin đồ án.
- **Xóa đồ án**: Xóa đồ án sau khi kiểm tra liên kết.
- **Tra cứu đồ án**:
  - Tìm kiếm theo MSSV, tên đồ án, hoặc lớp học.
  - Xem chi tiết đầy đủ thông tin đồ án.

### **4. Thống kê**
- **Loại đồ án**: Pie Chart thống kê số lượng đồ án theo loại.
- **Xếp loại đồ án**: Bar Chart hiển thị số lượng đồ án theo rating.
- **Tổng quan**:
  - Tổng số tài khoản, lớp học, đồ án, giảng viên.

---

## **Mô Tả Cơ Sở Dữ Liệu**

### **Bảng `accounts`**
- **Mục đích**: Lưu thông tin tài khoản người dùng.
- **Các trường**:
  - `id`: ID duy nhất của tài khoản.
  - `username`: Tên đăng nhập.
  - `password`: Mật khẩu (đã mã hóa).
  - `role`: Vai trò (`admin`, `teacher`, `student`).
  - `avt`: Đường dẫn ảnh đại diện.

### **Bảng `infos`**
- **Mục đích**: Lưu thông tin cá nhân của sinh viên.
- **Các trường**:
  - `id`: ID duy nhất.
  - `accountid`: ID tài khoản (liên kết `accounts`).
  - `fullname`: Họ và tên.
  - `birthday`: Ngày sinh.
  - `mail`: Email.
  - `classid`: ID lớp học (liên kết `classrooms`).
  - `mssv`: Mã số sinh viên.

### **Bảng `teachers`**
- **Mục đích**: Lưu thông tin chi tiết của giảng viên.
- **Các trường**:
  - `id`: ID duy nhất.
  - `accountid`: ID tài khoản (liên kết `accounts`).
  - `fullname`: Họ và tên.
  - `teacher_code`: Mã giảng viên.
  - `qualification`: Trình độ chuyên môn.
  - `mail`: Email.

### **Bảng `classrooms`**
- **Mục đích**: Lưu thông tin lớp học.
- **Các trường**:
  - `id`: ID duy nhất.
  - `classname`: Tên lớp học.
  - `classid`: Mã lớp học.
  - `courseyear`: Khóa học.

### **Bảng `projects`**
- **Mục đích**: Lưu thông tin đồ án.
- **Các trường**:
  - `id`: ID duy nhất.
  - `projectname`: Tên đồ án.
  - `projecttype`: Loại đồ án (`base`, `specialized`).
  - `mssv`: Mã số sinh viên (liên kết `infos`).
  - `teacherid`: ID giảng viên (liên kết `teachers`).
  - `totalscore`: Điểm tổng.
  - `rating`: Xếp loại (`Excellent`, `Good`, `Fair`, `Poor`).
  - `status`: Trạng thái (`completed`, `notcompleted`).

### **Mối quan hệ giữa các bảng**
1. `accounts → infos`: (1:1) Tài khoản sinh viên liên kết thông tin cá nhân.
2. `accounts → teachers`: (1:1) Tài khoản giảng viên liên kết thông tin giảng viên.
3. `classrooms → infos`: (1:N) Một lớp học có nhiều sinh viên.
4. `projects → infos`: (N:1) Đồ án thuộc về một sinh viên.
5. `projects → teachers`: (N:1) Đồ án hướng dẫn bởi một giảng viên.

---
