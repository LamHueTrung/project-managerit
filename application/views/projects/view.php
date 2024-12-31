<div class="container mt-5">
    <h2 class="text-center">Chi tiết Đồ án</h2>
    <div class="card">
        <div class="card-body">
            <p><strong>Tên đồ án:</strong> <?= $project['projectname'] ?></p>
            <p><strong>Loại:</strong> <?= $project['projecttype'] === 'base' ? 'Cơ sở ngành' : 'Chuyên ngành' ?></p>
            <p><strong>MSSV:</strong> <?= $project['mssv'] ?></p>
            <p><strong>Tên sinh viên:</strong> <?= $project['student_name'] ?></p>
            <p><strong>Email sinh viên:</strong> <?= $project['student_email'] ?></p>
            <p><strong>Ngày sinh:</strong> <?= date('d-m-Y', strtotime($project['student_birthday'])) ?></p>
            <p><strong>Lớp:</strong> <?= $project['classname'] ?> (Khóa: <?= $project['classroom_courseyear'] ?>)</p>
            <p><strong>Giảng viên hướng dẫn:</strong> <?= $project['teacher_name'] ?> (Mã GV: <?= $project['teacher_code'] ?>)</p>
            <p><strong>Điểm tổng:</strong> <?= $project['totalscore'] ?></p>
            <p><strong>Xếp loại:</strong> <?= ucfirst($project['rating']) ?></p>
            <p><strong>Trạng thái:</strong> <?= $project['status'] === 'completed' ? 'Hoàn thành' : 'Chưa hoàn thành' ?></p>
        </div>
        <div class="card-footer d-flex justify-content-between">
            <a href="<?= base_url('projects') ?>" class="btn btn-secondary">Quay lại</a>
        </div>
    </div>
</div>
