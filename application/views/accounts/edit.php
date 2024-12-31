<div class="container mt-5">
    <h2 class="text-center">Sửa tài khoản</h2>
    <form action="<?= base_url('accounts/update/' . $account['id']) ?>" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="username">Tên tài khoản</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= $account['username'] ?>" required>
        </div>
        <div class="form-group">
            <label for="role">Quyền</label>
            <select name="role" id="role" class="form-control" required>
                <option value="admin" <?= $account['role'] === 'admin' ? 'selected' : '' ?>>Quản trị viên</option>
                <option value="teacher" <?= $account['role'] === 'teacher' ? 'selected' : '' ?>>Giảng viên</option>
                <option value="student" <?= $account['role'] === 'student' ? 'selected' : '' ?>>Sinh viên</option>
            </select>
        </div>
        <div id="student-fields" style="display: <?= $account['role'] === 'student' ? 'block' : 'none' ?>;">
            <div class="form-group">
                <label for="mssv">Mã số sinh viên</label>
                <input type="text" name="mssv" id="mssv" class="form-control" value="<?= $info['mssv'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="classid">Lớp</label>
                <select name="classid" id="classid" class="form-control">
                    <option value="">Chọn lớp</option>
                    <?php foreach ($classrooms as $classroom): ?>
                        <option value="<?= $classroom['classid'] ?>" <?= isset($info['classid']) && $info['classid'] === $classroom['classid'] ? 'selected' : '' ?>>
                            <?= $classroom['classname'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
			<div class="form-group">
            <label for="mail">Email</label>
            <input type="email" name="mail" id="mail" class="form-control" value="<?= $info['mail'] ?? '' ?>">
        </div>
        </div>
        <div id="teacher-fields" style="display: <?= $account['role'] === 'teacher' ? 'block' : 'none' ?>;">
            <div class="form-group">
                <label for="teacher_code">Mã giảng viên</label>
                <input type="text" name="teacher_code" id="teacher_code" class="form-control" value="<?= $teacher['teacher_code'] ?? '' ?>">
            </div>
            <div class="form-group">
                <label for="qualification">Trình độ</label>
                <select name="qualification" id="qualification" class="form-control">
                    <option value="Master" <?= isset($teacher['qualification']) && $teacher['qualification'] === 'Master' ? 'selected' : '' ?>>Thạc sĩ</option>
                    <option value="PhD" <?= isset($teacher['qualification']) && $teacher['qualification'] === 'PhD' ? 'selected' : '' ?>>Tiến sĩ</option>
                </select>
            </div>
        </div>
        <div class="form-group">
            <label for="fullname">Họ và tên</label>
            <input type="text" name="fullname" id="fullname" class="form-control" value="<?= $info['fullname'] ?? $account['username'] ?>">
        </div>
        <div class="form-group">
            <label for="birthday">Ngày sinh</label>
            <input type="date" name="birthday" id="birthday" class="form-control" value="<?= $info['birthday'] ?? '' ?>">
        </div>
        <div class="form-group">
            <label for="avt">Ảnh đại diện</label>
            <input type="file" name="avt" id="avt" class="form-control-file">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
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
