<?php
    session_start();
    if(!isset($_SESSION["username"])){
      header("Location:login.html");
    }
    require_once('nav.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Scheduler</title>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css" integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">


</head>

<body>
    <div id="content" class="mx-auto text-center" style="width: 80%;">
       

        <div class="container">
            
            <form>

                <br><br><br>
                <div class="input-group mb-3">
                    <label for="invitationLinkInput" style="padding-right: 5px">Invitation Link</label>
                    
                  <input type="text" class="form-control" id="invitationLinkInput" placeholder="">
                    <button type="button" id="invButton"><i class="fas fa-paste"></i></button>
                    
                </div>
            </form>
            <br>
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Start Time</th>
                        <th scope="col">Duration</th>
                        <th scope="col">Booked By</th>
                    </tr>
                    
                    <?php
                    if(strpos($_SERVER['HTTP_HOST'], 'herokuapp') !== false) {
                        $db = mysqli_connect("us-cdbr-iron-east-02.cleardb.net","b46d43e6e83caf","28f838a4","heroku_698053562a31a38"); 
                        
                    }
                    else
                        $db = mysqli_connect("localhost","root","","Scheduler"); 
              
                    $sql = "SELECT * FROM appointments WHERE 1";
                    $sth = $db->query($sql);
                    echo "<div id='box'>";
                    //$i = 1;
                      
                    while($result=mysqli_fetch_array($sth))
                    {
                
                            //echo "<br>";
                            $date1 = $result['start_time'];
                            $date2 = $result['end_time'];
                            $diff = abs(strtotime($date2) - strtotime($date1)); 

                            $years   = floor($diff / (365*60*60*24)); 
                            $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                            $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                            
                            $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
                            
                            if($date1 > date("Y-m-d h:i:s") ){

                            echo "<div id='apps'><tr><td>" . $result['start_time'] . "</td> <td>". $result['end_time'] . "</td> <td>". $hours . " hour(s) </td> <td> ";
                        
                        
                            if($result['user_id'] == ""){
                                echo"<button id='book'>Book</button>";
                            }
                            else
                                echo $result['user_id'] ."</td></tr></div>";
                            echo "<br><br>";
                            }
                    }
                    
                    echo "</div>";
                ?>  
                
               
                </thead>
                
                <tbody>
                    

                </tbody>
            </table>
        </div>

      
    </div>
</body>

</html>