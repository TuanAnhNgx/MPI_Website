<?php
session_start();
include('connect.php');

if (isset($_POST['user_name']) && isset($_POST['password'])) {
    $user_name = $_POST['user_name'];
    $password = $_POST['password'];

    if ($user_name == "") {
        $_SESSION['tb'] = "Tên người dùng đang trống";
        header("location: ../login.php");
        exit();
    }

    if ($password == "") {
        $_SESSION['tb'] = "Mật khẩu đang trống";
        header("location: ../login.php");
        exit();
    }

    // Câu truy vấn kiểm tra tài khoản và phân quyền
    $tsql = "SELECT a.username, r.RoleName, a.RoleID, a.customerID, a.linhVucID
            FROM accounts a
            INNER JOIN roles r ON a.RoleID = r.RoleID
            WHERE a.username = ? AND a.password = ?";
    $params = array($user_name, $password);
    $stmt = sqlsrv_query($conn, $tsql, $params);

    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    // Kiểm tra kết quả truy vấn
    if (sqlsrv_has_rows($stmt)) {
        $row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC);
        $_SESSION['username'] = $user_name;
        $_SESSION['RoleName'] = $row['RoleName'];

        // var_dump( $_SESSION['RoleName']);
        // exit();
        if ($_SESSION['RoleName'] == "admin") {            
            header("location: ../Admin/admin.php");
        }
        // Mee
        if ($_SESSION['RoleName'] == "customer") {
                header("location:../User/index.php");            
        }
        // Mee

    } else {
        $_SESSION['tb'] = "Tài khoản hoặc mật khẩu không đúng.";
        header("location: ../login.php");
    }

    // Giải phóng tài nguyên
    sqlsrv_free_stmt($stmt);
    sqlsrv_close($conn);
} else {
    header("location: ../page-login.php");
}
?>
