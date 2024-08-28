<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require 'header.php'; ?>
</head>
<body style="background-color: #e4e4e4;">
    <?php 
        require 'alert.php'; 

    ?>
    <style>
        body {
            background-image: url('22222.png');
            background-repeat: no-repeat ;
            background-attachment: fixed ; 
            background-size: cover;
        }
    </style>
    <div class="container mt-5" >
        <div class="col-12 col-md-4 col-lg-4 mx-auto shadow p-3 mt-3 rounded bg-white" >
            <h1 class="text-center text-danger"><b>เจ้าหน้าที่ห้องพยาบาล</b></h1>
            <form action="ck_admin.php" method="POST">
                <input class="form-control" type="text" placeholder="username" name="username" required>
                <input class="form-control mt-2" type="password" placeholder="password" name="password" required>
                <button class="btn btn-primary form-control mt-2" type="submit" name="btn_login">เข้าสู่ระบบ</button>
            </form>
            <a class="btn btn-secondary form-control mt-2" href="teacher.php">Teacher</a>
        </div>
    </div>
</body>
</html>