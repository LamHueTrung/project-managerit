<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Thêm lớp học</h6>
		<?php if ($this->session->flashdata('error')): ?>
			<span class="text-danger"><?= $this->session->flashdata('error') ?></span>
		<?php endif; ?>
	</div>
	<div class="card-body">
		<form action="<?= base_url('classrooms/store'); ?>" method="post">
			<div class="mb-3">
				<label class="form-label">Mã lớp</label>
				<input type="text" class="form-control" name="classid" placeholder="Nhập mã lớp" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Tên lớp</label>
				<input type="text" class="form-control" name="classname" placeholder="Nhập tên lớp" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Khóa học</label>
				<input type="text" class="form-control" name="courseyear" placeholder="Nhập khóa học (VD: 2023)"
					required>
			</div>

			<button type="submit" class="btn btn-primary">Thêm</button>
		</form>
	</div>
</div>
