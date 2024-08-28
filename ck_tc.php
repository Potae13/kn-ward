<?php
session_start();
require 'conn.php';

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) || empty($password)) {
    $_SESSION['login_error'] = true;
    header("Location: teacher.php");
}

try {
    $sql = "SELECT * FROM teacher WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    $fetch = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($fetch) {
        if($fetch['password'] == $password){
            $_SESSION['key'] = Time();
            $_SESSION['username'] = $fetch['username'];
            $_SESSION['login_success'] = true;
            header("Location: hometc.php");
        } else {
            $_SESSION['login_error'] = true;
            header("Location: teacher.php");
        }
    } else {
        $_SESSION['login_error'] = true;
        header("Location: teacher.php");
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
