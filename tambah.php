<?php
require_once('koneksi.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $asal_kota = $_POST['asal_kota'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $jumlah_kamar = $_POST['jumlah_kamar'];
    

    
    $sql = "INSERT INTO pemesanan (nama, asal_kota, checkin, checkout, tipe_kamar, jumlah_kamar) 
            VALUES ('$nama', '$asal_kota', '$checkin', '$checkout', '$tipe_kamar', '$jumlah_kamar')";
    if ($conn->query($sql) === TRUE) {
        header("Location: index.php");
        exit(); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Pemesanan</title>
    <link rel="stylesheet" href="tambah.css"> 
</head>

<body>
    <h2>Tambah Data Pemesanan</h2>
    
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <table>
        <tr>
            <td><label for="nama">Nama:</label></td>
            <td><input type="text" id="nama" name="nama" required></td>
        </tr>
        <tr>
            <td><label for="asal_kota">Asal Kota:</label></td>
            <td><input type="text" id="asal_kota" name="asal_kota" required></td>
        </tr>
        <tr>
            <td><label for="checkin">checkin:</label></td>
            <td><input type="date" id="checkin" name="checkin" required></td>
        </tr>
        <tr>
            <td><label for="checkout">checkout:</label></td>
            <td><input type="date" id="checkout" name="checkout" required></td>
        </tr>
        <tr>
            <td><label for="tipe_kamar">tipe_kamar:</label></td>
            <td><input type="text" id="tipe_kamar" name="tipe_kamar" required></td>

        </tr>
        <tr>
            <td><label for=" jumlah_kamar"> jumlah_kamar:</label></td>
            <td><input type="number" id="jumlah_kamar" name="jumlah_kamar" required></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" value="Simpan"></td>
        </tr>
        
        </table>
    </form>
</body>

</html>
