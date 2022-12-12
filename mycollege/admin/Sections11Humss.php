<?php  
session_start();
error_reporting(0);
include('includes/dbconnection.php');


$key = 'jmnants';


function encryptthis($data, $key) {
  $encryption_key = base64_decode($key);
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

    if(isset($_GET['delid']))
  {
    $uid=$_GET['delid'];
    $query=mysqli_query($con,"delete tbluser,tbldocument,tbladmapplications from tbluser
left join tbladmapplications on tbladmapplications.UserId=tbluser.ID
left join tbldocument on tbldocument.UserID=tbluser.ID
where tbluser.ID='$uid'");
    echo "<script>alert('Record Deleted successfully');</script>";
    echo "<script>window.location.href='user-detail.php'</script>";
  }

?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>

  <title>MARTMHS || User Detail</title>
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
  <!--11-A-->
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">
           Grade 11 HUMSS - A
          </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
                </li>
                <li class="breadcrumb-item active">List of students
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
<table class="table mb-0">
 <thead>
                <tr>
                  <th>S.NO</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Mobile Number</th>
                  <th>Email</th>
                   <th>Action</th>
                </tr>
              </thead>
              <?php
            $ret=mysqli_query($con,"select tbldocument.ID as docid,tbladmapplications.CourseApplied,tbladmapplications.ID as apid,tbladmapplications.AdminStatus, tbluser.FirstName,tbluser.LastName,
            tbluser.MobileNumber,tbluser.Email from  tbladmapplications inner join tbluser on tbluser.ID=tbladmapplications.UserId  left join 
            tbldocument on tbldocument.UserId=tbladmapplications.UserID where tbladmapplications.Section='HUMSS 11-A'");
            $cnt=1;
            while ($row=mysqli_fetch_array($ret)) {
            ?>
                <tr>
                  <td><?php echo $cnt;?></td>
                  <td><?php  echo decryptthis($row['FirstName'], $key);?></td>
                  <td><?php  echo decryptthis($row['LastName'], $key);?></td>
                  <td><?php  echo $row['MobileNumber'];?></td>
                  <td><?php  echo $row['Email'];?> </td>
                  <td><a href="edit-userdetail.php?udid=<?php echo $row['ID'];?>" title="Edit user details"><i class="la la-edit"></i></a>
                      <a href="user-detail.php?delid=<?php echo $row['ID'];?>" onclick="return confirm('All details related to this user will be deleted.(E.g Application form , document and profile)');" style="color:red"><i class="la la-trash"></i></a>
                </tr>
                <?php 
            $cnt=$cnt+1;
                  }?>
</table>
</div>
      </div>
      </div>
<!--11-B-->
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">
           Grade 11 HUMSS - B
          </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
                </li>
                <li class="breadcrumb-item active">List of students
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
<table class="table mb-0">
 <thead>
                <tr>
                  <th>S.NO</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Mobile Number</th>
                  <th>Email</th>
                   <th>Action</th>
                </tr>
              </thead>
              <?php
            $ret=mysqli_query($con,"select tbldocument.ID as docid,tbladmapplications.CourseApplied,tbladmapplications.ID as apid,tbladmapplications.AdminStatus, tbluser.FirstName,tbluser.LastName,
            tbluser.MobileNumber,tbluser.Email from  tbladmapplications inner join tbluser on tbluser.ID=tbladmapplications.UserId  left join 
            tbldocument on tbldocument.UserId=tbladmapplications.UserID where tbladmapplications.Section='HUMSS 11-B'");
            $cnt=1;
            while ($row=mysqli_fetch_array($ret)) {
            ?>
                <tr>
                  <td><?php echo $cnt;?></td>
                  <td><?php  echo decryptthis($row['FirstName'], $key);?></td>
                  <td><?php  echo decryptthis($row['LastName'], $key);?></td>
                  <td><?php  echo $row['MobileNumber'];?></td>
                  <td><?php  echo $row['Email'];?> </td>
                  <td><a href="edit-userdetail.php?udid=<?php echo $row['ID'];?>" title="Edit user details"><i class="la la-edit"></i></a>
                      <a href="user-detail.php?delid=<?php echo $row['ID'];?>" onclick="return confirm('All details related to this user will be deleted.(E.g Application form , document and profile)');" style="color:red"><i class="la la-trash"></i></a>
                </tr>
                <?php 
            $cnt=$cnt+1;
                  }?>
</table>
</div>
      </div>
      </div>
<!--11-C-->
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">
           Grade 11 HUMSS - C
          </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
                </li>
                <li class="breadcrumb-item active">List of students
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
<table class="table mb-0">
 <thead>
                <tr>
                  <th>S.NO</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Mobile Number</th>
                  <th>Email</th>
                   <th>Action</th>
                </tr>
              </thead>
              <?php
            $ret=mysqli_query($con,"select tbldocument.ID as docid,tbladmapplications.CourseApplied,tbladmapplications.ID as apid,tbladmapplications.AdminStatus, tbluser.FirstName,tbluser.LastName,
            tbluser.MobileNumber,tbluser.Email from  tbladmapplications inner join tbluser on tbluser.ID=tbladmapplications.UserId  left join 
            tbldocument on tbldocument.UserId=tbladmapplications.UserID where tbladmapplications.Section='HUMSS 11-C'");
            $cnt=1;
            while ($row=mysqli_fetch_array($ret)) {
            ?>
                <tr>
                  <td><?php echo $cnt;?></td>
                  <td><?php  echo decryptthis($row['FirstName'], $key);?></td>
                  <td><?php  echo decryptthis($row['LastName'], $key);?></td>
                  <td><?php  echo $row['MobileNumber'];?></td>
                  <td><?php  echo $row['Email'];?> </td>
                  <td><a href="edit-userdetail.php?udid=<?php echo $row['ID'];?>" title="Edit user details"><i class="la la-edit"></i></a>
                      <a href="user-detail.php?delid=<?php echo $row['ID'];?>" onclick="return confirm('All details related to this user will be deleted.(E.g Application form , document and profile)');" style="color:red"><i class="la la-trash"></i></a>
                </tr>
                <?php 
            $cnt=$cnt+1;
                  }?>
</table>
</div>
      </div>
      </div>
<!--11-D -->
<div class="app-content content">
    <div class="content-wrapper">
      <div class="content-header row">
        <div class="content-header-left col-md-6 col-12 mb-2 breadcrumb-new">
          <h3 class="content-header-title mb-0 d-inline-block">
           Grade 11 HUMSS - D
          </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
               <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
                </li>
                <li class="breadcrumb-item active">List of students
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
<table class="table mb-0">
 <thead>
                <tr>
                  <th>S.NO</th>
                  <th>First Name</th>
                  <th>Last Name</th>
                  <th>Mobile Number</th>
                  <th>Email</th>
                   <th>Action</th>
                </tr>
              </thead>
              <?php
            $ret=mysqli_query($con,"select tbldocument.ID as docid,tbladmapplications.CourseApplied,tbladmapplications.ID as apid,tbladmapplications.AdminStatus, tbluser.FirstName,tbluser.LastName,
            tbluser.MobileNumber,tbluser.Email from  tbladmapplications inner join tbluser on tbluser.ID=tbladmapplications.UserId  left join 
            tbldocument on tbldocument.UserId=tbladmapplications.UserID where tbladmapplications.Section='HUMSS 11-D'");
            $cnt=1;
            while ($row=mysqli_fetch_array($ret)) {
            ?>
                <tr>
                  <td><?php echo $cnt;?></td>
                  <td><?php  echo decryptthis($row['FirstName'], $key);?></td>
                  <td><?php  echo decryptthis($row['LastName'], $key);?></td>
                  <td><?php  echo $row['MobileNumber'];?></td>
                  <td><?php  echo $row['Email'];?> </td>
                  <td><a href="edit-userdetail.php?udid=<?php echo $row['ID'];?>" title="Edit user details"><i class="la la-edit"></i></a>
                      <a href="user-detail.php?delid=<?php echo $row['ID'];?>" onclick="return confirm('All details related to this user will be deleted.(E.g Application form , document and profile)');" style="color:red"><i class="la la-trash"></i></a>
                </tr>
                <?php 
            $cnt=$cnt+1;
                  }?>
</table>
</div>
      </div>
      </div>
    
  <!-- ////////////////////////////////////////////////////////////////////////////-->
<?php include('includes/footer.php');?>
  <!-- BEGIN VENDOR JS-->
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
