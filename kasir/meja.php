<?php

// UNTUK TAMBAH USER 
if (isset($_POST['tambah_meja'])) {
    $no_meja = $_POST['no_meja'];
    $keterangan = $_POST['keterangan'];
    $status  = $_POST['status'];

    if (empty($no_meja) || empty($keterangan) || empty($status)) {
        echo "<script>alert('Data tidak boleh kosong');</script>";
    } else {
        $sql = "insert into t_meja values ('0', '$no_meja', '$keterangan', '$status')";
        $result1 = mysqli_query($tiarakoneksi, $sql);
        if ($result1) {
            echo "<script>alert('Data berhasil ditambahkan');</script>";
            echo "<script>location.href='index.php?page=meja';</script>";
        } else {
            echo "<script>alert('Data gagal ditambahkan');</script>";
            echo "<script>location.href='index.php?page=meja';</script>";
        }
    }
}
// END TAMBAH MEJA

//edit meja
if (isset($_POST['edit_meja'])) {
    $id_meja = $_POST['id_meja'];
    $no_meja = $_POST['no_meja'];
    $keterangan = $_POST['keterangan'];
    $status  = $_POST['status'];

    if (empty($no_meja) || empty($keterangan) || empty($status)) {
        echo "<script>alert('Data tidak boleh kosong');</script>";
    } else {
        $sql = "update t_meja set no_meja = '$no_meja', keterangan = '$keterangan', status = '$status' where id_meja = '$id_meja'";
        $result1 = mysqli_query($tiarakoneksi, $sql);
        if ($result1) {
            echo "<script>location.href='index.php?page=meja';</script>";
        } else {
            echo "<script>alert('Data gagal diubah');</script>";
            echo "<script>location.href='index.php?page=meja';</script>";
        }
    }
}
//end edit meja

//hapus meja
if (isset($_GET['hapus'])) {
    $id_meja = $_GET['id_meja'];
    $sql = "delete from t_meja where id_meja = '$id_meja'";
    $result1 = mysqli_query($tiarakoneksi, $sql);
    if ($result1) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<script>location.href='index.php?page=meja';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');</script>";
        echo "<script>location.href='index.php?page=meja';</script>";
    }
}

?>


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">User</h1>
    <button class="btn mb-3 invert" style="background-color: #4B0080; color: #FFFFFF" data-toggle="modal" data-target="#tambah_meja"><i class="fas fa-plus fa-sm"></i> Tambah Meja
    </button>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle" id="data-tables">
                <thead>
                    <tr>
                        <th>NO</th>
                        <th>No Meja</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT * FROM t_meja";
                    $sql_rm = mysqli_query($tiarakoneksi, $query) or die(mysqli_error($kon));
                    while ($data = mysqli_fetch_array($sql_rm)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['no_meja']  ?></td>
                            <td><?= $data['keterangan'] ?></td>
                            <?php if ($data['status'] == 'kosong') { ?>
                                <td><button class="btn btn-sm btn-danger"><?= $data['status'] ?></button></td>
                            <?php } elseif ($data['status'] == 'terisi') { ?>
                                <td><button class="btn btn-sm btn-success"><?= $data['status'] ?></button></td>
                            <?php } ?>
                            <td align="center">
                                <button data-toggle="modal" data-target="#id_meja<?= $data['id_meja'] ?>" class="btn btn-circle btn-sm" style="background-color: #4B0080;color:white;"><i class="fas fa-edit"></i></button>
                                <a onclick="return confirm('Apakah kamu yakin ingin menghapus data ini ?')" href="index.php?page=meja&hapus&id_meja=<?= $data['id_meja'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                            </td>
                        </tr>
                        <!-- MODAL EDIT MEJA -->
                        <div class="modal fade" id="id_meja<?= $data['id_meja'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">FORM EDIT MEJA</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" enctype="multipart/form-data" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="id_meja" value="<?= $data['id_meja'] ?>" required hidden>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">No Meja</label>
                                                <input type="text" class="form-control" name="no_meja" value="<?= $data['no_meja'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">keterangan</label>
                                                <input type="keterangan" class="form-control" name="keterangan" required value="<?= $data['keterangan'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">status</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="kosong">kosong</option>
                                                    <option value="terisi">terisi</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn" name="edit_meja" value="save" style="background-color: #4B0080;color:white;">
                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- END MODAL EDIT USER -->
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- MODAL TAMBAH MEJA -->
<div class="modal fade" id="tambah_meja" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">FORM TAMBAH MEJA</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label class="control-label">No Meja</label>
                        <input type="text" class="form-control" name="no_meja" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">keterangan</label>
                        <input type="text" class="form-control" name="keterangan" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Status</label>
                        <select class="form-control" name="status" required>
                            <option value="kosong">kosong</option>
                            <option value="terisi">terisi</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                <input type="submit" class="btn" style="background-color: #4B0080;color:white;" name="tambah_meja" value="save">
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL -->