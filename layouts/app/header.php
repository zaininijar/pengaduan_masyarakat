
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
    <header style="background-color: #7900FF;">
        <nav class="navbar py-2">
            <div class="container">
                <a href="<?= $base_url; ?>" class="navbar-brand text-light">
                    <svg class="rounded-circle p-2" width="40" height="40" viewBox="0 0 24 24" style="background-color: white !important;">
                        <path d="M12,8H4A2,2 0 0,0 2,10V14A2,2 0 0,0 4,16H5V20A1,1 0 0,0 6,21H8A1,1 0 0,0 9,20V16H12L17,20V4L12,8M15,15.6L13,14H4V10H13L15,8.4V15.6M21.5,12C21.5,13.71 20.54,15.26 19,16V8C20.53,8.75 21.5,10.3 21.5,12Z" />
                    </svg>
                    AppMas
                </a>
                <div class="d-flex">
                    <?php if(isset($url)): ?>
                        <?php if($url[0] == 'admin'): ?>
                            <div class="dropdown">
                                <div class="d-flex align-items-center" id="dropdownMenu2" data-bs-toggle="dropdown" aria-expanded="false" type="button">
                                    <span class="text-light"><?= $_SESSION['auth']['nama_lengkap']; ?></span>
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
        <div class="d-flex flex-column flex-shrink-0 p-3 bg-light min-h-screen" style="width: 250px;">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="#" class="nav-link active link-dark text-middle">
                        <span class="mdi mdi-view-dashboard-outline align-middle"></span>
                        <span class="align-middle">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link link-dark">
                        <span class="mdi mdi-message-bulleted align-middle"></span>
                        <span class="align-middle">Pengaduan</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link link-dark">
                        <span class="mdi mdi-account-group-outline align-middle"></span>
                        <span class="align-middle">Users</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link link-dark">
                        <span class="mdi mdi-cog-outline align-middle"></span>
                        <span class="align-middle">Settings</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <main>
    