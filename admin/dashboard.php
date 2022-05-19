       <?php

        //    MENGHITUNG JUMLAH USER MANAGER
        $query_manager = mysqli_query($tiarakoneksi, "SELECT COUNT(*) as count_manager FROM t_user where hak_akses = 'manager'");
        $data_manager = mysqli_fetch_object($query_manager);

        //    MENGHITUNG JUMLAH USER Admin
        $query_admin = mysqli_query($tiarakoneksi, "SELECT COUNT(*) as count_admin FROM t_user where hak_akses = 'admin'");
        $data_admin = mysqli_fetch_object($query_admin);

        //    MENGHITUNG JUMLAH USER Kasir
        $query_kasir = mysqli_query($tiarakoneksi, "SELECT COUNT(*) as count_kasir FROM t_user where hak_akses = 'kasir'");
        $data_kasir = mysqli_fetch_object($query_kasir);

        //    MENGHITUNG JUMLAH USER Total
        $query_total = mysqli_query($tiarakoneksi, "SELECT COUNT(*) as count_total FROM t_user ");
        $data_total = mysqli_fetch_object($query_total);

        ?>


       <!-- Page Heading -->
       <div class="d-sm-flex align-items-center justify-content-between mb-4">
           <h1 class="h3 mb-0 text-gray-800">Dashboard Admin</h1>

       </div>

       <!-- Content Row -->
       <div class="row">

           <!-- Earnings (Monthly) Card Example -->
           <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-primary shadow h-100 py-2">
                   <div class="card-body">
                       <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                               <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                   Manager</div>
                               <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_manager->count_manager; ?> User</div>
                           </div>
                           <div class="col-auto">
                               <i class="fas fa-calendar fa-2x text-gray-300"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

           <!-- Earnings (Monthly) Card Example -->
           <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-success shadow h-100 py-2">
                   <div class="card-body">
                       <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                               <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                   Admin</div>
                               <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_admin->count_admin; ?> User</div>
                           </div>
                           <div class="col-auto">
                               <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>



           <!-- Pending Requests Card Example -->
           <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-warning shadow h-100 py-2">
                   <div class="card-body">
                       <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                               <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                   Kasir</div>
                               <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $data_kasir->count_kasir; ?> User</div>
                           </div>
                           <div class="col-auto">
                               <i class="fas fa-comments fa-2x text-gray-300"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

           <!-- Earnings (Monthly) Card Example -->
           <div class="col-xl-3 col-md-6 mb-4">
               <div class="card border-left-info shadow h-100 py-2">
                   <div class="card-body">
                       <div class="row no-gutters align-items-center">
                           <div class="col mr-2">
                               <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Total
                               </div>
                               <div class="row no-gutters align-items-center">
                                   <div class="col-auto">
                                       <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?= $data_total->count_total; ?> User</div>
                                   </div>
                                   <div class="col">
                                       <div class="progress progress-sm mr-2">
                                           <div class="progress-bar bg-info" role="progressbar" style="width: <?= $data_total->count_total; ?>%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                       </div>
                                   </div>
                               </div>
                           </div>
                           <div class="col-auto">
                               <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                           </div>
                       </div>
                   </div>
               </div>
           </div>

       </div>