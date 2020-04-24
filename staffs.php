<?php

//start session 
session_start();
include_once 'staffs_crud.php';



if (is_null($_SESSION['username'])){
    //redirect to home page
  header("Location:login.php");
}

?>

<!DOCTYPE html>
<html>

  <style>
body {
   background-image: url('background-floral.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title>My Bed Linen Ordering System : Staffs</title>
 <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
 <?php include_once 'nav_bar.php'; ?>
 
 <div class="container-fluid">
  <div class="row">
    <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
      <div class="page-header">
        <h2>Create New Staff</h2>
      </div>
      <form action="staffs.php" method="post" class="form-horizontal">
        <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">Staff ID</label>
          <div class="col-sm-9">
            <input name="sid" type="text" class="form-control" id="staffid" placeholder="Staff ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_num']; ?>" required> 
          </div>
        </div>

        <div class="form-group">
          <label for="staffid" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-9">
            <input name="name" type="text" class="form-control" id="staffname" placeholder="Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_name']; ?>" required> 
          </div>
        </div>

        <div class="form-group">
          <label for="passwordid" class="col-sm-3 control-label">Password</label>
          <div class="col-sm-9">
            <input name="staffpassword" type="password" class="form-control" id="staffpassword" placeholder="Password" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_password']; ?>" required> 
          </div>
        </div>

        <div class="form-group">
          <label for="cpassword" class="col-sm-3 control-label">Confirm Password</label>
          <div class="col-sm-9">
            <input name="cpassword" type="password" class="form-control" id="confirmpassword" placeholder="Confirm Password" required> 
          </div>
        </div>

        

        <div class="form-group">
          <label for="productcond" class="col-sm-3 control-label">Gender</label>
          <div class="col-sm-9">
            <div class="radio">
              <label>
                <input name="gender" type="radio" value="Male" required="" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Male") echo "checked"; ?>> Male
               
              </label>
            </div>
            <div class="radio">
              <label>
                   <input name="gender" type="radio" value="Female" required="" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_gender']=="Female") echo "checked"; ?>> Female

              </label>
            </div>
          </div>
        </div>
        <div class="form-group">
          <label for="phone" class="col-sm-3 control-label">Phone</label>
          <div class="col-sm-9">
            <input name="phone" type="text" class="form-control" id="phonenumber" placeholder="Phone Number" value="  <?php if(isset($_GET['edit'])) echo $editrow['fld_staff_phone']; ?>"required> 
          </div>
        </div>

        <div class="form-group">
          <label for="email" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-9">
            <input name="email" type="text" class="form-control" id="email" placeholder="Email" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_staff_email']; ?>"required> 
          </div>
        </div>

        <div class="form-group">
          <label for="stafflevel" class="col-sm-3 control-label">Staff Level</label>
          <div class="col-sm-9">
           <select name="stafflevel" class="form-control" id="stafflevel" required="">
            <option value="">Please select</option>
            <option value="Normal Staff" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="Normal Staff") echo "selected"; ?>>Normal Staff</option>
            <option value="Supervisor" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="Supervisor") echo "selected"; ?>>Supervisor</option>
            <option value="Admin" <?php if(isset($_GET['edit'])) if($editrow['fld_staff_level']=="Admin") echo "selected"; ?>>Admin</option>
          </select> 
        </div>
      </div>

      <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
          <?php if (isset($_GET['edit'])) { ?>
            <input type="hidden" name="oldsid" value="<?php echo $editrow['fld_staff_num']; ?>">
            <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
          <?php } else { ?>
            <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
          <?php } ?>
          <button class="btn btn-default" type="reset"><span class="glyphicon glyphicon-erase" aria-hidden="true"></span>Clear</button>
        </div>
      </div>     
    </form>
  </div>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <div class="page-header">
      <h2>Staff List</h2>
    </div>
    <table class="table table-striped table-bordered">
      <tr>
        <th>Staff ID</th>
        <th>Name</th>
        <th>Gender</th>
        <th>Phone Number</th>
        <th>Email Address</th>
        <th>Staff Level</th>
        <th></th>
      </tr>
      <?php
      // Read
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_staff_a165936_pt2");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }

      foreach($result as $readrow) {
        ?>
        <tr>
          <td><?php echo $readrow['fld_staff_num']; ?></td>
          <td><?php echo $readrow['fld_staff_name']; ?></td>
          <td><?php echo $readrow['fld_staff_gender']; ?></td>
          <td><?php echo $readrow['fld_staff_phone']; ?></td>
          <td><?php echo $readrow['fld_staff_email']; ?></td>
          <td><?php echo $readrow['fld_staff_level'];?></td>
          <td>
            <a href="staffs.php?edit=<?php echo $readrow['fld_staff_num']; ?>"class="btn btn-success btn-xs" role="button">Edit</a>
            <a href="staffs.php?delete=<?php echo $readrow['fld_staff_num']; ?>" onclick="return confirm('Are you sure to delete?');"class="btn btn-danger btn-xs" role="button">Delete</a>
          </td>
        </tr>
        <?php
      }
      $conn = null;
      ?>
    </table>
    </div>
  </center>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>