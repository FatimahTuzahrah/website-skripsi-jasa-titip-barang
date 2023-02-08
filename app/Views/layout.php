<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="/docs/4.0/assets/img/favicons/favicon.ico">
    <link rel="stylesheet" href="https //cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Jastip Maluku Utara</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/starter-template/">

    <!-- Bootstrap core CSS -->
    <link href="<?= base_url('bootstrap-4.0.0/dist/css/bootstrap.min.css') ?>" rel="stylesheet">

    <!-- Custom styles for this template -->
    <style>
        body {
            padding-top: 5rem;
        }

        .starter-template {
            padding: 3rem 1.5rem;
            text-align: center;
        }
    </style>
</head>

<body>

    <?= $this->include('navbar') ?>

    <main role="main" class="container">

        <?= $this->renderSection('content') ?>

    </main><!-- /.container -->

    <script src="<?= base_url('jquery-3.6.0.min.js') ?>"></script>
    <script src="<?= base_url('bootstrap-4.0.0/dist/js/bootstrap.min.js') ?>"></script>
    <?= $this->renderSection('script') ?>
    <script src="<?= base_url(); ?>assets/dist/sweetalert2.all.min.js"></script>
    <script src="<?= base_url(); ?>assets/dist/myscript.js"></script>
</body>

</html>