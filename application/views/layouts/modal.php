<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
	aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Bạn muốn đăng xuất?</h5>
				<button class="close" type="button" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">×</span>
				</button>
			</div>
			<div class="modal-body">Chọn Đăng xuất để thoát khỏi hệ thống</div>
			<div class="modal-footer">
				<button class="btn btn-secondary" type="button" data-dismiss="modal">Huỷ</button>
				<form action="<?= base_url('logout') ?>" method="post">
				
				<button class="btn btn-primary" type="submit">Đăng xuất</button>
			</form>
			</div>
		</div>
	</div>
</div>
