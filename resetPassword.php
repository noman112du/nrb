<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <script src="js/jquery.js"></script>
    <script src="js/jquery-1.11.1.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link rel="shortcut icon" type="img/png" href="img/LogoPng.png">
    <link rel="stylesheet" href="fontawesome-web/css/all.min.css">
    <link rel="stylesheet" href="fontawesome-web/css/fontawesome.min.css">

    <title>NRB DATABASE!</title>
</head>
<body>
<div style="width:700px; margin:50 auto;">

<h2>Password Recovery</h2>   

<?php
include('config.php');
if (isset($_GET["key"]) && isset($_GET["user_email"])
&& isset($_GET["action"]) && ($_GET["action"]=="reset")
&& !isset($_POST["action"])){
$key = $_GET["key"];
$user_email = $_GET["user_email"];
$curDate = date("Y-m-d H:i:s");
$query = mysqli_query($conn,"
SELECT * FROM 'password_reset_temp' WHERE 'key'='".$key."' and 'user_email'='".$user_email."';");
$row = mysqli_num_rows($query);
if ($row==""){
$error .= '<h2>Invalid Link</h2>
<p>The link is invalid/expired. Either you did not copy the correct link from the email, 
or you have already used the key in which case it is deactivated.</p>
<p><a href="nrbabl.com/forgotPassword.php">Click here</a> to reset password.</p>';
	}else{
	$row = mysqli_fetch_assoc($query);
	$expDate = $row['expDate'];
	if ($expDate >= $curDate){
	?>
    <br />
	<form method="post" action="" name="update">
        <input type="hidden" name="action" value="update" />
        <br /><br />
        <label><strong>Enter New Password:</strong></label><br />
        <input type="password" name="pass1" id="pass1" maxlength="15" required />
        <br /><br />
        <label><strong>Re-Enter New Password:</strong></label><br />
        <input type="password" name="pass2" id="pass2" maxlength="15" required/>
        <br /><br />
        <input type="hidden" name="user_email" value="<?php echo $user_email;?>"/>
        <input type="submit" id="reset" value="Reset Password" />
	</form>
<?php
}else{
$error .= "<h2>Link Expired</h2>
<p>The link is expired. You are trying to use the expired link which as valid only 24 hours (1 days after request).<br /><br /></p>";
				}
		}
if($error!=""){
	echo "<div class='error'>".$error."</div><br />";
	}			
} // isset email key validate end


if(isset($_POST["user_email"]) && isset($_POST["action"]) && ($_POST["action"]=="update")){
$error="";
$pass1 = mysqli_escape_string($conn,$_POST["pass1"]);
$pass2 = mysqli_escape_string($conn,$_POST["pass2"]);
$user_email = $_POST["user_email"];
$curDate = date("Y-m-d H:i:s");
if ($pass1!=$pass2){
		$error .= "<p>Password do not match, both password should be same.<br /><br /></p>";
		}
	if($error!=""){
		echo "<div class='error'>".$error."</div><br />";
		}else{

$pass1 = md5($pass1);
mysqli_query($conn,
"UPDATE 'users' SET 'password'='".$pass1."', `trn_date`='".$curDate."' WHERE 'user_email'='".$user_email."';");	

mysqli_query($conn,"DELETE FROM 'password_reset_temp' WHERE 'user_email'='".$user_email."';");		
	
echo '<div class="error"><p>Congratulations! Your password has been updated successfully.</p>
<p><a href="nrbabl.com/login.php">Click here</a> to Login.</p></div><br />';
		}		
}
?>

</div>
</body>
</html>

