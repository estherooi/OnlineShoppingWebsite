<?php

include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//Create
if (isset($_POST['create'])) {

  if ($_SESSION['userlevel'] == "Admin") {

  if($_POST['cpassword']==$_POST['staffpassword']){
    try {

      $stmt = $conn->prepare("INSERT INTO tbl_staff_a165936_pt2(fld_staff_num, fld_staff_name,fld_staff_password,
        fld_staff_gender, fld_staff_phone, fld_staff_email,  fld_staff_level ) VALUES(:sid, :name, :staffpassword, :gender, :phone, :email,  :stafflevel)");

      $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
      $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
      $stmt->bindParam(':email', $email, PDO::PARAM_STR);
      $stmt->bindParam(':staffpassword', $staffpassword, PDO::PARAM_STR);
      $stmt->bindParam(':stafflevel', $stafflevel, PDO::PARAM_STR);

      $sid = $_POST['sid'];
      $name = $_POST['name'];
      $gender =  $_POST['gender'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $staffpassword = $_POST['staffpassword'];
      $stafflevel = $_POST['stafflevel'];


      $stmt->execute();
    }

    catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
    }

  }else{
    $message="You enter the wrong re-confirm password";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href='staffs.php';";
    echo "</script>";
  }
   }else{
   $message="You have no access to CREATE staff";
   echo "<script type='text/javascript'>alert('$message');";
   echo "window.location.href='staffs.php';";
   echo "</script>";
 }
}


//Update
if (isset($_POST['update'])) {
  if ($_SESSION['userlevel'] == "Normal Staff"){

   $message="You have no access to UPDATE staff";
   echo "<script type='text/javascript'>alert('$message');";
   echo "window.location.href='staffs.php';";
   echo "</script>";
 }else {

 if($_POST['cpassword']==$_POST['staffpassword']){
  try {

    $stmt = $conn->prepare("UPDATE tbl_staff_a165936_pt2 SET
      fld_staff_num = :sid, 
      fld_staff_name = :name, 
      fld_staff_password = :staffpassword,  
      fld_staff_gender = :gender,
      fld_staff_phone = :phone, 
      fld_staff_email = :email,  
      fld_staff_level = :stafflevel
      WHERE fld_staff_num = :oldsid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    $stmt->bindParam(':gender', $gender, PDO::PARAM_STR);
    $stmt->bindParam(':phone', $phone, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':staffpassword', $staffpassword, PDO::PARAM_STR);
    $stmt->bindParam(':stafflevel', $stafflevel, PDO::PARAM_STR);
    $stmt->bindParam(':oldsid', $oldsid, PDO::PARAM_STR);

    $sid = $_POST['sid'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $staffpassword = $_POST['staffpassword'];
    $stafflevel = $_POST['stafflevel'];
    $oldsid = $_POST['oldsid'];

    $stmt->execute();
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
}else{
  $message="You enter the wrong re-confirm password";
  echo "<script type='text/javascript'>alert('$message');";
  echo "window.location.href='staffs.php';";
  echo "</script>";
}
 
 }
}

//Delete
if (isset($_GET['delete'])) {

    if ($_SESSION['userlevel'] == "Admin" ){


  try {

    $stmt = $conn->prepare("DELETE FROM tbl_staff_a165936_pt2 where fld_staff_num = :sid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

    $sid = $_GET['delete'];

    $stmt->execute();

    header("Location: staffs.php");
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
  }else{
   $message="You have no access to DELETE staff";
   echo "<script type='text/javascript'>alert('$message');";
   echo "window.location.href='staffs.php';";
   echo "</script>";
 }
}

//Edit
if (isset($_GET['edit'])) {

  if ($_SESSION['userlevel'] == "Normal Staff"){
    $message="You have no access to EDIT staff";
   echo "<script type='text/javascript'>alert('$message');";
   echo "window.location.href='staffs.php';";
   echo "</script>";
 }else {

  try {

    $stmt = $conn->prepare("SELECT * FROM tbl_staff_a165936_pt2 where fld_staff_num = :sid");

    $stmt->bindParam(':sid', $sid, PDO::PARAM_STR);

    $sid = $_GET['edit'];

    $stmt->execute();

    $editrow = $stmt->fetch(PDO::FETCH_ASSOC);
  }

  catch(PDOException $e)
  {
    echo "Error: " . $e->getMessage();
  }
   
 }
}

$conn = null;

?>