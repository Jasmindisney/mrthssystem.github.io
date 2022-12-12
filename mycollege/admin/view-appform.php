<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');

$key = 'jmnants';

function encryptthis($data, $key ) {
  $encryption_key = base64_decode($key );
  $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
  $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
  return base64_encode($encrypted . '::' . $iv);
}

function decryptthis($data, $key) {
  $encryption_key = base64_decode($key);
  list($encrypted_data, $iv) = array_pad(explode('::', base64_decode($data), 2),2,null);
  return openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
}

    if (strlen($_SESSION['aid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
$cid=$_GET['aticid'];
$admrmk=$_POST['AdminRemark'];
$admsta=$_POST['status'];
$section=$_POST['Section'];
$toemail=$_POST['useremail'];
$query=mysqli_query($con, "update  tbladmapplications set AdminRemark='$admrmk',AdminStatus='$admsta', Section='$section' where ID='$cid'");
if ($query) {
$subj="Admission Application Status";       
$heade .= "MIME-Version: 1.0"."\r\n";
$heade .= 'Content-type: text/html; charset=iso-8859-1'."\r\n";
$heade .= 'From:CAMS<noreply@yourdomain.com>'."\r\n";   
$msgec.="<html></body><div><div>Hello,</div></br></br>";
$msgec.="<div style='padding-top:8px;'>Your Admission application has been $$admsta ) </br>
<strong>Admin Remark: </strong> $admrmk </div><div></div></body></html>";
mail($toemail,$subj,$msgec,$heade);
echo "<script>alert('Admin Remark, Status, and Section has been updated.');</script>";
echo "<script>window.location.href ='pending-application.php'</script>";

}else{
   echo "<script>alert('Something Went Wrong. Please try again.');</script>";
   echo "<script>window.location.href ='pending-application.php'</script>";
    }

}

  ?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <title>MARTMHS || View Form</title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Quicksand:300,400,500,700"
  rel="stylesheet">
  <link href="https://maxcdn.icons8.com/fonts/line-awesome/1.1/css/line-awesome.min.css"
  rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="app-assets/css/vendors.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/app.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu-modern.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/core/colors/palette-gradient.css">
  <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/extended/form-extended.css">
  <link rel="stylesheet" type="text/css" href="assets/css/style.css">
     <style>
    .errorWrap {
    padding: 10px;
    margin: 20px 0 0px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
    </style>

</head>
<body class="vertical-layout vertical-menu-modern 2-columns   menu-expanded fixed-navbar"
data-open="click" data-menu="vertical-menu-modern" data-col="2-columns">
<?php include('includes/header.php');?>
<?php include('includes/leftbar.php');?>
  <div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">
           View Application Form
          </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
            
                </li>
                <li class="breadcrumb-item active">Application Form
                </li>
                
              </ol>
            </div>
          </div>
        </div>
   
      </div>
      <div class="content-body">
 
<?php
$cid=$_GET['aticid'];
$ret=mysqli_query($con,"select tbladmapplications.*,tbluser.FirstName,tbluser.LastName,tbluser.MobileNumber,tbluser.Email from  tbladmapplications inner join tbluser on tbluser.ID=tbladmapplications.UserId where tbladmapplications.ID='$cid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

<table border="1" class="table table-bordered mg-b-0">
<tr>
    <th>Course Applied date</th>
    <td><?php  echo $row['CourseApplieddate'];?></td>
  </tr>
   <tr>
    <th>Grade Level Applied</th>
    <td><?php  echo $row['CourseApplied'];?></td>
  </tr>
  <tr>
    <th>LRN</th>
    <td><?php echo $row['LRN'];?></td>
  </tr>
  <tr>
    <th>Student Fullname</th>
    <td><?php  echo decryptthis($row['FirstName'],$key)." ".decryptthis($row['LastName'], $key);?></td>
  </tr>

    <tr>
    <th>Student Mobile Number</th>
    <td><?php  echo $row['MobileNumber'];?></td>
  </tr>

    <tr>
    <th>Student Email</th>
    <td><?php  echo $row['Email'];?></td>
  </tr>

  <tr>
  <th>Student Pic</th>
  <td><img src="../user/userimages/<?php echo $row['UserPic'];?>" width="200" height="150"></td>
</tr>
<tr>
    <th>Father Name</th>
    <td><?php  echo $row['FatherName'];?></td>
  </tr>
  
  <tr>
    <th>Mother Name</th>
    <td><?php  echo $row['MotherName'];?></td>
  </tr>
  <tr>
    <th>Date of Birth</th>
    <td><?php  echo $row['DOB'];?></td>
  </tr>
  <tr>
    <th>Nationality</th>
    <td><?php  echo $row['Nationality'];?></td>
  </tr>
  <tr>
    <th>Gender</th>
    <td><?php  echo $row['Gender'];?></td>
  </tr>
  <tr>
    <th>Category</th>
    <td><?php  echo $row['Category'];?></td>
  </tr>
<tr>
  <th>Correspondence Address</th>
  <td><?php echo $row['CorrespondenceAdd'];?></td>
</tr>
<tr>
  <th>Permanent Address</th>
  <td><?php echo $row['PermanentAdd'];?></td>
</tr>
<tr>
  <th>Last School year Average </th>
  <td><?php echo $row['average'];?></td>
</tr>
</table>

  <table class="table mb-0">
<tr>
  <th>#</th>
   <th>School attended</th>
    <th>Year</th>
     <th>Grade Level attended</th>

</tr>

<th>Elementary (Started)</th>
  <td><?php echo $row['SSchoolAttended'];?></td>
  <td><?php echo $row['SYear'];?></td>
   <td><?php echo $row['SGradeAttended'];?></td>
</tr>
<tr>
  <th>Elementary (Finished)</th>
  <td><?php echo $row['FSchoolAttended'];?></td>
   <td><?php echo $row['FYear'];?></td>
   <td><?php echo $row['FGradeAttended'];?></td>
</tr>
<tr>
  <th>Current Grade Level</th>
  <td><?php echo $row['CSchoolAttended'];?></td>
  <td><?php echo $row['CYear'];?></td>
  <td><?php echo $row['CGradeAttended'];?></td>
</tr>

 <tr>
    <th colspan="2"><font color="red">Declaration : </font>I hereby state that the facts mentioned above are true to the best of my knowledge and belief.<br />
(<?php  echo $row['Signature'];?>)
    </th>
  </tr>
</table>
<table class="table mb-0">

<?php if($row['AdminRemark']==""){ ?>
<form name="submit" method="post" enctype="multipart/form-data"> 
<input type="hidden" name="useremail" value="<?php  echo $row['Email'];?>">
<tr>
    <th>Admin Remark :</th>
    <td>
    <textarea name="AdminRemark" placeholder="" rows="12" cols="14" class="form-control wd-450" required="true"></textarea></td>
  </tr>

  <tr>
    <th>Admin Status :</th>
    <td>
   <select name="status" class="form-control wd-450" required="true" >
     <option value="1" selected="true">Selected</option>
     <option value="2">Rejected</option>
   </select></td>
  </tr>
  <tr>
    <th>Section: </th>
    <td>
      <select name="Section" class="form-control wd-450" required="true">
        <option value="Matapat" selected="true">Matapat</option>
        <option value="Mahinahon" selected="true">Mahinahon</option>
        <option value="Magiting" selected="true">Magiting</option>
        <option value="Magalang" selected="true">Magalang</option>
        <option value="El-Nido" selected="true">El-Nido</option>
        <option value="Boracay" selected="true">Boracay</option>
        <option value="Batanes" selected="true">Batanes</option>
        <option value="Camiguin" selected="true">Camiguin</option>
        <option value="Malapascua" selected="true">Malapascua</option>
        <option value="Genesis" selected="true">Genesis</option>
        <option value="Exodus" selected="true">Exodus</option>
        <option value="Leviticus" selected="true">Leviticus</option>
        <option value="Numbers" selected="true">Numbers</option>
        <option value="Deuteronomy" selected="true">Deuteronomy</option>
        <option value="Joshua" selected="true">Joshua</option>
        <option value="Judges" selected="true">Judges</option>
        <option value="Ruth" selected="true">Ruth</option>
        <option value="Samuel" selected="true">Samuel</option>
        <option value="Rizal" selected="true">Rizal</option>
        <option value="Bonifacio" selected="true">Bonifacio</option>
        <option value="Luna" selected="true">Luna</option>
        <option value="Mabini" selected="true">Mabini</option>
        <option value="Del Pilar" selected="true">Del Pilar</option>
        <option value="Jaena" selected="true">Jaena</option>
        <option value="Jacinto" selected="true">Jacinto</option>
        <option value="De Jesus" selected="true">De Jesus</option>
        <option value="Dizon" selected="true">Dizon</option>
        <option value="Valenzuela" selected="true">Valenzuela</option>
        <option value="GAS 11-A" selected="true">GAS 11-A</option>
        <option value="GAS 11-B" selected="true">GAS 11-B</option>
        <option value="GAS 11-C" selected="true">GAS 11-C</option>
        <option value="HUMSS 11-A" selected="true">HUMSS 11-A</option>
        <option value="HUMSS 11-B" selected="true">HUMSS 11-B</option>
        <option value="HUMSS 11-C" selected="true">HUMSS 11-C</option>
        <option value="HUMSS 11-D" selected="true">HUMSS 11-D</option>
        <option value="TVL 11-A" selected="true">TVL 11-A</option>
        <option value="TVL 11-B" selected="true">TVL 11-B</option>
        <option value="GAS 12-A" selected="true">GAS 12-A</option>
        <option value="GAS 12-B" selected="true">GAS 12-B</option>
        <option value="GAS 12-C" selected="true">GAS 12-C</option>
        <option value="GAS 12-D" selected="true">GAS 12-D</option>
        <option value="HUMSS 12-A" selected="true">HUMSS 12-A</option>
        <option value="HUMSS 12-B" selected="true">HUMSS 12-B</option>
        <option value="HUMSS 12-C" selected="true">HUMSS 12-C</option>
        <option value="TVL 12-A" selected="true">TVL 12-A</option>
        <option value="TVL 12-B" selected="true">TVL 12-B</option>
      </select>
    </td>
  </tr>
  <tr align="center">
    <td colspan="2"><button type="submit" name="submit" class="btn btn-primary">Update</button></td>
  </tr>
  </form>
<?php } else { ?>

<tr>
    <th>Admin Remark</th>
    <td><?php echo $row['AdminRemark']; ?></td>
  </tr>


<tr>
<th>Admin Remark date</th>
<td><?php echo $row['AdminRemarkDate']; ?>  </td>

<tr>
    <th>Admin Status</th>
    <td><?php  
if($row['AdminStatus']=="1")
{
  echo "Selected";
}

if($row['AdminStatus']=="2")
{
  echo "Rejected";
}

     ;?></td>
  </tr>
  <tr>
    <th>Section</th>
    <td><?php
    if ($row['Section']=="Matapat")
    {
      echo"Matapat";
    }
    if ($row['Section']=="Mahinahon")
    {
      echo "Mahinahon";
    }
    if ($row['Section']=="Magalang")
    {
      echo "Magalang";
    }
    if ($row['Section']=="Magiting")
    {
      echo "Magiting";
    }
    if ($row['Section']=="El-Nido")
    {
      echo "El-Nido";
    }
    if ($row['Section']=="Boracay")
    {
      echo "Boracay";
    }
    if ($row['Section']=="Batanes")
    {
      echo "Batanes";
    }
    if ($row['Section']=="Camiguin")
    {
      echo "Camiguin";
    }
    if ($row['Section']=="Malapascua")
    {
      echo "Malapascua";
    }
    if ($row['Section']=="Genesis")
    {
      echo "Genesis";
    }
    if ($row['Section']=="Exodus")
    {
      echo "Exodus";
    }
    if ($row['Section']=="Leviticus")
    {
      echo "Leviticus";
    }
    if ($row['Section']=="Numbers")
    {
      echo "Numbers";
    }
    if ($row['Section']=="Deuteronomy")
    {
      echo "Deuteronomy";
    }
    if ($row['Section']=="Joshua")
    {
      echo "Joshua";
    }
    if ($row['Section']=="Judges")
    {
      echo "Judges";
    }
    if ($row['Section']=="Ruth")
    {
      echo "Ruth";
    }
    if ($row['Section']=="Samuel")
    {
      echo "Samuel";
    }
    if ($row['Section']=="Rizal")
    {
      echo "Rizal";
    }
    if ($row['Section']=="Bonifacio")
    {
      echo "Bonifacio";
    }
    if ($row['Section']=="Luna")
    {
      echo "Luna";
    }
    if ($row['Section']=="Mabini")
    {
      echo "Mabini";
    }
    if ($row['Section']=="Del Pilar")
    {
      echo "Del Pilar";
    }
    if ($row['Section']=="Jaena")
    {
      echo "Jacinto";
    }
    if ($row['Section']=="De Jesus")
    {
      echo "De Jesus";
    }
    if ($row['Section']=="Dizon")
    {
      echo "Dizon";
    }
    if ($row['Section']=="Valenzuela")
    {
      echo "Valenzuela";
    }
    if ($row['Section']=="GAS 11-A")
    {
      echo "GAS 11-A";
    }
    if ($row['Section']=="GAS 11-B")
    {
      echo "GAS 11-B";
    }
    if ($row['Section']=="GAS 11-C")
    {
      echo "GAS 11-C";
    }
    if ($row['Section']=="HUMSS 11-A")
    {
      echo "HUMSS 11-A";
    }
    if ($row['Section']=="HUMSS 11-B")
    {
      echo "HUMSS 11-B";
    }
    if ($row['Section']=="HUMSS 11-C")
    {
      echo "HUMSS 11-C";
    }
    if ($row['Section']=="HUMSS 11-D")
    {
      echo "HUMSS 11-D";
    }
    if ($row['Section']=="TVL 11-A")
    {
      echo "TVL 11-A";
    }
    if ($row['Section']=="TVL 11-B")
    {
      echo "TVL 11-B";
    }
    if ($row['Section']=="GAS 12-A")
    {
      echo "GAS 12-A";
    }
    if ($row['Section']=="GAS 12-B")
    {
      echo "GAS 12-B";
    }
    if ($row['Section']=="GAS 12-C")
    {
      echo "GAS 12-C";
    }
    if ($row['Section']=="GAS 12-D")
    {
      echo "GAS 12-D";
    }
    if ($row['Section']=="HUMSS 12-A")
    {
      echo "HUMSS 12-A";
    }
    if ($row['Section']=="HUMSS 12-B")
    {
      echo "HUMSS 12-B";
    }
    if ($row['Section']=="HUMSS 12-C")
    {
      echo "HUMSS 12-C";
    }
    if ($row['Section']=="TVL 12-A")
    {
      echo "TVL 12-A";
    }
    if ($row['Section']=="TVL 12-B")
    {
      echo "TVL 12-B";
    }


    ;?></td>
  </tr>
  </tr>

  <?php } ?>
 
</table>

<?php } ?>
<div class="row" style="margin-top: 2%">
<div class="col-xl-6 col-lg-12">
</div>
</div>

 </div>
                </div>
              </div>
            
     

<?php include('includes/footer.php');?>
  <script src="app-assets/vendors/js/vendors.min.js" type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/typeahead/typeahead.bundle.min.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/typeahead/bloodhound.min.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/typeahead/handlebars.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/inputmask/jquery.inputmask.bundle.min.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/formatter/formatter.min.js"
  type="text/javascript"></script>
  <script src="../../../app-assets/vendors/js/forms/extended/maxlength/bootstrap-maxlength.js"
  type="text/javascript"></script>
  <script src="app-assets/vendors/js/forms/extended/card/jquery.card.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app-menu.js" type="text/javascript"></script>
  <script src="app-assets/js/core/app.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/customizer.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/forms/extended/form-typeahead.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/forms/extended/form-inputmask.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/forms/extended/form-formatter.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/forms/extended/form-maxlength.js" type="text/javascript"></script>
  <script src="app-assets/js/scripts/forms/extended/form-card.js" type="text/javascript"></script>

</body>
</html>
<?php  } ?>
