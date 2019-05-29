<?php
    include '../connect.php';
    $conn = getDatabaseConnection("cinder");
    
    $sql = "SELECT username, about_me, picture_url
            FROM   `user` 
            WHERE  id NOT IN (user_id FROM `match`)
            ";
    $
    
  //  $stmt = $conn->prepare($sql); // This will send the sql you provided
	$stmt->execute(); // This will execute the sql
	
	$records = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
    echo json_encode($records);

?>