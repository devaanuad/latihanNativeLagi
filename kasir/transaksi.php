       <!-- Page Heading -->
       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800"> Transaksi</h1>
       </div>



       <!-- Content Row -->
       <div class="row">

           <!-- Area Chart -->
           <div class="col-xl-5 col-lg-7">
               <div class="card shadow mb-4">
                   <!-- Card Header - Dropdown -->
                   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                       <h6 class="m-0 font-weight-bold text-primary">Daftar Menu</h6>
                   </div>
                   <!-- Card Body -->
                   <div class="card-body">
                       <div class="chart-area table-responsive">


                           <table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle" id="data-tables-menu">
                               <thead>
                                   <tr>

                                       <th>Nama Menu</th>
                                       <th>Harga</th>
                                       <th>Jumlah</th>
                                       <th>Opsi</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <?php
                                    $no = 1;
                                    $query = "SELECT * FROM t_menu";
                                    $sql_rm = mysqli_query($tiarakoneksi, $query) or die(mysqli_error($kon));
                                    while ($data = mysqli_fetch_array($sql_rm)) {
                                        $id_menu = $data['id_menu'];
                                    ?>

                                       <tr>
                                           <!-- FORM buat ngambil jumlah menu -->
                                           <form action="index.php?page=transaksi&cart=<?= $id_menu ?>" method="post" enctype="multipart/form-data">
                                               <td><?= $data['nama_menu']  ?></td>
                                               <td>Rp. <?= $data['harga'] ?></td>
                                               <td><input type="text" name="jumlah" class="form-control" required></td>
                                               <td align="center">
                                                   <a class="fas fa-eye" data-toggle="modal" data-target="#id_menu<?= $data['id_menu'] ?>"></a>
                                                   <button class="btn btn-sm" type="submit"><i class="fas fa-plus"></i></button>
                                               </td>
                                           </form>
                                       </tr>

                                       <!-- MODAL EDIT MEJA -->
                                       <div class="modal fade" id="id_menu<?= $data['id_menu'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                           <div class="modal-dialog">
                                               <div class="modal-content">
                                                   <div class="modal-header">
                                                       <h4 class="modal-title" id="myModalLabel">DETAIL MENU</h4>
                                                       <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                                                   </div>
                                                   <div class="modal-body">
                                                       <form action="" enctype="multipart/form-data" method="post">
                                                           <div class="form-group">
                                                               <label class="control-label">Nama Menu</label>
                                                               <input type="text" class="form-control" value="<?= $data['nama_menu'] ?>" readonly>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class="control-label">Deskripsi Menu</label>
                                                               <textarea type="text" class="form-control" readonly><?= $data['deskripsi'] ?></textarea>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class="control-label">Kategori</label>
                                                               <input type="text" class="form-control" value="<?= $data['kategori'] ?>" readonly>
                                                           </div>
                                                           <div class="form-group">
                                                               <label class="control-label">Harga</label>
                                                               <input type="text" class="form-control harga" value="Rp <?= $data['harga'] ?>" readonly>
                                                           </div>
                                                   </div>
                                                   <div class="modal-footer">
                                                       <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal">Close</button>
                                                       </form>
                                                   </div>

                                               </div>
                                           </div>
                                       </div>
                                       <!-- END MODAL VIEW MENU -->
                                   <?php } ?>
                               </tbody>
                           </table>


                       </div>
                   </div>
               </div>
           </div>








           <!-- INI TABEL CART-->
           <div class="col-xl-7 col-lg-5">
               <div class="card shadow mb-4">
                   <!-- Card Header - Dropdown -->
                   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                       <h6 class="m-0 font-weight-bold text-primary">Cart Menu</h6>
                   </div>

                   <?php
                    if (@$_GET['cart']) {
                        $id_cart_menu = $_GET['cart'];
                        $jumlah_menu = $_POST['jumlah'];

                        $query = "SELECT * FROM t_menu WHERE id_menu = '$id_cart_menu'";
                        $sql_rm2 = mysqli_query($tiarakoneksi, $query) or die(mysqli_error($kon));
                        $datacart = mysqli_fetch_array($sql_rm2);

                        // Data dimasukin ke session cart
                        $_SESSION['cart'][$id_cart_menu] = [
                            'id_menu' => $datacart['id_menu'],
                            'nama_menu' => $datacart['nama_menu'],
                            'harga' => $datacart['harga'],
                            'jumlah' => $jumlah_menu
                        ];
                        echo "<script>location.href='index.php?page=transaksi';</script>";
                    }

                    //hapus data cart
                    if (@$_GET['hapus']) {
                        $id_cart_menu = $_GET['hapus'];
                        unset($_SESSION['cart'][$id_cart_menu]);
                        echo "<script>location.href='index.php?page=transaksi';</script>";
                    }
                    ?>


                   <!-- Card Body -->
                   <div class="card-body">
                       <?php if (empty($_SESSION['cart'])) { ?>
                           <div class="chart-pie pt-4 pb-2 justify-content-center text-center">
                               <hi>Belum Ada Data yang dimasukan ke dalam cart menu</hi>
                           </div>
                       <?php  } else { ?>
                           <div class="table-responsive">
                               <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                   <thead>
                                       <tr>
                                           <th>No</th>
                                           <th>Nama Menu</th>
                                           <th>Harga</th>
                                           <th>Qty</th>
                                           <th>SubTotal</th>
                                           <th>Opsi</th>
                                       </tr>
                                   </thead>
                                   <tbody>
                                       <?php
                                        $no = 1;
                                        $grandtotal = 0;
                                        foreach ($_SESSION["cart"] as $cart => $value) {
                                            $subtotal = $value['harga'] * $value['jumlah'];
                                            $grandtotal += $subtotal;
                                        ?>
                                           <tr>
                                               <td><?= $no++ ?></td>
                                               <td><?= $value['nama_menu'] ?></td>
                                               <td>Rp. <?= $value['harga'] ?></td>
                                               <td><?= $value['jumlah'] ?></td>
                                               <td>Rp. <?= $value['harga'] * $value['jumlah'] ?></td>
                                               <td>
                                                   <a href="index.php?page=transaksi&hapus=<?= $value['id_menu'] ?>" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                                               </td>
                                           </tr>
                                       <?php } ?>
                                   </tbody>
                               </table>
                           </div>

                           <div class="mt-3 text-center small">
                               <h6><b>TOTAL BAYAR : Rp. <?= $grandtotal ?></b></h6>
                           </div>
                       <?php } ?>
                       <div class="mt-3 text-center small">
                           <h6>...</h6>
                       </div>
                   </div>
               </div>
           </div>
           <!-- INI END TABEL CART-->

       </div>

       <div class="row">
           <div class="col-xl-12 col-lg-5">
               <div class="card shadow mb-4">
                   <!-- Card Header - Dropdown -->
                   <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                       <h6 class="m-0 font-weight-bold text-primary">No Meja</h6>
                   </div>
                   <!-- Card Body -->
                   <div class="card-body">

                   </div>
               </div>
           </div>
       </div>