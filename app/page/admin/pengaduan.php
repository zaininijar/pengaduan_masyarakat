<?php 

    global $conn;
    $sql = "SELECT * FROM pengaduan";
    $result = mysqli_query($conn, $sql);

    if (isset($url[2])) {
        var_dump($url[2]);
    }

?>
<div class="container pt-5">
    <div class="row">
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
                            <th scope="col">Judul</th>
                            <th scope="col">Isi</th>
                            <th scope="col">Foto</th>
                            <th scope="col">Status</th>
                            <th scope="col">Dibuat</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if ($result->num_rows > 0): ?>
                        <?php $no = 1; ?>
                        <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <th><?= $no ?></th>
                            <th>
                                <details>
                                    <summary>
                                    </summary>
                                    <a class="badge bg-success fs-6" href="<?= $row['id'] ?>">
                                        <span class="mdi mdi-check"></span>
                                    </a>
                                    <br>
                                    <a class="badge bg-warning fs-6 mt-1" href="<?= $row['id'] ?>">
                                        <span class="mdi mdi-chat-plus-outline"></span>
                                    </a>
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
                            <?php else: ?>
                            <td><?= $row['status_id'] ?></td>
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