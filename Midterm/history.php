<head>
    <meta charset=”utf-8” />

    <script scr ="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href="css/styles.css" rel="stylesheet" type="text/css" />

    <title>History @ Cinder</title>
    <style>
        h1, body{
            text-align: center;

        }
    </style>
    <script>
        $(document).ready(function(){
                $.ajax({
                    type: "GET",
                    url: "api/getHistory.php",
                    dataType: "json",
                    success: function(data, status){
                        $("#res").html("");
                        data.forEach(function(key){
                            $("#usern").append("" + key['username']);
                            $("#status").append("" + key['answer_type_id']);
                            $("#when").append("" + key['answer_timestamp']);
                        });
                    }
                });
                $(document).on('click', '.historyLink', function(){
                    $('#purchaseHistoryModal').modal("show");
                    $.ajax({
                        type: "GET",
                        url: "api/getPurchaseHistory.php",
                        dataType: "json",
                        data: {"productId" : $(this).attr("id")},
                        success: function(data, status) {
                            if (data.length != 0) { // Checks if the API returned a non-empty list
                                $("#history").html(""); //clears content
                                $("#history").append(data[0]['productName'] + "<br />");
                                $("#history").append("<img src='" + data[0]['productImage'] + "' width='200' /> <br />");
                                data.forEach(function(key) {
                                    $("#history").append("Purchase Date: " + key['purchaseDate'] + "<br />");
                                    $("#history").append("Unit Price: " + key['unitPrice'] + "<br />");
                                    $("#history").append("Quantity: " + key['quantity'] + "<br />");
                                });
                            }
                            else {
                                $("#history").html("No purchase history for this item.");
                            }
                        });
                    });
                });
            });
    </script>
     
</head>
<body>
        <nav>
            <hr width="50%"/>
            <a href="index.php" >Match</a> |
            <a href="history.php" id="current">History</a>
        </nav>
        <br>
        <h1>History</h1>
        <table id="res">
            <tr>
                <th id="usern"> Username </th>
                <th id="status"> Status </th>
                <th id="when"> When </th>
                <th>
                    <button id="detail">Detail</button>
                </th>
            </tr>
        </table>
        <!-- Modal -->
        <div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">About</h3>
                <button type="button" class="done" data-dismiss="modal" aria-label="Done">
                  <span aria-hidden="true">&times;</span>
                </button>
                </div>
              <div class="modal-body">
                  <div id="about"></div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Done</button>
              </div>
            </div>
          </div>
        </div>
        
    
    
</body>