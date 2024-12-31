<div class="card shadow mb-4">
	<div class="card-header py-3">
		<h6 class="m-0 font-weight-bold text-primary">Sửa thông tin lớp học</h6>
		<?php if ($this->session->flashdata('error')): ?>
			<span class="text-danger"><?= $this->session->flashdata('error') ?></span>
		<?php endif; ?>
	</div>
	<div class="card-body">
		<form action="<?= base_url('classrooms/update/' . $classroom['id']); ?>" method="post">
			<div class="mb-3">
				<label class="form-label">Tên lớp</label>
				<input type="text" class="form-control" name="classname" value="<?= $classroom['classname']; ?>"
					required>
			</div>
			<div class="mb-3">
				<label class="form-label">Mã lớp</label>
				<input type="text" class="form-control" name="classid" value="<?= $classroom['classid']; ?>" required>
			</div>
			<div class="mb-3">
				<label class="form-label">Khóa học</label>
				<input type="text" class="form-control" name="courseyear" value="<?= $classroom['courseyear']; ?>"
					required>
			</div>


			<button type="submit" class="btn btn-primary">Lưu thay đổi</button>
		</form>
	</div>
</div>
