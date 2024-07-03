<?php
require_once('koneksi.php');


if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM pemesanan WHERE id =?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $nama = $row['nama'];
        $asal_kota = $row['asal_kota'];
        $checkin = $row['checkin'];
        $checkout = $row['checkout'];
        $tipe_kamar = $row['tipe_kamar'];
        $jumlah_kamar = $row['jumlah_kamar'];
    } else {
        echo "Data tidak ditemukan.";
        exit();
    }

} else {
    echo "ID tidak ditemukan.";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $asal_kota = $_POST['asal_kota'];
    $checkin = $_POST['checkin'];
    $checkout = $_POST['checkout'];
    $tipe_kamar = $_POST['tipe_kamar'];
    $jumlah_kamar = $_POST['jumlah_kamar'];

    $updateSql = "UPDATE pemesanan SET nama=?, asal_kota=?, checkin=?, checkout=?, tipe_kamar=?, jumlah_kamar=? WHERE id=?";
    $stmt = $conn->prepare($updateSql);
    $stmt->bind_param("ssssssi", $nama, $asal_kota, $checkin, $checkout, $tipe_kamar, $jumlah_kamar, $id);
    if ($stmt->execute()) {
        header("Location: index.php");
        exit(); 
    } else {
        echo "Error: ". $stmt->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar Pemesanan Hotel</title>
    <style>
        body {
            margin: 40px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }

        a {
            display: inline-block;
            padding: 8px 16px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

       .merah {
            background: red;
        }

       .biru {
            background: #01B9F7;
        }
    </style>
</head>
<body>
    

    <div class="container">
        <h2>Edit Pemesanan</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"].'?id='. $id);?>" method="POST">
            <div class="form-group">
                <label for="nama">Nama Pemesan:</label>
                <input type="text" class="form-control" id="nama" name="nama" value="<?php echo $nama;?>" required>
            </div>
            <div class="form-group">
                <label for="asal_kota">Asal Kota:</label>
                <input type="text" class="form-control" id="asal_kota" name="asal_kota" value="<?php echo $asal_kota;?>" required>
            </div>
            <div class="form-group">
                <label for="checkin">Check-In:</label>
                <input type="date" class="form-control" id="checkin" name="checkin" value="<?php echo $checkin;?>" required>
            </div>
            <div class="form-group">
                <label for="checkout">Check-Out:</label>
                <input type="date" class="form-control" id="checkout" name="checkout" value="<?php echo $checkout;?>" required>
            </div>
            <div class="form-group">
                <label for="tipe_kamar">Tipe Kamar:</label>
                <input type="text" class="form-control" id="tipe_kamar" name="tipe_kamar" value="<?php echo $tipe_kamar;?>" required>
            </div>
           
            <div class="form-group">
                <label for="jumlah_kamar">Jumlah Kamar:</label>
                <input type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar" value="<?php echo $jumlah_kamar; ?>" required>
            </div>
            <td><input type="submit" value="Simpan"></td>
        </form>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>

