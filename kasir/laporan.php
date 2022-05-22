<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800 uwu">Laporan Yang Di Tangani</h1>
    <button class="btn mb-3 invert uwu" style="background-color: #4B0080; color: #FFFFFF" onclick="return print()"><i class="fas fa-plus fa-sm uwu"></i> Cetak
    </button>
</div>

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
                        <th>Total</th>
                        <th>Meja</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $get_id_kasir = $_SESSION['id_kasir'];
                    $no = 1;
                    $query = "SELECT * FROM t_transaksi INNER JOIN t_meja ON t_transaksi.id_meja=t_meja.id_meja INNER JOIN t_user ON t_transaksi.id_user=t_user.id_user WHERE t_transaksi.id_user='$get_id_kasir' ORDER BY t_transaksi.id_transaksi DESC";
                    $sql_rm = mysqli_query($tiarakoneksi, $query) or die(mysqli_error($kon));
                    while ($data = mysqli_fetch_array($sql_rm)) {
                        $id_transaksi =  $data['id_transaksi'] ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d F Y', strtotime($data['tanggal_transaksi']))  ?></td>
                            <td><?= $id_transaksi ?> </td>
                            <td>Rp <?= number_format($data['total_bayar'], 0, ",", ".") ?></td>
                            <td><?= $data['no_meja'] ?></td>
                            <td align="center">
                                <a class="btn btn-circle btn-sm" href="index.php?page=struk&transaksi=<?= $id_transaksi ?>" data-toggle="tooltip" data-placement="top" title="Lihat Struk" style="background-color: #4B0080;color:white;"><i class="fas fa-eye"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>