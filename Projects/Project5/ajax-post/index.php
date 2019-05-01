<!DOCTYPE html>
<?php include './uploadFile.php'; ?>

<html>

<head>
    <title>Event Picture Upload</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional bootstrap theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="col-md-3">
            <div id="enterEmail">
                
                <label for="log_email">Enter email </label>
                <br><input type="email" id="log_email" name='email_address'>
                <button id="button" onclick="myFunction()">Enter</button>
                <p id="uploadImage"></p>
                
                
            </div>
            <div id="uploadSection">
                
                You are logged in as: <mail id="login"></mail>
               
                
                <div style="display:none;">
                    <input type="file" name="image" multiple />
                </div>
                <br><br>
                
                <button id="selectButton" type="button" class="btn btn-primary btn-xs">Pick File(s)</button>
                

                <br><br>
                Caption 
                <br>
                <input type="text" id="caption" name= "caption" class="resizedTextbox">
                <br>
                <br>
            
                <button id="uploadButton" type="button" class="btn btn-primary btn-xs" name="submit">Upload File(s)</button>
            </div>
            <div class="progress">
                <div class="progress-bar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;">
                    0%
                </div>
            </div>
             <div class="gallery">
                <?php
                    $db = mysqli_connect("us-cdbr-iron-east-02.cleardb.net","b46d43e6e83caf","28f838a4","heroku_698053562a31a38");
                    $sql = "SELECT * from uploads";
                    $sth = $db->query($sql);
                    while($result=mysqli_fetch_array($sth)){
                        echo '<img style="width:400px; height:250px;"src="data:image/jpeg;base64,'.base64_encode( $result['media'] ).'"onclick="myFunction(this);" />Caption: '.$result['caption'].'<br>Uploaded by: '.$result['email_address'].'<br> Data/Time: '.$result['timestamp'];
                        
                    }
                ?>
            </div>
            </div>
                
            </div>
        </div>
        

        <!-- jQuery -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

        <script type="text/javascript">
            
            $("#button").ready(function(){ 
                $("#uploadSection").hide();
                $(".progress").hide();
                
            });
            $('#log_email').on('input', function() {
            	var input=$(this);
            	var re = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
            	var is_email=re.test(input.val());
            	if(is_email){input.removeClass("invalid").addClass("valid");}
            	else{input.removeClass("valid").addClass("invalid");}
            });
            $("#button").click(function() {
                
                $("#uploadSection").show();
                $(".progress").show();
                $("#enterEmail").hide();
                
                $("#login").html(
                    $("#log_email").val() 
                );
            });
            $("#selectButton").click(function() {
                console.log("clicked")
                $("form input[type='file']").trigger("click")
            })

            // 2. Use ajax to submit files
            $("form input[type='file']").change(function(e) {
                $('#filesList').empty();
                $.map(this.files, function(val) {
                    $('#filesList')
                        .append($('<div>')
                            .html(val.name)
                        );
                });
            })

            // 3. Send files with ajax
            $('#uploadButton').click(function(e) {
                setProgress(0);
                var formData = new FormData($('form')[0]);
                $.ajax({
                        url: "uploadFile.php",
                        type: "POST",
                        data: formData,
                        processData: false,
                        contentType: false,
                        mimeType: "multipart/form-data",
                        cache: false,
                        // This part gives up chunk progress of the file upload
                        xhr: function() {
                            //upload Progress
                            var xhr = $.ajaxSettings.xhr();
                            if (xhr.upload) {
                                xhr.upload.addEventListener('progress', function(event) {
                                    var percent = 0;
                                    var position = event.loaded || event.position;
                                    var total = event.total;
                                    if (event.lengthComputable) {
                                        percent = Math.ceil(position / total * 100);
                                    }
                                    //update progressbar
                                    setProgress(percent);
                                }, true);
                            }
                            return xhr;
                        }
                    })
                    .done(function(data, status, xhr) {
                        console.log('upload done');
                        //window.location.href = "<?php echo BASE_PATH?>/assets/<?php echo $controller->group ?>";
                        console.log(xhr);
                        $("#results").html(xhr.responseText)
                    })
                    .fail(function(xhr) {
                        console.log('upload failed');
                        console.log(xhr);
                    })
                    .always(function() {
                        //console.log('done processing upload');
                    });
            });

            function setProgress(percent) {
                $(".progress-bar").css("width", +percent + "%");
                $(".progress-bar").text(percent + "%");
            }
        </script>
</body>

</html>
