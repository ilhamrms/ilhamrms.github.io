<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "project";

// Buat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Query untuk menghapus data berdasarkan id
    $sql = "DELETE FROM pemesanan WHERE id = ?";
    
    // Siapkan statement
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param("i", $id);
        
        // Eksekusi statement
        if ($stmt->execute()) {
            echo "Data berhasil dihapus";
        } else {
            echo "Error: " . $stmt->error;
        }
        
        // Tutup statement
        $stmt->close();
    } else {
        echo "Error: " . $conn->error;
    }
    
    // Redirect ke halaman utama setelah penghapusan
    header("Location: index.php");
    exit();
} else {
    echo "ID tidak ditemukan";
}

// Tutup koneksi
$conn->close();
?>