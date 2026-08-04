<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title><?= esc($title ?? 'Login') ?></title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

</head>

<body class="bg-light">

    <div class="container">

        <div class="row justify-content-center mt-5">

            <div class="col-md-5">

                <div class="card shadow-sm">

                    <div class="card-body p-4">

                        <h3 class="mb-4">
                            Login
                        </h3>

                        <?php if (session()->getFlashdata('error')): ?>

                            <div class="alert alert-danger">

                                <?= esc(session()->getFlashdata('error')) ?>

                            </div>

                        <?php endif; ?>


                        <form
                            action="<?= site_url('login') ?>"
                            method="post">

                            <?= csrf_field() ?>


                            <div class="mb-3">

                                <label class="form-label">
                                    Email
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="<?= esc(old('email'), 'attr') ?>">

                            </div>


                            <div class="mb-3">

                                <label class="form-label">
                                    Password
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control">

                            </div>


                            <button
                                type="submit"
                                class="btn btn-primary w-100">
                                Login
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>
