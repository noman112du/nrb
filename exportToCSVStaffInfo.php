<?php
    // Database Connection file
    include('config.php');
    $branch_name = $_SESSION["branch_name"];
?>

<center><h2>Staff Information as on 31/03/2020</h2></center><br>
<h3><?php echo ($_SESSION['branch_name']); ?></h3>
<table border="1">
    <thead>  
        <tr>
            <th>ক্রমিক নং</th>
            <th>ব্যক্তিগত নং</th>
            <th>কর্মকর্তা/কর্মচারীর নাম</th>
            <th>পিতার নাম</th>
            <th>বর্তমান কর্মস্থল</th>
            <th>বর্তমান কর্মস্থলে যোগদানের তারিখ</th>
            <th>পদবী/দায়িত্ব</th>
            <th>ডেস্কের কাজের বিবরন</th>
            <th>চাকুরীতে যোগদানকৃত পদবী</th>
            <th>চাকুরীতে যোগদানের তারিখ</th>
            <th>শিক্ষাগত যোগ্যতা</th>
            <th>অনার্স/মাস্টার্স এর বিষয়</th>
            <th>কলেজ/বিশ্ববিদ্যালয়</th>
            <th>আইবিবি ১/২</th>
            <th>অন্যান্য যোগ্যতা (এলএলবি ইটিসি.)</th>
            <th>জন্ম তারিখ</th>
            <th>সর্বশেষ পদোন্নতির তারিখ</th>
            <th>মূল বেতন</th>
            <th>নিজ জেলা</th>
            <th>মন্তব্য (পদত্যাগ, ব্যাখ্যা তলব ইত্যাদি স্থান ও তারিখ)</th>
            <th>মোবাইল নম্বর</th>
        </tr>
    </thead>
<?php
// File name
$filename = "staffInformation";
// Fetching data from data base
$query = mysqli_query($conn,"select * from staff_info");
$cnt = "1";
while ($row=mysqli_fetch_array($query)) {

?>
        <tr>
            <td><?php echo $cnt;  ?></td>
            <td><?php echo $row['personnel_no'];?></td>
            <td><?php echo $row['personnel_name'];?></td>
            <td><?php echo $row['personnel_father_name'];?></td>
            <td><?php echo $row['present_workplace'];?></td>
            <td><?php echo $row['joining_date_tothis_branch'];?></td>
            <td><?php echo $row['designation'];?></td>
            <td><?php echo $row['responsibility'];?></td>
            <td><?php echo $row['joining_designation'];?></td>
            <td><?php echo $row['joining_date'];?></td>
            <td><?php echo $row['education'];?></td>
            <td><?php echo $row['subject'];?></td>
            <td><?php echo $row['university'];?></td>
            <td><?php echo $row['ibb_diploma'];?></td>
            <td><?php echo $row['other_qualification'];?></td>
            <td><?php echo $row['birth_date'];?></td>
            <td><?php echo $row['last_promotion_date'];?></td>
            <td><?php echo $row['present_basic'];?></td>
            <td><?php echo $row['district'];?></td>
            <td><?php echo $row['remarks'];?></td>
            <td><?php echo $row['personnel_mobile_no'];?></td>
        </tr>
<?php 
$cnt++;
// Genrating Execel  filess
//header("Content-type: application/octet-stream");
//header("Content-Disposition: attachment; filename=".$filename.".xls");
//header("Pragma: no-cache");
//header("Expires: 0");
} ?>
</table>