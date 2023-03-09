<?php
include('assets/head.php');
include('config/database.php');
if (isset($_POST['simpan'])) {
    $nik = $_POST['nik'];
    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $telp = $_POST['telp'];
    $q = mysqli_query($con, "INSERT INTO `masyarakat` (nik, nama, username, password, telp, verifikasi) VALUES ('$nik', '$nama', '$username', '$password', '$telp', 0)");
    if ($q) {
        echo  '<div class="alert alert-success alert-dismissable">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                Registrasi Berhasil Tunggu verifikasi oleh admin
                </div>';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="./dist/styles.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp"
          crossorigin="anonymous">
    <style>
        .login{
            background: url('./dist/images/login-new.jpeg')
        }
    </style>
    <title>Register</title>
</head>
<body class="h-screen font-sans login bg-cover">
<div class="container mx-auto h-full flex flex-1 justify-center items-center">
    <div class="w-full max-w-lg">
        <div class="leading-loose">
            <form class="max-w-xl m-4 p-10 bg-white rounded shadow-xl" method="post">
                <p class="text-gray-800 font-medium">Registrasi Masyarakat</p>
                <div class="">
                    <label class="block text-sm text-gray-00" for="cus_name">Nik</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" type="text" name="nik" required="" placeholder="Nik" aria-label="Nik">
                </div>
                <div class="">
                    <label class="block text-sm text-gray-00" for="cus_name">Nama Lengkap</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="nama" type="text" required="" placeholder="Nama Lengkap" aria-label="Name">
                </div>
                <div class="">
                    <label class="block text-sm text-gray-00" for="username">Username</label>
                    <input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" name="username" type="text" required="" placeholder="User Name" aria-label="username">
                  </div>
                  <div class="mt-2">
                    <label class="block text-sm text-gray-600" for="password">Password</label>
                    <input class="w-full px-5  py-1 text-gray-700 bg-gray-200 rounded" name="password" type="text" required="" placeholder="*******" aria-label="password">
                  </div>
                <div class="mt-2">
                    <label class="block text-sm block text-gray-00">Telp</label>
                    <input class="w-full px-2 py-2 text-gray-700 bg-gray-200 rounded" name="telp" type="number" required="" placeholder="Telp" aria-label="telp">
                </div>

                <div class="mt-4">
                    <button class="px-4 py-1 text-white font-light tracking-wider bg-blue-700 rounded" name="simpan" type="submit">Daftar</button>
                </div>
                <a class="inline-block right-0 align-baseline font-bold text-sm text-500 hover:text-blue-800" href="login.php">
                    Sudah punya akun?
                </a>
            </form>
        </div>
    </div>
</div>
<?php include('assets/body.php') ?>
</body>
</html>