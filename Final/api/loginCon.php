<?php
    session_start();
    include("dbConnection.php");
    $conn = getDBConnection("Scheduler");
    $sql = "SELECT * FROM user WHERE username = :username ";
    $stmt = $conn->prepare($sql);
    $stmt->execute( array (":username" => $_POST['username']));
    $record = $stmt->fetch();
    $isAuthenticated = password_verify($_POST["password"], $record["password"]);
    if($isAuthenticated)
    {
        $_SESSION["username"] = $_POST["username"];
    }
    echo json_encode($isAuthenticated);
?>