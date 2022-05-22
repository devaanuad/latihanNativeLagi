 <!-- Page Heading -->

 <?php
    $get_id_transaksi = $_GET['transaksi'];
    // MENAMILKAN INFO KONTAK
    $tiarasql1 = mysqli_query($tiarakoneksi, "SELECT * FROM t_transaksi INNER JOIN t_meja ON t_transaksi.id_meja=t_meja.id_meja INNER JOIN t_user ON t_transaksi.id_user=t_user.id_user WHERE t_transaksi.id_transaksi='$get_id_transaksi'");
    $tiaradata1 = mysqli_fetch_array($tiarasql1);
    ?>

 <div class="d-sm-flex align-items-center justify-content-between mb-4 uwu">
     <h1 class="h3 mb-0 text-gray-800 uwu"> Struk #<?= $tiaradata1['id_transaksi'] ?></h1>
     <button class="btn mb-3 invert uwu" style="background-color: #4B0080; color: #FFFFFF" onclick="return print()"><i class="fas fa-plus fa-sm uwu"></i> Cetak
     </button>
 </div>


 <div class="row">


     <div id="invoice-POS" style="width: 300px;">

         <center id="top">
             <div class="info">
                 <h3><b>Cafe Bisa Ngopi</b></h3>
                 <p style="margin-top: -5px;">Jl Cimindi Raya No36 A Blok B</p>
             </div>
             <!--End Info-->
         </center>
         <!--End InvoiceTop-->



         <div id="mid">
             <div class="info">
                 <h2>Info Kontak</h2>
                 <p>
                     Tgl TRS : <?= date('d-m-Y', strtotime($tiaradata1['tanggal_transaksi'])) ?><br>
                     No TRS : <?= $tiaradata1['id_transaksi'] ?></br>
                     No Meja : <?= $tiaradata1['no_meja'] ?></br>
                     Kasir : <?= $tiaradata1['nama_user'] ?></br>
                 </p>
             </div>
         </div>
         <!--End Invoice Mid-->

         <div id="bot">

             <div id="table">
                 <table>
                     <tr class="tabletitle">
                         <td class="item">
                             <h2>Item</h2>
                         </td>
                         <td class="Hours">
                             <h2>Harga</h2>
                         </td>
                         <td class="Hours">
                             <h2>Qty</h2>
                         </td>
                         <td class="Rate">
                             <h2>Sub Total</h2>
                         </td>
                     </tr>

                     <?php
                        // Menampilkan info menu yg di beli
                        $grandtotal = 0;
                        $tiarasql2 = mysqli_query($tiarakoneksi, "SELECT * FROM t_detail_transaksi INNER JOIN t_menu ON t_detail_transaksi.id_menu=t_menu.id_menu WHERE t_detail_transaksi.id_transaksi='$get_id_transaksi' ");
                        while ($tiaradata2 = mysqli_fetch_array($tiarasql2)) {
                            $subtotal = $tiaradata2['harga'] * $tiaradata2['jumlah'];
                            $grandtotal += $subtotal;
                        ?>

                         <tr class="service">
                             <td class="tableitem">
                                 <p class="itemtext"><?= $tiaradata2['nama_menu'] ?></p>
                             </td>
                             <td class="tableitem">
                                 <p class="itemtext"><?= $tiaradata2['harga'] ?></p>
                             </td>
                             <td class="tableitem">
                                 <p class="itemtext"><?= $tiaradata2['jumlah'] ?></p>
                             </td>
                             <td class="tableitem">
                                 <p class="itemtext"><?= $subtotal ?></p>
                             </td>
                         </tr>


                     <?php
                        } ?>

                     <tr class="tabletitle">
                         <td></td>
                         <td class="Rate">
                         </td>
                         <td class="Rate">
                             <h2>Total</h2>
                         </td>
                         <td class="payment">
                             <h2><?= $grandtotal ?></h2>
                         </td>
                     </tr>

                     <tr class="tabletitle">
                         <td></td>
                         <td class="Rate">
                         </td>
                         <td class="Rate">
                             <h2>Jumlah Bayar</h2>
                         </td>
                         <td class="payment">
                             <h2><?= $tiaradata1['jumlah_bayar'] ?></h2>
                         </td>
                     </tr>

                     <tr class="tabletitle">
                         <td></td>
                         <td class="Rate">
                         </td>
                         <td class="Rate">
                             <h2>Kembalian</h2>
                         </td>
                         <td class="payment">
                             <h2><?= $tiaradata1['jumlah_bayar'] - $grandtotal ?></h2>
                         </td>
                     </tr>

                 </table>
             </div>
             <!--End Table-->

             <div id="legalcopy">
                 <p class="legal"><strong>Terimakasih Telah Datang!</strong> Semoga anda berkunjung kembali
                 </p>
             </div>

         </div>
         <!--End InvoiceBot-->
     </div>
     <!--End Invoice-->


 </div>