<?php
include('assets/head.php');
// SESSION
@session_start();
include('config/database.php');
if (empty($_SESSION['username'])) {
    @header('location: login.php');
} else {
    if ($_SESSION['level'] == 'masyarakat') {
        $nik = $_SESSION['nik'];
    }
}
// CRUD
if (isset($_POST['tambahPengaduan'])) {
    $isi_laporan = $_POST['isi_laporan'];
    $tgl = $_POST['tgl_pengaduan'];
    //upload
    $ekstensi_diperbolehkan = array('jpg', 'png');
    $foto = $_FILES['foto']['name'];
    print_r($foto);
    $x = explode(".", $foto);
    $ekstensi = strtolower(end($x));
    $file_tmp = $_FILES['foto']['tmp_name'];
    if (!empty($foto)) {
        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '$foto', '0')";
            $r = mysqli_query($con, $q);
            if ($r) {
                move_uploaded_file($file_tmp, 'dist/images/' . $foto);
            }
        }
    } else {
        $q = "INSERT INTO `pengaduan`(id_pengaduan, tgl_pengaduan, nik, isi_laporan, foto, `status`) VALUES ('', '$tgl', '$nik', '$isi_laporan', '', '0')";
        $r = mysqli_query($con, $q);
    }
}

// hapus pengaduan
if (isset($_POST['hapus'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    if ($id_pengaduan != '') {
        $q = "SELECT `foto` FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
        $r = mysqli_query($con, $q);
        $d = mysqli_fetch_object($r);
        unlink('dist/images/' . $d->foto);
    }
    $q = "DELETE FROM `pengaduan` WHERE id_pengaduan = $id_pengaduan";
    $r = mysqli_query($con, $q);
}

// rubah status pengaduan
if (isset($_POST['proses_pengaduan'])) {
    $id_pengaduan = $_POST['id_pengaduan'];
    $status = $_POST['status'];
    $q = "UPDATE `pengaduan` SET status = '$status' WHERE id_pengaduan = '$id_pengaduan'";
    $r = mysqli_query($con, $q);
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
    <title>Pengaduan</title>
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
                    <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas') { ?>
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
                            <a href="http://<?= $_SERVER['SERVER_NAME']?>/ujikom2023/logout.php" class="nav-link">
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
            <!-- Centered With a Form Modal -->
                    <!--Main-->
                <!-- <div class="flex flex-1 md:flex-row lg:flex-row mx-2"> -->
                        <div class="bg-gray-200 px-2 py-3 border-solid border-gray-200 border-b">
                            Pengaduan Masyarakat
                        </div>
                        <?php 
                    if($_SESSION['level'] == 'masyarakat'){
                        ?> 
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#tambahmodal">
                            <i class="fas fa-plus"></i> Buat Pengaduan
                        </button>
                            <!-- Modal -->
                            <div class="modal fade" id="tambahmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">.: Buat Pengaduan :.</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="mb-3">
                                            <label for="tgl" class="form-label">Tanggal Pengaduan</label>
                                            <input type="date" class="form-control" id="tgl" name="tgl_pengaduan" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="nik" class="form-label">NIK (terisi otomatis)</label>
                                            <input type="text" readonly class="form-control-plaintext" id="nik" name="nik" value="<?= $_SESSION['nik'] ?>">
                                        </div>
                                        <div class="mb-3">
                                            <label for="pengaduan" class="form-label">Hal yang ingin Dilaporkan</label>
                                            <textarea class="form-control" id="pengaduan" name="isi_laporan" rows="3"></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label for="foto" class="form-label">Foto</label>
                                            <input type="file" class="form-control" name="foto">
                                        </div>
                                        <div class="row justify-content-center">
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-primary" name="tambahPengaduan" id="buat">Buat Laporan</button>
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
                    </div>
                    <!--/Main-->
                                <div class="card-body">
                                    <table id="dataTablesNya" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Tanggal</th>
                                                <th>Nik</th>
                                                <th>Isi Laporan</th>
                                                <th>Foto</th>
                                                <th>Status</th>
                                                <th>hapus</th>
                                                <th>proses Pengaduan</th>
                                            </tr>
                                        </thead>
                                        <?php  ?>
                                        <tbody>
                                            <?php
                                            if ($_SESSION['level'] == 'masyarakat') {
                                                $q = "SELECT * FROM `pengaduan` WHERE `nik` = $nik";
                                            } else {
                                                $q = "SELECT * FROM `pengaduan`";
                                            }
                                            $r = mysqli_query($con, $q);
                                            $no = 1;
                                            while ($d = mysqli_fetch_object($r)) {
                                            ?>
                                                <tr>
                                                    <td><?= $no ?></td>
                                                    <td><?= $d->tgl_pengaduan ?></td>
                                                    <td><?= $d->nik ?></td>
                                                    <td><?= $d->isi_laporan ?></td>
                                                    <td><?php if ($d->foto == '') {
                                                            echo '<img style="max-height:100px" class="img img-thumbnail" src="dist/images/">';
                                                        } else {
                                                            echo '<img style="max-height:100px" class="img img-thumbnail" src="dist/images/' . $d->foto . '">';
                                                        } ?></td>
                                                    <td><?= $d->status ?></td>
                                                    <td>
                                                        <?php if ($_SESSION['level'] == 'masyarakat') { ?>
                                                            <form action="" method="post"><input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>"><button type="submit" name="hapus" class="btn btn-danger"><i class="fa fa-trash"></i></button></form>
                                                        <?php } ?>
                                                    </td>
                                                    <td><?php if ($_SESSION['level'] == 'petugas') { ?>
                                                            <form action="" method="post">
                                                                <input type="hidden" name="id_pengaduan" value="<?= $d->id_pengaduan ?>">
                                                                <select class="form-control" name="status">
                                                                    <option value="0"> 0 </option>
                                                                    <option value="proses"> proses </option>
                                                                    <option value="selesai"> selesai </option>
                                                                </select><br>
                                                                <button type="submit" name="proses_pengaduan" class="btn btn-success form-control">ubah</button>
                                                            </form>
                                                        <?php } ?>
                                                    </td>
                                                </tr>
                                            <?php $no++;
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
                <!-- /.content -->
            </div>
            <!-- /.content-wrapper -->
            </div>
        </div>
        <!--Footer-->
        <footer class="bg-grey-darkest text-white p-2">
            <div class="flex flex-1 mx-auto">&copy; My Design</div>
        </footer>
        <!--/footer-->

    </div>

</div>

<?php include('assets/body.php') ?>
 
</body>

</html>