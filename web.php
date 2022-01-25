<?php 

    require_once 'connection.php'; 
    require_once 'function.php'; 
    
    $base_url = 'http://localhost/zaini_nijar/pengaduan_masyarakat/';

    if (isset($_GET['url'])) {
        $url = rtrim($_GET['url'], '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        $url = explode('/', $url);
    }

    session_start();
    
    if (isset($url)) {
        if ($url[0] == 'register') {
            require_once "layouts/guest/header.php";
            require_once "app/auth/register.php";
            require_once "layouts/guest/footer.php";
        } elseif($url[0] == 'login') {
            require_once "layouts/guest/header.php";
            require_once "app/auth/login.php";
            require_once "layouts/guest/footer.php";
        }elseif($url[0] == 'admin' && $url[1] == 'index'){
            if (isset($_SESSION['auth'])) {

                $result = mysqli_query($conn, "SELECT * FROM sessions WHERE user_id = '". $_SESSION['auth']['id'] . "'");
                if ($result) {
                    $id = mysqli_fetch_assoc($result)['user_id'];
                    if ($_SESSION['auth']['id'] == $id && $_SESSION['auth']['role_id'] == 1) {
                        require_once "layouts/app/header.php";
                        require_once "app/page/admin/index.php";
                        require_once "layouts/app/footer.php";
                    }else {
                        header('Location: ' . $base_url);
                    }
                }else {
                    header('Location: ' . $base_url . 'error_page');
                }
            }else {
                header('Location: ' . $base_url);
            }
        }elseif($url[0] == 'admin' && $url[1] == 'pengaduan'){
            if (isset($_SESSION['auth'])) {
                $result = mysqli_query($conn, "SELECT * FROM sessions WHERE user_id = '". $_SESSION['auth']['id'] . "'");
                if ($result) {
                    $id = mysqli_fetch_assoc($result)['user_id'];
                    if ($_SESSION['auth']['id'] == $id && $_SESSION['auth']['role_id'] == 1) {
                        require_once "layouts/app/header.php";
                        require_once "app/page/admin/pengaduan.php";
                        require_once "layouts/app/footer.php";
                    }else {
                        header('Location: ' . $base_url);
                    }
                }else {
                    header('Location: ' . $base_url . 'error_page');
                }
    
            }else {
                header('Location: ' . $base_url);
            }
        }elseif($url[0] == 'admin' && $url[1] == 'users'){
            if (isset($_SESSION['auth']) && $_SESSION['auth']['role_id'] == 1) {
                $result = mysqli_query($conn, "SELECT * FROM sessions WHERE user_id = '". $_SESSION['auth']['id'] . "'");
                if ($result) {
                    $id = mysqli_fetch_assoc($result)['user_id'];
                    if ($_SESSION['auth']['id'] == $id) {
                        require_once "layouts/app/header.php";
                        require_once "app/page/admin/users.php";
                        require_once "layouts/app/footer.php";
                    } else {
                        header('Location: ' . $base_url);
                    }
                } else {
                    header('Location: ' . $base_url . 'error_page');
                }
            }else {
                header('Location: ' . $base_url);
            }

        }elseif($url[0] == 'admin' && $url[1] == 'settings'){
            if (isset($_SESSION['auth'])) {

                $result = mysqli_query($conn, "SELECT * FROM sessions WHERE user_id = '". $_SESSION['auth']['id'] . "'");
                if ($result) {
                    $id = mysqli_fetch_assoc($result)['user_id'];
                    if ($_SESSION['auth']['id'] == $id) {
                        require_once "layouts/app/header.php";
                        require_once "app/page/admin/settings.php";
                        require_once "layouts/app/footer.php";
                    }else {
                        header('Location: ' . $base_url);
                    }
                }else {
                    header('Location: ' . $base_url . 'error_page');
                }

            }else {
                header('Location: ' . $base_url);
            }
        }elseif($url[0] == 'masyarakat' && $url[1] == 'index'){
            if (isset($_SESSION['auth'])) {

                $result = mysqli_query($conn, "SELECT * FROM sessions WHERE user_id = '". $_SESSION['auth']['id'] . "'");
                if ($result) {
                    $id = mysqli_fetch_assoc($result)['user_id'];
                    if ($_SESSION['auth']['id'] == $id) {
                        require_once "layouts/app/header.php";
                        require_once "app/page/masyarakat/index.php";
                        require_once "layouts/app/footer.php";
                    }else {
                        header('Location: ' . $base_url);
                    }
                }else {
                    header('Location: ' . $base_url . 'error_page');
                }

            }else {
                header('Location: ' . $base_url);
            }
        }elseif($url[0] == 'masyarakat' && $url[1] == 'mengadu'){
            if (isset($_SESSION['auth'])) {

                $result = mysqli_query($conn, "SELECT * FROM sessions WHERE user_id = '". $_SESSION['auth']['id'] . "'");
                if ($result) {
                    $id = mysqli_fetch_assoc($result)['user_id'];
                    if ($_SESSION['auth']['id'] == $id) {
                        require_once "layouts/app/header.php";
                        require_once "app/page/masyarakat/mengadu.php";
                        require_once "layouts/app/footer.php";
                    }else {
                        header('Location: ' . $base_url);
                    }
                }else {
                    header('Location: ' . $base_url . 'error_page');
                }

            }else {
                header('Location: ' . $base_url);
            }
        }elseif($url[0] == 'error_page'){
            require_once "app/page/error_page.php";
        }elseif($url[0] == 'logout'){
            require_once "app/auth/logout.php";
        }
    }else {
        require_once "layouts/guest/header.php";
        require_once "app/welcome.php";
        require_once "layouts/guest/footer.php";
    }