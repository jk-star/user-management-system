<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1">

    <title>
        <?= esc($title ?? 'Admin Panel') ?>
    </title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        .sidebar {
            min-height: calc(100vh - 56px);
        }
    </style>

</head>

<body>

    <?= $this->include('partials/navbar') ?>

    <div class="container-fluid">

        <div class="row">

            <div class="col-md-2 p-0">

                <?= $this->include('partials/sidebar') ?>

            </div>

            <main class="col-md-10 p-4">

                <?= $this->renderSection('content') ?>

            </main>

        </div>

    </div>

</body>

</html>
