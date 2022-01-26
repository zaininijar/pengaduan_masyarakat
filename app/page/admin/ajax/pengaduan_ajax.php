<?php 

    global $conn;

    $sql = "SELECT * FROM pengaduan";

    $result = $conn->query($sql);

    $row = [];
    while($rows = $result->fetch_assoc()){
        $row[] = $rows;
    }

    echo json_encode($row);

?>
