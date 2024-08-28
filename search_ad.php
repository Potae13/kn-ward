<?php
    session_start();
    require 'conn.php';
    
    if(!isset($_SESSION['key'] )){
        header("location: index.php");
    }
    if(!isset($_SESSION['username'])){
        header("location: index.php");
    }

    $sql = "SELECT * FROM history1 WHERE DATE(date_add) = CURDATE()";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require 'header.php' ?> ;
</head>
<body>
    
    <div class="container mt-5">
        <div class="col-12 col-md-4 col-lg-4 mx-auto p-3 rounded shadow bg-white">
            <h1>ยินดีต้อนรับ</h1>
            <form action="search.php" method="POST">
                <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อนักเรียน">
                <button class="form-control btn btn-success mt-3" type="submit" name="btn_search">ค้นหา<i class="fa-solid fa-magnifying-glass"></i></button>
            
            <a href="home.php" class="btn btn-warning">กลับไปหน้าบันทึกข้อมูล</a>
        </div>
        </form>
        
       <div class="col-12 col-md-4 col-lg-4 mx-auto p-3 rounded shadow bg-white mt-4">
            <table class="table">
                <h2><b>บันทึกการเข้าใช้ห้องพยาบาล</b></h2>
                <thead>
                    <tr>
                        <th scope="col">เลขประจำตัวนักเรียน</th>
                        <th scope="col">ชื่อ-สกุล</th>
                        <th scope="col">ห้อง</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        foreach($result as $row) {
                    ?>
                    <tr>
                        <th scope="row"><?= $row['noid'] ?> </th>
                        <td><?= $row['prefix'],$row['fname'],' ',$row['lname'] ?></td>
                        <th scope="row"><?= $row['class'] ?> </th> 
                    </tr>
                    <?php
                    }
                    ?>
                </tbody>
            </table>
       </div>
    </div>
</body>
</html>