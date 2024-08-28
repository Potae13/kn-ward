<?php 
session_start();
require 'conn.php';

$fetch = ['prefix'=>'', 'fname'=>'', 'lname'=>'', 'class'=>'', 'no'=>''];
if(!isset($_SESSION['key'] )){
    header("location: index.php");
}
if(!isset($_SESSION['username'])){
    header("location: index.php");
}

if(isset($_POST['st1'])){
    $noid = $_POST['noid'];
    
    $sql = "SELECT * FROM students WHERE noid = :noid";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':noid', $noid, PDO::PARAM_INT);
    $stmt->execute();
    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);
    if($stmt->rowCount() < 1){
        echo 'ไม่มีข้อมูลนักเรียน';
        $fetch = ['prefix'=>'', 'fname'=>'', 'lname'=>'', 'class'=>'', 'no'=>''];
    }
}

if(isset($_POST['save_data'])){
    $noid = $_POST['noid'];
    $prefix = $_POST['prefix'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $class = $_POST['class'];
    $no = $_POST['no'];
    $symptom = $_POST['symptom'];

    date_default_timezone_set('Asia/Bangkok');
    $date_add = date('Y/m/d H:i:s');

    try{
        $sql = "INSERT INTO history1 (noid, prefix, fname, lname, class, no, date_add, symptom) 
                VALUES(:noid, :prefix, :fname, :lname, :class, :no, :date_add, :symptom)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':noid', $noid, PDO::PARAM_INT);
        $stmt->bindParam(':prefix', $prefix, PDO::PARAM_STR);
        $stmt->bindParam(':fname', $fname, PDO::PARAM_STR);
        $stmt->bindParam(':lname', $lname, PDO::PARAM_STR);
        $stmt->bindParam(':class', $class, PDO::PARAM_INT);
        $stmt->bindParam(':no', $no, PDO::PARAM_INT);
        $stmt->bindParam(':date_add', $date_add, PDO::PARAM_STR);
        $stmt->bindParam(':symptom', $symptom, PDO::PARAM_STR);
        $result = $stmt->execute();
       
        if($result){
            $_SESSION['save_success'] = true;
            header("Refresh: 2");
        }else{
            $_SESSION['error'] = true;
            header("Refresh: 2");
        }
    }catch(PDOException $e){
        echo $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <?php require 'header.php';?>
</head>
<body style="background-color: #e4e4e4;">
    <?php require 'alert.php'; ?>
    
    <div class="container mt-5">
        <div class="col-12 col-md-6 col-lg-6 mx-auto mt-5 rounded shadow p-3 bg-white">
            <h1 class="text-center"><b>ระบบบันทึกการเข้าใช้ห้องพยาบาล</b></h1>
        
        <form action="" method="POST">
            <input type="number" placeholder="กรอกเลขประจำตัวนักเรียน" name="noid" value="<?= isset($noid) ? htmlspecialchars($noid) : '' ?>">
            <button type="submit" class="btn btn-success" name="st1">ดึงข้อมูลนักเรียน</button>
        </form>
        
        <form action="" method="POST">
            <input class="form-control" type="hidden" name="noid" value="<?= htmlspecialchars($noid) ?>">
            <input type="hidden" name="prefix" value="<?= htmlspecialchars($fetch['prefix']) ?>">
            <input type="hidden" name="fname" value="<?= htmlspecialchars($fetch['fname']) ?>">
            <input type="hidden" name="lname" value="<?= htmlspecialchars($fetch['lname']) ?>">
            <input type="hidden" name="class" value="<?= htmlspecialchars($fetch['class']) ?>">
            <input type="hidden" name="no" value="<?= htmlspecialchars($fetch['no']) ?>">

            <label for="">ชื่อ-สกุล</label>
            <input class="form-control" type="text" readonly value="<?= htmlspecialchars($fetch['prefix'].$fetch['fname'].' '.$fetch['lname']) ?>">
            <label for="">ห้อง</label>
            <input class="form-control" type="text" readonly value="<?= htmlspecialchars($fetch['class']) ?>">
            <label for="">เลขที่</label>
            <input class="form-control" type="text" readonly value="<?= htmlspecialchars($fetch['no']) ?>">
        
        </div>
        <div class="col-12 col-md-6 col-lg-6 mx-auto shadow mt-3 p-3 bg-white rounded ">
            <h5>อาการ</h5>
            <input class="mt-1" type="radio" id="หวัด" name="symptom" value="หวัด" required>
                <label for="หวัด">หวัด</label><br>
            <input class="mt-2" type="radio" id="ปวดหัว" name="symptom" value="ปวดหัว" required>
                <label for="ปวดหัว">ปวดหัว</label><br>
            <input class="mt-2" type="radio" id="เจ็บคอ" name="symptom" value="เจ็บคอ" required>
                <label for="เจ็บคอ">เจ็บคอ</label><br>
            <input class="mt-2" type="radio" id="ท้องเสีย" name="symptom" value="ท้องเสีย" required>
                <label for="ท้องเสีย">ท้องเสีย</label><br>
            
        
        <button class="btn btn-success mt-2 form-control" type="submit" name="save_data">บันทึกข้อมูล</button>
        </div>
        <div class="col-12 col-md-6 col-lg-6 mx-auto bg-white rounded shadow p-3 mt-3 ">
            <a class="btn btn-warning form-control " href="search_ad.php">ค้นหาชื่อนักเรียน</a>
            <a class="btn btn-danger mt-2 " href="remove.php" name="out-s" >ออกจากระบบ</a>
            
        </div>
    </form>
    </div>

</body>
</html>
