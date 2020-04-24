<?php
	session_start();
	include_once 'database.php';

	$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts1/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts1/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css1/util.css">
	<link rel="stylesheet" type="text/css" href="css1/main.css">
<!--===============================================================================================-->


</head>



	

<body>

	<?php
			
			if(isset($_POST['id']) && isset($_POST['password'])){
				$query = "SELECT * FROM tbl_staff_a165936_pt2 WHERE fld_staff_num = '".$_POST['id']."' AND fld_staff_password = '".$_POST['password']."'";
				$statement = $conn->prepare($query);
				$statement -> execute();
				$result = $statement -> fetch();
				if(!empty($result)){
					$_SESSION['userlevel'] = $result["fld_staff_level"];
					$_SESSION['username'] = $result['fld_staff_name'];
					
					header("Location: index.php");
				}else{
					$message = "Incorrect id and password!";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
         ?>

 
	<div class="limiter">

		<div class="container-login100">

			<div class="wrap-login100">

				<form class="login100-form validate-form" method="POST" action="login.php">
					<span class="login100-form-title p-b-26">
						Welcome
					</span>
					<span class="login100-form-title p-b-48">
						<i class='fas fa-bed' style='font-size:36px'></i>
					</span>

					<div class="wrap-input100 validate-input">
						<input class="input100" type="text" name="id">
						<span class="focus-input100" data-placeholder="Staff ID"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<span class="btn-show-pass">
							<i class="zmdi zmdi-eye"></i>
						</span>
						<input class="input100" type="password" name="password">
						<span class="focus-input100" data-placeholder="Password"></span>
					</div>

					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>

							<button class="login100-form-btn" name="login">
								Login
							</button>
						</div>
					</div>

					
					</div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js1/main.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
</body>
</html>

