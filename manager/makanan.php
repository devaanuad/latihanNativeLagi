<?php

// UNTUK TAMBAH MENU
if (isset($_POST['tambah_menu'])) {
    $nama_menu = $_POST['nama_menu'];
    $deskripsi = $_POST['deskripsi'];
    $harga  = $_POST['harga'];
    $kategori  = $_POST['kategori'];

    $query = "INSERT INTO t_menu VALUES ('0' ,'$nama_menu' ,'$deskripsi' ,'$harga' ,'$kategori')";
    $result = mysqli_query($tiarakoneksi, $query);
    if ($result) {
        echo "<script>alert('Data berhasil ditambahkan');</script>";
        echo "<script>location='index.php?page=makanan';</script>";
    } else {
        echo "<script>alert('Data gagal ditambahkan');</script>";
        echo "<script>location='index.php?page=makanan';</script>";
    }
}
// END TAMBAH MENU

// UNTUK DELETE MENU
if (isset($_GET['hapus'])) {
    $id_menu = $_GET['id_menu'];
    $query = "DELETE FROM t_menu WHERE id_menu = '$id_menu'";
    $result = mysqli_query($tiarakoneksi, $query);
    if ($result) {
        echo "<script>alert('Data berhasil dihapus');</script>";
        echo "<script>location='index.php?page=makanan';</script>";
    } else {
        echo "<script>alert('Data gagal dihapus');</script>";
        echo "<script>location='index.php?page=makanan';</script>";
    }
}
// END DELETE MENU

// UNTUK EDIT USER
if (isset($_POST['edit_menu'])) {
    $id_menu = $_POST['id_menu'];
    $nama_menu = $_POST['nama_menu'];
    $deskripsi = $_POST['deskripsi'];
    $harga  = $_POST['harga'];
    $kategori  = $_POST['kategori'];

    $query = "UPDATE t_menu SET nama_menu = '$nama_menu' , deskripsi = '$deskripsi' , harga = '$harga' , kategori = '$kategori' WHERE id_menu = '$id_menu'";
    $result = mysqli_query($tiarakoneksi, $query);
    if ($result) {
        echo "<script>alert('Data berhasil diubah');</script>";
        echo "<script>location='index.php?page=makanan';</script>";
    } else {
        echo "<script>alert('Data gagal diubah');</script>";
        echo "<script>location='index.php?page=makanan';</script>";
    }
}

?>


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Menu Makanan</h1>
    <button class="btn mb-3 invert" style="background-color: #4B0080; color: #FFFFFF" data-toggle="modal" data-target="#tambah_makanan"><i class="fas fa-plus fa-sm"></i> Tambah Menu
    </button>
</div>

<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle" id="data-tables">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Nama Menu</th>
                        <th>Deskripsi</th>
                        <th>Harga</th>
                        <th>Kategori</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $query = "SELECT * FROM t_menu where kategori = 'Makanan' ";
                    $sql_rm = mysqli_query($tiarakoneksi, $query) or die(mysqli_error($kon));
                    while ($data = mysqli_fetch_array($sql_rm)) {
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $data['nama_menu'] ?></td>
                            <td><?= $data['deskripsi'] ?></td>
                            <td>Rp <?= $data['harga'] ?></td>
                            <td align="center"><button class="btn btn-sm" style="background-color: blueviolet;color:white;"><?= $data['kategori'] ?></button></td>
                            <td align="center">
                                <!-- BUTTON EDIT  -->
                                <button data-toggle="modal" data-target="#edit_menu<?= $data['id_menu'] ?>" class="btn btn-circle btn-sm" style="background-color: #4B0080;color:white;"><i class="fas fa-edit"></i></button>
                                <!-- END BUTTON EDIT -->

                                <!-- BUTTON HAPUS -->
                                <a onclick="return confirm('Apakah kamu yakin ingin menghapus data ini ?')" href="index.php?page=makanan&hapus&id_menu=<?= $data['id_menu'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                <!-- END BUTTON HAPUS -->
                            </td>
                        </tr>
                        <!-- MODAL EDIT USER -->
                        <div class="modal fade" id="edit_menu<?= $data['id_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="myModalLabel">FORM EDIT USER</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="" enctype="multipart/form-data" method="post">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="id_menu" value="<?= $data['id_menu'] ?>" required hidden>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Nama Menu</label>
                                                <input type="text" class="form-control" name="nama_menu" value="<?= $data['nama_menu'] ?>" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Deskripsi</label>
                                                <textarea type="text" class="form-control" name="deskripsi" required><?= $data['deskripsi'] ?></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Harga</label>
                                                <input type="number" class="form-control" required value="<?= $data['harga'] ?>">
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Kategori</label>
                                                <select class="form-control" name="kategori" required>
                                                    <option value="makanan">Makanan</option>
                                                    <option value="minuman">Minuman</option>
                                                </select>
                                            </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                        <input type="submit" class="btn" name="edit_menu" value="save" style="background-color: #4B0080;color:white;">
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



<!-- MODAL TAMBAH MENU -->
<div class="modal fade" id="tambah_makanan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">FORM TAMBAH MENU</h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            </div>
            <div class="modal-body">
                <form action="" enctype="multipart/form-data" method="post">
                    <div class="form-group">
                        <label class="control-label">Nama Menu</label>
                        <input type="text" class="form-control" name="nama_menu" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Deskripsi</label>
                        <textarea type="text" class="form-control" name="deskripsi" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Harga</label>
                        <input type="number" class="form-control" name="harga" required>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Kategori</label>
                        <select class="form-control" name="kategori" required>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                <input type="submit" class="btn" style="background-color: #4B0080;color:white;" name="tambah_menu" value="save">
                </form>
            </div>

        </div>
    </div>
</div>
<!-- END MODAL -->