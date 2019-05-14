<?php
    include 'dbConnection.php';
    $conn = getDBConnection("Scheduler");
    

    $namedParameters = array();
    $sql = "SELECT *
            FROM
                `appointments`
            LEFT JOIN 
                `user` on appointments.user_id = id
            WHERE
               start_time >= CURDATE() AND username = :userName
            ORDER BY 
                appointmetns.start_time ASC;";
                
    $stmt = $conn->prepare($sql);
    $stmt->execute(array(':userName' => $_GET['userName'])); // We NEED to include $namedParameters here
    $records = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
	echo json_encode($records);
?>