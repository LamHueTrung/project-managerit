<div class="card shadow mb-4">
	<div class="card-header py-3 d-flex justify-content-between">
		<h6 class="m-0 font-weight-bold text-primary">Danh sách lớp học</h6>
	</div>
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>#</th>
						<th>Tên lớp</th>
						<th>Mã lớp</th>
						<th>Khóa học</th>
						<th>Hành động</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($classrooms as $index => $classroom): ?>
						<tr>
							<td><?= $index + 1; ?></td>
							<td><?= $classroom['classname']; ?></td>
							<td><?= $classroom['classid']; ?></td>
							<td><?= $classroom['courseyear']; ?></td>
							<td>
								<a href="<?= base_url('classrooms/edit/' . $classroom['id']); ?>"
									class="btn btn-warning btn-sm">Sửa</a>
								<a href="<?= base_url('classrooms/delete/' . $classroom['id']); ?>"
									class="btn btn-danger btn-sm"
									onclick="return confirm('Bạn có chắc chắn muốn xóa lớp này?');">Xóa</a>
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
