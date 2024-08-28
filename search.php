 <?php
    session_start();
    require 'conn.php';
    
    if(isset($_POST['btn_search'])){
        $search = $_POST['search'];
        $search = "%$search%";
        $sql = "SELECT * FROM history1 WHERE fname LIKE :search";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':search',$search,PDO::PARAM_STR);
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
        <div class="col-8 mx-auto p-3 rounded shadow bg-white">
            <form action="search.php" method="POST">
                <input type="text" name="search" class="form-control" placeholder="ค้นหาชื่อนักเรียน">
                <button class="form-control btn btn-success mt-3" type="submit" name="btn_search">ค้นหา<i class="fa-solid fa-magnifying-glass"></i></button>
            <a href="index.php" class="btn btn-warning mt-3">กลับไปหน้าหลัก</a>
        </div>
        </form>
        
       <div class="col-8 mx-auto p-3 rounded shadow bg-white mt-3">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">เลขประจำตัวนักเรียน</th>
                        <th scope="col">คำนำหน้า</th>
                        <th scope="col">ชื่อ-สกุล</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                        foreach($result as $row) {
                    ?>
                    <tr>
                        <th scope="row"><?= $row['noid'] ?> </th>
                        <th scope="row"><?= $row['prefix'] ?> </th> 
                        <td><?= $row['fname'],' ',$row['lname'] ?></td>
                    </tr>
                    <?php
                    }
                }
                    ?>
                </tbody>
            </table>
       </div>
    </div>
</body>
</html>