<div class="container mt-4">
    <h1 class="text-center">Danh Sách Tài Khoản</h1>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Role</th>
                <th>Avatar</th>
                <th>Hành Động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($accounts as $account): ?>
                <tr>
                    <td><?= $account['id'] ?></td>
                    <td><?= $account['username'] ?></td>
                    <td><?= ucfirst($account['role']) ?></td>
                    <td>
                        <?php if (!empty($account['avt'])): ?>
                            <img src="<?= base_url($account['avt']) ?>" alt="Avatar" width="50" height="50">
                        <?php else: ?>
                            <span>Chưa có</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="<?= base_url('accounts/edit/' . $account['id']) ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="<?= base_url('accounts/delete/' . $account['id']) ?>" 
                           class="btn btn-danger btn-sm" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa tài khoản này không?');">Xóa</a>
                        <a href="<?= base_url('accounts/detail/' . $account['id']) ?>" class="btn btn-info btn-sm">Xem</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
