<?php
include '../koneksi.php';
session_start();

if (@!$_SESSION['hak_akses'] == 'manager') {
    echo "<script>alert('Anda tidak memiliki hak akses');</script>";
    echo "<script>location='../index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Manager </title>
    <!-- Custom fonts for this template-->
    <link href="../assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Cusom styles for this template-->
    <link href="../assets/css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Data Table -->
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/datatables.min.css" />
    <link rel="stylesheet" type="text/css" href="../assets/DataTables/jquery.dataTables.min.css">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #4B0080;">
            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php?page=dashboard">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Manager</div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">








            <!-- MENU -->
            <li class="nav-item">
                <a class="nav-link" href="index.php?page=dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Menu</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header">Kategori:</h6>
                        <a class="collapse-item" href="index.php?page=makanan">Makanan</a>
                        <a class="collapse-item" href="index.php?page=minuman">Minuman</a>
                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?page=meja">
                    <i class="fas fa-chair"></i>
                    <span>Meja</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="index.php?page=laporan">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Laporan</span></a>
            </li>

            <!-- <div class="sidebar-heading">
                Interface
            </div> -->
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End MENU SIDE BAR -->









        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content" style="background-color:#FAF5F9 ;">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light  topbar mb-4 static-top shadow" style="background-color:#8100DE; color:white;">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn" type="button" style="background-color: #4B0080;color:white;">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                        </li>
                        <button class="btn btn-sm" data-toggle="modal" data-target="#logoutModal" style="background-color:#4B0080;color:white;">LOGOUT</button>
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline  small"> <?= $_SESSION['nama_user'] ?></span>
                                <img class="img-profile rounded-circle" src="../assets/img/undraw_profile.svg">
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->







                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <?php

                    @$page = $_GET['page'];
                    switch ($page) {
                        case 'makanan':
                            include "makanan.php";
                            break;
                        case 'minuman':
                            include "minuman.php";
                            break;
                        case 'dashboard':
                            include "dashboard.php";
                        case 'meja':
                            include "meja.php";
                            break;
                        default:
                            $page = "dashboard";
                            include "dashboard.php";
                            break;
                    }
                    ?>
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->






            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Tiara Kasir</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Yakin Ingin Keluar ?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Silahkan tekan "logout" jika ingin keluar, tekan "cancel" jika tidak jadi</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn" href="../logout.php" style="background-color:#4B0080;color:white;">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <!-- END LOGOUT MODAL -->
    <!-- Bootstrap core JavaScript-->
    <script src="../assets/vendor/jquery/jquery.min.js"></script>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../assets/vendor/jquery-easing/jquery.easing.min.js"></script>
    <!-- Custom scripts for all pages-->
    <script src="../assets/js/sb-admin-2.min.js"></script>
    <!-- Page level plugins -->
    <script src="../assets/vendor/chart.js/Chart.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="../assets/js/demo/chart-area-demo.js"></script>
    <script src="../assets/js/demo/chart-pie-demo.js"></script>
    <!-- Data Table -->
    <script type="text/javascript" src="../assets/DataTables/datatables.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#data-tables').DataTable()
        });
    </script>
    <!-- MASKING CONVERT ANGKA FORM JADI RUPIAHHHHHH -->
    <script src="../assets/js/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('#harga').mask('#.##0', {
                reverse: true
            });
            $('#harga2').mask('#.##0', {
                reverse: true
            });
            // $('#masking2').mask('#.##0,0', {reverse: true});
            // $('#harga_awal1').mask('#,##0.00', {reverse: true});
        });
    </script>
</body>

</html>