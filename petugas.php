<?php 
@session_start();
include('assets/head.php');
include('config/database.php');

if(isset($_POST['edit'])){
    $nik = $_POST['nik'];
    $status = $_POST['status'];
    if($status == '1'){
        $q = mysqli_query($con, "UPDATE masyarakat SET verifikasi = '1' WHERE nik = '$nik'");
    }else{
        $q = mysqli_query($con, "UPDATE masyarakat SET verifikasi = '0' WHERE nik = '$nik'");
    }
}

if(isset($_POST['hapus'])){
    $nik = $_POST['nik'];
    $q = mysqli_query($con, "DELETE FROM masyarakat WHERE nik = '$nik'");
}

if(isset($_POST['edit-mas'])){
    $niklama = $_POST['nikLama'];
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $telp = $_POST['telp'];

    $u = mysqli_query($con, "SELECT * from masyarakat WHERE username='$username'");
    $r = mysqli_num_rows($u);
    if($r == 1){
        $q = mysqli_query($con, "UPDATE masyarakat SET nik = '$nik', nama = '$nama', password = '$password', telp = '$telp' WHERE nik = '$niklama'");
        ?>
            <div class="alert alert-danger" role="alert">
                Username Gagal Diganti Karena Username Telah Digunakan ! 
            </div>
        <?php
    }else{
        $q = mysqli_query($con, "UPDATE masyarakat SET nik = '$nik', nama = '$nama', username = '$username', password = '$password', telp = '$telp' WHERE nik = '$niklama'");
    ?>
        <div class="alert alert-success" role="alert">
            Anda Telah Berhasil Memperbarui Data !
        </div>
    <?php
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="keywords" content="tailwind,tailwindcss,tailwind css,css,starter template,free template,admin templates, admin template, admin dashboard, free tailwind templates, tailwind example">
    <!-- Css -->
    <link rel="stylesheet" href="./dist/styles.css">
    <link rel="stylesheet" href="./dist/all.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>Petugas</title>
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
                    <img onclick="profileToggle()" class="inline-block h-8 w-8 rounded-full" src="https://i.pinimg.com/474x/8f/e3/79/8fe379b8c02ed5d62c8e12097f07620a.jpg" alt="">
                    <a href="#" onclick="profileToggle()" class="text-white p-2 no-underline hidden md:block lg:block">Petugas</a>
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
                <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom2023/tanggapan.php" class="nav-link">
                <li class="w-full h-full py-3 px-2 border-b border-light-border">
                        <b class="font-sans font-hairline hover:font-normal text-sm text-nav-item no-underline"></b>
                           <i class="fas fa-grip-horizontal float-left mx-2"></i>
                           Tanggapan
                           <span><i class="fa fa-angle-right float-right"></i></span>
                        </a>
                    </li>
                    <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level' == 'petugas']) { ?>
                    <a href="http://<?= $_SERVER['SERVER_NAME'] ?>/ujikom2023/petugas.php" class="nav-link">
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
             <!-- Card Sextion Starts Here -->
                    <div class="flex flex-1 flex-col md:flex-row lg:flex-row mx-2">

                        <!-- card -->

                        <div class="container">
        <div class="card">
            <div class="card-header">
                <p class="fs-4 fw-bold">Daftar Masyarakat</p>
            </div>
            <div class="card-body">
                <?php 
                    if($_SESSION['level'] == 'masyarakat'){
                        true;
                    }else{
                        ?> 
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                            <i class="fas fa-user-plus"></i> Tambahkan masyarakat
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h5 class="fw-bold mb-5">Tambahkan Warga</h5>
                                    <form action="" method="POST">
                                        <div class="mb-3">
                                            <label for="nik" class="form-label">NIK</label>
                                            <input type="text" class="form-control" id="nik" name="nik" placeholder="NIK Berdasarkan KTP" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nama" class="form-label">Nama</label>
                                            <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Berdasarkan KTP" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="username" class="form-label">Username</label>
                                            <input type="text" class="form-control" id="username" name="username" placeholder="Pilih Username yang Belum Digunakan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" class="form-control" id="password" name="password" placeholder="Pilih Password yang Aman" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="telp" class="form-label">Nomor Telpon</label>
                                            <input type="number" class="form-control" id="telp" name="telp" placeholder="Nomor HP Aktif">
                                        </div>
                                        <div class="row justify-content-center modal-footer">
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-primary" name="daftar" id="daftar">Daftar</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            </div>
                        <?php
                    }
                ?>
                
                <table id="" class="table table-primary table-striped mt-3">
                    <tr>
                        <th scope="col">NIK</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Username</th>
                        <th scope="col">No. Telpon</th>
                        <?php 
                            if($_SESSION['level'] == 'masyarakat'){
                                true;
                            }else{
                                ?> 
                                    <th scope="col">Edit</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Hapus</th>
                                <?php
                            }
                        ?>
                    </tr>
                    
                    <?php 
                    include('config/database.php');
                    $q = mysqli_query($con, "SELECT * FROM masyarakat");
                    while($m = mysqli_fetch_object($q)){
                        ?>
                            <tr>
                                <td><?= $m -> nik ?></td>
                                <td><?= $m -> nama ?></td>
                                <td><?= $m -> username ?></td>
                                <td><?= $m -> telp ?></td>
                                <td>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal<?= $m -> nik ?>">
                                    Edit
                                </button>

                                <div class="modal fade" id="exampleModal<?= $m -> nik ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"> Perbarui data</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="" method="post">
                                                    <input type="hidden" name="nikLama" value="<?= $m->nik ?>">
                                                    <div class="modal-body">
                                                            <div class="mb-3">
                                                            <div class="form-group"><label for="nik">Nik</label>
                                                                <input class="form-control" type="text" name="nik" value="<?= $m->nik ?>">
                                                            </div>
                                                            </div>
                                                                <div class="mb-3">
                                                                    <div class="form-group"><label for="nama">Nama</label>
                                                                        <input class="form-control" type="text" name="nama" value="<?= $m->nama ?>">
                                                                    </div>
                                                                </div>
                                                            <div class="mb-3">
                                                                <div class="form-group"><label for="username">Username</label>
                                                                    <input class="form-control" type="text" name="username" value="<?= $m->username ?>">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-group"><label for="username">New Password</label>
                                                                    <input class="form-control" type="password" name="password" value="">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <div class="form-group"><label for="username">Telepon</label>
                                                                    <input class="form-control" type="number" name="telp" value="<?= $m->nik ?>">
                                                                </div>
                                                            </div>
                                                            <div class="mb-3"></div>
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">tutup</button>
                                                                <button name="edit-mas" class="btn btn-primary">simpan</button>
                                                            </div>
                                                    </div>
                                                </form>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                                </td>
                                <?php 
                                    if($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas'){
                                        ?> 
                                            <td><?php if ($m->verifikasi == '0') {
                                                        echo '<form action="" method="post"><input name="nik" type="hidden" value="' . $m->nik . '"><input name="status" type="hidden" value="1"><button name="edit" type="submit" class="btn btn-danger"><i class="fa fa-ban"></i></button></form>';
                                                    } else {
                                                        echo '<form action="" method="post"><input name="nik" type="hidden" value="' . $m->nik . '"><input name="status" type="hidden" value="0"><button name="edit" type="submit" class="btn btn-success"><i class="fa fa-check"></i></button></form>';
                                                    } ?>
                                            </td>
                                            <td>
                                                <form action="" method="post"><input type="hidden" name="nik" value="<?= $m->nik ?>"><button name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
                                            </td>
                                        <?php
                                    }
                                ?>
                                
                            </tr> 
                        <?php
                    }
                    ?>
                </table>
            </div>
        </div>
    </div>
                        <!-- /card -->

                    </div>
                    <!-- /Cards Section Ends Here -->
        </div>
        <!--Footer-->
        <footer class="bg-grey-darkest text-white p-2">
            <div class="flex flex-1 mx-auto">&copy; My Design</div>
        </footer>
        <!--/footer-->

    </div>
</div>
</div>


<?php include('assets/body.php') ?>

<script src="./main.js"></script>
</body>

</html>