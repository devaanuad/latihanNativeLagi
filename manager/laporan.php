<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0">Laporan Pendapatan Cafe Bisa Ngopi</h1>
    <button class="btn mb-3 invert uwu" style="background-color: #4B0080; color: #FFFFFF" onclick="return print()"><i class="fas fa-plus fa-sm uwu"></i> Cetak
    </button>
</div>
<h6 class="h6 mb-5">Tanggal : <?= date('d-m-Y'); ?></h6>



<!-- CARI DATA LAPORAN BERDASARKAN TANGGAL DAN NAMA KASIR -->
<div class="row uwu">
    <div class="col-3">
        <form method="post" enctype="multipart/form-data">
            <div class="form-group col-md-12">
                <label for="">Tanggal Awal</label>
                <input type="date" class="form-control" name="tgl_awal">
            </div>
    </div>
    <div class="col-3">
        <div class="form-group col-md-12">
            <label for="">Tanggal Akhir</label>
            <input type="date" class="form-control" name="tgl_akhir">
        </div>
    </div>

    <div class="col-3">
        <div class="form-group col-md-12">
            <label for="">Nama Kasir</label>
            <select class="form-control" name="nama_kasir" required>
                <?php
                $tiaraquery = "SELECT * FROM t_user where hak_akses='kasir' ";
                $tiararesult = mysqli_query($tiarakoneksi, $tiaraquery);
                while ($tiararow = mysqli_fetch_array($tiararesult)) { ?>
                    <option value="<?= $tiararow['nama_user'] ?>"><?= $tiararow['nama_user'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="col-3">
        <div class="form-group col-md-12">
            <label for="">&nbsp;</label>
            <button class="form-control btn " name="cari" style="background-color: #8100DE;color:white;">Cari</button>
        </div>
        </form>
    </div>
</div>



<br>
<!-- Content Row -->
<div class="row">
    <div class="col-lg-12">
        <div class="table-responsive">
            <table class="tablesaw table-striped table-hover table-bordered table" data-tablesaw-mode="columntoggle" id="data-tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl</th>
                        <th>No TRS</th>
                        <th>Nama Kasir</th>
                        <th>Meja</th>
                        <th>Total</th>
                        <th class="uwu">Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $total_pendapatan = 0;

                    if (isset($_POST['cari'])) {
                        $tgl_awal = $_POST['tgl_awal'];
                        $tgl_akhir = $_POST['tgl_akhir'];
                        $nama_kasir = $_POST['nama_kasir'];

                        // JIKA TANGGAL AWAL DAN TANGGAL AKHIR KOSONG DAN NAMA KASIR KOSONG
                        if (empty($tgl_awal) && empty($tgl_akhir) && empty($nama_kasir)) {
                            // MAKA TAMPILKAN SEMUA DATA LAPORAN
                            $query = "SELECT * FROM t_transaksi INNER JOIN t_meja ON t_transaksi.id_meja=t_meja.id_meja INNER JOIN t_user ON t_transaksi.id_user=t_user.id_user ORDER BY t_transaksi.id_transaksi DESC";

                            // JIKA TANGGAL AWAL DAN TANGGAL AKHIR KOSONG DAN NAMA KASIR TIDAK KOSONG
                        } elseif (empty($tgl_awal) && empty($tgl_akhir)) {
                            // MAKA TAMPILKAN DATA LAPORAN BERDASARKAN NAMA KASIR
                            $query = "SELECT * FROM t_transaksi INNER JOIN t_meja ON t_transaksi.id_meja=t_meja.id_meja INNER JOIN t_user ON t_transaksi.id_user=t_user.id_user WHERE t_user.nama_user LIKE '%$nama_kasir%' ORDER BY t_transaksi.id_transaksi DESC";

                            // JIKA TANGGAL AWAL DAN TANGGAL AKHIR TIDAK KOSONG DAN NAMA KASIR KOSONG
                        } elseif (empty($nama_kasir)) {
                            // MAKA TAMPILKAN DATA LAPORAN BERDASARKAN TANGGAL AWAL DAN TANGGAL AKHIR
                            $query = " SELECT*FROM t_transaksi INNER JOIN t_meja ON t_transaksi.id_meja=t_meja.id_meja INNER JOIN t_user ON t_transaksi.id_user=t_user.id_user WHERE t_transaksi.tanggal_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir' ORDER BY t_transaksi.id_transaksi DESC";

                            // JIKA TANGGAL AWAL DAN TANGGAL AKHIR TIDAK KOSONG DAN NAMA KASIR TIDAK KOSONG
                        } else {
                            // MAKA TAMPILKAN DATA LAPORAN BERDASARKAN TANGGAL AWAL DAN TANGGAL AKHIR DAN NAMA KASIR
                            $query = "SELECT*FROM t_transaksi 
                            INNER JOIN t_meja ON t_transaksi.id_meja=t_meja.id_meja 
                            INNER JOIN t_user ON t_transaksi.id_user=t_user.id_user WHERE t_transaksi.tanggal_transaksi BETWEEN '$tgl_awal' AND '$tgl_akhir' AND t_user.nama_user='$nama_kasir' ORDER BY t_transaksi.id_transaksi DESC";
                        }
                        $sql_rm = mysqli_query($tiarakoneksi, $query) or die(mysqli_error($tiarakoneksi));
                        while ($data = mysqli_fetch_array($sql_rm)) {
                            $id_transaksi =  $data['id_transaksi'];
                            $total_pendapatan += $data['total_bayar']; ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= date('d F Y', strtotime($data['tanggal_transaksi']))  ?></td>
                                <td><?= $id_transaksi ?> </td>
                                <td><?= $data['nama_user'] ?></td>
                                <td><?= $data['no_meja'] ?></td>
                                <td>Rp <?= number_format($data['total_bayar'], 0, ",", ".") ?></td>
                                <td align="center" class="uwu">
                                    <a class="btn btn-circle btn-sm" href="index.php?page=struk&transaksi=<?= $id_transaksi ?>" data-toggle="tooltip" data-placement="top" title="Lihat Struk" style="background-color: #4B0080;color:white;"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                        <!-- JIKA TOMBOL CARI TIDAK DI TEKAN MAKA TAMPILKAN-->
                        <?php } else {
                        $query = "SELECT * FROM t_transaksi INNER JOIN t_meja ON t_transaksi.id_meja=t_meja.id_meja INNER JOIN t_user ON t_transaksi.id_user=t_user.id_user ORDER BY t_transaksi.id_transaksi DESC";

                        $sql_rm = mysqli_query($tiarakoneksi, $query) or die(mysqli_error($tiarakoneksi));
                        while ($data = mysqli_fetch_array($sql_rm)) {
                            $id_transaksi =  $data['id_transaksi'];
                            $total_pendapatan += $data['total_bayar']; ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= date('d F Y', strtotime($data['tanggal_transaksi']))  ?></td>
                                <td><?= $id_transaksi ?> </td>
                                <td><?= $data['nama_user'] ?></td>
                                <td><?= $data['no_meja'] ?></td>
                                <td>Rp <?= number_format($data['total_bayar'], 0, ",", ".") ?></td>
                                <td align="center" class="uwu">
                                    <a class="btn btn-circle btn-sm" href="index.php?page=struk&transaksi=<?= $id_transaksi ?>" data-toggle="tooltip" data-placement="top" title="Lihat Struk" style="background-color: #4B0080;color:white;"><i class="fas fa-eye"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    <?php   } ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Total</td>
                        <td align="right">Rp <?= number_format($total_pendapatan, 0, ",", ".") ?></td>
                        <td class="uwu"></td>
                </tfoot>
            </table>
        </div>
    </div>
</div>



















<!-- SELECT*FROM t_transaksi INNER JOIN t_meja ON t_transaksi.id_meja=t_meja.id_meja INNER JOIN t_user ON t_transaksi.id_user=t_user.id_user WHERE t_transaksi.tanggal_transaksi BETWEEN '2022-05-22' AND '2022-05-22' ORDER BY t_transaksi.id_transaksi DESC; -->

<!-- SELECT*FROM t_transaksi 
INNER JOIN t_meja ON t_transaksi.id_meja=t_meja.id_meja 
INNER JOIN t_user ON t_transaksi.id_user=t_user.id_user WHERE t_transaksi.tanggal_transaksi BETWEEN '2022-05-22' AND '2022-05-22' AND t_user.nama_user='tiara' ORDER BY t_transaksi.id_transaksi DESC; -->