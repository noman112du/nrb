<?php
session_start();
include("functions.php");
if(isset($_SESSION["user_id"])) {
	if(isLoginSessionExpired()) {
		header("Location:logout.php?session_expired=1");
	}
}

include("config.php");
$user_id = $_SESSION["user_id"];

if (isset($_POST['submit'])){
    if(!empty == currentPassword)
        $result = mysqli_query($conn, "SELECT password from users WHERE user_id='" . $_SESSION["user_id"] . "'");
        $row = mysqli_fetch_array($result);
        $pawo = $row->password 

        if (md5($_POST['currentPassword']) == $pawo){
        if ($_POST['newPassword']==$_POST['confirmPassword']){
         mysqli_query($conn, ("UPDATE users SET password='" . md5($_POST['newPassword']) . "' WHERE user_id='" . $_SESSION['user_id'] . "';")
         }
        else { echo "Passwords do not match" }
        }
    else { echo "Wrong password entered" }
    }

?>


<?php include("header.php"); ?>

            <div class="col-md-9" style="background-color:#f2f2f2; height:650px;">
                <div id="pass_change_form">
                    <h4 class="passchangeh4"> Password Change </h4> <hr/>

                    <?php if(isset($_SESSION['pass_change_error'])) { ?>
                        <center> <p class="text-danger wrong_pass_change">Warning! Password and confirm password is not same.</p> </center>
                    <?php } ?>

                    <form name="frmChange" method="post" action="" onSubmit="return validatePassword()">
                        <div style="width:500px;">
                            <div class="message"><?php if(isset($message)) { echo $message; } ?></div>
                                <table border="0" cellspacing="0" width="500" align="center" class="tblSaveForm">
                                    <tr style="margin-bottom:5px;">
                                        <td width="30%"><label style="font-weight:bold;">Current Password</label></td>
                                        <td width="70%"><input type="password" name="currentPassword" class="txtField"/><span id="currentPassword"  class="required"></span></td>
                                    </tr>
                                    <tr>
                                        <td><label style="font-weight:bold;">New Password</label></td>
                                        <td><input type="password" name="newPassword" class="txtField"/><span id="newPassword" class="required"></span></td>
                                    </tr>
                                    <tr>
                                        <td><label style="font-weight:bold;">Confirm Password</label></td>
                                        <td><input type="password" name="confirmPassword" class="txtField"/><span id="confirmPassword" class="required"></span></td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" style="text-align:center;"><input type="submit"  name="submit" value="Submit" class="btn btn-success"></td>
                                    </tr>
                                </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>   
    </div>   
</div>
    
<!---  <script>
function validatePassword() {
var currentPassword, newPassword, confirmPassword, output = true;

currentPassword = document.frmChange.currentPassword;
newPassword = document.frmChange.newPassword;
confirmPassword = document.frmChange.confirmPassword;

if(!currentPassword.value) {
currentPassword.focus();
document.getElementById("currentPassword").innerHTML = "This field is required";
output = false;
}
else if(!newPassword.value) {
newPassword.focus();
document.getElementById("newPassword").innerHTML = "This field is required";
output = false;
}
else if(!confirmPassword.value) {
confirmPassword.focus();
document.getElementById("confirmPassword").innerHTML = "This field is required";
output = false;
}
if(newPassword.value != confirmPassword.value) {
newPassword.value="";
confirmPassword.value="";
newPassword.focus();
document.getElementById("confirmPassword").innerHTML = "Password does not same";
output = false;
} 	
return output;
}
</script> -->
	
<?php include("footer.php");?>	
