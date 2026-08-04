<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">
    Add User
</h2>

<?= $this->include('partials/validation_errors') ?>

<form
    action="<?= site_url('admin/users/store') ?>"
    method="post"
    enctype="multipart/form-data">

    <?= csrf_field() ?>

    <?= $this->include('admin/users/_form') ?>

    <button class="btn btn-primary">
        Save User
    </button>

</form>

<?= $this->endSection() ?>
