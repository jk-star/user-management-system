<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h1>Dashboard</h1>

<p class="text-muted">
    Welcome,
    <?= esc(ucfirst(session()->get('user_name'))) ?>
</p>

<div class="row mt-4">
    <div class="col-md-12">
        <div class="card mt-4 shadow-sm">

            <div class="card-header">
                Recent Users
            </div>

            <div class="card-body">

                <table class="table">

                    <thead>

                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Status</th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php foreach ($recentUsers as $user): ?>

                            <tr>

                                <td>
                                    <?= esc($user['name']) ?>
                                </td>

                                <td>
                                    <?= esc($user['email']) ?>
                                </td>

                                <td>
                                    <?= esc($user['role']) ?>
                                </td>

                                <td>
                                    <?= esc($user['status']) ?>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>
    </div>
</div>

<div class="row mt-4">

    <div class="col-md-3">

        <div class="card shadow-sm">

            <div class="card-body">

                <h5>Total Users</h5>

                <h2>
                    <?= esc($totalUsers) ?>
                </h2>

            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card shadow-sm">

            <div class="card-body">

                <h5>Active Users</h5>

                <h2>
                    <?= esc($activeUsers) ?>
                </h2>

            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card shadow-sm">

            <div class="card-body">

                <h5>Inactive Users</h5>

                <h2>
                    <?= esc($inactiveUsers) ?>
                </h2>

            </div>

        </div>

    </div>


    <div class="col-md-3">

        <div class="card shadow-sm">

            <div class="card-body">

                <h5>Admins</h5>

                <h2>
                    <?= esc($totalAdmins) ?>
                </h2>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
