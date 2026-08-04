<nav class="navbar navbar-dark bg-dark px-3">

    <div class="text-white">
        <a class="navbar-brand" href="#">
            User Management
        </a>
    </div>

    <div class="text-white"><?= esc(session()->get('user_name')) ?></div>

    <div class="text-white d-flex">
        <a class="text-white text-decoration-none">Admin</a>

        <a
            href="<?= site_url('logout') ?>"
            class="btn btn-outline-light btn-sm ms-4">
            Logout
        </a>

    </div>

</nav>
