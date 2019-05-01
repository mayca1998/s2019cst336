<?php
    include './dbConnection.php';
    
    
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
                    $email = ($_POST['email_address']);
                    $caption = ($_POST['caption']);
                    $timestamp = date("Y-m-d H:i:s");
                    
                    if(substr($imageType,0,5) == "image"){
                        mysql_query("INSERT INTO uploads(email_address, caption, media, timestamp) VALUES('$email','$caption','$imageData','$timestamp')");
                        $msg ="Images Uploaded Sucessfully!";
                    }
                    else{
                        $msg ="only images are allowed";
                    }
                }
                else{
                   $msg = "File Size to big";
                }
            }
            else{
                $msg = "Caption is Empty";
            }
        }
        else{
        $msg = "Email Address is Empty";
        }
    }
    echo $msg
?>