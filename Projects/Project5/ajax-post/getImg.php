<?php
    include './dbConnection.php';
    
    $myArray = array();
    
    $con = mysql_connect($host,$dbname,$username,$password);
    $dbs = mysql_select_db($dbname, $con);
  
    $result = mysql_query("SELECT * FROM uploads");          
    
    
    while ($row = mysql_fetch_assoc($result)) {
       array_push($myArray,$row);
       
    echo json_encode($myArray);

   }
 

    
    
