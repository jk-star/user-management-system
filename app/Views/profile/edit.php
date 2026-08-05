<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">
    Edit Profile
</h2>

<?= $this->include('partials/validation_errors') ?>

<form
    action="<?= site_url('profile/update/' . session()->get('user_id')) ?>"
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

    <?php

    $image = !empty($user['profile_image'])
        ? 'uploads/profiles/' . $user['profile_image']
        : 'uploads/profiles/default.png';

    ?>

    <div class="mb-3">

        <img
            src="<?= base_url($image) ?>"
            class="rounded-circle border"
            width="120"
            height="120"
            style="object-fit: cover;">

    </div>

    <div class="mb-3">

        <label class="form-label">
            Profile Image
        </label>

        <input
            type="file"
            name="profile_image"
            class="form-control"
            accept=".jpg,.jpeg,.png,.webp">

        <small class="text-muted">
            Allowed: JPG, JPEG, PNG, WEBP (Max: 2MB)
        </small>

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
