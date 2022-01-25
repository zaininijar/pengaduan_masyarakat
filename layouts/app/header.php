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

    if (isset($_POST['profileUpdate'])) {
       
        $errors = is_valid([
            'id' => $_SESSION['auth']['id'],
            'nama_lengkap' => $_POST['nama_lengkap'],
            'nik' => $_POST['nik'],
            'email' => $_POST['email'],
        ]);

        if (count($errors) < 1) {

            if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
                
                $messageSuccess = user_update([
                    'id' => $_SESSION['auth']['id'],
                    'nama_lengkap' => filter_input(INPUT_POST, 'nama_lengkap', FILTER_SANITIZE_STRING),
                    'nik' => filter_input(INPUT_POST, 'nik', FILTER_SANITIZE_STRING),
                    'email' => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
                    'new_password' => password_hash($_POST["new_password"], PASSWORD_DEFAULT),
                ]);

                // if ($messageSuccess) {
                //     $result = mysqli_query($conn, "SELECT users.*, roles.role_name FROM users JOIN roles ON users.role_id = roles.id WHERE id = $_SESSION['auth']['id']")
                //     $row = mysqli_fetch_assoc($result);                    
                // }
            }else {
                $emailError = "format email tidak benar";
            }

        }

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
    <header style="background-color: #fff !important; height: 70px;">
        <nav class="navbar py-2 shadow fixed-top" style="background-color: #fff !important;">
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
                                <button class="dropdown-item" type="button" data-bs-toggle="modal"
                                    data-bs-target="#profileUpdate">Profile</button>
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
                                <button class="dropdown-item" data-bs-toggle="modal" data-bs-target="#profileUpdate"
                                    type="button">Profile</button>
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
    <main class="min-h-screen">
        <aside style="position: fixed; z-index: 99;">
            <div class="aside-content active d-flex flex-column min-h-screen flex-shrink-0 p-3 bg-light shadow">
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

        <!-- Modal -->
        <div class="modal fade" id="profileUpdate" tabindex="-1" aria-labelledby="profileUpdateLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="profileUpdateLabel">Modal title</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="" method="POST">
                            <div class="modal-body">
                                <input type="hidden" name="id" value="<?= $_SESSION['auth']['id'] ?>">
                                <div class="mb-3">
                                    <label for="nama_lengkap">Nama Lengkap</label>
                                    <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap"
                                        value="<?= $_SESSION['auth']['nama_lengkap'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nik">NIK</label>
                                    <input class="form-control" type="text" name="nik" id="nik"
                                        value="<?= $_SESSION['auth']['nik'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="email">Email</label>
                                    <input class="form-control" type="text" name="email" id="email"
                                        value="<?= $_SESSION['auth']['email'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="password">Password</label>
                                    <input class="form-control" type="password" id="password"
                                        value="<?= $_SESSION['auth']['password'] ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="new_password">New Password</label>
                                    <input class="form-control" type="password" name="new_password" id="new_password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="profileUpdate">
                                    <span>Simpan</span>
                                    <span class="mdi mdi-send"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>