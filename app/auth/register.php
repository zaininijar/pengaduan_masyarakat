<?php 

    if (isset($_POST['submit'])) {

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

<div class="container min-h-screen d-flex flex-column justify-content-center px-5">
    <div class="row d-flex justify-content-center">
        <div class="card p-0" style="width: 500px;">
            <div class="card-header text-center">
                Form Pendaftaran
            </div>

            <?php if(isset($errors)): ?>
            <?php if(count($errors) > 0): ?>
            <div class="alert alert-danger text-capitalize" role="alert">
                <?php foreach($errors as $key => $error): ?>
                <li><?= $errors[$key]; ?></li>
                <?php endforeach; ?>
            </div>
            <?php endif; ?>
            <?php endif; ?>

            <?php if(isset($messageSuccess)): ?>
            <div class="alert alert-success" role="alert">
                <?= $messageSuccess; ?> <a href="login" class="alert-link">Login Sekarang</a>
            </div>
            <?php endif; ?>

            <div class="card-body px-5">
                <form action="" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Nama Lengkap</label>
                        <input name="nama_lengkap" type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">NIK</label>
                        <input name="nik" type="text" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                        <?php if(isset($emailError)): ?>
                        <p class="text-danger text-capitalize">
                            <?= $emailError; ?>!!
                        </p>
                        <?php endif; ?>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input name="password" type="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="d-flex align-items-center justify-content-end">
                        <button type="submit" name="submit" class="btn btn-primary px-3">Daftar</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                Pengaduan Masyarakat
            </div>
        </div>
    </div>
</div>