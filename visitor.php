<?php
    
    include ("config.php");

    $visitor_ip = $_SERVER['REMOTE_ADDR'];
    
    $query = "SELECT * FROM counter_table WHERE ip_address='$visitor_ip'";
    $result = mysqli_query($conn, $query);
    
    $total_visitors = mysqli_num_rows($result);
    
    if ($total_visitors<1){
        $query2 = "INSERT INTO counter_table (ip_address) VALUES('$visitor_ip')";
        $result2 = mysqli_query($conn, $query2);
    }
    
    $query3 = "SELECT * FROM counter_table";
    $result3 = mysqli_query($conn, $query3);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title> NRB DATABASE! </title>

    
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/style.css">
	<link rel="stylesheet" href="fontawesome-web/css/all.min.css">
	<link rel="stylesheet" href="fontawesome-web/css/fontawesome.min.css">
	<link rel="shortcut icon" type="img/png" href="img/LogoPng.png">
    <title>NRB DATABASE !</title>

</head>
<body>
    <div class="container">
        <div class="col-md-3 offset-md-5">
            <div class="row" style="background-color: skyblue; width: 200px; height: 70px; color: #fff;">
                <h5 style="padding: 10px; text-align: center;">Visitor Count</h5>
                
                                </br></br></br></br>
                
                <p style="font-size: 2em;"><?php echo $total_visitors ; ?></p>
            </div>
        </div>
    </div>
    
    
</body>
</html>