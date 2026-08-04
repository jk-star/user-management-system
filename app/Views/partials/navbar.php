<nav class="navbar navbar-dark bg-dark px-3">

    <div class="text-white">
        <a class="navbar-brand" href="#">
            User Management
        </a>
    </div>

    <div class="text-white">
        <?= esc(ucfirst(session()->get('user_name'))) ?>
        <span class="badge bg-secondary">
            <?= esc(ucfirst(session()->get('role'))) ?>
        </span>
    </div>

    <div class="text-white d-flex align-items-center">
        <a class="text-white text-decoration-none"><?= esc(ucfirst(session()->get('role'))) ?></a>

        <a
            href="<?= site_url('logout') ?>"
            class="btn btn-outline-light btn-sm ms-4">
            Logout
        </a>

    </div>

</nav>
