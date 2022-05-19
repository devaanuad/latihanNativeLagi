      <?php

        // UNTUK TAMBAH USER 
        if (isset($_POST['tambah_user'])) {
            $nama_user = $_POST['nama_user'];
            $password = $_POST['password'];
            $hak_akses  = $_POST['hak_akses'];

            $sql = "select * from t_user where nama_user = '$nama_user'";
            $result1 = mysqli_query($tiarakoneksi, $sql);
            $row = mysqli_num_rows($result1);

            if ($row > 0) {
                echo "<script>alert('Nama User Sudah digunakan');</script>";
            } else {
                $query = "INSERT INTO t_user VALUES ('0' ,'$nama_user' ,'$password' ,'$hak_akses')";
                $result = mysqli_query($tiarakoneksi, $query);
                if ($result) {
                    echo "<script>alert('Data berhasil ditambahkan');</script>";
                    echo "<script>location='index.php?page=user';</script>";
                } else {
                    echo "<script>alert('Data gagal ditambahkan');</script>";
                    echo "<script>location='index.php?page=user';</script>";
                }
            }
        }
        // END TAMBAH USER

        // UNTUK DELETE USER
        if (isset($_GET['hapus'])) {
            $id_user = $_GET['id_user'];
            $query = "DELETE FROM t_user WHERE id_user = '$id_user'";
            $result = mysqli_query($tiarakoneksi, $query);
            if ($result) {
                echo "<script>alert('Data berhasil dihapus');</script>";
                echo "<script>location='index.php?page=user';</script>";
            } else {
                echo "<script>alert('Data gagal dihapus');</script>";
                echo "<script>location='index.php?page=user';</script>";
            }
        }
        // END DELETE USER

        // UNTUK EDIT USER
        if (isset($_POST['edit_user'])) {
            $id_user = $_POST['id_user'];
            $nama_user = $_POST['nama_user'];
            $password = $_POST['password'];
            $hak_akses = $_POST['hak_akses'];

            $sql = "select * from t_user where nama_user = '$nama_user'";
            $result1 = mysqli_query($tiarakoneksi, $sql);
            $row = mysqli_num_rows($result1);

            if ($row > 0) {
                echo "<script>alert('Nama User Sudah digunakan');</script>";
            } else {
                $query = "UPDATE t_user SET nama_user = '$nama_user' , password = '$password' , hak_akses = '$hak_akses' WHERE id_user = '$id_user'";
                $result = mysqli_query($tiarakoneksi, $query);
                if ($result) {
                    echo "<script>alert('Data berhasil diubah');</script>";
                    echo "<script>location='index.php?page=user';</script>";
                } else {
                    echo "<script>alert('Data gagal diubah');</script>";
                    echo "<script>location='index.php?page=user';</script>";
                }
            }
        }

        ?>


      <!-- Page Heading -->
      <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800">User</h1>
          <button class="btn mb-3 invert" style="background-color: #4B0080; color: #FFFFFF" data-toggle="modal" data-target="#tambah_user"><i class="fas fa-plus fa-sm"></i> Tambah User
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
                              <th>Nama User</th>
                              <th>Hak Akses</th>
                              <th>Opsi</th>
                          </tr>
                      </thead>
                      <tbody>
                          <?php
                            $no = 1;
                            $query = "SELECT * FROM t_user";
                            $sql_rm = mysqli_query($tiarakoneksi, $query) or die(mysqli_error($kon));
                            while ($data = mysqli_fetch_array($sql_rm)) {
                            ?>
                              <tr>
                                  <td><?= $no++ ?></td>
                                  <td><?= $data['nama_user'] ?></td>
                                  <td><?= $data['hak_akses'] ?></td>
                                  <td align="center">
                                      <button data-toggle="modal" data-target="#edit_user<?= $data['id_user'] ?>" class="btn btn-circle btn-sm" style="background-color: #4B0080;color:white;"><i class="fas fa-edit"></i></button>
                                      <a onclick="return confirm('Apakah kamu yakin ingin menghapus data ini ?')" href="index.php?page=user&hapus&id_user=<?= $data['id_user'] ?>" class="btn btn-circle btn-sm btn-danger"><i class="fas fa-trash"></i></a>

                                  </td>
                              </tr>
                              <!-- MODAL EDIT USER -->
                              <div class="modal fade" id="edit_user<?= $data['id_user'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                  <div class="modal-dialog">
                                      <div class="modal-content">
                                          <div class="modal-header">
                                              <h4 class="modal-title" id="myModalLabel">FORM EDIT USER</h4>
                                              <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                          </div>
                                          <div class="modal-body">
                                              <form action="" enctype="multipart/form-data" method="post">
                                                  <div class="form-group">
                                                      <input type="text" class="form-control" name="id_user" value="<?= $data['id_user'] ?>" required hidden>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="control-label">Nama User</label>
                                                      <input type="text" class="form-control" name="nama_user" value="<?= $data['nama_user'] ?>" required>
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="control-label">Password</label>
                                                      <input type="password" class="form-control" name="password" required value="<?= $data['nama_user'] ?>">
                                                  </div>
                                                  <div class="form-group">
                                                      <label class="control-label">Hak Akses</label>
                                                      <select class="form-control" name="hak_akses" required>
                                                          <option value="manager">Manager</option>
                                                          <option value="admin">Admin</option>
                                                          <option value="kasir">Kasir</option>
                                                      </select>
                                                  </div>
                                          </div>
                                          <div class="modal-footer">
                                              <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                              <input type="submit" class="btn" name="edit_user" value="save" style="background-color: #4B0080;color:white;">
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



      <!-- MODAL TAMBAH USER -->
      <div class="modal fade" id="tambah_user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
              <div class="modal-content">
                  <div class="modal-header">
                      <h4 class="modal-title" id="myModalLabel">FORM TAMBAH USER</h4>
                      <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                  </div>
                  <div class="modal-body">
                      <form action="" enctype="multipart/form-data" method="post">
                          <div class="form-group">
                              <label class="control-label">Nama User</label>
                              <input type="text" class="form-control" name="nama_user" required>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Password</label>
                              <input type="text" class="form-control" name="password" required>
                          </div>
                          <div class="form-group">
                              <label class="control-label">Hak Akses</label>
                              <select class="form-control" name="hak_akses" required>
                                  <option value="manager">Manager</option>
                                  <option value="admin">Admin</option>
                                  <option value="kasir">Kasir</option>
                              </select>
                          </div>
                  </div>
                  <div class="modal-footer">
                      <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                      <input type="submit" class="btn" style="background-color: #4B0080;color:white;" name="tambah_user" value="save">
                      </form>
                  </div>

              </div>
          </div>
      </div>
      <!-- END MODAL -->