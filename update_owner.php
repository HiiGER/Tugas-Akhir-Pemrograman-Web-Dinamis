<?php
    require 'Fungction.php';
    
    if (isset($_POST['username']) && isset($_POST['name'])) {
        $username = $_POST['username'];
        $name = $_POST['name'];
        $passwordya =$_POST["Password"];
    
        // Perbarui data di database
        $updateQuery = "UPDATE person SET Username='$username', Nama='$name',password='$passwordya' WHERE Username='{$_SESSION['username']}'";
        if (mysqli_query($conn, $updateQuery)) {
            // Perbarui data di sesi
            $_SESSION['username'] = $username;
            $_SESSION['name'] = $name;
            $_SESSION['pass'] = $passwordya;

            header("location:owner.php");
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
?>