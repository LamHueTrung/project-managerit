<div class="container mt-5">
    <h2 class="text-center">Chi tiết tài khoản</h2>
    <div class="card">
        <div class="card-header">
            <h4>Tài khoản: <?= htmlspecialchars($account['username']) ?></h4>
        </div>
        <div class="card-body">
            <p><strong>Quyền:</strong> <?= ucfirst($account['role']) ?></p>

            <?php if ($account['role'] === 'student'): ?>
                <p><strong>Họ và tên:</strong> <?= htmlspecialchars($info['fullname']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($info['mail']) ?></p>
                <p><strong>Ngày sinh:</strong> <?= date('d-m-Y', strtotime($info['birthday'])) ?></p>
                <p><strong>Mã số sinh viên:</strong> <?= htmlspecialchars($info['mssv']) ?></p>
                <p><strong>Lớp:</strong> <?= htmlspecialchars($info['classid']) ?></p>
            <?php elseif ($account['role'] === 'teacher'): ?>
                <p><strong>Họ và tên:</strong> <?= htmlspecialchars($teacher['fullname']) ?></p>
                <p><strong>Mã giảng viên:</strong> <?= htmlspecialchars($teacher['teacher_code']) ?></p>
                <p><strong>Trình độ:</strong> <?= htmlspecialchars($teacher['qualification']) ?></p>
            <?php endif; ?>

            <p>
                <strong>Ảnh đại diện:</strong><br>
                <?php if (!empty($account['avt'])): ?>
                    <img src="<?= base_url($account['avt']) ?>" alt="Avatar" width="100">
                <?php else: ?>
                    Không có ảnh đại diện
                <?php endif; ?>
            </p>
        </div>
        <div class="card-footer">
            <a href="<?= base_url('accounts/edit/' . $account['id']) ?>" class="btn btn-warning">Sửa</a>
            <a href="<?= base_url('accounts') ?>" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>
