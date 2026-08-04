<ul class="nav flex-column">

    <li class="nav-item">

        <a
            class="nav-link"
            href="<?= site_url('admin/dashboard') ?>">
            Dashboard
        </a>

    </li>


    <?php if (session()->get('role') === 'admin'): ?>

        <li class="nav-item">

            <a
                class="nav-link"
                href="<?= site_url('admin/users') ?>">
                Users
            </a>

        </li>

    <?php endif; ?>


    <li class="nav-item">

        <a
            class="nav-link"
            href="<?= site_url('profile') ?>">
            Profile
        </a>

    </li>

</ul>
