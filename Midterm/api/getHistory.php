<?php

    include '../connect.php';
    $conn = getDatabaseConnection("cind");
    
    //$u = $_GET['user_id'];
    $sql = "SELECT user.username, `match`.user_id
            FROM `user`
            LEFT JOIN `match` on user.username = `match`.id
            
            UNION
            
            SELECT user.name, `match`.user_id
            FROM `user`
            RIGHT JOIN `course` on user.course = `match`.id";
            
    //$np = array();
    //$np [':uId'] = $productId;
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($records);
    
?>