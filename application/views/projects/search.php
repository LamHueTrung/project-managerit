<div class="container mt-4 card shadow mb-4">
	<h1 class="text-center mt-4">Tra cứu đồ án</h1>
	<?php if (!empty($projects)): ?>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>Tên đồ án</th>
							<th>MSSV</th>
							<th>Sinh viên</th>
							<th>Lớp học</th>
							<th>Trạng thái</th>
							<th>Thao tác</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($projects as $project): ?>
							<tr>
								<td><?= $project['projectname'] ?></td>
								<td><?= $project['mssv'] ?></td>
								<td><?= $project['student_name'] ?></td>
								<td><?= $project['classname'] ?></td>
								<td><?= ucfirst($project['status']) ?></td>
								<td>
									<a href="<?= base_url('projects/view/' . $project['id']) ?>" class="btn btn-info">Xem chi
										tiết</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			<?php else: ?>
				<p class="mt-4">Không có kết quả tìm kiếm phù hợp.</p>
			<?php endif; ?>

		</div>
	</div>

</div>
