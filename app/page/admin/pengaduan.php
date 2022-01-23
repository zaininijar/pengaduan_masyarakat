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
<div class="container pt-5">
    <div class="row">
        <?php if(isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <div class="card p-0">
            <div class="card-header">
                <h3 class="text-center">
                    Semua Aduan
                </h3>
            </div>
            <div class="card-body p-5">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Act</th>
                            <th scope="col">Judul Aduan/th>
                            <th scope="col">Isi Aduan</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            global $conn;
                            $sql = "SELECT * FROM pengaduan";
                            $result = mysqli_query($conn, $sql);
                        ?>
                        <?php if ($result->num_rows > 0): ?>
                        <?php $no = 1; ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <th><?= $no ?></th>
                            <th>
                                <details>
                                    <summary>
                                    </summary>
                                    <form action="" method="POST">
                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                        <button name="konfirmasi" type="submit" class="btn btn-success py-0"
                                            style="padding-left: 10px; padding-right: 10px;">
                                            <span class="mdi mdi-check"></span>
                                        </button>
                                    </form>
                                    <a class="badge bg-warning fs-6 mt-1 cursor-pointer" data-bs-toggle="modal"
                                        data-bs-target="#modalTanggapi<?= $row['id'] ?>">
                                        <span class="mdi mdi-chat-plus-outline"></span>
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalTanggapi<?= $row['id'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Kirim Tanggapan</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                        <div class="mb-3">
                                                            <label for="isi_tanggapan" class="form-label">Isi
                                                                Tanggapan</label>
                                                            <textarea name="isi_tanggapan" id="isi_tanggapan" cols="30"
                                                                rows="10" class="form-control"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="tanggapi" class="btn btn-primary" name="tanggapi">
                                                            <span>Kirim</span>
                                                            <span class="mdi mdi-send"></span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </details>
                            </th>
                            <td><?= $row['judul_aduan'] ?></td>
                            <td><?= $row['isi_aduan'] ?></td>
                            <td>

                                <img data-bs-toggle="modal" data-bs-target="#exampleModal<?= $no; ?>" width="30"
                                    height="30" class="rounded-circle cursor-pointer"
                                    src="<?= $base_url . 'assets/images/aduan/' . $row['foto'] ?>" alt="">

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal<?= $no; ?>" tabindex="-1"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img width="400" class="rounded cursor-pointer"
                                                    src="<?= $base_url . 'assets/images/aduan/' . $row['foto'] ?>"
                                                    alt="">
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
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