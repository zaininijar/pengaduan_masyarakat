<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/bootstrap5/css/bootstrap.min.css">
    <!-- custom-css -->
    <link rel="stylesheet" href="assets/custom-css/style.css">
    <title>AppMas</title>
</head>
<body>
    <header class="bg-light">
        <nav class="navbar navbar-light bg-light py-3">
            <div class="container">
                <a href="<?= $base_url; ?>" class="navbar-brand" style="background-image: url(<?= $base_url . 'assets/appmas-logo/cover.png' ?>);"></a>
                <div class="d-flex">
                    <?php if(isset($url)): ?>
                        <?php if($url[0] == 'login'): ?>
                            <a href="login">
                                <button class="btn btn-primary px-3">Masuk</button>
                            </a>
                            <a href="register">
                                <button class="btn btn-outline-primary ms-3 px-3">Daftar</button>
                            </a>
                        <?php elseif($url[0] == 'register'): ?>
                            <a href="login">
                                <button class="btn btn-outline-primary px-3">Masuk</button>
                            </a>
                            <a href="register">
                                <button class="btn btn-primary ms-3 px-3">Daftar</button>
                            </a>
                        <?php endif; ?> 
                    <?php else: ?>
                        <a href="login">
                            <button class="btn btn-outline-primary px-3">Masuk</button>
                        </a>
                        <a href="register">
                            <button class="btn btn-outline-primary ms-3 px-3">Daftar</button>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>
    </header>
    <main>
    