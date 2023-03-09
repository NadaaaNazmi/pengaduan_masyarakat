<!DOCTYPE html>
<html lang="en">
<?php

session_start();
include('assets/head.php');
include('config/database.php');
if (empty($_SESSION['username'])) {
    @header('location:login.php');
} else {
    $nik = $_SESSION['nik'];
    $nama = $_SESSION['nama'];
    $username = $_SESSION['username'];
    $telp = $_SESSION['telp'];
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="./dist/styles.css">
    <link rel="stylesheet" href="./dist/all.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>Profile</title>
</head>

<body>
<!--Container -->
<div class="mx-auto bg-grey-400">
    <!--Screen-->
    <div class="min-h-screen flex flex-col">
        <!--Header Section Starts Here-->
        <header class="bg-nav">
            <div class="flex justify-between">
                <div class="p-1 mx-3 inline-flex items-center">
                    <i class="fas fa-bars pr-2 text-white"></i>
                    <h1 class="text-white p-2">SISPEMAS</h1>
                </div>
                <div class="p-1 flex flex-row items-center">
                    <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="https://divedigital.id/wp-content/uploads/2021/11/42.jpg" alt="">
                    <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block"><?= $_SESSION['username'] ?></a>
                </div>
            </div>
        </header>
        <!--/Header-->

        <div class="flex flex-1">
            <!--Sidebar-->
            <aside id="sidebar" class="bg-side-nav w-1/2 md:w-1/6 lg:w-1/6 border-r border-side-nav hidden md:block lg:block">
                <ul class="list-reset flex flex-col">
                <li class=" w-full h-full py-3 px-2 border-b border-light-border ">
                    <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom2023/profil.php" class="nav-link">
                        <b class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline"></b>
                        <i class="fas fa-table float-left mx-2"></i>
                            Profile
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                </li>
                    <?php } ?>
                <li class="w-full h-full py-3 px-2 border-b border-light-border">
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom2023/pengaduan.php" class="nav-link">
                        <b class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline"></b>
                        <i class="fab fa-wpforms float-left mx-2"></i>
                        Pengaduan
                        <span><i class="fa fa-angle-right float-right"></i></span>
                    </a>
                </li>
                <a href="http://<?= $_SERVER['SERVER_NAME'] ?> /ujikom2023/tanggapan.php" class="nav-link">
                <li class="w-full h-full py-3 px-2 border-b border-light-border">
                        <b class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline"></b>
                           <i class="fas fa-grip-horizontal float-left mx-2"></i>
                           Tanggapan
                           <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <?php if ($_SESSION['level'] == 'petugas') { ?>
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?> /ujikom2023/petugas.php" class="nav-link">
                        <li class="w-full h-full py-3 px-2 border-b border-light-border">
                            <b class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline"></b>
                                <i class="fas fa-table float-left mx-2"></i>
                                Petugas
                            <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <?php } ?>
                    <ul class="list-reset bg-white-medium-dark">
                        <li class="border-t border-light-border w-full h-full px-2 py-3">
                            <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom2023/logout.php" class="nav-link">
                            <i class="mx-4 font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline"></i>
                            Logout
                            <span><i class="fa fa-angle-right float-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </aside>
            <!--/Sidebar-->    
            <!--Main-->
            <main class="bg-white-300 flex-1 p-3 overflow-hidden">

            <div class="wrapper">
            <!-- Main content -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                    <div class="px-6 py-2 border-b border-light-grey">
                        <div class="alert alert-success alert-dismissable">Selamat Datang <strong><?= $_SESSION['username'] ?></strong> anda Login Sebagai <strong><?= $_SESSION['level'] ?></strong> <a class="close" href="" data-dismiss="alert"></a></div>
                    </div>
                        <div class="card">
                            <table class="table table-hover">
                            <tbody>
                                <tr>
                                <th scope="row">Nik : </th>
                                <td><?= $nik ?></td>
                                </tr>
                                <tr>
                                <th scope="row">Nama : </th>
                                <td><?= $nama ?></td>
                                </tr>
                                <tr>
                                <th scope="row">Username : </th>
                                <td><?= $username ?></td>
                                </tr>
                                <tr>
                                <th scope="row">Tlp : </th>
                                <td><?= $telp ?></td>
                                </tr>
                            </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
            <!-- /.content -->
            </div>
        </main>
     <!--/Main-->
        </div>
        <!--Footer-->
        <footer class="bg-grey-darkest text-white p-2">
            <div class="flex flex-1 mx-auto">&copy; My Design</div>
        </footer>
        <!--/footer-->

    </div>

</div>
<?php include('assets/body.php') ?>
<script src="./main.js"></script>
</body>

</html>