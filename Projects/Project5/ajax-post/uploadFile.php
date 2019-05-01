<?php
    include './dbConnection.php';
    mysql_connect($dbHost, $dbUsername, $dbPassword);
    mysql_select_db($dbName);
    
    if(isset($_POST['submit']))
    {
        $file = $_FILES['image'];
        $fileSize = $file['size'];
        
        //EMAIL ADDRESS
        if(!empty ($_POST['email_address']))
        {
            if(!empty($_POST['caption']))
            {
                if($fileSize < 10000){
                    $imageName = mysql_real_escape_string($_FILES["image"]["name"]);
                    $imageData = mysql_real_escape_string(file_get_contents($_FILES["image"]["tmp_name"]));
                    $imageType = mysql_real_escape_string($_FILES['image']['type']);
                    $emailadd = ($_POST['email_address']);
                    $cap = ($_POST['caption']);
                    $timestamp = date("Y-m-d H:i:s");
                    
                    if(substr($imageType,0,5) == "image"){
                        mysql_query("INSERT INTO uploads(email_address, caption, media, timestamp) VALUES('$emailadd','$cap','$imageData','$timestamp')");
                        $statusMsg ="Images Uploaded Sucessfully!";
                    }
                    else{
                        $statusMsg ="only images are allowed";
                    }
                }
                else{
                   $statusMsg = "File Size to big";
                }
            }
            else{
                $statusMsg = "Caption is Empty";
            }
        }
        else{
        $statusMsg = "Email Address is Empty";
        }
    }
    echo $statusMsg
?>