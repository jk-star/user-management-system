<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Project Documentation</title>

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <style>
        body {
            background: #f8f9fa;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: #212529;
            padding: 20px;
        }

        .sidebar h4 {
            color: white;
            margin-bottom: 20px;
        }

        .sidebar a {
            display: block;
            color: #adb5bd;
            text-decoration: none;
            padding: 10px 12px;
            margin-bottom: 5px;
            border-radius: 5px;
        }

        .sidebar a:hover {
            background: #343a40;
            color: white;
        }

        .sidebar a.active {
            background: #0d6efd;
            color: white;
        }

        /* Content */
        .content {
            padding: 40px;
            background: white;
            min-height: 100vh;
        }

        .content table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .content th,
        .content td {
            padding: 10px;
            border: 1px solid #dee2e6;
        }

        .content th {
            background: #f8f9fa;
        }

        .content pre {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            padding: 20px;
            border-radius: 6px;
            overflow-x: auto;
        }
    </style>
</head>

<body>

<div class="container-fluid">

    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 sidebar">

            <h4>Chapters</h4>

            <?php foreach ($chapters as $item): ?>

                <a
                    href="<?= site_url('tutorial/' . $item['filename']) ?>"
                    class="<?= $currentChapter === $item['filename'] ? 'active' : '' ?>"
                >
                    <?= esc($item['title']) ?>
                </a>

            <?php endforeach; ?>

        </div>


        <!-- Markdown Content -->
        <div class="col-md-9 col-lg-10 content">

            <?= $content ?>

        </div>

    </div>

</div>

</body>
</html>