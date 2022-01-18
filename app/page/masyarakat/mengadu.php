<?php 

    if (isset($_POST['submit'])) {

        $errors = is_valid([
            'judul_aduan' => filter_input(INPUT_POST, 'judul_aduan', FILTER_SANITIZE_STRING),
            'isi_aduan' => filter_input(INPUT_POST, 'isi_aduan', FILTER_SANITIZE_STRING)
        ]);

        if (isset($_FILES['foto'])) {
            $target_dir = "assets/images/aduan/";
            $target_file = $target_dir . basename($_FILES["foto"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
            $check = getimagesize($_FILES["foto"]["tmp_name"]);
            if($check !== false) {
                // echo "File is an image - " . $check["mime"] . ".";
                $uploadOk = 1;
            } else {
                $errors[] = "File bukan gambar.";
                $uploadOk = 0;
            }

            if (file_exists($target_file)) {
                $errors[] = "Maaf, gambar telah ada.";
                $uploadOk = 0;
            }

            if ($_FILES["foto"]["size"] > 500000) {
                $errors[] = "Maaf, gambar terlalu besar.";
                $uploadOk = 0;
            }

            if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
            && $imageFileType != "gif" ) {
                $errors[] = "Maaf, Hanya format JPG, JPEG, PNG & GIF yang bisa di masukkan.";
                $uploadOk = 0;
            }

            if ($uploadOk == 0) {
                $errors[] = "Maaf, gambar belum ter-Upload";
            } else {
                if (move_uploaded_file($_FILES["foto"]["tmp_name"], $target_file)) {
                    $filename = htmlspecialchars(basename($_FILES["foto"]["name"]));
                } else {
                    $errors[] = "Gagal, Meng-upload gambar";
                }
            }
        }else {
            $errors[] = 'Gambar tidak boleh kosong';
        }

        if (count($errors) <= 0 && strlen($filename) > 0) {
            $result = mengadu([
                'judul_aduan' => filter_input(INPUT_POST, 'judul_aduan', FILTER_SANITIZE_STRING),
                'isi_aduan' => filter_input(INPUT_POST, 'isi_aduan', FILTER_SANITIZE_STRING),
                'foto' => $filename
            ]);

            if ($result) {
                $messageSuccess = 'Aduan Berhasil di Kirim, Silahkan tunggu konfirmasi dari petugas';
            }
        }
        
    }

?>

<div class="container pt-5">
    <div class="row">
        <div class="col">
            <div class="card">

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
                    <?= $messageSuccess; ?> <a href="<?= $base_url . 'masyarakat/index' ?>" class="alert-link">Kemabali
                        ke
                        halaman utama</a>
                </div>
                <?php endif; ?>

                <div class="card-header">
                    Form Pengaduan
                </div>
                <div class="card-body">
                    <form action="" method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="judul_aduan" class="form-label">Judul Aduan</label>
                            <input type="text" class="form-control" id="judul_aduan" name="judul_aduan">
                        </div>
                        <div class="mb-3">
                            <label for="isi_aduan" class="form-label">Isi Aduan</label>
                            <textarea name="isi_aduan" id="isi_aduan" cols="30" rows="10"
                                class="form-control"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input class="form-control" type="file" name="foto" id="foto" multiple>
                        </div>
                        <button type="submit" class="btn btn-primary mt-2" name="submit">
                            <span>Kirim</span>
                            <span class="mdi mdi-send"></span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>