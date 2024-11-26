<?php 

session_start(); // -> Harus ditambahkan ketika menggunakan session

if(!isset($_SESSION['login'])) {
    header('location: auth/login.php');
    exit;
}

    include('connect.php');

    $id = $_GET['id'];

    $queryData = "SELECT * FROM pengaduan WHERE id = '$id'";

    $result = mysqli_query($conn, $queryData);

    while($loop = mysqli_fetch_assoc($result)) {
        $data = $loop;
    }

    if(isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $pesan = $_POST['pesan'];
        $pos = $_POST['pos'];

        $result = mysqli_query($conn, "UPDATE pengaduan SET nama_lengkap='$nama', pesan='$pesan', kode_pos='$pos' WHERE id=$id");

        if($result) {
            echo "<script>
                alert ('Data Berhasil Di Update')
                document.location.href='index.php'
            </script>";
        } else {
        echo "<script>
                alert('Data Gagal Di Update')
            </script>";
        }   
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDIT REPORT</title>
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

        .navbar a{
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

        .navbar a:hover, .navbar a:focus{
            color: black;
            background-color: white;
            box-shadow: 0px 0px 10px 1px white;
        }

        .navbar img{
            width: 5vw;
            height: auto;
        }

        form{
            margin-top: 3%;
            border: 2px solid black;
            border-radius: 30px;
            padding: 30px 60px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        form .lable{
            width: max-content;
            gap: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
        }

        .container{
            gap: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }

        .container input{
            font-size: 1rem;
            padding: 5px 10px;
        }

        .container input:focus{
            box-shadow: 0px 0px 10px 1px #80C4E9;
        }

        .pesan{
            width: max-content;
            gap: 5px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        .pesan input{
            width: 25vw;
            height: 20vh;
            font-size: 1rem;
            padding: 10px;
        }

        .pesan input:focus{
            box-shadow: 0px 0px 10px 1px #80C4E9;
        }

        button{
            width: 20vw;
            padding: 10px 0;
            font-size: 1rem;
            font-weight: 600;
            border: 2px solid black;
            border-radius: 30px;
            background-color: transparent;
            cursor: pointer;
            transition: all 0.3s ease-in-out;
        }

        button:hover, button:focus{
            color: white;
            background-color: black;
            box-shadow: 0px 0px 10px 1px black;
        }

    </style>
</head>
<body>
    <nav>
        <h1>Edit Data <?= $data['nama_lengkap'] ?></h1>
        <p>By: Partai Gerakan Indonesia Raya (GERINDRA)</p>
        <div class="navbar">
            <a href="create.php">Isi Report</a>
            <img src="Logo-Gerindra.png" alt="logo GERINDRA">
            <a href="index.php">Report Saya</a>
        </div>
    </nav>

    </br>

    <form action="" method="post">
        <div class="container">
            <div class="lable">
                <label for="">Nama Lengkap:</label>
                <input type="text" name="nama" id="nama" value=<?= $data['nama_lengkap']?>>
            </div>
            <div class="lable">
                <label for="">Kode Pos:</label>
                <input type="number" name="pos" id="pos" value=<?= $data['kode_pos']?>>
            </div>
        </div>

        <div class="pesan">
            <label for="">Pesan:</label>
            <input type="teks" name="pesan" id="pesan" value=<?= $data['pesan']?>>
        </div>

        <button type="submit" name="submit">Simpan</button>
    </form>
</body>
</html>