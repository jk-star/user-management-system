<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<div class="d-flex justify-content-between mb-4">
    <h2>Users</h2>
    <a
        href="<?= site_url('admin/users/create') ?>"
        class="btn btn-primary">
        Add User
    </a>
</div>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?= esc(session()->getFlashdata('error')) ?>
    </div>
<?php endif; ?>

<table class="table table-bordered">

    <thead>

        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Role</th>
            <th>Status</th>
            <th>Action</th>
        </tr>

    </thead>

    <tbody>

        <?php foreach ($users as $user): ?>

            <tr>

                <td><?= esc($user['id']) ?></td>

                <td><?= esc($user['name']) ?></td>

                <td><?= esc($user['email']) ?></td>

                <td><?= esc($user['role']) ?></td>

                <td><?= esc($user['status']) ?></td>

                <td>

                    <a
                        href="<?= site_url('admin/users/' . $user['id']) ?>"
                        class="btn btn-info btn-sm">
                        View
                    </a>

                    <a
                        href="<?= site_url('admin/users/edit/' . $user['id']) ?>"
                        class="btn btn-warning btn-sm">
                        Edit
                    </a>

                    <form
                        action="<?= site_url('admin/users/delete/' . $user['id']) ?>"
                        method="post"
                        class="d-inline">

                        <?= csrf_field() ?>

                        <button
                            type="submit"
                            class="btn btn-danger btn-sm"
                            onclick="return confirm('Delete this user?')">
                            Delete
                        </button>

                    </form>

                </td>

            </tr>

        <?php endforeach; ?>

    </tbody>

</table>

<?= $this->endSection() ?>
