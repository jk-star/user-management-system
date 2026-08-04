<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">
    Edit User
</h2>

<?= $this->include('partials/validation_errors') ?>

<form
    action="<?= site_url(
                'admin/users/update/' . $user['id']
            ) ?>"
    method="post">

    <?= csrf_field() ?>

    <?= $this->include('admin/users/_form') ?>

    <button class="btn btn-primary">
        Update User
    </button>

</form>

<?= $this->endSection() ?>
