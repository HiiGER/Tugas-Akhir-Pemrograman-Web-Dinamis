<?php
require 'Fungction.php';
require 'cek.php';

$no_struck;

if (isset($_SESSION['no_struck'])) {
    $no_struck = $_SESSION['no_struck'];
    // Gunakan $no_struck untuk keperluan lain, misalnya menampilkan atau query database
} else {
    // Jika session tidak ada, mungkin tampilkan pesan error atau redirect
    $no_struck = "";
}

$total = 0;
// Hitung total dari tabel detail_transaksi berdasarkan no_struck
if (!empty($no_struck)) {
    $query = "SELECT SUM(total_harga) AS total FROM detail_transaksi WHERE no_struck = '$no_struck'";
    $result = $conn->query($query);
    if ($result && $row = $result->fetch_assoc()) {
        $total = $row['total'] ?? 0;
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

    <title>KASIR</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">
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

        <div id="content-wrapper" class="d-flex flex-column">
            <div id="content">
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <ul class="navbar-nav ml-auto">
                        <div class="topbar-divider d-none d-sm-block"></div>
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo htmlspecialchars($name); ?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
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

                <!-- Main Content Kasir -->
                <div class="container-fluid">
                    <!-- get no struck / generate button -->
                    <form method="POST">
                        <button type="submit" name="generate" class="btn btn-primary btn-lg">
                            Buat struk
                        </button>
                    </form>

                    <div class="row mt-4">

                        <!-- input Order obat form -->
                        <div class="col-md-8">
                            <form method="POST" action="fungction.php">
                                <div class="form-group">
                                    <label for="no_struck">No Struk :</label>
                                        <input type="text" class="form-control" id="no_struck" name="no_struck" value="<?php echo isset($no_struck) ? htmlspecialchars($no_struck, ENT_QUOTES, 'UTF-8') : ''; ?>" readonly>
                                </div>

                                
                                <div class="form-group">
                                    <label for="id_obat">Pilih Obat:</label>
                                    <select class="form-control" id="id_obat" name="id_obat" onchange="updateHargaJual(this.value)" required>
                                        <option value="">-- Pilih Obat --</option>
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
                                            
                                                echo "<option value='{$fetcharray['id_obat']}' data-harga='{$fetcharray['harga_jual']}'>
                                                    {$fetcharray['nama_obat']} - Rp{$fetcharray['harga_jual']}
                                                </option>";
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="harga_jual">Harga Jual:</label>
                                    <input type="number" class="form-control" id="harga_jual" name="harga_jual" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="jumlah">Jumlah:</label>
                                    <input type="number" class="form-control" id="jumlah" name="jumlah" onchange="updateTotalHarga()" required>
                                </div>
                                <div class="form-group">
                                    <label for="total_harga">Total Harga:</label>
                                    <input type="number" class="form-control" id="total_harga" name="total_harga" readonly>
                                </div>
                                <button type="submit" name="addtocart" class="btn btn-primary">Tambah ke Keranjang</button>
                            </form>
                        </div>
                        <!-- end input order form -->

                        <!-- Keranjang dan sub Total -->
                        <div class="col-md-4">
                            <!-- table keranjang -->
                            <h4>Detail Transaksi</h4>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID Obat</th>
                                        <th>Nama</th>
                                        <th>Jumlah</th>
                                        <th>Total Harga</th>
                                    </tr>
                                </thead>
                                <tbody id="detail-transaksi">
                                <?php
                                        // Ambil data dari tabel detail_transaksi
                                        $query = "SELECT id_obat, jumlah, total_harga FROM detail_transaksi WHERE no_struck = '$no_struck'";
                                        $result = $conn->query($query);

                                        while ($row = $result->fetch_assoc()) {
                                            $id_obat = $row['id_obat'];
                                            $total_harga = $row['total_harga'];
                                            $jumlah = $row['jumlah'];

                                            // Query untuk mendapatkan nama obat berdasarkan id_obat
                                            $query_obat = "SELECT nama_obat FROM obat WHERE id_obat = '$id_obat'";
                                            $result_obat = $conn->query($query_obat);
                                            $nama_obat = '';

                                            if ($result_obat->num_rows > 0) {
                                                $obat = $result_obat->fetch_assoc();
                                                $nama_obat = $obat['nama_obat'];
                                            }

                                            // Tampilkan data
                                            echo "<tr>
                                                    <td>{$id_obat}</td>
                                                    <td>{$nama_obat}</td>
                                                    <td>{$jumlah}</td>
                                                    <td>{$total_harga}</td>
                                                </tr>";
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <!-- Sub total -->
                            <h5>Total : 
                                <?php
                                    echo "Rp" . $total;                                    
                                ?>
                            </h5>
                            <!-- end table keranjang -->
                            
                            <!-- Action buton Checkout & cancle -->
                            <form method="POST" action="fungction.php">
                                <input type="hidden" name="no_struck" value="<?php echo $no_struck; ?>">
                                <input type="hidden" name="nama" value="<?php echo htmlspecialchars($name); ?>">
                                <input type="hidden" name="total" value="<?php echo $total; ?>">
                                
                                <button type="submit" name="Checkout" class="btn btn-success btn-lg">Check Out</button>
                                <button type="submit" name="Cancel" class="btn btn-danger btn-lg">Batalkan</button>
                            </form>
                            <!-- end action button -->
                            
                        </div>
                        <!-- end keranjang & Sub total -->

                    </div>

                </div>
            </div>

            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; PHARMASYCN 2024</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NOTIFIKASI</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Yakin ingin keluar ? tekan Logout. Pastikan pekerjaan anda selesai sebelum meninggalkan toko</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="logout.php">Logout</a>
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

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

    <script>
        function updateHargaJual(id) {
            const select = document.getElementById('id_obat');
            const harga = select.options[select.selectedIndex].getAttribute('data-harga');
            document.getElementById('harga_jual').value = harga || 0;
            updateTotalHarga();
        }

        function updateTotalHarga() {
            const harga = parseFloat(document.getElementById('harga_jual').value) || 0;
            const jumlah = parseInt(document.getElementById('jumlah').value) || 0;
            document.getElementById('total_harga').value = harga * jumlah;
        }
    </script>
    
</body>

</html>
