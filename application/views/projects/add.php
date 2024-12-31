<div class="container mt-5">
	<h2 class="text-center">Thêm Đồ án</h2>
	<?php if ($this->session->flashdata('error')): ?>
		<span class="text-danger"><?= $this->session->flashdata('error') ?></span>
	<?php endif; ?>
	<form action="<?= base_url('projects/store') ?>" method="POST">
		<div class="form-group">
			<label for="projectname">Tên đồ án</label>
			<input type="text" class="form-control" id="projectname" name="projectname" required>
		</div>
		<div class="form-group">
			<label for="projecttype">Loại đồ án</label>
			<select class="form-control" id="projecttype" name="projecttype" required>
				<option value="base">Cơ sở ngành</option>
				<option value="specialized">Chuyên ngành</option>
			</select>
		</div>
		<div class="form-group">
			<label for="mssv">MSSV</label>
			<input type="text" class="form-control" id="mssv" name="mssv" required>
		</div>
		<div class="form-group">
			<label for="teacherid">Giảng viên</label>
			<select class="form-control" id="teacherid" name="teacherid" required>
				<option value="">Chọn giảng viên</option>
				<?php foreach ($teachers as $teacher): ?>
					<option value="<?= $teacher['id'] ?>"><?= $teacher['fullname'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="totalscore">Điểm tổng</label>
			<input type="number" class="form-control" id="totalscore" name="totalscore" min="0" max="100" required>
		</div>

		<button type="submit" class="btn btn-success">Thêm</button>
		<a href="<?= base_url('projects') ?>" class="btn btn-secondary">Hủy</a>
	</form>
</div>
