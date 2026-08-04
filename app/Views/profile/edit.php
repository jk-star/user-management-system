<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">
    Edit Profile
</h2>

<?= $this->include('partials/validation_errors') ?>

<form
    action="<?= site_url('profile/update') ?>"
    method="post"
    enctype="multipart/form-data">

    <?= csrf_field() ?>

    <div class="mb-3">

        <label class="form-label">

            Name

        </label>

        <input
            type="text"
            name="name"
            class="form-control"
            value="<?= esc(old('name', $user['name']), 'attr') ?>">

    </div>

    <div class="mb-3">

        <label class="form-label">

            Email

        </label>

        <input
            type="email"
            name="email"
            class="form-control"
            value="<?= esc(old('email', $user['email']), 'attr') ?>">

    </div>

    <button class="btn btn-primary">

        Update Profile

    </button>

    <a
        href="<?= site_url('profile') ?>"
        class="btn btn-secondary">

        Cancel

    </a>

</form>

<?= $this->endSection() ?>
