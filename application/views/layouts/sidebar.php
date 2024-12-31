<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-graduation-cap"></i>
        </div>
        <div class="sidebar-brand-text mx-3">
            <?= ucfirst($this->session->userdata('role')) ?> Dashboard
        </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <?php if ($this->session->userdata('role') === 'admin'): ?>
        <!-- Admin Section -->
        <div class="sidebar-heading">Admin Functions</div>

        <!-- User Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manageUsers"
               aria-expanded="true" aria-controls="manageUsers">
                <i class="fas fa-fw fa-users"></i>
                <span>Quản lý người dùng</span>
            </a>
            <div id="manageUsers" class="collapse" aria-labelledby="headingUsers" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Người dùng:</h6>
                    <a class="collapse-item" href="<?= base_url('accounts/add') ?>">Thêm mới</a>
                    <a class="collapse-item" href="<?= base_url('accounts') ?>">Danh sách</a>
                </div>
            </div>
        </li>

        <!-- Classroom Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manageClassrooms"
               aria-expanded="true" aria-controls="manageClassrooms">
                <i class="fas fa-fw fa-school"></i>
                <span>Quản lý lớp học</span>
            </a>
            <div id="manageClassrooms" class="collapse" aria-labelledby="headingClassrooms" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Lớp học:</h6>
                    <a class="collapse-item" href="<?= base_url('classrooms/add') ?>">Thêm mới</a>
                    <a class="collapse-item" href="<?= base_url('classrooms') ?>">Danh sách</a>
                </div>
            </div>
        </li>

        <!-- Project Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#manageProjects"
               aria-expanded="true" aria-controls="manageProjects">
                <i class="fas fa-fw fa-folder"></i>
                <span>Quản lý đồ án</span>
            </a>
            <div id="manageProjects" class="collapse" aria-labelledby="headingProjects" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Đồ án:</h6>
                    <a class="collapse-item" href="<?= base_url('projects') ?>">Danh sách</a>
                    <a class="collapse-item" href="<?= base_url('projects/statistics') ?>">Thống kê</a>
                    <a class="collapse-item" href="<?= base_url('projects/search') ?>">Tra cứu</a>
                </div>
            </div>
        </li>

    <?php elseif ($this->session->userdata('role') === 'teacher'): ?>
        <!-- Teacher Section -->
        <div class="sidebar-heading">Teacher Functions</div>

        <!-- Project Management -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('projects') ?>" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Danh sách đồ án</span>
            </a>
        </li>
		<li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('projects/statistics') ?>">
                <i class="fas fa-fw fa-folder"></i>
                <span>Thống kê đồ án</span>
            </a>
        </li>
		<li class="nav-item">
            <a class="nav-link collapsed" href="<?= base_url('projects/search') ?>" >
                <i class="fas fa-fw fa-folder"></i>
                <span>Tra cứu đồ án</span>
            </a>
        </li>

    <?php elseif ($this->session->userdata('role') === 'student'): ?>
        <!-- Student Section -->
        <div class="sidebar-heading">Student Functions</div>

        <!-- Project Search -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('projects/search') ?>">
                <i class="fas fa-fw fa-search"></i>
                <span>Tìm kiếm đồ án</span>
            </a>
        </li>

    <?php endif; ?>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->
