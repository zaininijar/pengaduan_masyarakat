<?php 

    if (isset($_POST['hapus'])){
        $sql = "DELETE FROM users WHERE id = " . $_POST['id'];
        $result = mysqli_query($conn, $sql);
        
        if($result){
            $success = "Berhasil Menghapus User";
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
                <!-- <h5 class="card-title">Special title treatment</h5> -->
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Act</th>
                            <th scope="col">Nama Lengkap</th>
                            <th scope="col">NIK</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Bergabung</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            global $conn;
                            $sql = "SELECT * FROM users INNER JOIN roles ON users.role_id = roles.id";
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
                                    <a class="badge bg-danger fs-6 mt-1 cursor-pointer" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete<?= $row['id'] ?>">
                                        <span class="mdi mdi-delete"></span>
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDelete<?= $row['id'] ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="border: 0px;">
                                                    <!-- <h5 class="modal-title text-center border" id="exampleModalLabel">
                                                        Yakin
                                                        Ingin Menghapus
                                                        User ini?</h5> -->
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <h5 class="modal-title text-center" id="exampleModalLabel">
                                                        Yakin
                                                        Ingin Menghapus
                                                        User ini?</h5>
                                                </div>
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                    <div class="modal-footer" style="border: 0px;">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="tanggapi" class="btn btn-primary" name="hapus">
                                                            <span>Ya</span>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    <a class="badge bg-info fs-6 mt-1 cursor-pointer" data-bs-toggle="modal"
                                        data-bs-target="#modalTanggapi<?= $row['id'] ?>">
                                        <span class="mdi mdi-account-edit"></span>
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
                            <td><?= $row['nama_lengkap'] ?></td>
                            <td><?= $row['nik'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['role_name'] ?></td>
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