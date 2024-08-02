<?php 
session_start();
require_once('config.php');

if (isset($_POST['signup'])) {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $c_password = $_POST['c_password'];
    $urole = 'user';

    // ตรวจสอบข้อมูลที่ป้อนเข้ามา
    if (empty($firstname)) {
        $_SESSION["error"] = "กรุณากรอกชื่อ!";
        header("location: register.php");
        exit();
    } else if (empty($lastname)) {
        $_SESSION["error"] = "กรุณากรอกนามสกุล!";
        header("location: register.php");
        exit();
    } else if (empty($email)) {
        $_SESSION["error"] = "กรุณากรอกอีเมล!";
        header("location: register.php");
        exit();
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["error"] = "อีเมลไม่ถูกต้อง!";
        header("location: register.php");
        exit();
    } else if (empty($password)) {
        $_SESSION["error"] = "กรุณากรอกรหัสผ่าน!";
        header("location: register.php");
        exit();
    } else if (strlen($password) > 20 || strlen($password) < 5) {
        $_SESSION["error"] = "รหัสต้องมีความยาวระหว่าง 5 ถึง 20 ตัวอักษร!";
        header("location: register.php");
        exit();
    } else if (empty($c_password)) {
        $_SESSION["error"] = "กรุณายืนยันรหัสผ่าน!";
        header("location: register.php");
        exit();
    } else if ($password != $c_password) {
        $_SESSION["error"] = "รหัสผ่านไม่ตรงกัน!";
        header("location: register.php");
        exit();
    } else {
        try {
            // ตรวจสอบอีเมลในฐานข้อมูล
            $check_email = $conn->prepare("SELECT email FROM users WHERE email = :email");
            $check_email->bindParam(":email", $email);
            $check_email->execute();

            if ($check_email->rowCount() > 0) {
                $_SESSION['warning'] = "มีอีเมลนี้อยู่ในระบบแล้ว <a href='login.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                header("location: register.php");
                exit();
            } else {
                // แฮชรหัสผ่านและบันทึกข้อมูลผู้ใช้
                $passwordHash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, urole) VALUES (:firstname, :lastname, :email, :password, :urole)");
                $stmt->bindParam(":firstname", $firstname);
                $stmt->bindParam(":lastname", $lastname);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":password", $passwordHash);
                $stmt->bindParam(":urole", $urole);
                $stmt->execute();

                $_SESSION['success'] = "สมัครสมาชิกเรียบร้อยแล้ว <a href='login.php' class='alert-link'>คลิ๊กที่นี่</a> เพื่อเข้าสู่ระบบ";
                header("location: register.php");
                exit();
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
