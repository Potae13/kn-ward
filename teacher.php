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
<body>
    <?php 
        require 'alert.php'; 

    ?>

    <div class="container mt-5">
        <div class="col-12 col-md-4 col-lg-4 mt-5 p-3 mx-auto bg-white mb-3 shadow rounded">
            <h1 class="text-center text-primary"><b>เข้าสู่ระบบTeacher</b></h1>
            <form action="ck_tc.php" method="POST">
                <input class="form-control" type="text" placeholder="username" name="username" required>
                <input class="form-control mt-2" type="password" placeholder="password" name="password" required>
                <button class="btn btn-primary form-control mt-2" type="submit" name="btn_login">เข้าสู่ระบบ</button>
            </form>
            <a class="btn btn-warning form-control mt-2" href="index.php">เจ้าหน้าห้องพยาบาล</a>
        </div>
    </div>
    
</body>
</html>