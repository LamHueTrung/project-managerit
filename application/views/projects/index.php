<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between">
		<h2 class="text-center">Danh sách Đồ án</h2>
		<a href="<?= base_url('projects/add') ?>" class="btn btn-primary mb-3">Thêm Đồ án</a>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên đồ án</th>
						<th>Loại</th>
						<th>MSSV</th>
						<th>Lớp</th>
						<th>Giảng viên</th>
						<th>Trạng thái</th>
						<th>Thao tác</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($projects as $index => $project): ?>
						<tr>
							<td><?= $index + 1 ?></td>
							<td><?= $project['projectname'] ?></td>
							<td><?= $project['projecttype'] === 'base' ? 'Cơ sở ngành' : 'Chuyên ngành' ?></td>
							<td><?= $project['mssv'] ?></td>
							<td><?= $project['classname'] ?></td>
							<td><?= $project['teacher_name'] ?></td>
							<td><?= ucfirst($project['status']) ?></td>
							<td>
								<a href="<?= base_url('projects/detail/' . $project['id']) ?>"
									class="btn btn-info btn-sm">Chi tiết</a>
								<a href="<?= base_url('projects/edit/' . $project['id']) ?>"
									class="btn btn-warning btn-sm">Sửa</a>
								<a href="<?= base_url('projects/delete/' . $project['id']) ?>" class="btn btn-danger btn-sm"
									onclick="return confirm('Bạn có chắc chắn muốn xóa không?')">Xóa</a>
							</td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
			<?php if ($this->session->flashdata('error')): ?>
				<div class="alert alert-danger alert-dismissible fade show" role="alert">
					<?= $this->session->flashdata('error') ?>
					<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
				</div>
			<?php endif; ?>

		</div>
	</div>
</div>

<?php if ($this->session->flashdata('confirm_delete')): ?>
	<script>
		Swal.fire({
			title: "Xác nhận xóa!",
			text: "<?= $this->session->flashdata('confirm_delete')['text'] ?>",
			icon: "warning",
			showCancelButton: true,
			confirmButtonText: "Xóa tất cả",
			cancelButtonText: "Hủy"
		}).then((result) => {
			if (result.isConfirmed) {
				window.location.href = "<?= base_url('classrooms/confirm_delete_students/' . $this->session->flashdata('confirm_delete')['classroom_id']) ?>";
			}
		});
	</script>
<?php endif; ?>
