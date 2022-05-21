<?php
include 'koneksi.php';
session_start();

if (@$_POST['submit_login']) {
    $nama_user = $_POST['nama_user'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM t_user WHERE nama_user = '$nama_user'";
    $query = mysqli_query($tiarakoneksi, $sql);
    $row = mysqli_num_rows($query);

    if ($row > 0) {
        $data = mysqli_fetch_assoc($query);
        if ($password == $data['password']) {

            if ($data['hak_akses'] == 'manager') {
                $_SESSION['nama_user'] = $nama_user;
                $_SESSION['hak_akses'] = $data['hak_akses'];
                header("location:manager/index.php");
            } elseif ($data['hak_akses'] == 'admin') {
                $_SESSION['nama_user'] = $nama_user;
                $_SESSION['hak_akses'] = $data['hak_akses'];
                header("location:admin/index.php");
            } elseif ($data['hak_akses'] == 'kasir') {
                $_SESSION['nama_user'] = $nama_user;
                $_SESSION['hak_akses'] = $data['hak_akses'];
                $_SESSION['id_kasir'] = $data['id_user'];
                header("location:kasir/index.php");
            }
        } else {
            echo "<script>alert('Password Salah');</script>";
        }
    } else {
        echo "<script>alert('Nama User tidak ditemukan');</script>";
    }
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

    <title>Login</title>

    <!-- Custom fonts for this template-->
    <link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="assets/css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="dark-mode" style="background-color: #4B0082">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-5 col-lg-12 col-md-9 ">

                <div class="card o-hidden border-2 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">

                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <i class="fas fa-users invert " style="color: #FFFFFF"></i>
                                        <h1 class="h4 text-gray-900 mb-4 "><b class="invert">Form Login</b></h1>
                                    </div>


                                    <form method="post" action="" class="user">


                                        <div class="form-group">
                                            <input type="text" class="form-control form-control-user " id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukan username..." name="nama_user">


                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="exampleInputPassword" placeholder="Masukan password..." name="password">



                                        </div>
                                        <button type="submit" class="btn invert form-control" style="background-color: #4B0082; color: #FFFFFF" value="login" name="submit_login">
                                            Login
                                        </button>



                                    </form>
                                    <hr>

                                    <div class="text-center">
                                        <a class="small invert" style="color: #FFFFFF;" href=" ">Belum punya akun? Daftar!</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>



</body>

</html>