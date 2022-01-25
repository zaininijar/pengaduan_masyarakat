<?php 

    if (isset($_POST['hapus'])){
        $sql = "DELETE FROM users WHERE id = " . $_POST['id'];
        $result = mysqli_query($conn, $sql);
        
        if($result){
            $success = "Berhasil Menghapus User";
        }
    }

    if (isset($_POST['update'])) {
       
        $errors = is_valid([
            'id' => $_POST['id'],
            'nama_lengkap' => $_POST['nama_lengkap'],
            'nik' => $_POST['nik'],
            'email' => $_POST['email'],
        ]);

        if (count($errors) < 1) {

            if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
                
                $messageSuccess = user_update([
                    'id' => $_POST['id'],
                    'nama_lengkap' => filter_input(INPUT_POST, 'nama_lengkap', FILTER_SANITIZE_STRING),
                    'nik' => filter_input(INPUT_POST, 'nik', FILTER_SANITIZE_STRING),
                    'email' => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
                    'new_password' => password_hash($_POST["new_password"], PASSWORD_DEFAULT),
                ]);

            }else {
                $emailError = "format email tidak benar";
            }

        }

    }

    if (isset($_POST['tambah'])) {

        $errors = is_valid([
            'nama_lengkap' => $_POST['nama_lengkap'],
            'nik' => $_POST['nik'],
            'email' => $_POST['email'],
            'password' => $_POST['password'],
        ]);

        if (count($errors) < 1) {

            if (filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL)) {
                
                $messageSuccess = register([
                    'nama_lengkap' => filter_input(INPUT_POST, 'nama_lengkap', FILTER_SANITIZE_STRING),
                    'nik' => filter_input(INPUT_POST, 'nik', FILTER_SANITIZE_STRING),
                    'email' => filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL),
                    'password' => password_hash($_POST["password"], PASSWORD_DEFAULT),
                ]);

            }else {
                $emailError = "format email tidak benar";
            }

        }

    };

?>

<!-- Modal -->
<div class="modal fade" id="modalTambahUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <?php if(isset($errors)): ?>
            <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger text-capitalize" role="alert">
                <?php foreach($errors as $key => $error): ?>
                <li class="fs-6"><?= $errors[$key]; ?></li>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edite User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="POST">
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input class="form-control" type="text" name="nama_lengkap" id="nama_lengkap">
                    </div>
                    <div class="mb-3">
                        <label for="nik">NIK</label>
                        <input class="form-control" type="text" name="nik" id="nik">
                    </div>
                    <div class="mb-3">
                        <label for="email">Email</label>
                        <input class="form-control" type="text" name="email" id="email">
                    </div>
                    <div class="mb-3">
                        <label for="password">Password</label>
                        <input class="form-control" type="password" name="password" id="password">
                    </div>
                    <div class="mb-3">
                        <label for="role_id">Role</label>
                        <select class="form-control" name="role_id" id="role_id">
                            <?php 

                            $sql = "SELECT * FROM roles";
                            $result_opt = $conn->query($sql);

                            if ($result_opt->num_rows > 0): ?>
                            <option>-pilih-</option>
                            <?php while($row_opt = $result_opt->fetch_assoc()): ?>
                            <option value="<?= $row_opt['id'] ?>">
                                <?= $row_opt['role_name'] ?>
                            </option>
                            <?php endwhile; ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="tambah">
                        <span>Tambah</span>
                        <span class="mdi mdi-send"></span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="container pt-5" style="margin-left: 90px;">
    <div class="row">
        <?php if(isset($success)): ?>
        <div class="alert alert-success"><?= $success ?></div>
        <?php endif; ?>
        <div class="card p-0">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="text-center">
                    Semua Aduan
                </h3>
                <div class="btn btn-success mt-1 cursor-pointer" data-bs-toggle="modal"
                    data-bs-target="#modalTambahUser">
                    <span class="mdi mdi-account-edit"></span><span>Tambah User</span>
                </div>
            </div>
            <div class="card-body p-5">
                <?php if(isset($messageSuccess)): ?>
                <div class="alert alert-success" role="alert">
                    <?= $messageSuccess; ?>
                </div>
                <?php endif; ?>
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
                            $sql = "SELECT users.*, roles.role_name FROM users INNER JOIN roles ON users.role_id = roles.id";
                            $result = mysqli_query($conn, $sql);
                        ?>
                        <?php if ($result->num_rows > 0): ?>
                        <?php $no = 1; ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <?php 
                            
                            if ($row['role_name'] == 'admin') {
                                continue;
                            }
                                
                        ?>
                        <tr>
                            <th><?= $no ?></th>
                            <th>
                                <details>
                                    <summary>
                                    </summary>
                                    <a class="badge bg-danger fs-6 mt-1 cursor-pointer" data-bs-toggle="modal"
                                        data-bs-target="#modalDelete<?= $row['id'] + 1 ?>">
                                        <span class="mdi mdi-delete"></span>
                                    </a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalDelete<?= $row['id'] + 1 ?>" tabindex="-1"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header" style="border: 0px;">
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div
                                                    class="modal-body d-flex justify-content-center align-items-center flex-column">
                                                    <img width="70" src="<?= $base_url . 'assets/icon/warning.png' ?>"
                                                        alt="" srcset="">
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
                                                <?php if(isset($errors)): ?>
                                                <?php if(count($errors) > 0): ?>
                                                <div class="alert alert-danger text-capitalize" role="alert">
                                                    <?php foreach($errors as $key => $error): ?>
                                                    <li class="fs-6"><?= $errors[$key]; ?></li>
                                                    <?php endforeach; ?>
                                                </div>
                                                <?php endif; ?>
                                                <?php endif; ?>
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Edite User</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <form action="" method="POST">
                                                    <div class="modal-body">
                                                        <input type="hidden" name="id" value="<?= $row['id'] ?>">
                                                        <div class="mb-3">
                                                            <label for="nama_lengkap">Nama Lengkap</label>
                                                            <input class="form-control" type="text" name="nama_lengkap"
                                                                id="nama_lengkap" value="<?= $row['nama_lengkap'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="nik">NIK</label>
                                                            <input class="form-control" type="text" name="nik" id="nik"
                                                                value="<?= $row['nik'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="email">Email</label>
                                                            <input class="form-control" type="text" name="email"
                                                                id="email" value="<?= $row['email'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="password">Password</label>
                                                            <input class="form-control" type="password" id="password"
                                                                value="<?= $row['password'] ?>">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="new_password">New Password</label>
                                                            <input class="form-control" type="password"
                                                                name="new_password" id="new_password">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="role_id">Role</label>
                                                            <select class="form-control" name="role_id" id="role_id">
                                                                <?php 

                                                                    $sql = "SELECT * FROM roles";
                                                                    $result_opt = $conn->query($sql);

                                                                if ($result_opt->num_rows > 0): ?>
                                                                <option value="<?= $row['role_id'] ?>">
                                                                    <?= $row['role_name'] ?></option>
                                                                <?php while($row_opt = $result_opt->fetch_assoc()): ?>
                                                                <option value="<?= $row_opt['id'] ?>">
                                                                    <?= $row_opt['role_name'] ?>
                                                                </option>
                                                                <?php endwhile; ?>
                                                                <?php endif; ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary" name="update">
                                                            <span>Simpan</span>
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