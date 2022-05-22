     <?php
        if (@$_GET['cart']) {
            $id_cart_menu = $_GET['cart'];
            $jumlah_menu = $_POST['jumlah'];
            // dapetin data id keranjang
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
            unset($_SESSION['grandtotal']);
            echo "<script>location.href='index.php?page=transaksi';</script>";
        }
        ?>


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
                 <!-- Card Body -->
                 <div class="card-body">
                     <?php if (empty($_SESSION['cart'])) { ?>
                         <div class="chart-pie pt-4 pb-2 justify-content-center text-center">
                             <hi>Belum Ada Data yang dimasukan ke dalam cart menu</hi>
                         </div>
                     <?php  } else { ?>
                         <div class="table-responsive">
                             <table class="table table-bordered" id="data-tables-cart-menu" width="100%" cellspacing="0">
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
                         <?php $_SESSION['grandtotal'] = $grandtotal; ?>
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



     <!-- INI KODINGAN CHECKOUT  -->
     <?php
        if (isset($_POST['checkout'])) {
            $id_transaksi = $_POST['no_transaksi'];
            $id_meja = $_POST['id_meja'];
            $id_user = $_SESSION['id_kasir'];
            $total_bayar = $_SESSION['grandtotal'];
            $jumlah_bayar = $_POST['jumlah_bayar'];
            $tgl_transaksi = date('Y-m-d');

            if ($jumlah_bayar < $total_bayar) {
                echo "<script>alert('Jumlah bayar tidak mencukupi');</script>";
            } else {
                if ($id_transaksi == "" || $id_meja == "" || $id_user == "" || $total_bayar == "" || $jumlah_bayar == "" || $tgl_transaksi == "") {
                    echo "<script>alert('Transaksi Gagal, Mohon pastikan data terisi');</script>";
                } else {
                    $sql4 = "INSERT INTO t_transaksi VALUES ('0', '$id_transaksi', '$id_meja', '$id_user', '$total_bayar', '$jumlah_bayar', '$tgl_transaksi')";
                    $query4 = mysqli_query($tiarakoneksi, $sql4);
                    if ($query4) {
                        foreach ($_SESSION['cart'] as $cart => $value) {
                            $id_menu = $value['id_menu'];
                            $jumlah = $value['jumlah'];
                            $harga = $value['harga'];
                            $subtotal = $value['harga'] * $value['jumlah'];
                            $sql5 = "INSERT INTO t_detail_transaksi VALUES ('0', '$id_transaksi', '$id_menu', '$jumlah', '$harga', '$subtotal')";
                            $query5 = mysqli_query($tiarakoneksi, $sql5);
                            if ($query5) {
                                $query6 = mysqli_query($tiarakoneksi, "UPDATE t_meja SET status = 'terisi' WHERE id_meja = '$id_meja'");
                                unset($_SESSION['cart']);
                                unset($_SESSION['grandtotal']);
                                echo "<script>alert('Transaksi Berhasil');</script>";
                                echo "<script>location='index.php?page=struk&transaksi=$id_transaksi';</script>";
                            }
                        }
                    }
                }
            }
        }


        //INI AUTO KODEE UNTUK MANGGIL ID TRANSAKSI BARU
        $tiarasql = mysqli_query($tiarakoneksi, "select max(id_transaksi) as maxID from t_transaksi");
        $data = mysqli_fetch_array($tiarasql);
        $kodeBarang = $data['maxID'];
        $kode = (int) substr($kodeBarang, 11, 3);
        $kode++;
        $ket = "TRS" . date('Ymd');
        $autokode_id_transaksi = $ket . sprintf("%03s", $kode);
        ?>

     <!-- CHECKOUT -->
     <div class="row">
         <div class="col-xl-12 col-lg-5">
             <div class="card shadow mb-4">
                 <!-- Card Header - Dropdown -->
                 <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                     <h6 class="m-0 font-weight-bold text-primary">Checkout</h6>
                 </div>
                 <!-- Card Body -->
                 <div class="card-body">
                     <form method="post" enctype="multipart/form-data">
                         <div class="form-group">
                             <label class="control-label">No Transaksi</label>
                             <input type="text" class="form-control" style="color: #4B0080;" name="no_transaksi" value="<?= $autokode_id_transaksi ?>" readonly required>
                         </div>
                         <!-- QUERY MENAMPILKAN DATA MEJA KOSONG -->
                         <?php
                            $query3 = "SELECT * FROM t_meja WHERE status = 'kosong' ";
                            $sql_rm3 = mysqli_query($tiarakoneksi, $query3) or die(mysqli_error($tiarakoneksi));
                            ?>
                         <div class="form-group">
                             <label class="control-label">No Meja</label>
                             <select class="form-control" name="id_meja" required>
                                 <option value="">Pilih No Meja Kosong</option>
                                 <?php while ($data3 = mysqli_fetch_array($sql_rm3)) { ?>
                                     <option value="<?= $data3['id_meja'] ?>"><?= $data3['no_meja'] ?></option>
                                 <?php } ?>
                             </select>
                         </div>
                         <div class="form-group">
                             <label class="control-label">Total Bayar</label>
                             <?php if (empty($_SESSION['grandtotal'])) { ?>
                                 <input type="text" class="form-control" name="" value="Belum ada Menu yang dimasukan kedalam keranjang" readonly>
                             <?php } else { ?>
                                 <input type="text" class="form-control" style="color: #4B0080;" name="total_bayar" value="<?= $_SESSION['grandtotal'] ?>" required readonly>
                             <?php } ?>
                         </div>
                         <div class="form-group">
                             <label class="control-label">Jumlah Bayar</label>
                             <input type="number" class="form-control" name="jumlah_bayar" required>
                         </div>
                         <div class="card-footer">
                             <button type="submit" class="btn form-control" style="background-color: #4B0080;color:white;" name="checkout">Checkout</button>
                         </div>
                     </form>
                 </div>
             </div>
         </div>
     </div>
     <!-- END CHECKOUT  -->