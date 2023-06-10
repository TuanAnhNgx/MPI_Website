<?php
    $serverName = "DESKTOP-ASUUQ5M"; //serverName\instanceName
    $connectionInfo = array( "Database" => "dataMPI", "CharacterSet" => "UTF-8");
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    if (!$conn) {
        echo "failed to connect to database.<br />";
        die(print_r(sqlsrv_errors(), true));
    }
    ?>