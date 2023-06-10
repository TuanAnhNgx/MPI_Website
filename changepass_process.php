<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit(); // cần dừng thực thi kịp thời sau khi chuyển hướng đến trang khác
}
        include('handle/connect.php');

        $username = $_SESSION['username'];
        $password = $_POST['password'];
        $newpassword = $_POST['newpassword'];

        $query = sqlsrv_query($conn, "select * from accounts where Username = '$username' and Password = '$password'");
        
        if (sqlsrv_has_rows($query) == true) {
            $updateQuery = "UPDATE accounts SET password = '$newpassword' WHERE username = '$username'";
            $update = sqlsrv_query($conn, $updateQuery);
            echo "Mật khẩu đã được đổi thành công. Chờ 3 giây để chuyển hướng trang";
            header("refresh:3;url=login.php");
        }
        else{
            echo "Mật khẩu cũ không đúng";
            $_SESSION['tbs']="Mật khẩu cũ không đúng. Vui lòng thử lại";
            header("changepassword.php");
        }


?>