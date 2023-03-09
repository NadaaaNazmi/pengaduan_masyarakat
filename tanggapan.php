<?php
// SESSION
session_start();
include('assets/head.php');
include('config/database.php');
if (empty($_SESSION['username'])) {
    @header('location: login.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    } else {
        $id_petugas = $_SESSION['id_petugas'];
    }
}
// tambah tanggapan
if (isset($_POST['tambah_tanggapan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $id_petugas = $_POST['id_petugas'];
    $tanggapan = $_POST['tanggapan'];
    $q = "INSERT INTO `tanggapan` (id_tanggapan, id_pengaduan, tgl_tanggapan, tanggapan, id_petugas) VALUES ('','$id_pengaduan', '$tgl_tanggapan', '$tanggapan', '$id_petugas')";
    $r = mysqli_query($con, $q);
}
// hapus tanggapan
if (isset($_POST['hapusTanggapan'])) {
    $id_tanggapan = $_POST['id_tanggapan'];
    mysqli_query($con, "DELETE FROM `tanggapan` WHERE id_tanggapan = '$id_tanggapan'");
}
// update tanggapan
if (isset($_POST['ubahTanggapan'])) {
    $id_tanggapan =  $_POST['id_tanggapan'];
    $tgl_tanggapan = $_POST['tgl_tanggapan'];
    $tanggapan = $_POST['tanggapan'];
    mysqli_query($con, "UPDATE `tanggapan` SET tgl_tanggapan = '$tgl_tanggapan', tanggapan = '$tanggapan' WHERE `id_tanggapan` = '$id_tanggapan'");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="./dist/styles.css">
    <link rel="stylesheet" href="./dist/all.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,400i,600,600i,700,700i" rel="stylesheet">
    <title>Tanggapan</title>
</head>

<body>
<!--Container -->
<div class="mx-auto bg-grey-lightest">
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
                    <a href="http://<?= $_SERVER['SERVER_NAME']?>/ujikom2023/pengaduan.php" class="nav-link">
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
                    <?php if ($_SESSION['level'] == 'petugas' || $_SESSION['level'] == 'admin') { ?>
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
            <div class="content-wrapper">
                <!-- Main content -->
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-3" style="padding:0.5%;">
                            <button type="button" data-bs-toggle="modal" data-bs-target="#modal-lg" class="btn btn-primary"><i class="fa fa-pen"></i>&nbsp;tambah tanggapan</button>
                        </div>
                        <!-- modal start -->
                    <div class="modal fade" id="modal-lg">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            Tambah Tanggapan
                                        </div>
                                        <div class="modal-body">
                                            <form action="" method="post">
                                                <label for="id_pengaduan"> Pilih Id Pengaduan</label>
                                                <select name="id_pengaduan" class="form-control">
                                                    <?php
                                                    $q = "SELECT * FROM pengaduan JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik";
                                                    $r = mysqli_query($con, $q);
                                                    while ($d = mysqli_fetch_object($r)) { ?>
                                                        <option value="<?= $d->id_pengaduan ?>"><?= $d->id_pengaduan . '|' . $d->nik . '|' . $d->nama ?></option>
                                                    <?php } ?>
                                                </select>
                                                <br>
                                                <label for="tgl_tanggapan">Tanggal</label>
                                                <input class="form-control" type="date" name="tgl_tanggapan">
                                                <label for="tanggapan">Beri Tanggapan</label>
                                                <textarea class="form-control" name="tanggapan" id="" cols="30" rows="3"></textarea>
                                                <label for="id_petugas">ID Petugas</label>
                                                <input name="id_petugas" type="text" class="form-control" value="<?= $id_petugas ?>" readonly>
                                                <br>
                                                <button name="tambah_tanggapan" type="submit" class="btn btn-info">simpan</button>
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- modal ends -->
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Tabel Tanggapan <br>
                        </div>
                        <div class="card-body">
                            <table id="dataTablesNya" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Pengaduan</th>
                                        <th>tanggal Tanggapan</th>
                                        <th>Isi Tanggapan</th>
                                        <th>Petugas</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $q = "SELECT * FROM `tanggapan` JOIN `petugas` JOIN `pengaduan`
                                 WHERE tanggapan.id_petugas = petugas.id_petugas 
                                 AND tanggapan.id_pengaduan = pengaduan.id_pengaduan";
                                    $r = mysqli_query($con, $q);
                                    while ($d = mysqli_fetch_object($r)) { ?>
                                        <tr>
                                            <td>
                                                <?= $no ?>
                                            </td>
                                            <td>
                                                <?= $d->id_pengaduan ?>
                                            </td>
                                            <td>
                                                <?= $d->tgl_tanggapan ?>
                                            </td>
                                            <td>
                                                <?= $d->tanggapan ?>
                                            </td>
                                            <td>
                                                <?= $d->nama_petugas ?>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="modal-lg<?= $d->id_pengaduan ?>">
                                            <div class="modal-dialog modal-lg<?= $d->id_pengaduan ?>">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        Edit Pengaduan
                                                    </div>
                                                    <form action="" method="post">
                                                        <div class="modal-body">
                                                            <input class="form-control" name="id_tanggapan" type="hidden" value="<?= $d->id_tanggapan ?>">
                                                            <label for="id_pengaduan">ID Pengaduan</label><br>
                                                            <select class="form-control" name="id_pengaduan">
                                                                <?php
                                                                $result = mysqli_query($con, "SELECT * FROM `pengaduan` JOIN `masyarakat` WHERE pengaduan.nik = masyarakat.nik");
                                                                while ($data = mysqli_fetch_object($result)) { ?>
                                                                    <option value="<?= $data->id_pengaduan ?>" <?php if ($d->id_pengaduan == $data->id_pengaduan) {
                                                                                                                    echo 'selected';
                                                                                                                } ?>><?= $data->id_pengaduan . '|' . $data->nik . '|' . $data->nama ?></option>
                                                                <?php } ?>
                                                            </select><br>
                                                            <label for="tgl_tanggapan">Tanggal Tanggapan</label>
                                                            <input class="form-control" name="tgl_tanggapan" class="form-control" type="date" name="" value="<?= $d->tgl_tanggapan ?>">
                                                            <label for="tanggapan">Tanggapan</label>
                                                            <textarea class="form-control" name="tanggapan" id="" cols="30" rows="10"><?= $d->tanggapan ?></textarea>
                                                            <br>
                                                            <button name="ubahTanggapan" type="submit" class="btn btn-info">Update</button>
                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
    
                                            </div>
                                        </div>
                                    <?php $no++;
                                    } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        <!--Footer-->
        <footer class="bg-grey-darkest text-white p-2">
            <div class="flex flex-1 mx-auto">&copy; My Design</div>
        </footer>
        <!--/footer-->

    </div>

</div>

<script src="./main.js"></script>
<?php include('assets/body.php') ?>
</body>

</html>