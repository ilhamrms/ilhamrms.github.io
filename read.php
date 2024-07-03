<?php
$host = "localhost"; 
$username = "root";
$password = ""; 
$database = "project";

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

$id = null;
if(isset($_GET['op']) && $_GET['op'] == 'read' && isset($_GET['id'])){
    $id = $_GET['id'];
}

$sql = "SELECT id, nama, asal_kota, checkin, checkout, tipe_kamar, jumlah_kamar FROM pemesanan";
$result = $conn->query($sql);
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
        <h2>Daftar Pemesanan</h2>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nama Pemesan</th>
                    <th>Asal Kota</th>
                    <th>Check-In</th>
                    <th>Check-Out</th>
                    <th>Tipe Kamar</th>
                    <th>Jumlah Kamar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0) : ?>
                    <?php $counter = 1; ?>
                    <?php while ($row = $result->fetch_assoc()) : ?>
                        <tr>
                            <td><?php echo $counter; ?></td>
                            <td><?php echo $row["nama"]; ?></td>
                            <td><?php echo $row["asal_kota"]; ?></td>
                            <td><?php echo $row["checkin"]; ?></td>
                            <td><?php echo $row["checkout"]; ?></td>
                            <td><?php echo $row["tipe_kamar"]; ?></td>
                            <td><?php echo $row["jumlah_kamar"]; ?></td>
                            <td>
                                <a class="biru" href="edit2.php?id=<?php echo $row["id"]; ?>">Edit</a>
                                <a class="merah" href="hapus.php?id=<?php echo $row["id"]; ?>">Delete</a>
                            </td>
                        </tr>
                        <?php $counter++; ?>
                    <?php endwhile; ?>
                <?php else : ?>
                    <tr>
                        <td colspan="8">Tidak ada data</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$conn->close();
?>
