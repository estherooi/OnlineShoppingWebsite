

<?php
include_once 'database.php';

$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


//Create

if (isset($_POST['create'])) {

  if ($_SESSION['userlevel']=="Normal Staff"){
    $message = "You have no access to CREATE product.";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'products.php';";
    echo "</script>";
  }else{

    try {

      $stmt = $conn->prepare("INSERT INTO tbl_products_a165936_pt2 (fld_product_num, fld_product_name, fld_product_brand, fld_product_price,  fld_product_material, fld_product_weight ,fld_product_warranty_length ) VALUES (:pid, :name, :brand, :price,  :material,  :weight, :warranty_length)");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);    
      $stmt->bindParam(':material', $material, PDO::PARAM_STR);
      $stmt->bindParam(':warranty_length', $warranty_length, PDO::PARAM_INT);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);

      $pid = $_POST['pid'];
      $name = $_POST['name'];
      $brand =  $_POST['brand'];
      $price = $_POST['price']; 
      $material = $_POST['material'];
      $warranty_length = $_POST['warranty_length'];
      $weight = $_POST['weight'];

      $stmt->execute();
    }

    catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
    }
  }
}

//Update
if (isset($_POST['update'])) {

  if ($_SESSION['userlevel']=="Normal Staff"){
    $message = "You have no access to UPDATE product.";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'products.php';";
    echo "</script>";
  }else{


    try {

      $stmt = $conn->prepare("UPDATE tbl_products_a165936_pt2 SET fld_product_num = :pid,
        fld_product_name = :name, fld_product_price = :price, fld_product_brand = :brand,
        fld_product_material = :material, fld_product_warranty_length = :warranty_length, fld_product_weight = :weight
        WHERE fld_product_num = :oldpid");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $stmt->bindParam(':name', $name, PDO::PARAM_STR);
      $stmt->bindParam(':brand', $brand, PDO::PARAM_STR);
      $stmt->bindParam(':price', $price, PDO::PARAM_INT);    
      $stmt->bindParam(':material', $material, PDO::PARAM_STR);
      $stmt->bindParam(':warranty_length', $warranty_length, PDO::PARAM_INT);
      $stmt->bindParam(':weight', $weight, PDO::PARAM_INT);
      $stmt->bindParam(':oldpid', $oldpid, PDO::PARAM_STR);

      $pid = $_POST['pid'];
      $name = $_POST['name'];
      $brand =  $_POST['brand'];
      $price = $_POST['price']; 
      $material = $_POST['material'];
      $warranty_length = $_POST['warranty_length'];
      $weight = $_POST['weight'];
      $oldpid = $_POST['oldpid'];

      $stmt->execute();

      header("Location: products.php");
    }

    catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
    }
  }
}

//Delete
if (isset($_GET['delete'])) {

  if ($_SESSION['userlevel']=="Normal Staff"){
    $message = "You have no access to DELETE product.";
    echo "<script type='text/javascript'>alert('$message');";
    echo "window.location.href = 'products.php';";
    echo "</script>";
  }else{


    try {

      $stmt = $conn->prepare("DELETE FROM tbl_products_a165936_pt2 WHERE fld_product_num = :pid");

      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

      $pid = $_GET['delete'];

      $stmt->execute();

      header("Location: products.php");
    }

    catch(PDOException $e)
    {
      echo "Error: " . $e->getMessage();
    }

}
}

//Edit
if (isset($_GET['edit'])) {
 if ($_SESSION['userlevel']=="Normal Staff"){
  $message = "You have no access to EDIT product.";
  echo "<script type='text/javascript'>alert('$message');";
  echo "window.location.href = 'products.php';";
  echo "</script>";
}else{

  try {

    $stmt = $conn->prepare("SELECT * FROM tbl_products_a165936_pt2 WHERE fld_product_num = :pid");

    $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);

    $pid = $_GET['edit'];

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