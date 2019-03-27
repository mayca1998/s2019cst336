<!DOCTYPE html>
<html>
    <head>
        <title> Otter Mart Product Search </title>
        <link href="css/styles.css" rel="stylesheet" type="test/css" />
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script>
            /*global $*/
            $(document).ready(function(){
                $.ajax({
                    type: "GET",
                    url: "api/getCategories.php",
                    dataType: "json",
                    success: function(data, status){
                        data.forEach(function(key){
                            $("[name=category]").append("<option value=" + key["catId"] + ">" + key["catName"] + "</option>");
                        });
                    }
                });
            });
            $("#searchForm").on("click", function(){
                 $.ajax({
                    type: "GET",
                    url: "api/getSearchResults.php",
                    dataType: "json",
                    data: {
                        "product" : $("[name=product]").val(),
                        //"category" : $([])
                    },
                    success: function(data, status){
                    	$("#results").html("<h3> Products Found: </h3>");
                        data.forEach(function(key){
                    	    $("#results").append(key['productName'] + " " +  key['productDescription'] + " $" + key['price'] + "<br>");
                    	});
                    }
                });
            });
        </script>
    </head>
    <body>
        <div>
            <h1>OtterMart Product Search</h1>
            <form>
                Product: <input type="text" name="product"/>
                <br>
                Category:
                <select name="category">
                    <option value =" "> Select One </option>
                </select>
                <br>
                Price: From<input type="text" name="priceFrom" size="7"/>
                       To<input type="text" name="priceTo" size="7"/>
                <br>
                Order result by:
                
                <br>
                <input type="radio" name="orderBy" value="price" />Price <br>
                <input type="radio" name="orderBy" balue="name" />Name <br>
                
                <br><br>
            </form>
            <button id="searchForm">Search</button>
            
        </div>
        <br>
        <br>
        <div id="results"></div>
        

    </body>
</html>