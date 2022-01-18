<?php 

    global $auth; 

    $link_active_dashboard = '';
    $link_active_pengaduan = '';
    $link_active_users = '';
    $link_active_settings = '';

    if ($url[0] == 'admin' && $url[1] == 'index') {
        $link_active_dashboard = 'active';
    }elseif($url[0] == 'admin' && $url[1] == 'pengaduan'){
        $link_active_pengaduan = 'active';
    }elseif($url[0] == 'admin' && $url[1] == 'users'){
        $link_active_users = 'active';
    }elseif($url[0] == 'admin' && $url[1] == 'settings'){
        $link_active_settings = 'active';
    }elseif($url[0] == 'masyarakat' && $url[1] == 'index'){
        $link_active_dashboard_masyarakat = 'active';
    }elseif($url[0] == 'masyarakat' && $url[1] == 'mengadu'){
        $link_active_mengadu_masyarakat = 'active';
    }

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
                <a href="<?= $base_url; ?>" class="navbar-brand"
                    style="background-image: url(<?= $base_url . 'assets/appmas-logo/cover.png' ?>);"></a>
                <div class="d-flex" style="margin-right: 20px !important;">
                    <?php if(isset($url)): ?>
                    <?php if($url[0] == 'admin'): ?>
                    <div class="dropdown">
                        <div class="d-flex align-items-center" id="dropdownMenu2" data-bs-toggle="dropdown"
                            aria-expanded="false" type="button">
                            <span class="text-primary"><?= $_SESSION['auth']['nama_lengkap']; ?></span>
                            <div class="ms-3 rounded-circle"
                                style="border: 0px !important; width: 30px; height: 30px; background-size: cover; background: position: center; background-image: url(<?= $base_url . '/assets/images/avatar/avatar1.jfif' ?>)">
                            </div>
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
                    <div class="dropdown">
                        <div class="d-flex align-items-center" id="dropdownMenu2" data-bs-toggle="dropdown"
                            aria-expanded="false" type="button">
                            <span class="text-primary"><?= $_SESSION['auth']['nama_lengkap']; ?></span>
                            <div class="ms-3 rounded-circle"
                                style="border: 0px !important; width: 30px; height: 30px; background-size: cover; background: position: center; background-image: url(<?= $base_url . '/assets/images/avatar/avatar1.jfif' ?>)">
                            </div>
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
        <aside style="position: fixed; z-index: 99;">
            <div class="aside-content active d-flex flex-column flex-shrink-0 p-3 bg-light min-h-screen shadow">
                <?php if($_SESSION['auth']['role_id'] == 1 || $_SESSION['auth']['role_id'] == 2): ?>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="<?= $base_url . 'admin/index' ?>"
                            class="<?= $link_active_dashboard ?> nav-link hoverable link-dark text-middle">
                            <span class="mdi mdi-view-dashboard-outline align-middle fs-5"></span>
                            <span class="menu-aside align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_url . 'admin/pengaduan' ?>"
                            class="<?= $link_active_pengaduan ?> nav-link hoverable link-dark">
                            <span class="mdi mdi-message-bulleted align-middle fs-5"></span>
                            <span class="menu-aside align-middle">Pengaduan</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_url . 'admin/users' ?>"
                            class="<?= $link_active_users ?> nav-link hoverable link-dark">
                            <span class="mdi mdi-account-group-outline align-middle fs-5"></span>
                            <span class="menu-aside align-middle">Users</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_url . 'admin/settings' ?>"
                            class="<?= $link_active_settings ?> nav-link hoverable link-dark">
                            <span class="mdi mdi-cog-outline align-middle fs-5"></span>
                            <span class="menu-aside align-middle">Settings</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <span id="toggle-aside"
                            class="active open mdi fs-4 ms-3 mdi-menu align-middle cursor-pointer"></span>
                        <span id="toggle-aside"
                            class="mdi close fs-4 ms-3 mdi-window-close align-middle cursor-pointer"></span>
                    </li>
                </ul>
                <?php elseif($_SESSION['auth']['role_id'] == 3): ?>
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-item">
                        <a href="<?= $base_url . 'masyarakat/index' ?>"
                            class="<?= $link_active_dashboard_masyarakat ?> nav-link hoverable link-dark text-middle">
                            <span class="mdi mdi-view-dashboard-outline align-middle fs-5"></span>
                            <span class="menu-aside align-middle">Dashboard</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="<?= $base_url . 'masyarakat/mengadu' ?>"
                            class="<?= $link_active_mengadu_masyarakat ?> nav-link hoverable link-dark">
                            <span class="mdi mdi-message-bulleted align-middle fs-5"></span>
                            <span class="menu-aside align-middle">Mengadu</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <span id="toggle-aside"
                            class="active open mdi fs-4 ms-3 mdi-menu align-middle cursor-pointer"></span>
                        <span id="toggle-aside"
                            class="mdi close fs-4 ms-3 mdi-window-close align-middle cursor-pointer"></span>
                    </li>
                </ul>
                <?php endif; ?>
            </div>
        </aside>