 <?php
include_once 'database.php';
try {
      $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = $conn->prepare("SELECT * FROM tbl_products_a165936_pt2 WHERE fld_product_num = :pid");
      $stmt->bindParam(':pid', $pid, PDO::PARAM_STR);
      $pid = $_GET['pid'];
      $stmt->execute();
      $readrow = $stmt->fetch(PDO::FETCH_ASSOC);
    }
    catch(PDOException $e) {
      echo "Error: " . $e->getMessage();
    }
    $conn = null;

?>

<div class="container-fluid">
  <div class="row">
    <div class="col-xs-10 col-xs-offset-2 col-xs-pull-1 col-sm-10 col-sm-offset-2 col-sm-pull-1 col-md-10 col-md-offset-2 col-md-pull-1 well well-sm text-center">
      <?php if ($readrow['fld_product_image'] == "" ) {
        echo "No image";
      }
      else { ?>
      <img src="products/<?php echo $readrow['fld_product_image'] ?>" class="img-responsive">
      <?php } ?>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="panel panel-default">
      <div class="panel-heading"><strong>Product Details</strong></div>
      <div class="panel-body">
          Below are specifications of the product.
      </div>
      <table class="table">
        <tr>
          <td class="col-xs-4 col-sm-4 col-md-4"><strong>Product ID</strong></td>
          <td><?php echo $readrow['fld_product_num'] ?></td>
        </tr>
        <tr>
          <td><strong>Name</strong></td>
          <td><?php echo $readrow['fld_product_name'] ?></td>
        </tr>
        <tr>
          <td><strong>Price</strong></td>
          <td>RM <?php echo $readrow['fld_product_price'] ?></td>
        </tr>
        <tr>
          <td><strong>Brand</strong></td>
          <td><?php echo $readrow['fld_product_brand'] ?></td>
        </tr>
        <tr>
          <td><strong>Material</strong></td>
          <td><?php echo $readrow['fld_product_material'] ?></td>
        </tr>
        <tr>
          <td><strong>Product Weight(kg)</strong></td>
          <td><?php echo $readrow['fld_product_weight'] ?></td>
        </tr>
        <tr>
          <td><strong>Warranty Length(Days)</strong></td>
          <td><?php echo $readrow['fld_product_warranty_length'] ?></td>
        </tr>

        
      </table>
      </div>
    </div>
  </div>
</div>
