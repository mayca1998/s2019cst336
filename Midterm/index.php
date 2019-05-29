<html>
    <head>
    <meta charset=”utf-8” />

    <script scr ="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />

    <title>Match @ Cinder</title>
    <style>
        h1, body{
            text-align: center;
        }
    </style>
    <script>
            /*global $*/
            $(document).ready(function(){
                $.ajax({
                    type: "GET",
                    url: "api/getUser.php",
                    dataType: "json",
                    success: function(data, status){
                        data.forEach(function(key){
                            $("#pic").append("<img src= " + key["picture_url"] + ">");
                            $("#res").append("<h2> About @" + key['username'] + "</h2>");
                            $("#abt").append("<h3>"+key['about_me'] +"</h3>");
   
                        });
                    }
                });
                
            });
            
    </script>
</head>
<body>
        <nav>
            <hr width="50%"/>
            <a href="index.php" id="current">Match</a> |
            <a href="history.php">History</a>
        </nav>
        <br>
        <h1>Match</h1>
        <div>
            
            <div id="pic"></div>
            <div id="res"></div>
            <div id="abt"></div>
               
            
        </div>
        
    
    
</body>
</html>
