<?php
session_start(); // -> Harus ditambahkan ketika menggunakan session

if(!isset($_SESSION['login'])) {
    header('location: auth/login.php');
    exit;
}

require('connect.php');

// if (!$conn) {
//      echo "Koneksi gagal";
// } else {
//      echo "Koneksi berhasil";
// }

$query = mysqli_query($conn, 'SELECT * FROM pengaduan');

$i = 1;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaduan Masyarakat</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: serif;
        }

        body{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        nav{
            width: 95%;
            height: auto;
            padding: 20px 30px;
            margin-top: 10px;
            border-radius: 10px;
            background-color: #000000;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        nav h1{
            color: white;
            font-size: 2rem;
        }

        nav p{
            color: white;
            font-size: 1rem;
            margin-bottom: 20px;
        }

        .navbar{
            gap: 10vw;
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
        }

        .navbar .create{
            width: 15vw;
            padding: 10px 0;
            color: white;
            text-decoration: none;
            text-align: center;
            font-size: 1rem;
            font-weight: 600;
            border: 2px solid white;
            border-radius: 30px;
            transition: all 0.3s ease-in-out;
        }

        .navbar .create:hover, .navbar .create:focus{
            color: black;
            background-color: white;
            box-shadow: 0px 0px 10px 1px white;
        }

        .navbar form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        .navbar form button{
            width: 15vw;
            padding: 10px 0;
            color: white;
            background-color: transparent;
            border: 2px solid white;
            border-radius: 30px;
            text-decoration: none;
            text-align: center;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        .navbar form button:hover, .navbar form button:focus{
            color: black;
            background-color: white;
            box-shadow: 0px 0px 10px 1px white;
        }
        
        .navbar img{
            width: 5vw;
            height: auto;
        }

        table{
            padding: 30px 30px;
            border: 2px solid black;
            border-radius: 30px;
            margin-top: 5vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        thead{
            padding: 0 0 15px 0;
            margin-bottom: 20px;
            border-bottom: 2px solid black;
        }

        thead tr{
            gap: 10px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        thead tr th{
            border: none;
            width: 15vw;
            /* background-color: gold; */
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        tbody tr{
            gap: 10px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        tbody tr td{
            border: none;
            width: 15vw;
            /* background-color: gold; */
            margin-bottom: 20px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        tbody tr td a{
            width: 30%;
            padding: 5px 0;
            margin-right: 10px;
            border: 2px solid black;
            border-radius: 30px;
            font-size: 1rem;
            text-decoration: none;
            text-align: center;
            color: black;
            background-color: transparent;
            transition: all 0.3s ease-in-out;
        }

        tbody tr td a:hover, tbody tr td a:focus{
            color: white;
            background-color: black;
            box-shadow: 0px 0px 10px 1px black;
        }
    </style>
</head>
<body>
    <nav>
        <h1>PENGADUAN MASYARAKAT</h1>
        <p>By: Partai Gerakan Indonesia Raya (GERINDRA)</p>
        <div class="navbar">
            <a class="create" href="create.php">Isi Report</a>
            <img src="Logo-Gerindra.png" alt="logo GERINDRA">
            <form action="auth/logout.php" method="post">
                <button type="submit">Log Out</button>
            </form>
        </div>
    </nav>
    <table border="1" cellpadding="3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nama Lengkap</th>
                <th>Pesan</th>
                <th>Kode Pos</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($baris = mysqli_fetch_assoc($query)) { ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td><?php echo $baris['nama_lengkap']; ?></td>
                <td><?php echo $baris['pesan']; ?></td>
                <td><?php echo $baris['kode_pos']; ?></td>
                <td>
                    <a href="edit.php?id=<?php echo $baris['id']; ?>">EDIT</a>
                    <!-- Menggunakan POST agar ID yang dikirim tidak terlihat -->
                    <form action="delete.php" method="post">
                        <!-- Input tidak telihat dan tidak bisa diubah, hanya untuk mengirim ID -->
                        <input readonly type="hidden" name="id" value="<?= $baris['id']; ?>">
                        <button style="font-size: 1rem; background-color: transparent; border: none; cursor:pointer" type="submit" name="delete">Delete</button>
                    </form>
                </td>
            </tr>
            <?php $i++; } ?>
        </tbody>
    </table>
</body>
</html>