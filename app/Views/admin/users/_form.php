<div class="mb-3">

    <label class="form-label">
        Name
    </label>

    <input
        type="text"
        name="name"
        class="form-control"
        value="<?= esc(
                    old('name', $user['name'] ?? ''),
                    'attr'
                ) ?>">

</div>


<div class="mb-3">

    <label class="form-label">
        Email
    </label>

    <input
        type="email"
        name="email"
        class="form-control"
        value="<?= esc(
                    old('email', $user['email'] ?? ''),
                    'attr'
                ) ?>">

</div>


<?php if (! isset($user)): ?>

    <div class="mb-3">

        <label class="form-label">
            Password
        </label>

        <input
            type="password"
            name="password"
            class="form-control">

    </div>

<?php endif; ?>


<div class="mb-3">

    <label class="form-label">
        Role
    </label>

    <?php
    $role = old(
        'role',
        $user['role'] ?? 'user'
    );
    ?>

    <select
        name="role"
        class="form-select">

        <option
            value="user"
            <?= $role === 'user' ? 'selected' : '' ?>>
            User
        </option>

        <option
            value="admin"
            <?= $role === 'admin' ? 'selected' : '' ?>>
            Admin
        </option>

    </select>

</div>


<div class="mb-3">

    <label class="form-label">
        Status
    </label>

    <?php
    $status = old(
        'status',
        $user['status'] ?? 'active'
    );
    ?>

    <select
        name="status"
        class="form-select">

        <option
            value="active"
            <?= $status === 'active' ? 'selected' : '' ?>>
            Active
        </option>

        <option
            value="inactive"
            <?= $status === 'inactive' ? 'selected' : '' ?>>
            Inactive
        </option>

    </select>

</div>
