<?php
    session_start();
    require 'fpdf/fpdf.php'; // Include library FPDF
    //tes koneksi untuk login
    $conn = mysqli_connect("localhost", "root", "", "pharmasync");


    //ambil informasi user
    $name = isset($_SESSION['name']) ? $_SESSION['name'] : 'Guest';
    $jabatan = isset($_SESSION['jabatan']) ? $_SESSION['jabatan'] : 'staff';
    $username  = isset($_SESSION['username']) ? $_SESSION['username'] : 'username';
    $pass = isset($_SESSION['pass']) ? $_SESSION['pass'] : 'pass';
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
//////////////////////////////////////////////////////////////////////////////////////
//MASUKAN DATA PENGGUNA BARu
    if(isset($_POST['addEmploye'])){
        $Uname = $_POST['username'];
        $PW = $_POST['password'];
        $nama = $_POST['nama'];
        $jbtan = $_POST['jabatan'];
    
        $addtotable = mysqli_query($conn, "INSERT INTO person (Username, password, Nama, Jabatan) VALUES ('$Uname', '$PW', '$nama', '$jbtan')");
        if($addtotable){
            header("location: manageEmploye.php");
        }else{
            echo 'gagal: ' . mysqli_error($conn);  // Tambahkan pesan error untuk debugging
        }
    }
//Hapus data pegawai///////////////////////////////////////////////////////////////////////////////////
    if (isset($_POST['deleteEmploye'])) {
        $id = $_POST['id_person'];

        // Query untuk menghapus data obat
        $query = "DELETE FROM person WHERE id_aktor = '$id'";

        if (mysqli_query($conn, $query)) {
            echo "Data berhasil dihapus";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        header("Location: manageEmploye.php"); // Redirect kembali ke halaman daftar obat
        exit();
    }

//input OBAT BARU///////////////////////////////////////////////////////////////////////
//UPDATE DATA EMPLOYE///////////////////////////////////////////////////////////////////
    if (isset($_POST['updateEmploye'])) {
        $id = $_POST['id_person'];
        $nama = $_POST['nama'];
        $username = $_POST['Username'];
        $pasw = $_POST['pw'];
        $jabatan = $_POST['jabatan'];

        // Query untuk update data obat
        $query = "UPDATE person SET 
                    Username = '$username',
                    password = '$pasw',
                    Nama = '$nama',
                    jabatan = '$jabatan'

                WHERE id_aktor = '$id'";

        if (mysqli_query($conn, $query)) {
            echo "Data obat berhasil diperbarui";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        header("Location: manageEmploye.php"); // Redirect kembali ke halaman daftar obat
        exit();
    }
///////////////////////////////////////////////////////////////////////////////////////

    if(isset($_POST['addMedic'])){
        $nama_obat =$_POST['nama_obat'];
        $jenis_obat =$_POST['jenis_obat'];
        $dosis =$_POST['dosis'];
        $bentuk =$_POST['bentuk'];
        $stock =$_POST['stock'];
        $kodeobat =$_POST['kodeobat'];
        $harga_beli =$_POST['harga_beli'];
        $harga_jual  =$_POST['harga_jual'];
        $editor = $_SESSION['name'];

        $addtomedic = mysqli_query($conn, "INSERT INTO obat (nama_obat, jenis_obat, dosis, bentuk, stock, kodeobat, harga_beli, harga_jual, editor) VALUES ('$nama_obat', '$jenis_obat', '$dosis', '$bentuk', '$stock', '$kodeobat', '$harga_beli', '$harga_jual', '$editor')");
        
        if($addtomedic){
            header("location: MedicineList.php");
        }else{
            echo 'gagal: ' . mysqli_error($conn);  // Tambahkan pesan error untuk debugging
        }

    }
//////////////////////////////////////////////////////////////////////////////////////////

//UPDATE OBAT////////////////////////////////////////////////////////////////////////////
    if (isset($_POST['update_medicine'])) {
        $id = $_POST['id_obat'];
        $kodeobat = $_POST['kodeobat'];
        $nama_obat = $_POST['nama_obat'];
        $jenis = $_POST['jenis_obat'];
        $doses = $_POST['dosis'];
        $bentuk = $_POST['bentuk'];
        $qty =  $_POST['stock'];
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
        $editor = $_SESSION['name'];

        // Query untuk update data obat
        $query = "UPDATE obat SET 
                    nama_obat = '$nama_obat',
                    jenis_obat = '$jenis',
                    dosis = '$doses',
                    bentuk = '$bentuk',
                    stock = '$qty',
                    kodeobat = '$kodeobat',
                    harga_beli = '$harga_beli',
                    harga_jual = '$harga_jual',
                    editor = '$editor'
                WHERE id_obat = '$id'";

        if (mysqli_query($conn, $query)) {
            echo "Data obat berhasil diperbarui";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        header("Location: MedicineList.php"); // Redirect kembali ke halaman daftar obat
        exit();
    }

//////////////////////////////////////////////////////////////////////////////////////////////

//HAPUS DATA OBAT////////////////////////////////////////////////////////////////////////////
    if (isset($_POST['delete_medicine'])) {
        $id = $_POST['id_obat'];

        // Query untuk menghapus data obat
        $query = "DELETE FROM obat WHERE id_obat = '$id'";

        if (mysqli_query($conn, $query)) {
            echo "Data obat berhasil dihapus";
        } else {
            echo "Error: " . $query . "<br>" . mysqli_error($conn);
        }

        mysqli_close($conn);
        header("Location: MedicineList.php"); // Redirect kembali ke halaman daftar obat
        exit();
    }
/////////////////////////////////////////////////////////////////////////////////////////////

// Proses Generate No_struck
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['generate'])) {

        function generate_no_struck($conn) {
            do {
                $no_struck = str_pad(rand(0, 9999999999), 10, '0', STR_PAD_LEFT);
                $query = "SELECT COUNT(*) as count FROM transaksi WHERE no_struck = '$no_struck'";
                $result = $conn->query($query);
                $row = $result->fetch_assoc();
            } while ($row['count'] > 0);

            // Simpan no_struck ke dalam session
            $_SESSION['no_struck'] = $no_struck;
            header("Location: charts.php");
            exit;
        }

        // Panggil fungsi
        generate_no_struck($conn);
    }

//////////////////////////////////////////
//tambah ke keranjang 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addtocart'])) {
        $no_struck = $_POST['no_struck'];
        $id_obat = $_POST['id_obat'];
        $jumlah = $_POST['jumlah'];
        $total_harga = $_POST['total_harga'];

        // Periksa apakah no_struck sudah ada di tabel transaksi
        $checkTransaksi = "SELECT * FROM transaksi WHERE no_struck = '$no_struck'";
        $result = $conn->query($checkTransaksi);

        if ($result->num_rows === 0) {
            $tanggal = date('Y-m-d H:i:s');
            $total = 0; // Inisialisasi total awal
            $id_aktor = 1; // Sesuaikan ID kasir
        
            $insertTransaksi = "INSERT INTO transaksi (no_struck, tanggal, total, pembeli, id_aktor) 
                                VALUES ('$no_struck', '$tanggal', '$total', 'Anonim', '$id_aktor')";
            // unset($_SESSION['no_struck']);
            if (!$conn->query($insertTransaksi)) {
                die("Error saat menambahkan transaksi: " . $conn->error);
            }
        }
    

        // Tambahkan ke detail_transaksi
        $query = "INSERT INTO detail_transaksi (no_struck, id_obat, jumlah, total_harga) VALUES ('$no_struck', '$id_obat', '$jumlah', '$total_harga')";

        if ($conn->query($query)) {
            // Update total di tabel transaksi
            $updateTotal = "UPDATE transaksi SET total = (SELECT SUM(total_harga) FROM detail_transaksi WHERE no_struck = '$no_struck') WHERE no_struck = '$no_struck'";
            $conn->query($updateTotal);

            // Redirect ke halaman kasir
            header("Location: charts.php");
        } else {
            die("Error saat menambahkan detail transaksi: " . $conn->error);
        }
    }
//////////////////////////////////////////

// Check out & cancle 
    //checkout pdf finish activitas
    function checkout_items($conn, $no_struck, $nama, $total) {
        unset($_SESSION['no_struck']);
        ob_start();
    
        // Ambil data transaksi berdasarkan no_struck
        $queryTransaksi = "SELECT * FROM transaksi WHERE no_struck = '$no_struck'";
        $resultTransaksi = $conn->query($queryTransaksi);
        $transaksi = $resultTransaksi->fetch_assoc();
    
        if (!$transaksi) {
            die("Data transaksi tidak ditemukan!");
        }
    
        $pdf = new FPDF('L', 'mm', 'A4');
        $pdf->AddPage();
    
        // Header Apotek
        $pdf->SetFont('Arial', 'B', 18);
        $pdf->Cell(0, 10, 'APOTEK PHARMASYCN', 0, 1, 'C');
        $pdf->SetFont('Arial', 'I', 11);
        $pdf->Cell(0, 7, 'Jl. Masjid Labbaik, Sonopakis Kidul, Ngestiharjo,', 0, 1, 'C');
        $pdf->Cell(0, 7, 'Kec. Kasihan, Kabupaten Bantul, Daerah Istimewa Yogyakarta 55184', 0, 1, 'C');
        $pdf->Ln(5);
    
        // Info Nota

        // Lebar kolom pertama (judul)
        $kolom_judul = 40; 
        // Lebar kolom kedua (isi)
        $kolom_isi = 100;

        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell($kolom_judul, 8, 'Nomor Nota', 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell($kolom_isi, 8, $transaksi['no_struck'], 0, 1);
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell($kolom_judul, 8, 'Tanggal', 0, 0);
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell($kolom_isi, 8, $transaksi['tanggal'], 0, 1);
        $pdf->Ln(5);
    
        // Tabel Detail Transaksi
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->SetFillColor(200, 220, 255);
        $pdf->Cell(120, 10, 'Nama Obat', 1, 0, 'C', true); // Kolom Nama Obat
        $pdf->Cell(40, 10, 'Dosis', 1, 0, 'C', true);      // Kolom Dosis
        $pdf->Cell(60, 10, 'Harga Satuan', 1, 0, 'C', true); // Kolom Harga Satuan
        $pdf->Cell(40, 10, 'Jumlah', 1, 1, 'C', true);     // Kolom Jumlah
    
        $queryDetail = "
        SELECT d.*, o.nama_obat, o.dosis, o.harga_jual 
        FROM detail_transaksi d
        JOIN obat o ON d.id_obat = o.id_obat
        WHERE d.no_struck = '$no_struck'";
        $resultDetail = $conn->query($queryDetail);
    
        $pdf->SetFont('Arial', '', 12);
        $subTotal = 0;
    
        if ($resultDetail->num_rows > 0) {
            while ($row = $resultDetail->fetch_assoc()) {
                $totalHarga = $row['jumlah'] * $row['harga_jual'];
                $subTotal += $totalHarga;
    
                $pdf->Cell(120, 10, $row['nama_obat'], 1, 0); // Nama Obat
                $pdf->Cell(40, 10, $row['dosis'], 1, 0, 'C'); // Dosis
                $pdf->Cell(60, 10, 'Rp. ' . number_format($row['harga_jual'], 0, ',', '.'), 1, 0, 'R'); // Harga Satuan
                $pdf->Cell(40, 10, $row['jumlah'], 1, 1, 'C'); // Jumlah
            }
        } else {
            die("Tidak ada data detail transaksi!");
        }
    
        // Subtotal
        $pdf->SetFont('Arial', 'B', 12);
        $pdf->Cell(220, 10, 'SUB TOTAL', 1, 0, 'R');
        $pdf->SetFont('Arial', '', 12);
        $pdf->Cell(40, 10, 'Rp. ' . number_format($subTotal, 0, ',', '.'), 1, 1, 'R'); 
    
        $pdf->Ln(10); // Jarak 10 unit (enter)
        // Mengatur font untuk teks
        $pdf->SetFont('Arial', '', 10);

        
        // Baris 1: Teks catatan di kiri, "Hormat Kami" di kanan
        $pdf->Cell(90, 7, 'Note ! Barang yang sudah dibeli tidak boleh dikembalikan,', 0, 0, 'L'); // Kolom kiri
        $pdf->Cell(0, 7, 'Hormat Kami       ', 0, 1, 'R'); // Kolom kanan

        // Baris 2: Lanjutan teks catatan di kiri, "..................................." di kanan
        $pdf->Cell(90, 7, 'pastikan mengonsumsi obat sesuai dengan dosis Dokter.', 0, 0, 'L'); // Kolom kiri
        $pdf->Cell(0, 7, '...................................', 0, 1, 'R'); // Kolom kanan

        // Baris 4: Kolom kosong di kiri, nama perusahaan/apotek di kanan
        $pdf->Cell(90, 7, '', 0, 0, 'L'); // Kolom kiri kosong
        $pdf->Cell(0, 7, '(Apoteker Pharmasycn)', 0, 1, 'R'); // Kolom kanan


    
        $pdf->Output('I', 'Nota_' . $transaksi['no_struck'] . '.pdf');
        ob_end_flush();
        exit;
    }
    


    function cancel_items($conn, $no_struck) {
        // Query untuk menghapus data
        $query_delete_detail = "DELETE FROM detail_transaksi WHERE no_struck = '$no_struck'";
        $query_delete_transaksi = "DELETE FROM transaksi WHERE no_struck = '$no_struck'";

        $conn->begin_transaction(); // Mulai transaksi
        try {
            // Hapus data dari tabel transaksi
            $conn->query($query_delete_transaksi);

            // Hapus data dari tabel detail_transaksi
            $conn->query($query_delete_detail);

            $conn->commit(); // Commit transaksi jika semua berhasil
            unset($_SESSION['no_struck']);
            return "Transaksi berhasil dibatalkan!";
        } catch (Exception $e) {
            $conn->rollback(); // Batalkan transaksi jika terjadi error
            return "Gagal membatalkan transaksi: " . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $no_struck = $_POST['no_struck'];

        if (isset($_POST['Checkout'])) {
            $nama = $_POST['nama'];
            $total = $_POST['total'];

            // Panggil fungsi checkout
            $message = checkout_items($conn, $no_struck, $nama, $total);
            echo "<script>alert('$message');</script>";
        } elseif (isset($_POST['Cancel'])) {
            // Panggil fungsi cancel
            $message = cancel_items($conn, $no_struck);
            echo "<script>alert('$message');</script>";
        }
        header("Location: charts.php");
    }



?>