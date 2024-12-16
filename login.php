<?php
require 'Fungction.php';

// verifikasi
if (isset($_POST['Login'])) {
    $username = $_POST["username"];
    $password = $_POST["password"]; 

    // cek pada database
    $cekdatabase = mysqli_query($conn, "SELECT * FROM person WHERE Username='$username' AND password='$password'");
    $hitung = mysqli_num_rows($cekdatabase);

    if ($hitung > 0) {
        $data = mysqli_fetch_assoc($cekdatabase);
        $_SESSION["log"] = "true";
        $_SESSION["username"] = $data["Username"];
        $_SESSION["name"] = $data["Nama"];
        $_SESSION["jabatan"]=$data["Jabatan"];
        $_SESSION["pass"]=$data["password"];

        if($_SESSION['jabatan']=='owner'){
            header("location:owner.php");
            exit();
        }else{    
            header("location:index.php");
            exit();
        }
    } else {
        header("location:login.php");
        exit();
    }
}

if (isset($_SESSION['log'])) {
    if(isset($_SESSION['jabatan'])){
        header('location: owner.php');
    }else{
        header("location:index.php");
    }
    exit();
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

    <title>SB Admin 2 - Login</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login-image">
                            <img src="img/LOGIN.jpeg"class="img-fluid">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Welcome back!</h1>
                                    </div>

                                    <form class="center" method="post">
                                        <div class="form-group">
                                            <input type="username" class="form-control form-control-user"
                                                name="username" id="username" aria-describedby="emailHelp"
                                                placeholder="Enter Username..." require>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user"
                                                name="password" id="exampleInputPassword" placeholder="Password" require>
                                        </div>
                                        <div class="form-group">
                                        </div>
                                        <button class="btn btn-primary btn-user btn-block" name="Login">Login</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

</body>

</html>