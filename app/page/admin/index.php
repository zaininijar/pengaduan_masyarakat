<?php 

    global $conn;
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);

    if($result->num_rows > 0 ){
        $jumlah_users = $result->num_rows;
    }
    
    $sql = "SELECT * FROM pengaduan";
    $result = mysqli_query($conn, $sql);

    if($result->num_rows > 0 ){
        $jumlah_aduan = $result->num_rows;
    }
    
    $sql = "SELECT * FROM pengaduan WHERE status_id = 3";
    $result = mysqli_query($conn, $sql);

    if($result->num_rows > 0 ){
        $jumlah_aduan_selesai = $result->num_rows;
    }
    
    $sql = "SELECT * FROM pengaduan WHERE status_id = 2";
    $result = mysqli_query($conn, $sql);

    if($result->num_rows > 0 ){
        $jumlah_aduan_proses = $result->num_rows;
    }else {
        $jumlah_aduan_proses = 0;
    }

?>

<div class="container" style="margin-left: 90px;">
    <div class="row pt-5">
        <div class="col-md-4">
            <div class="card bg-gradient-primary text-white shadow" style="height: 225px;">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Semua User</h5>
                    <h1 class="mt-3 card-subtitle mb-2">
                        <?= $jumlah_users ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-gradient-info text-white shadow" style="height: 225px;">
                <div class="card-body">
                    <h5 class="card-title">Jumlah Semua Aduan</h5>
                    <h1 class="mt-3 card-subtitle mb-2">
                        <?= $jumlah_aduan ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card bg-gradient-success text-white shadow" style="height: 100px;">
                <div class="card-body">
                    <h5 class="card-title">Jumlah aduan selesai</h5>
                    <h3 class="card-subtitle mb-2">
                        <?= $jumlah_aduan_selesai ?>
                    </h3>
                </div>
            </div>
            <br>
            <div class="card bg-gradient-warning text-white shadow" style="height: 100px;">
                <div class="card-body">
                    <h5 class="card-title">Jumlah aduan proses</h5>
                    <h3 class="card-subtitle mb-2">
                        <?= $jumlah_aduan_proses ?>
                    </h3>
                </div>
            </div>
        </div>
    </div>
</div>