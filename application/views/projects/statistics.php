<div class="container mt-5">
    <h2 class="text-center">Thống kê Đồ án</h2>
    <canvas id="projectStatistics"></canvas>
	<h2 class="text-center mt-4">Thống kê theo xếp hạng</h2>
    <canvas id="ratingChart"></canvas>
	<h2 class="text-center mt-4">Thống kê loại đồ án</h2>
    <canvas id="projectTypeChart"></canvas>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        var ctx = document.getElementById('projectStatistics').getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Chưa hoàn thành', 'Hoàn thành'],
                datasets: [{
                    label: 'Số lượng',
                    data: [<?= $statistics[0]['total'] ?? 0 ?>, <?= $statistics[1]['total'] ?? 0 ?>],
                    backgroundColor: ['#f39c12', '#2ecc71'],
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: false }
                }
            }
        });
    });
</script>
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
