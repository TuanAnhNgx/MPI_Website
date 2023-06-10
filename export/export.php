<?php
session_start();
$user = $_SESSION['username'];

require("../PHPExcel/Classes/PHPExcel.php");
require("../handle/connect.php");
    $objExcel = new PHPExcel;
    $objExcel->setActiveSheetIndex(0);
    $sheet = $objExcel->getActiveSheet()->setTitle('data');

    $rowCount = 1;
    $sheet->setCellValue('A' . $rowCount, 'Mã Thông Báo');
    $sheet->setCellValue('B' . $rowCount, 'Ngày Đăng Tải');
    $sheet->setCellValue('C' . $rowCount, 'Phiên Bản Thay Đổi');
    $sheet->setCellValue('D' . $rowCount, 'Mã KHLCNT');
    $sheet->setCellValue('E' . $rowCount, 'Phân Loại KHLCNT');    
    $sheet->setCellValue('F' . $rowCount, 'Tên Dự Toán Mua Sắm');    
    $sheet->setCellValue('G' . $rowCount, 'Tên Gói Thầu');    
    $sheet->setCellValue('H' . $rowCount, 'Chủ Đầu Tư');    
    $sheet->setCellValue('I' . $rowCount, 'Bên Mời Thầu');    
    $sheet->setCellValue('J' . $rowCount, 'Nguồn Vốn');    
    $sheet->setCellValue('K' . $rowCount, 'Lĩnh Vực');    
    $sheet->setCellValue('L' . $rowCount, 'Hình Thức LCNT');    
    $sheet->setCellValue('M' . $rowCount, 'Loại Hợp Đồng');    
    $sheet->setCellValue('N' . $rowCount, 'Trong Nước / Quốc Tế');    
    $sheet->setCellValue('O' . $rowCount, 'Phương Thức LCNT');    
    $sheet->setCellValue('P' . $rowCount, 'Thời Gian Thực Hiện HĐ');    
    $sheet->setCellValue('Q' . $rowCount, 'Hình Thức Dự Thầu');    
    $sheet->setCellValue('R' . $rowCount, 'Địa Điểm Phát Hành EHSMT');    
    $sheet->setCellValue('S' . $rowCount, 'Chi Phí Nộp EHSDT');    
    $sheet->setCellValue('T' . $rowCount, 'Địa Điểm Nhận EHSDT');    
    $sheet->setCellValue('U' . $rowCount, 'Địa Điểm Thực Hiện Gói Thầu');    
    $sheet->setCellValue('V' . $rowCount, 'Thời Điểm Đóng Thầu');    
    $sheet->setCellValue('W' . $rowCount, 'Thời Điểm Mở Thầu');    
    $sheet->setCellValue('X' . $rowCount, 'Địa Điểm Mở Thầu');    
    $sheet->setCellValue('Y' . $rowCount, 'Hiệu Lực Báo Giá');    
    $sheet->setCellValue('Z' . $rowCount, 'Số Quyết Định Phê Duyệt');    
    $sheet->setCellValue('AA' . $rowCount, 'Ngày Phê Duyệt');    
    $sheet->setCellValue('AB' . $rowCount, 'Cơ Quan Ban Hành Quyết Định');    
    // $sheet->setCellValue('AC' . $rowCount, 'Quyết Định Phê Duyệt');    
    
    $query = "SELECT * FROM TBMT where linhvuc = (SELECT linhVucName FROM linhvuc WHERE linhVucID = (SELECT linhVucID FROM accounts WHERE username = '".$user."'))";
                                    
    $stmt = sqlsrv_query($conn, $query);
    if ($stmt === false) {
        die(print_r(sqlsrv_errors(), true));
    }

    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_NUMERIC)) {
        
        $rowCount++;

        $sheet->setCellValue('A' .$rowCount,$row[0]);
        $sheet->setCellValue('B' .$rowCount,$row[1]);
        $sheet->setCellValue('C' .$rowCount,$row[2]);
        $sheet->setCellValue('D' .$rowCount,$row[3]);
        $sheet->setCellValue('E' .$rowCount,$row[4]);
        $sheet->setCellValue('F' .$rowCount,$row[6]);
        $sheet->setCellValue('G' .$rowCount,$row[7]);
        $sheet->setCellValue('H' .$rowCount,$row[8]);
        $sheet->setCellValue('I' .$rowCount,$row[9]);
        $sheet->setCellValue('J' .$rowCount,$row[10]);
        $sheet->setCellValue('K' .$rowCount,$row[11]);
        $sheet->setCellValue('L' .$rowCount,$row[12]);
        $sheet->setCellValue('M' .$rowCount,$row[13]);
        $sheet->setCellValue('N' .$rowCount,$row[14]);
        $sheet->setCellValue('O' .$rowCount,$row[15]);
        $sheet->setCellValue('P' .$rowCount,$row[16]);
        $sheet->setCellValue('Q' .$rowCount,$row[17]);
        $sheet->setCellValue('R' .$rowCount,$row[18]);
        $sheet->setCellValue('S' .$rowCount,$row[19]);
        $sheet->setCellValue('T' .$rowCount,$row[20]);
        $sheet->setCellValue('U' .$rowCount,$row[21]);
        $sheet->setCellValue('V' .$rowCount,$row[22]);
        $sheet->setCellValue('W' .$rowCount,$row[23]);
        $sheet->setCellValue('X' .$rowCount,$row[24]);
        $sheet->setCellValue('Y' .$rowCount,$row[25]);
        $sheet->setCellValue('Z' .$rowCount,$row[26]);
        $sheet->setCellValue('AA' .$rowCount,$row[27]);
        $sheet->setCellValue('AB' .$rowCount,$row[28]);
        // $sheet->setCellValue('AC' .$rowCount,$row[29]);

    }

    $objWriter = new PHPExcel_Writer_Excel2007($objExcel);
    $filename = 'TBMT.xlsx';
    $objWriter->save($filename);

    header('Content-Disposition: attachment; fileName="' . $filename . '"');
    header('Content-Type: appliciation/vnd.openxmlformationsofficedocument.spreadsheetml.sheet');
    header('Content-Leagth: ' . filesize($filename));
    header('Content-Transfer-Encoding: bianry');
    header('Cache-Control: must-revalidate');
    header('Pragma: no-cache');
    readfile($filename);
    
    ?>
