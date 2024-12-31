<div class="container mt-5">
	<h2 class="text-center">Sửa Đồ án</h2>
	<?php if ($this->session->flashdata('error')): ?>
		<span class="text-danger"><?= $this->session->flashdata('error') ?></span>
	<?php endif; ?>
	<form action="<?= base_url('projects/update/' . $project['id']) ?>" method="POST">
		<div class="form-group">
			<label for="projectname">Tên đồ án</label>
			<input type="text" class="form-control" id="projectname" name="projectname"
				value="<?= $project['projectname'] ?>" required>
		</div>
		<div class="form-group">
			<label for="projecttype">Loại đồ án</label>
			<select class="form-control" id="projecttype" name="projecttype" required>
				<option value="base" <?= $project['projecttype'] === 'base' ? 'selected' : '' ?>>Cơ sở ngành</option>
				<option value="specialized" <?= $project['projecttype'] === 'specialized' ? 'selected' : '' ?>>Chuyên ngành
				</option>
			</select>
		</div>
		<div class="form-group">
			<label for="mssv">MSSV</label>
			<input type="text" class="form-control" id="mssv" name="mssv" value="<?= $project['mssv'] ?>" required>
		</div>
		<div class="form-group">
			<label for="teacherid">Giảng viên</label>
			<select class="form-control" id="teacherid" name="teacherid" required>
				<?php foreach ($teachers as $teacher): ?>
					<option value="<?= $teacher['id'] ?>" <?= $teacher['id'] == $project['teacherid'] ? 'selected' : '' ?>>
						<?= $teacher['fullname'] ?></option>
				<?php endforeach; ?>
			</select>
		</div>
		<div class="form-group">
			<label for="totalscore">Điểm tổng</label>
			<input type="number" class="form-control" id="totalscore" name="totalscore"
				value="<?= $project['totalscore'] ?>" min="0" max="100" required>
		</div>
		<button type="submit" class="btn btn-primary">Cập nhật</button>
		<a href="<?= base_url('projects') ?>" class="btn btn-secondary">Hủy</a>
	</form>
</div>
