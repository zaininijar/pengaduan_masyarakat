<?php 

    if (isset($_POST['konfirmasi'])) {

        $sql = "UPDATE pengaduan SET status_id = 3 WHERE id = " . $_POST['id'];
        $result = mysqli_query($conn, $sql);
        
        if($result){
            $success = "Berhasil di selesaikan";
        }
    }

    if (isset($_POST['tanggapi'])) {

        
        $sql = "UPDATE pengaduan SET status_id = 2 WHERE id = " . $_POST['id'];
        $result = mysqli_query($conn, $sql);
        
        if ($result) {

            $sql = "INSERT INTO tanggapan (pengaduan_id, isi_tanggapan)
                    VALUES(". $_POST['id'] .", '". $_POST['isi_tanggapan'] ."')";

            $result = mysqli_query($conn, $sql);
            
            if($result){
                $success = "Berhasil mengirim tanggapan";
            }

        }else {
            var_dump(mysqli_error($conn));
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

<body onload="print()">
    <div class="container-fluid">
        <div class="row">
            <?php if(isset($success)): ?>
            <div class="alert alert-success"><?= $success ?></div>
            <?php endif; ?>
            <div class="card p-0">
                <div class="card-header">
                    <h6 class="text-center">
                        Semua Aduan
                    </h6>
                </div>
                <div class="card-body p-5">
                    <!-- <h5 class="card-title">Special title treatment</h5> -->
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Pengadu</th>
                                <th scope="col">Judul</th>
                                <th scope="col">Isi</th>
                                <th scope="col">Foto</th>
                                <th scope="col">Status</th>
                                <th scope="col">Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            global $conn;
                            $sql = "SELECT pengaduan.*, users.nama_lengkap FROM pengaduan INNER JOIN users ON pengaduan.user_id = users.id";
                            $result = mysqli_query($conn, $sql);
                        ?>
                            <?php if ($result->num_rows > 0): ?>
                            <?php $no = 1; ?>
                            <?php while($row = $result->fetch_assoc()): ?>
                            <tr>
                                <th><?= $no ?></th>
                                <td><?= $row['nama_lengkap'] ?></td>
                                <td><?= $row['judul_aduan'] ?></td>
                                <td><?= $row['isi_aduan'] ?></td>
                                <td>

                                    <img width="100" class="cursor-pointer"
                                        src="<?= $base_url . 'assets/images/aduan/' . $row['foto'] ?>" alt="">
                                    <?php if($row['status_id'] == 0): ?>
                                <td>
                                    <div class="badge bg-warning">none</div>
                                </td>
                                <?php elseif($row['status_id'] == 'selesai'): ?>
                                <td>
                                    <div class="badge bg-success"><?= $row['status_id'] ?></div>
                                </td>
                                <?php else: ?>
                                <td>
                                    <div class="badge bg-primary"><?= $row['status_id'] ?></div>
                                </td>
                                <?php endif; ?>
                                <td><?= date($row['created_at']) ?></td>
                            </tr>
                            <?php $no++; ?>
                            <?php endwhile; ?>
                            <?php else: ?>
                            <td colspan="6">
                                <h6 class="text-center mt-5">Data Kosong</h6>
                            </td>
                            <?php endif; ?>

                            <?php $conn->close(); ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>

</html>