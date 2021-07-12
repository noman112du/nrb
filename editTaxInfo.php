<?php
session_start();
include("functions.php");
if(isset($_SESSION["user_id"])) {
	if(isLoginSessionExpired()) {
		header("Location:logout.php?session_expired=1");
	}
}
  $p_id = $_GET['p_id'];
    
  include ("config.php");
  $user_id = $_SESSION["user_id"];
  $sql = "SELECT personnel_name, designation, personnel_mobile_no, present_workplace, present_basic FROM tablestaff_info INNER JOIN tabletax_info ON tablestaff_info.p_id = tabletax_info.p_id";
  $result = mysqli_query($conn, $sql);
  $nrb = mysqli_fetch_assoc($result);

if (isset($_POST['personnel_name'])) {
    $personnel_name= $_POST['personnel_name'];
    $designation = $_POST['designation'];
    $personnel_mobile_no = $_POST['personnel_mobile_no'];
    $tin_no = $_POST['tin_no'];
    $present_workplace = $_POST['present_workplace'];
    $present_basic = $_POST['present_basic'];
    $division = $_POST['division'];
    

    $user_id = $_POST['user_id'];
    
    $sql = "UPDATE tax_info SET personnel_name='$personnel_name', designation='$designation', personnel_mobile_no='$personnel_mobile_no', tin_no='$tin_no', present_workplace='$present_workplace',  present_basic='$present_basic', division='$division', WHERE p_id=$p_id";
    mysqli_query($conn, $sql);
    header("Location: indexTaxInfo.php?p_id=" . $p_id);
    }
?>

<?php include("header.php") ; ?>
      
    <br>
    
<div class="offset-md-3" id="edit_background" style="width:70%; border: 1px solid #007500; border-radius: 5px;">

        <center> <h4 class="edith4"> Update Tax Information </h4> </center>

        
        <form action="updateTaxInfo.php?personnel_no=<?php echo $personnel_no ; ?>" method="POST">
            <table class="table table-bordered table-hover">
                <tr>
                    <th style="font-size:14px; width:420px;">কর্মকর্তা/কর্মচারীর নাম</th>
                    <th style="width:10%; text-align:center;"> : </th>
                    <td><input id="text-area" type="text" name="personnel_name" value="<?php echo $tax_info['personnel_name']; ?>" class="form-control" id="edit_receiverName"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;">পদবী/দায়িত্ব</th>
                    <th style="width:10%; text-align:center;"> : </th>
                    <td><input id="text-area" type="text" name="designation" value="<?php echo $tax_info['designation']; ?>" class="form-control" id="edit_remitterName"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;">মোবাইল নম্বর</th>
                    <th style="width:10%; text-align:center;"> : </th>
                    <td><input id="text-area" type="text" name="personnel_mobile_no" value="<?php echo $tax_info['personnel_mobile_no']; ?>" class="form-control" id="edit_receiver_relation"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;">টিন নম্বর</th>
                    <th style="width:10%; text-align:center;"> : </th>
                    <td><input id="text-area" type="text" name="personnel_mobile_no" value="<?php echo $tax_info['tin_no']; ?>" class="form-control" id="edit_receiver_relation"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;">বর্তমান কর্মস্থল</th></th>
                    <th style="width:10%; text-align:center;"> : </th>
                    <td><input id="text-area" type="text" name="present_workplace" value="<?php echo $tax_info['present_workplace']; ?>" class="form-control" id="edit_receiverPermanentAddress"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;">মূল বেতন</th>
                    <th style="width:10%; text-align:center;"> : </th>
                    <td><input id="text-area" type="text" name="present_basic" value="<?php echo $tax_info['present_basic']; ?>" class="form-control" id="edit_receiver_relation"></td>
                </tr>
                <tr>
                    <th style="font-size:14px;">বিভাগ</th>
                    <th style="width:10%; text-align:center;"> : </th>
                    <td><input id="text-area" type="text" name="district" value="<?php echo $tax_info['division']; ?>" class="form-control" id="edit_receiver_relation"></td>
                </tr>
                <tr>
                    <td colspan="3" align="center"> <input class="btn btn-success" type="submit" value="Submit"> </td>
                </tr>   
            </table> 
        </form> 
               
</div>

<script>
    $('#text-area').bangla('on');      // enables bangla
</script>
	
<?php include("footer.php");?>
