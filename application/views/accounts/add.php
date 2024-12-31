<div class="container mt-5">
    <h2 class="text-center">Thêm tài khoản</h2>
    <form action="<?= base_url('accounts/store') ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Tên tài khoản</label>
            <input type="text" name="username" id="username" class="form-control" placeholder="Nhập tên tài khoản" required>
        </div>
        <div class="form-group">
            <label for="password">Mật khẩu</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="Nhập mật khẩu" required>
        </div>
        <div class="form-group">
            <label for="role">Quyền</label>
            <select name="role" id="role" class="form-control" required>
                <option value="">Chọn quyền</option>
                <option value="admin">Quản trị viên</option>
                <option value="teacher">Giảng viên</option>
                <option value="student">Sinh viên</option>
            </select>
        </div>
        <div id="student-fields" style="display: none;">
            <div class="form-group">
                <label for="mssv">Mã số sinh viên</label>
                <input type="text" name="mssv" id="mssv" class="form-control" placeholder="Nhập mã số sinh viên">
            </div>
            <div class="form-group">
                <label for="classid">Lớp</label>
                <select name="classid" id="classid" class="form-control">
                    <option value="">Chọn lớp</option>
                    <?php foreach ($classrooms as $classroom): ?>
                        <option value="<?= $classroom['classid'] ?>"><?= $classroom['classname'] ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
			<div class="form-group">
            <label for="mail">Email</label>
            <input type="email" name="mail" id="mail" class="form-control" placeholder="Nhập email">
        </div>
        </div>
        <div id="teacher-fields" style="display: none;">
            <div class="form-group">
                <label for="teacher_code">Mã giảng viên</label>
                <input type="text" name="teacher_code" id="teacher_code" class="form-control" placeholder="Nhập mã giảng viên">
            </div>
            <div class="form-group">
                <label for="qualification">Trình độ</label>
                <select name="qualification" id="qualification" class="form-control">
                    <option value="">Chọn trình độ</option>
                    <option value="Master">Thạc sĩ</option>
                    <option value="PhD">Tiến sĩ</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="fullname">Họ và tên</label>
            <input type="text" name="fullname" id="fullname" class="form-control" placeholder="Nhập họ và tên">
        </div>
        
        <div class="form-group">
            <label for="birthday">Ngày sinh</label>
            <input type="date" name="birthday" id="birthday" class="form-control">
        </div>
        <div class="form-group">
            <label for="avt">Ảnh đại diện</label>
            <input type="file" name="avt" id="avt" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Thêm tài khoản</button>
        <a href="<?= base_url('accounts') ?>" class="btn btn-secondary">Quay lại</a>
    </form>
</div>

<script>
    document.getElementById('role').addEventListener('change', function () {
        const role = this.value;
        document.getElementById('student-fields').style.display = (role === 'student') ? 'block' : 'none';
        document.getElementById('teacher-fields').style.display = (role === 'teacher') ? 'block' : 'none';
    });
</script>
