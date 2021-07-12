<!DOCTYPE html>
<html lang="en">
  <head>
     <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <!-- Required meta tags -->
    
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" type="img/png" href="img/LogoPng.png">
    <link rel="stylesheet" href="fontawesome-web/css/all.min.css">
    <link rel="stylesheet" href="fontawesome-web/css/fontawesome.min.css">

    <title>NRB DATABASE!</title>
    
    <style>
        input[type="email"]
        {
            width: 95%;
            margin: 0 auto;
        }
        
        .btn-block {
            width: 35%;
            margin: 0 auto;
            margin-top:20px;
        }
        
    </style>
    
  </head>
  <body> 
    
<?php
    include('config.php');
    if(isset($_POST["forgotButton"]) && (!empty($_POST["user_email"]))){
    $user_email = $_POST["user_email"];
    $user_email = filter_var($user_email, FILTER_SANITIZE_EMAIL);
    $user_email = filter_var($user_email, FILTER_VALIDATE_EMAIL);
    if (!$user_email) {
        $error .="<p>Invalid email address please type a valid email address!</p>";
        }else{
        $sel_query = "SELECT * FROM 'users' WHERE user_email='".$user_email."'";
        $result = mysqli_query($conn, $sel_query);
        $row = mysqli_num_rows($result);
        if ($row==""){
            $error .= "<p>No user is registered with this email address!</p>";
            }
        }
        if($error!=""){
        echo "<div class='error'>".$error."</div>";
            }else{
        $expFormat = mktime(date("H"), date("i"), date("s"), date("m") , date("d")+1, date("Y"));
        $expDate = date("Y-m-d H:i:s",$expFormat);
        $key = md5(2418*2+$user_email);
        $addKey = substr(md5(uniqid(rand(),1)),3,10);
        $key = $key . $addKey;
    // Insert Temp Table
    mysqli_query($conn,
    "INSERT INTO 'password_reset_temp' ('user_email', 'key', 'expDate')
    VALUES ('".$user_email."', '".$key."', '".$expDate."');");

    $output='<p>Dear user,</p>';
    $output.='<p>Please click on the following link to reset your password.</p>';
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p><a href="nrbabl.com/resetPassword.php?key='.$key.'&user_email='.$user_email.'&action=reset" target="_blank">nrbabl.com/resetPassword.php?key='.$key.'&user_email='.$user_email.'&action=reset</a></p>';		
    $output.='<p>-------------------------------------------------------------</p>';
    $output.='<p>Please be sure to copy the entire link into your browser.
    The link will expire after 1 day for security reason.</p>';
    $output.='<p>If you did not request this forgotten password email, no action 
    is needed, your password will not be reset. However, you may want to log into 
    your account and change your security password as someone may have guessed it.</p>';   	
    $output.='<p>Thanks,</p>';
    $output.='<p>Foreign Remittance Division</p>';
    $body = $output; 
    $subject = "Password Recovery";

    $email_to = $user_email;
    $fromserver = "mail.nrbabl.com"; 
    require("PHPMailer/PHPMailerAutoload.php");
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Host = "mail.nrbabl.com"; // Enter your host here
    $mail->SMTPAuth = true;
    $mail->Username = "info@nrbabl.com"; // Enter your email here
    $mail->Password = "2}miE&e~K@Ym"; //Enter your passwrod here
    $mail->Port = 465;
    $mail->IsHTML(true);
    $mail->From = "info@nrbabl.com";
    $mail->FromName = "Foreign Remittance Division";
    $mail->Sender = $fromserver; // indicates ReturnPath header
    $mail->Subject = $subject;
    $mail->Body = $body;
    $mail->AddAddress($email_to);
    if(!$mail->Send()){
    echo "Mailer Error: " . $mail->ErrorInfo;
    }else{
    echo "<div class='error'>
    <p>An email has been sent to you with instructions on how to reset your password.</p>
    </div><br /><br /><br />";
        }

            }	

    }else{
        
?>
<div class="container">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-3"></div>
                <div class="col-md-6 col-sm-12">
                    <div style="margin-top:70px; border:1px solid #008a05; border-radius:5px;">
                        <h4 class="passwordRecoverh4">Password Recover</h4><hr>
                        
                        <?php echo ($_SESSION["$user_email"]) ;?>
                        
                        <form method="POST" action="forgotPassword.php" name="reset"><br />
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-3">
                                        <label><strong>Enter Your Email Address:</strong></label>
                                    </div>
                                    <div class="col-md-9">
                                        <input class="form-control resetPassInput" type="email" name="user_email" placeholder="Enter your email" />
                                    </div>
                                    
                                    <button type="submit" class="btn btn-success btn-block forgotButton" name="forgotButton">Reset Password</button>
                                    
                                </div>
                            </div>
                        </form>
                       
                        <?php } ?>
                        <center><a class="btn btn-link" href="login.php"> Login </a></center>
                    </div>
                </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</div>

<?php include("footer.php");?>

    
  </body>
</html>

