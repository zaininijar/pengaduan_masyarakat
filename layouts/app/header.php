
<?php 

    global $auth; 

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= $base_url . '/assets/bootstrap5/css/bootstrap.min.css'; ?> ">
    <!-- custom-css -->
    <link rel="stylesheet" href="<?= $base_url . '/assets/custom-css/style.css'; ?> ">
    <link rel="stylesheet" href="<?= $base_url . '/assets/icon/css/materialdesignicons.min.css'; ?> ">
    <title>AppMas</title>
</head>
<body>
    <header style="background-color: #fff;">
        <nav class="navbar py-2 shadow">
            <div class="container-fluid">
                <a href="<?= $base_url; ?>" class="navbar-brand" style="background-image: url(<?= $base_url . 'assets/appmas-logo/cover.png' ?>);"></a>
                <div class="d-flex">
                    <?php if(isset($url)): ?>
                        <?php if($url[0] == 'admin'): ?>
                            <div class="dropdown">
                                <div class="d-flex align-items-center" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" type="button">
                                    <span class="text-primary"><?= $_SESSION['auth']['nama_lengkap']; ?></span>
                                    <div class="ms-3 rounded-circle" style="border: 0px !important; width: 30px; height: 30px; background-size: cover; background: position: center; background-image: url(<?= $base_url . '/assets/images/avatar/avatar1.jfif' ?>)" ></div>
                                </div>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenu2">
                                    <li>
                                        <a style="text-decoration: none;" href="<?= $base_url . 'profile' ?>">
                                            <button class="dropdown-item" type="button">Profile</button>
                                        </a>
                                    </li>
                                    <li>
                                        <a style="text-decoration: none;" href="<?= $base_url . 'logout' ?>">
                                            <button class="dropdown-item" type="button">Logout</button>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        <?php elseif($url[0] == 'masyarakat'): ?>
                            <a href="">
                                <div class="rounded-circle" style="width: 30px; height: 30px; background-size: cover; background: position: center; background-image: url(<?= $base_url . '/assets/images/avatar/avatar1.jfif' ?>)"></div>
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
    <aside>
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light min-h-screen shadow" style="width: 250px;">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="<?= $base_url . 'admin/index' ?>" class="nav-link active link-dark text-middle">
                        <span class="mdi mdi-view-dashboard-outline align-middle"></span>
                        <span class="align-middle">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $base_url . 'admin/pengaduan' ?>" class="nav-link hoverable link-dark">
                        <span class="mdi mdi-message-bulleted align-middle"></span>
                        <span class="align-middle">Pengaduan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $base_url . 'admin/users' ?>" class="nav-link hoverable link-dark">
                        <span class="mdi mdi-account-group-outline align-middle"></span>
                        <span class="align-middle">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= $base_url . 'admin/settings' ?>" class="nav-link hoverable link-dark">
                        <span class="mdi mdi-cog-outline align-middle"></span>
                        <span class="align-middle">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main>
    