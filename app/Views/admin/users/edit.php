<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2>Edit User</h2>

<?php $errors = session()->getFlashdata('errors'); ?>

<?php if ($errors): ?>

    <div class="alert alert-danger">

        <ul class="mb-0">

            <?php foreach ($errors as $error): ?>

                <li><?= esc($error) ?></li>

            <?php endforeach; ?>

        </ul>

    </div>

<?php endif; ?>

<form
    action="<?= site_url('admin/users/update/' . $user['id']) ?>"
    method="post">

    <?= csrf_field() ?>

    <div class="mb-3">

        <label class="form-label">Name</label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="<?= esc(old('name', $user['name']), 'attr') ?>">

    </div>

    <div class="mb-3">

        <label class="form-label">Email</label>

        <input
            type="email"
            name="email"
            class="form-control"
            value="<?= esc(old('email', $user['email']), 'attr') ?>">

    </div>

    <div class="mb-3">

        <label class="form-label">Role</label>

        <select name="role" class="form-select">

            <option
                value="user"
                <?= old('role', $user['role']) === 'user' ? 'selected' : '' ?>>
                User
            </option>

            <option
                value="admin"
                <?= old('role', $user['role']) === 'admin' ? 'selected' : '' ?>>
                Admin
            </option>

        </select>

    </div>

    <div class="mb-3">

        <label class="form-label">Status</label>

        <select name="status" class="form-select">

            <option
                value="active"
                <?= old('status', $user['status']) === 'active' ? 'selected' : '' ?>>
                Active
            </option>

            <option
                value="inactive"
                <?= old('status', $user['status']) === 'inactive' ? 'selected' : '' ?>>
                Inactive
            </option>

        </select>

    </div>

    <button class="btn btn-primary">
        Update User
    </button>

</form>

<?= $this->endSection() ?>
