<?php
    session_start();
    include("functions.php");
    if(isset($_SESSION["user_id"])) {
        if(isLoginSessionExpired()) {
            header("Location:logout.php?session_expired=1");
        }
    }
    $mobile_no = $_GET['mobile_no'];
    include("config.php");
    $user_id = $_SESSION["user_id"];
    $sql = "SELECT * FROM nrb WHERE mobile_no=$mobile_no";
    $result = mysqli_query($conn, $sql);
    $nrb = mysqli_fetch_assoc($result);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>NRB DATABASE!</title>
    
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="shortcut icon" type="img/png" href="img/LogoPng.png">
        <link rel="stylesheet" href="fontawesome-web/css/all.min.css">
        <link rel="stylesheet" href="fontawesome-web/css/fontawesome.min.css">
    </head>
<body>

    <br>
    <br>
    <br>

<center> <button class="btn btn_print" onclick="myFunction()">Print</button> </center>

<script>
    function myFunction() {
      window.print();
    }
</script>
    
                            <center><a></a></center>
      
    <div class="col-md-6 offset-md-3" id="show_background" style="width:70%; border:1px solid #007500; border-radius: 5px; padding:0px 0px 5px 0px;">
                
                <h4 class="showh4"> Beneficiary Information </h4>
                
                <table class="table table-bordered table-hover">                   
                    
                    <tr>
                        <th style="width:45%">Mobile No</th>
                        <th style="width:10%; text-align:center;">:</th>
                        <td style="width:45%"><?php echo $nrb['mobile_no']; ?></td>
                    </tr>
                    <tr>
                        <th>Name of Receiver</th>
                        <th style="width:10%; text-align:center;">:</th>
                        <td><?php echo $nrb['receiver']; ?></td>
                    </tr>
                    <tr>
                        <th>Father's Name of Receiver</th>
                        <th style="width:10%; text-align:center;">:</th>
                        <td><?php echo $nrb['father_name']; ?></td>
                    </tr>
                    <tr>
                        <th>Permanent Address</th>
                        <th style="width:10%; text-align:center;">:</th>
                        <td><?php echo $nrb['permanent_address']; ?></td>
                    </tr>
                    <tr>
                        <th>Bank Account</th>
                        <th style="width:10%; text-align:center;">:</th>
                        <td><?php echo $nrb['bank_ac']; ?></td>
                    </tr>
                    <tr>
                        <th>Name of Remitter</th>
                        <th style="width:10%; text-align:center;">:</th>
                        <td><?php echo $nrb['remitter']; ?></td>
                    </tr>
                    <tr>
                        <th>Father's Name of Remitter</th>
                        <th style="width:10%; text-align:center;">:</th>
                        <td><?php echo $nrb['father_name_remitter']; ?></td>
                    </tr>
                    <tr>
                        <th>Origin of Remittance</th>
                        <th style="width:10%; text-align:center;">:</th>
                        <td><?php echo $nrb['origin']; ?></td>
                    </tr>
                    <tr>
                        <th>Receiver's Relation with Remitter</th>
                        <th style="width:10%; text-align:center;">:</th>
                        <td><?php echo $nrb['relation']; ?></td>
                    </tr>
                </table>         
    </div>

<?php include("footer.php");?>	
	