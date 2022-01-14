<?php 

    if (isset($_POST['submit'])) {

        $email_login = $_POST['email'];
        $password_login = $_POST['password'];

        $errors = is_valid([
            'email' => $email_login, 
            'password' => $password_login
        ]);

        if (count($errors) < 1) {

            $errors[] = login([
                'email' => $email_login, 
                'password' => $password_login
            ]);

        }

    }

?>


<div class="container min-h-screen d-flex flex-column justify-content-center px-5">
    <div class="row d-flex justify-content-center">
        <div class="card p-0" style="width: 500px;">
            <div class="card-header text-center">
                Form Login
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
            <div class="card-body px-5">
                <form action="" method="POST" id="login">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Alamat Email</label>
                        <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Ingat saya</label>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary px-3">Masuk</button>
                    </div>
                </form>
            </div>
            <div class="card-footer text-center">
                Pengaduan Masyarakat
            </div>
        </div>
    </div>
</div>