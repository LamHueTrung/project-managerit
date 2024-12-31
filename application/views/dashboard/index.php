<div class="row">
	<!-- Users -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-primary shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
							Tổng số người dùng</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $user_count ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-users fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Projects -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-success shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-success text-uppercase mb-1">
							Tổng số đồ án</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $project_count ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-folder fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Classrooms -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-info shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-info text-uppercase mb-1">
							Tổng số lớp học</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $classroom_count ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-school fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Teachers -->
	<div class="col-xl-3 col-md-6 mb-4">
		<div class="card border-left-warning shadow h-100 py-2">
			<div class="card-body">
				<div class="row no-gutters align-items-center">
					<div class="col mr-2">
						<div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
							Tổng số giáo viên</div>
						<div class="h5 mb-0 font-weight-bold text-gray-800"><?= $teacher_count ?></div>
					</div>
					<div class="col-auto">
						<i class="fas fa-chalkboard-teacher fa-2x text-gray-300"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="row ">
	<div class="col-xl-8">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Thống kê theo xếp hạng</h6>
			</div>
			<div class="card-body">
				<canvas id="ratingChart"></canvas>
			</div>
		</div>
	</div>
	<div class="col-xl-4">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Thống kê loại đồ án</h6>
			</div>
			<div class="card-body">
				<canvas id="projectTypeChart"></canvas>
			</div>
		</div>
	</div>

 
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	// Dữ liệu thống kê loại đồ án từ server
	const projectTypeData = <?= json_encode($project_stats) ?>;
	const projectTypeLabels = projectTypeData.map(data => data.projecttype === 'base' ? 'Cơ sở ngành' : 'Chuyên ngành');
	const projectTypeCounts = projectTypeData.map(data => data.count);

	// Dữ liệu thống kê rating từ server
	const ratingData = <?= json_encode($rating_stats) ?>;
	const ratingLabels = ['Excellent', 'Good', 'Fair', 'Poor'];
	const ratingCounts = [ratingData.excellent || 0, ratingData.good || 0, ratingData.fair || 0, ratingData.poor || 0];

	// Biểu đồ thống kê loại đồ án
	const ctxProjectType = document.getElementById('projectTypeChart').getContext('2d');
	new Chart(ctxProjectType, {
		type: 'pie',
		data: {
			labels: projectTypeLabels,
			datasets: [{
				data: projectTypeCounts,
				backgroundColor: ['#4e73df', '#1cc88a'],
				hoverBackgroundColor: ['#2e59d9', '#17a673'],
				borderColor: '#fff',
			}],
		},
		options: {
			responsive: true,
			plugins: {
				legend: {
					position: 'top',
				},
			},
		},
	});

	// Biểu đồ thống kê rating
	const ctxRating = document.getElementById('ratingChart').getContext('2d');
	new Chart(ctxRating, {
		type: 'bar',
		data: {
			labels: ratingLabels,
			datasets: [{
				label: 'Số lượng',
				data: ratingCounts,
				backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc', '#f6c23e'],
				borderColor: ['#2e59d9', '#17a673', '#2c9faf', '#f4b619'],
				borderWidth: 1,
			}],
		},
		options: {
			responsive: true,
			plugins: {
				legend: {
					display: false,
				},
			},
			scales: {
				y: {
					beginAtZero: true,
				},
			},
		},
	});
</script>
