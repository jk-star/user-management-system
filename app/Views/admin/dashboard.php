<?= $this->extend('layouts/admin') ?>

<?= $this->section('content') ?>

<h1>Dashboard</h1>

<p class="text-muted">
    Welcome to User Management System
</p>

<div class="row mt-4">

    <div class="col-md-4">

        <div class="card">

            <div class="card-body">

                <h5>Total Users</h5>

                <h2>2</h2>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card">

            <div class="card-body">

                <h5>Active Users</h5>

                <h2>2</h2>

            </div>

        </div>

    </div>

    <div class="col-md-4">

        <div class="card">

            <div class="card-body">

                <h5>Inactive Users</h5>

                <h2>0</h2>

            </div>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
