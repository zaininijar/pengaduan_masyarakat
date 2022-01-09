<?php 


if (isset($_SESSION['auth'])) {
        global $conn;
        $query = "DELETE FROM sessions WHERE user_id = " . $_SESSION['auth']['id'];
        $result = mysqli_query($conn, $query);
        var_dump($result);
        if($result){
            session_unset();
            session_destroy();
            header('Location: ' . $base_url);
        }else{
            header('Location: error+page');
        }
    }else {
        session_destroy();
        session_unset();
        header('Location: ' . $base_url);
    }

?>
