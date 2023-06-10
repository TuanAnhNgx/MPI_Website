<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("location:../login.php");
} 
$user = $_SESSION['username'];
include('../handle/connect.php');

$start_date = $_GET['start_date'];
$end_date = $_GET['end_date'];

// var_dump($start_date);
// exit();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <meta http-equiv="refresh" content="10"> -->
    <title>Dữ Liệu Đấu Thầu</title>
    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="https://cdn4.iconfinder.com/data/icons/education-information/32/data-512.png">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="https://cdn4.iconfinder.com/data/icons/education-information/32/data-512.png">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="https://cdn4.iconfinder.com/data/icons/education-information/32/data-512.png">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="https://cdn4.iconfinder.com/data/icons/education-information/32/data-512.png">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="https://cdn4.iconfinder.com/data/icons/education-information/32/data-512.png">
    <!-- Styles -->
    <link href="../css/lib/calendar2/pignose.calendar.min.css" rel="stylesheet">
    <link href="../css/lib/chartist/chartist.min.css" rel="stylesheet">
    <link href="../css/lib/font-awesome.min.css" rel="stylesheet">
    <link href="../css/lib/themify-icons.css" rel="stylesheet">
    <link href="../css/lib/owl.carousel.min.css" rel="stylesheet" />
    <link href="../css/lib/owl.theme.default.min.css" rel="stylesheet" />
    <link href="../css/lib/weather-icons.css" rel="stylesheet" />
    <link href="../css/lib/menubar/sidebar.css" rel="stylesheet">
    <link href="../css/lib/bootstrap.min.css" rel="stylesheet">
    <link href="../css/lib/helper.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/table.css" rel="stylesheet">
    </head>
<body>
<button onclick="topFunction()" id="myBtn" title="Go to top">↑</button>
<script>
  // Khi người dùng cuộn xuống 20px từ đầu trang, hiển thị nút
  window.onscroll = function() {scrollFunction()};

  function scrollFunction() {
    if (document.body.scrollTop > 50 || document.documentElement.scrollTop > 50) {
      document.getElementById("myBtn").style.display = "block";
    } else {
      document.getElementById("myBtn").style.display = "none";
    }
  }

  // Khi người dùng nhấp vào nút, cuộn lên đầu trang
  function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
  }
</script>
    <div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
        <div class="nano">
            <div class="nano-content">
                <ul>
                    <div class="logo"><a href="User.php">
                            <span>Xin chào <?php if (isset($_SESSION['username'])) {echo $_SESSION['username'];} ?></span>
                        </a></div>
                    <li class="label"></li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-lock"></i> Account <span class="badge badge-primary"></span> <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                              <ul>
                              <div class="dropdown-content-body">
                                        <ul>
                                            <li>
                                                <a href="../changepassword.php">
                                                    <i class="ti-user"></i>
                                                    <span>Đổi Mật Khẩu</span>
                                                </a>
                                            </li>
                                            <li>
                                                <a onclick="window.location='handle/checkLogout.php';" href="../handle/checkLogout.php">
                                                    <i class="ti-power-off"></i>
                                                    <span>Đăng Xuất</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                              </ul>                    
                    </li>
                    <li><a class="sidebar-sub-toggle"><i class="ti-book"></i> Data <span class="badge badge-primary"></span> <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                    <ul>
                    <form action="search.php" method="get" class="form-search">
                        <label for="start_date">Ngày bắt đầu:</label>
                        <input type="date" id="start_date" name="start_date" value="<?php echo date('Y-m-d', strtotime('-1 day')); ?>">
                        <label for="end_date">Ngày kết thúc:</label>
                        <input type="date" id="end_date" name="end_date" value="<?php echo date('Y-m-d'); ?>">
                        <button type="submit">Tìm kiếm</button>
                    </form>
                              </ul>                    
                    </li>
                    <li>
    <a class="sidebar-sub-toggle"><i class="ti-upload"></i> Update Data <span class="badge badge-primary"></span> <span class="sidebar-collapse-icon ti-angle-down"></span></a>
    <ul class="sidebar-submenu">
    <form action="../uploadExcel/upload.php" method="post" enctype="multipart/form-data" id="fileUploadForm">
        <li class="sidebar-item">
            <input type="file" name="file" id="fileInput" class="sidebar-input">
            
        </li>
        <li class="sidebar-item">
            <input type="submit" class="sidebar-btn" value="Update">
        </li>
        </form>
    </ul>
</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /# sidebar -->
    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                               <h2>Dữ Liệu Đấu Thầu</h2>
                                <!--Thêm tính năng lọc ngày-->
                            </br>
                                <h4>Tổng dữ liệu: <?php 
                               $sqllimit = "SELECT COUNT(*) AS limit FROM TBMT WHERE LinhVuc = (SELECT linhVucName FROM linhvuc WHERE linhVucID = (SELECT linhVucID FROM accounts WHERE username = '".$user."')) AND CONVERT(date, NgayDangTai, 103) >= '$start_date' AND CONVERT(date, NgayDangTai, 103) <= '$end_date';";
                               $stmtlimit = sqlsrv_query($conn, $sqllimit);
                               $row = sqlsrv_fetch_array($stmtlimit, SQLSRV_FETCH_ASSOC);
                                $total_rows = $row['limit'];
                                echo $total_rows;
                               ?></h4>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                    <div class="col-lg-4 p-l-0 title-margin-left">
                        <div class="page-header">
                            <div class="page-title">
                                <ol class="breadcrumb">
                                <li ><button type="submit" class = "btn btn-success"><a href="../export/export.php" style = "color: #fff; font-weight: bold; text-decoration: none; transition: all 0.3s ease; ">Xuất dữ liệu</a></button></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- /# column -->
                </div>
                <!-- /# row -->
                <section id="main-content">
                    <div class="row">
                        <table class="tbl">
                            <thead>
                                <tr style = "background-color: #FF5050; color: white; font-weight: bold;">
                                <th scope="col" style = "color: white; text-align: center">STT</th>
                                <th scope="col" style = "color: white; text-align: center">Mã TBMT</th>
                                <th scope="col" style = "color: white; text-align: center">Ngày Upload</th>
                                <th scope="col" style = "color: white; text-align: center">Tên Gói Thầu</th>
                                <th scope="col" style = "color: white; text-align: center">Bên Mời Thầu</th>
                                <th scope="col" style = "color: white; text-align: center">Địa Điểm Đấu Thầu</th>
                                <th scope="col" style = "color: white; text-align: center">Thời Gian Đóng Thầu</th>
                                </tr>                                
                            </thead>
                            <tbody>
                                <?php
                                $i = 0;
                                $data_Rows_Per_Page = !empty($_GET['per_page'])?$_GET['per_page']:20;
                                $currentPage = !empty($_GET['page'])?$_GET['page']:1;
                                $offset = ($currentPage - 1) * $data_Rows_Per_Page;                                
                                //Lấy giá trị giới hạn số lượng data của tài khoản
                                $sqlCount = sqlsrv_query($conn, "select * from accounts where Username = '".$_SESSION['username']."'");
                                if (sqlsrv_has_rows($sqlCount) == true) {
                                    $row = sqlsrv_fetch_array($sqlCount, SQLSRV_FETCH_ASSOC);
                                    
                                    $sql = "SELECT * FROM TBMT where linhvuc = (SELECT linhVucName FROM linhvuc WHERE linhVucID = (SELECT linhVucID FROM accounts WHERE username = '".$user."')) AND CONVERT(date, NgayDangTai, 103) >= '$start_date' AND CONVERT(date, NgayDangTai, 103) <= '$end_date' order by NgayDangTai DESC ";
                                $result = sqlsrv_query($conn, $sql);
                                $pageRecord = ceil($total_rows/$data_Rows_Per_Page);
                                while ($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_NUMERIC)) {
                                    $i++;
                                ?>                                
                                    <!-- <form method="post" action = "update.php"> -->
                                    <tr>
                                    <th><?php echo $i; ?></th>
                                    <td data-toggle="tooltip" title="<?php echo $row[0]; ?>" ><?php echo substr($row[0], 0, 14); ?></td>
                                        <td data-toggle="tooltip" title="<?php echo $row[1]; ?>"><?php echo ($row[1]); ?></td>
                                        <td data-toggle="tooltip" title="<?php echo $row[6]; ?>"><?php echo ($row[6]); ?></td>
                                        <td data-toggle="tooltip" title="<?php echo $row[8]; ?>"><?php echo ($row[8]); ?></td>                                      
                                        <td data-toggle="tooltip" title="<?php echo $row[20]; ?>"><?php echo ($row[20]); ?></td>       
                                        <td data-toggle="tooltip" title="<?php echo $row[21]; ?>"><?php echo substr($row[21], 0, 20); ?></td>       
                                    </tr>
                                <?php
                                }
                            }
                                ?>
                            </tbody>
                        </table>                        
                    </div>
                </section>
            </div>
        </div>
    </div>                                       
    <!-- jquery vendor -->
    <script src="../js/lib/jquery.min.js"></script>
    <script src="../js/lib/jquery.nanoscroller.min.js"></script>
    <!-- nano scroller -->
    <script src="../js/lib/menubar/sidebar.js"></script>
    <script src="../js/lib/preloader/pace.min.js"></script>
    <!-- sidebar -->

    <script src="../js/lib/bootstrap.min.js"></script>
    <script src="../js/scripts.js"></script>
    <!-- bootstrap -->
    <!-- scripit init-->
    <script src="../js/dashboard2.js"></script>
    <script>
        function uploadFileData() {
            var form_data = new FormData();
            form_data.append('file', $('#ip_file').prop('files')[0]);
            $.ajax({
                type: "post",
                cache: false,
                contentType: false,
                processData: false,
                url: "handle/upData.php",
                data: form_data,
                success: function(response) {
                    alert(response);
                    $("#main-content").html(response);
                }
            });
        }
    </script>
</body>
</html>