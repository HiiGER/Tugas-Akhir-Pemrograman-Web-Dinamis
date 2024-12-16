<?php
    require 'Fungction.php'; // Ensure the filename is correctly spelled
    require 'cek.php'; // Ensure the filename is correctly spelled

    $name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>LIST OBAT</title>
    <!-- Custom fonts for this template -->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    <!-- Custom styles for this page -->
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <!-- PHARMASYCN -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-text mx-3">PHARMASYCN</div>
            </a>
            <!-- Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider">
            <!-- Nav Item - Charts -->
            <li class="nav-item">
                <a class="nav-link" href="charts.php">
                    <i class="fas fa-fw fa-chart-area"></i>
                    <span>CASHIER</span></a>
            </li>
            <!-- Nav daftarobat -->
            <li class="nav-item">
                <a class="nav-link" href="MedicineList.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>MEDICINE LIST</span></a>
            </li>
            <!-- Nav retock obat -->
            <li class="nav-item">
                <a class="nav-link" href="MedicineRestock.php">
                    <i class="fas fa-fw fa-table"></i>
                    <span>MEDICINE RESTOCK</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">
            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($name); ?></span>
                                <img class="img-profile rounded-circle"
                                    src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="profile.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">MEDICINE LIST</h1>
                    <!-- Data obat -->
                    <div class="card shadow mb-4">
                        <div class="card-header">
                            <!-- Button to Open the Modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">
                                Tambah Obat
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Nama</th>
                                            <th>Jenis obat</th>
                                            <th>Bentuk</th>
                                            <th>Kode Obat</th>
                                            <th>Harga Beli</th>
                                            <th>Harga Jual</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $ambildataobat = mysqli_query($conn, "SELECT * FROM obat");
                                            while ($fetcharray = mysqli_fetch_array($ambildataobat)){
                                                $id = $fetcharray['id_obat'];
                                                $Nama = $fetcharray['nama_obat'];
                                                $Jenis = $fetcharray['jenis_obat'];
                                                $dosis = $fetcharray['dosis'];
                                                $bentuk = $fetcharray['bentuk'];
                                                $stock = $fetcharray['stock'];
                                                $kodeobat = $fetcharray['kodeobat'];
                                                $harga_beli = $fetcharray['harga_beli'];
                                                $harga_jual = $fetcharray['harga_jual'];
                                        ?>
                                        <tr>
                                            <td><?=$Nama;?></td>
                                            <td><?=$Jenis;?></td>
                                            <td><?=$bentuk;?></td>
                                            <td><?=$kodeobat;?></td>
                                            <td>Rp.<?=$harga_beli;?></td>
                                            <td>Rp.<?=$harga_jual;?></td>
                                            <td>
                                                <!-- Button trigger modal -->
                                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#updateModal<?=$kodeobat;?>">
                                                    Update
                                                </button>
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?=$kodeobat;?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Update Modal -->
                                        <div class="modal fade" id="updateModal<?=$kodeobat;?>" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel<?=$kodeobat;?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="updateModalLabel<?=$kodeobat;?>">Update Data Obat</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Update form content -->
                                                        <form action="Fungction.php" method="post" id="updateMedicineForm">
                                                            <div class="modal-body">
                                                                <input type="hidden" name="id_obat" value="<?=$id;?>">
                                                                <div class="form-group">
                                                                    <label for="nama_obat">Nama Obat:</label>
                                                                    <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="<?=$Nama;?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="jenis_obat">Jenis Obat:</label>
                                                                    <select class="form-control" id="jenis_obat" name="jenis_obat" required>
                                                                    <option value="antasida">Antasida</option>
                                                                        <option value="antibiotik">Antibiotik</option>
                                                                        <option value="analgesik">Analgesik</option>
                                                                        <option value="antipiretik">Antipiretik</option>
                                                                        <option value="antihistamin">Antihistamin</option>
                                                                        <option value="antiseptik">Antiseptik</option>
                                                                        <option value="bronkodilator">Bronkodilator</option>
                                                                        <option value="dekongestan">Dekongestan</option>
                                                                        <option value="diuretik">Diuretik</option>
                                                                        <option value="ekpektoran">Ekspektoran</option>
                                                                        <option value="imunosupresan">Imunosupresan</option>
                                                                        <option value="insulin">Insulin</option>
                                                                        <option value="laksatif">Laksatif</option>
                                                                        <option value="neuroleptik">Neuroleptik</option>
                                                                        <option value="obat_penenang">Obat Penenang</option>
                                                                        <option value="obat_tidur">Obat Tidur</option>
                                                                        <option value="kortikosteroid">Kortikosteroid</option>
                                                                        <option value="antikoagulan">Antikoagulan</option>
                                                                        <option value="statin">Statin</option>
                                                                        <option value="antiviral">Antiviral</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="dosis">Dosis:</label>
                                                                    <input type="text" class="form-control" id="dosis" name="dosis" value="<?=$dosis;?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="bentuk">Bentuk:</label>
                                                                    <select class="form-control" id="bentuk" name="bentuk" required>
                                                                        <option value="sirup">Sirup</option>
                                                                        <option value="kapsul">Kapsul</option>
                                                                        <option value="tablet">Tablet</option>
                                                                        <option value="salep">Salep</option>
                                                                        <option value="krim">Krim</option>
                                                                        <option value="gel">Gel</option>
                                                                        <option value="injeksi">Injeksi</option>
                                                                        <option value="suplemen">Suplemen</option>
                                                                        <option value="supositoria">Supositoria</option>
                                                                        <option value="patch">Patch</option>
                                                                        <option value="spray">Spray</option>
                                                                        <option value="suspensi">Suspensi</option>
                                                                        <option value="drop">Drop</option>
                                                                        <option value="serbuk">Serbuk</option>
                                                                        <option value="emulsi">Emulsi</option>
                                                                        <option value="inhaler">Inhaler</option>
                                                                        <option value="bubuk">Bubuk</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="kodeobat">Kode Obat:</label>
                                                                    <input type="text" class="form-control" id="kodeobat" name="kodeobat" value="<?=$kodeobat;?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="harga_beli">Harga Beli:</label>
                                                                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" value="<?=$harga_beli;?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="harga_jual">Harga Jual:</label>
                                                                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" value="<?=$harga_jual;?>" required>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label for="stock">Stock:</label>
                                                                    <input type="text" class="form-control" id="stock" name="stock" value="<?=$stock;?>" required>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-primary" name="update_medicine">Save changes</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Delete Modal -->
                                        <div class="modal fade" id="deleteModal<?=$kodeobat;?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel<?=$kodeobat;?>" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="deleteModalLabel<?=$kodeobat;?>">Delete Data Obat</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this data?
                                                        <form action="Fungction.php" method="post" id="deleteMedicineForm">
                                                            <input type="hidden" name="id_obat" value="<?=$id;?>">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-danger" name="delete_medicine">Delete</button>
                                                    </div>
                                                        </form>
                                                </div>
                                            </div>
                                        </div>

                                        <?php
                                            };
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- end data obat -->
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- End of Main Content -->
        </div>
        <!-- End of Content Wrapper -->
    </div>
    <!-- End of Page Wrapper -->
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- The Modal add emMedicine -->
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
            
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Obat Baru</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                
                <!-- Modal body -->
                <form method="post" id="addMedicineForm">
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="nama_obat">Nama Obat:</label>
                            <input type="text" class="form-control" id="nama_obat" name="nama_obat" required>
                        </div>

                        <div class="form-group">
                            <label for="jenis_obat">Jenis Obat:</label>
                            <select class="form-control" id="jenis_obat" name="jenis_obat" required>
                                <option value="antasida">Antasida</option>
                                <option value="antibiotik">Antibiotik</option>
                                <option value="analgesik">Analgesik</option>
                                <option value="antipiretik">Antipiretik</option>
                                <option value="antihistamin">Antihistamin</option>
                                <option value="antiseptik">Antiseptik</option>
                                <option value="bronkodilator">Bronkodilator</option>
                                <option value="dekongestan">Dekongestan</option>
                                <option value="diuretik">Diuretik</option>
                                <option value="ekpektoran">Ekspektoran</option>
                                <option value="imunosupresan">Imunosupresan</option>
                                <option value="insulin">Insulin</option>
                                <option value="laksatif">Laksatif</option>
                                <option value="neuroleptik">Neuroleptik</option>
                                <option value="obat_penenang">Obat Penenang</option>
                                <option value="obat_tidur">Obat Tidur</option>
                                <option value="kortikosteroid">Kortikosteroid</option>
                                <option value="antikoagulan">Antikoagulan</option>
                                <option value="statin">Statin</option>
                                <option value="antiviral">Antiviral</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="dosis">Dosis:</label>
                            <input type="text" class="form-control" id="dosis" name="dosis" required>
                        </div>

                        <div class="form-group">
                            <label for="bentuk">Bentuk:</label>
                            <select class="form-control" id="bentuk" name="bentuk" required>
                                <option value="sirup">Sirup</option>
                                <option value="kapsul">Kapsul</option>
                                <option value="tablet">Tablet</option>
                                <option value="salep">Salep</option>
                                <option value="krim">Krim</option>
                                <option value="gel">Gel</option>
                                <option value="injeksi">Injeksi</option>
                                <option value="suplemen">Suplemen</option>
                                <option value="supositoria">Supositoria</option>
                                <option value="patch">Patch</option>
                                <option value="spray">Spray</option>
                                <option value="suspensi">Suspensi</option>
                                <option value="drop">Drop</option>
                                <option value="serbuk">Serbuk</option>
                                <option value="emulsi">Emulsi</option>
                                <option value="inhaler">Inhaler</option>
                                <option value="bubuk">Bubuk</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="stock">Stock:</label>
                            <input type="number" class="form-control" id="stock" name="stock" required>
                        </div>

                        <div class="form-group">
                            <label for="kodeobat">Kode Obat:</label>
                            <input type="text" class="form-control" id="kodeobat" name="kodeobat" required>
                        </div>

                        <div class="form-group">
                            <label for="harga_beli">Harga Beli:</label>
                            <input type="text" class="form-control" id="harga_beli" name="harga_beli" required pattern="\d+" title="Masukkan angka saja">
                        </div>

                        <div class="form-group">
                            <label for="harga_jual">Harga Jual:</label>
                            <input type="text" class="form-control" id="harga_jual" name="harga_jual" required pattern="\d+" title="Masukkan angka saja">
                        </div>

                        <button type="submit" class="btn btn-primary" name="addMedic">Tambah</button>
                    
                    </div>
                </form>
                
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
    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>
</body>
</html>
