<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['uid']==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
    $uid=$_SESSION['uid'];
    $coursename=$_POST['coursename'];
    $lrn=$_POST['lrn'];
    $fathername=$_POST['fathername'];
    $mothername=$_POST['mothername'];
    $dob=$_POST['dob'];
    $nationality=$_POST['nationality'];
    $gender=$_POST['gender'];
    $category=$_POST['category'];
    $coradd=$_POST['coradd'];
    $peradd=$_POST['peradd'];
    $average=$_POST['average'];
    $secboard=$_POST['10thboard'];
    $secyop=$_POST['10thpyear'];
    $secper=$_POST['10thpercentage'];
    $ssecboard=$_POST['12thboard'];
    $ssecyop=$_POST['12thpyear'];
    $ssecper=$_POST['12thpercentage'];
    $grauni=$_POST['graduation'];
    $grayop=$_POST['graduationpyeaer'];
    $graper=$_POST['graduationpercentage'];
    $dec=$_POST['declaration'];
    $sign=$_POST['signature'];
    $upic=$_FILES["userpic"]["name"];
$extension = substr($upic,strlen($upic)-4,strlen($upic));
$allowed_extensions = array(".jpg","jpeg",".png",".gif");
if(!in_array($extension,$allowed_extensions))
{
echo "<script>alert('Invalid format. Only jpg / jpeg/ png /gif format allowed');</script>";
}
else
{
$userpic=md5($upic).$extension;
     move_uploaded_file($_FILES["userpic"]["tmp_name"],"userimages/".$userpic);
    $query=mysqli_query($con,"insert into tbladmapplications(UserId,CourseApplied,LRN,FatherName,MotherName,DOB,Nationality,Gender,Category,CorrespondenceAdd,PermanentAdd,average,SSchoolAttended,SYear,SGradeAttended,FSchoolAttended,FYear,FGradeAttended,CSchoolAttended,CYear,CGradeAttended,Signature,UserPic) value('$uid','$coursename','$lrn','$fathername','$mothername','$dob','$nationality','$gender','$category','$coradd','$peradd','$average','$secboard','$secyop','$secper','$ssecboard','$ssecyop','$ssecper','$grauni','$grayop','$graper','$sign','$userpic')");
    if ($query) {
    echo '<script>alert("Data has been added successfully.")</script>';
    echo "<script>window.location.href ='addmission-form.php'</script>";
  }
  else
    {
     echo '<script>alert("Something Went Wrong. Please try again.")</script>';
         echo "<script>window.location.href ='addmission-form.php'</script>";
    }
}
}
  ?>
<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<head>
  <title>MRTHS || Admission Form</title>
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
           Admission Form
          </h3>
          <div class="row breadcrumbs-top d-inline-block">
            <div class="breadcrumb-wrapper col-12">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a>
                </li>
            
                </li>
                <li class="breadcrumb-item active">Application
                </li>
              </ol>
            </div>
          </div>
        </div>
      </div>
      <div class="content-body">
<?php 
$stuid=$_SESSION['uid'];
$query=mysqli_query($con,"select * from tbladmapplications where  UserId=$stuid");
$rw=mysqli_num_rows($query);
if($rw>0)
{
while($row=mysqli_fetch_array($query)){
?>
<p style="font-size:16px; color:red" align="center">Your Addmission Form already submitted.</p>
<table class="table mb-0">
<tr>
  <th>Course Applied</th>
  <td><?php echo $row['CourseApplied'];?></td>
</tr>
<tr>
  <th>LRN</th>
  <td><?php echo $row['LRN'];?></td>
</tr>
<tr>
  <th>Student Pic</th>
  <td><img src="userimages/<?php echo $row['UserPic'];?>" width="200" height="150"></td>
</tr>
<tr>
  <th>Father's Name</th>
  <td><?php echo $row['FatherName'];?></td>
</tr>
<tr>
  <th>Mother's Name</th>
  <td><?php echo $row['MotherName'];?></td>
</tr>
<tr>
  <th>DOB</th>
  <td><?php echo $row['DOB'];?></td>
</tr>
<tr>
  <th>Nationality</th>
  <td><?php echo $row['Nationality'];?></td>
</tr>
<tr>
  <th>Gender</th>
  <td><?php echo $row['Gender'];?></td>
</tr>
<tr>
  <th>Category</th>
  <td><?php echo $row['Category'];?></td>
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
  <td> <?php echo $row['average'];?> </td>
</tr>
</table>
<table class="table mb-0">
<tr>
  <th>#</th>
   <th>School Attended</th>
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
  <th>Current Level</th>
  <td><?php echo $row['CSchoolAttended'];?></td>
  <td><?php echo $row['CYear'];?></td>
  <td><?php echo $row['CGradeAttended'];?></td>
</tr>
</table>
<table class="table mb-0">
<tr>
  <th>Admin Remark</th>
  <td><?php echo $row['AdminRemark'];?></td>
</tr>
<tr>
  <th>Admin Status</th>
 <td><?php 
if($row['AdminStatus']==""){
echo "admin remark is pending";
} 

 if($row['AdminStatus']=="1"){
  echo "Selected";
}
    
if($row['AdminStatus']=="2"){
  echo "Rejected";
}
                    ?></td>
</tr>
<tr>
  <th>Admin Remark Date</th>
  <td><?php echo $row['AdminRemarkDate'];?></td>
</tr>
  <tr>
    <th colspan="2"><font color="red">Declaration : </font>I hereby state that the facts mentioned above are true to the best of my knowledge and belief.<br />
(<?php  echo $row['Signature'];?>)
    </th>
  </tr>
</table>
<br>
<?php 
if ($row['AdminStatus']==""){
?>
<p style="text-align: center;font-size: 20px;"><a href="edit-appform.php?editid=<?php echo $row['ID'];?>">Edit Details</a></p>
<?php }} } else { ?>
<form name="submit" method="post" enctype="multipart/form-data">        
        <section class="formatter" id="formatter">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h4 class="card-title">Admission Form</h4>
                  <div class="heading-elements">
                    <ul class="list-inline mb-0">
                      <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                      <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                    </ul>
                  </div>
                </div>
                <div class="card-content">
                  <div class="card-body">
<div class="row">
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Grade Level </h5>
   <div class="form-group">
   <select name='coursename' id="coursename" class="form-control white_bg" required="true">
     <option value="">Grade Level</option>
      <?php $query=mysqli_query($con,"select * from tblgradelevels");
              while($row=mysqli_fetch_array($query))
              {
              ?>    
              <option value="<?php echo $row['CourseName'];?>"><?php echo $row['CourseName'];?></option>
                  <?php } ?>  
   </select>
    </div>
</fieldset>
</div>
<div class="col-xl-6 col-lg-12">
  <fieldset>
    <h5>LRN</h5>
    <div class="form-group">
      <input class="form-control white_bg" id="lrn" name="lrn" type="text" required>
    </div>
  </fieldset>
</div>
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Student Pic                   </h5>
   <div class="form-group">
    <input class="form-control white_bg" id="userpic" name="userpic"  type="file" required>
    </div>
</fieldset>                  
</div>
 </div>               
 <div class="row">
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Father's Name                   </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="fathername" name="fathername"  type="text" required>
    </div>
</fieldset>               
</div>
<div class="col-xl-6 col-lg-12">
 <fieldset>
  <h5>Mother's Name                 </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="mothername" name="mothername"  type="text" required>
                          </div>
                        </fieldset>
                      </div>
                    </div>
<div class="row">
<div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Date of Birth</h5>
   <div class="form-group">
   <input class="form-control white_bg" id="dob" name="dob"  type="date" required>
          <small class="text-muted"></small>
    </div>
</fieldset>                  
</div>
<div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Nationality                </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="nationality" name="nationality"  type="text" required>
                          </div>
                        </fieldset>
                      </div>
<div class="col-xl-4 col-lg-12">
 <fieldset>
  <h5>Gender                </h5>
   <div class="form-group">
   <select class="form-control white_bg" id="gender" name="gender"  required>
    <option value="">Select</option>
<option value="Male">Male</option>
<option value="Female">Female</option>
<option value="Transgender">Transgender</option>
   </select>
                          </div>
                        </fieldset>
                      </div>
                    </div>
<div class="row">
  <div class="col-xl-12 col-lg-12">
    <h5>Category : </h5>
<select class="form-control white_bg" id="category" name="category"  required>
    <option value="">Select Category</option>
<option value="Old Student">Old Student</option>
<option value="New Student">New Student</option>
<option value="Transferee">Transferee</option>
   </select>
  </div>
</div>
<div class="row" style="margin-top:1%">
  <div class="col-xl-12 col-lg-12">
    <fieldset>
  <h5>Correspondence Address                  </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="coradd" name="coradd"  type="text" required>
    </div>
</fieldset>
  </div>
</div>
<div class="row">
  <div class="col-xl-12 col-lg-12">
    <fieldset>
  <h5>Permanent Address                  </h5>
   <div class="form-group">
   <input class="form-control white_bg" id="peradd" name="peradd"  type="text" required>
    </div>
</fieldset>
  </div>
</div>
<div class="row">
  <div class="col-xl-12 col-lg-12">
    <fieldset>
      <h5> Last School year Average </h5>
      <div class="form-group">
        <input class="form-control white_bg" id="average" name="average" type="text" required>
      </div>
    </fieldset>
  </div>
</div>
<div class="row" style="margin-top: 2%">
  <div class="col-xl-12 col-lg-12"><h4 class="card-title">Education Qualification</h4>
  <p>Note: If you have attended at least 2 schools when you are in Elementary, please input where you started and where you finished your Primary school. If you only attended 1 school, put N/A for the "Elementary (started)" row and only fill up the "Elementary (finished)"
<hr />
  </div>
</div>
<div class="row">
<div class="col-xl-12 col-lg-12">
<table class="table mb-0">
<tr>
  <th>#</th>
   <th>School Attended</th>
    <th> Year </th>
     <th>Grade Attended</th>
</tr>
<tr>
<th>Elementary (started)</th>
<td>   <input class="form-control white_bg" id="10thboard" name="10thboard" placeholder="School Attended"  type="text" required></td>
<td>   <input class="form-control white_bg" id="10thpyeaer" name="10thpyear" placeholder="Year"  type="text" required></td>
<td>   <input class="form-control white_bg" id="10thpercentage" name="10thpercentage" placeholder="Grade Attended"  type="text" required></td>
</tr>
<tr>
<th>Elementary (Finished)</th>
<td>   <input class="form-control white_bg" id="12thboard" name="12thboard" placeholder="School Attended"  type="text" required></td>
<td>   <input class="form-control white_bg" id="12thboard" name="12thpyear" placeholder="Year"  type="text" required></td>
<td>   <input class="form-control white_bg" id="12thpercentage" name="12thpercentage" placeholder="Grade Attended"  type="text" required></td>
</tr>
<tr>
<th>Current Grade Level</th>
<td>   <input class="form-control white_bg" id="graduation" name="graduation" placeholder="School Attended"  type="text"></td>
<td>   <input class="form-control white_bg" id="graduationpyeaer" name="graduationpyeaer" placeholder="Year"  type="text"></td>
<td>   <input class="form-control white_bg" id="graduationpercentage" name="graduationpercentage" placeholder="Grade Attended"  type="text"></td>
</tr>
</table>
</div>
</div>
</hr>
<div class="row" style="margin-top: 2%">
<div class="col-xl-12 col-lg-12"><h4 class="card-title"><b>Declaration</b></h4> <hr />
</div>
</div>
 <div class="row">
<div class="col-xl-12 col-lg-12">
<h5><b>I hereby state that the facts mentioned above are true to the best of my knowledge and belief.</b></h5>
 </div>
 </div>               
<div class="row"> 
<div class="col-xl-4 col-lg-12">
<fieldset>
 <input class="form-control white_bg" id="signature" name="signature" placeholder="Signature"  type="text"> 
 </fieldset>  
</div>
</div>
<div class="row" style="margin-top: 2%">
<div class="col-xl-6 col-lg-12">
<button type="submit" name="submit" class="btn btn-info btn-min-width mr-1 mb-1">Submit</button>
</div>
</div>
 </div>
                </div>
              </div>
            </div>
          </div>
        </section>
        <?php } ?>
      </form>  
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