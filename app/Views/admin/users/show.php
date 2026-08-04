<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2>User Details</h2>

<table class="table table-bordered mt-4">

    <tr>
        <th>ID</th>
        <td><?= esc($user['id']) ?></td>
    </tr>

    <tr>
        <th>Name</th>
        <td><?= esc($user['name']) ?></td>
    </tr>

    <tr>
        <th>Email</th>
        <td><?= esc($user['email']) ?></td>
    </tr>

    <tr>
        <th>Role</th>
        <td><?= esc($user['role']) ?></td>
    </tr>

    <tr>
        <th>Status</th>
        <td><?= esc($user['status']) ?></td>
    </tr>

</table>

<a
    href="<?= site_url('admin/users') ?>"
    class="btn btn-secondary">
    Back
</a>

<?= $this->endSection() ?>
