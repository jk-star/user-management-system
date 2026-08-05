<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">
    My Profile
</h2>

<div class="card shadow">

    <div class="card-body">

        <div class="row">

            <div class="col-md-3 text-center">
                <img
                    src="<?= base_url('uploads/profiles/' . $user['profile_image']) ?>"
                    class="img-fluid rounded-circle"
                    width="180">

            </div>

            <div class="col-md-9">

                <table class="table">

                    <tr>

                        <th width="180">
                            Name
                        </th>

                        <td>
                            <?= esc($user['name']) ?>
                        </td>

                    </tr>

                    <tr>

                        <th>Email</th>

                        <td>
                            <?= esc($user['email']) ?>
                        </td>

                    </tr>

                    <tr>

                        <th>Role</th>

                        <td>

                            <span class="badge bg-primary">

                                <?= esc(ucfirst($user['role'])) ?>

                            </span>

                        </td>

                    </tr>

                    <tr>

                        <th>Status</th>

                        <td>

                            <?php if ($user['status'] == 'active'): ?>

                                <span class="badge bg-success">
                                    Active
                                </span>

                            <?php else: ?>

                                <span class="badge bg-danger">
                                    Inactive
                                </span>

                            <?php endif; ?>

                        </td>

                    </tr>

                </table>

                <a
                    href="<?= site_url('profile/edit') ?>"
                    class="btn btn-warning">
                    Edit Profile
                </a>

                <a
                    href="<?= site_url('profile/change-password') ?>"
                    class="btn btn-primary">
                    Change Password
                </a>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
