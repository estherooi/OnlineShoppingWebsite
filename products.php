<?php


  //start session 
session_start();
include_once 'products_crud.php';
if (is_null($_SESSION['userlevel'])){
    //redirect to home page
  header("Location:login.php");
}
?>

<!DOCTYPE html>
<html>

<head>
 <meta charset="utf-8">
 <meta http-equiv="X-UA-Compatible" content="IE=edge">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
 <title>My Bed Linen Ordering System : Products</title>
 <!-- Bootstrap -->
 <link href="css/bootstrap.min.css" rel="stylesheet">
 
</head>

<body>
  <style>
body {
   background-image: url('background-floral.jpg');
  background-repeat: no-repeat;
  background-attachment: fixed;
  background-size: cover;
}
</style>
  <?php include_once 'nav_bar.php';?>
  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
        <div class="page-header">
          <h2>Create New Product</h2>
        </div>
        <form action="products.php" method="post" class="form-horizontal">
          <div class="form-group">
           <label for="productid" class="col-sm-3 control-label">Product ID</label>
           <div class="col-sm-9">
            <input name="pid" type="text"  class="form-control" id="productid" placeholder="Product ID" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_num']; ?>" required>    
          </div>
        </div>

        <div class="form-group">
         <label for="productname" class="col-sm-3 control-label">Name</label>
         <div class="col-sm-9">
          <input name="name" type="text" class="form-control" id="productname" placeholder="Product Name" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_name']; ?>" required>
        </div>
      </div>

      <div class="form-group">
       <label for="productbrand" class="col-sm-3 control-label">Brand</label>
       <div class="col-sm-9">
        <input name="brand" type="text" class="form-control" id="productbrand" placeholder="Product Brand" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_brand']; ?>" required> 
      </div>
    </div>

    <div class="form-group">
     <label for="productprice" class="col-sm-3 control-label">Price (RM)</label>
     <div class="col-sm-9">
      <input name="price" type="text" class="form-control" id="productprice" placeholder="Product Price" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_price']; ?>" required> 
    </div>
  </div>

  <div class="form-group">
    <label for="productmaterial" class="col-sm-3 control-label">Material</label>
    <div class="col-sm-9">
     <select name="material" class="form-control" id="productmaterial" required="">
      <option value="">Please select</option>
      <option value="Polyester" <?php if(isset($_GET['edit'])) if($editrow['fld_product_material']=="Polyester") echo "selected"; ?>>Polyester</option>
      <option value="Cotton" <?php if(isset($_GET['edit'])) if($editrow['fld_product_material']=="Cotton") echo "selected"; ?>>Cotton</option>
      <option value="Microfiber" <?php if(isset($_GET['edit'])) if($editrow['fld_product_material']=="Microfiber") echo "selected"; ?>>Microfiber</option>
    </select> 
  </div>
</div>

<div class="form-group">
 <label for="productweight" class="col-sm-3 control-label">Weight (kg)</label>
 <div class="col-sm-9">
  <input name="weight" type="text" class="form-control" id="productweight" placeholder="Product Weight" value="<?php if(isset($_GET['edit'])) echo $editrow['fld_product_weight']; ?>" required> 
</div>
</div>

<div class="form-group">
  <label for="productwarranty" class="col-sm-3 control-label">
  Warranty Length (days) </label>
  <div class="col-sm-9">
    <div class="radio">
      <label>
        <input name="warranty_length" type="radio" id="warrantylength" value="30" required="" <?php if(isset($_GET['edit'])) if($editrow['fld_product_warranty_length']=="30") echo "checked"; ?>> 30 days
      </label>
    </div>
    <div class="radio">
      <label>
        <input name="warranty_length" type="radio" id="warrantylength" value="60" required="" <?php if(isset($_GET['edit'])) if($editrow['fld_product_warranty_length']=="60") echo "checked"; ?>> 60 days
      </label>
    </div>
  </div>
</div>

<div class="form-group">
  <div class="col-sm-offset-3 col-sm-9">
    <?php if (isset($_GET['edit'])) { ?>
      <input type="hidden" name="oldpid" value="<?php echo $editrow['fld_product_num']; ?>">
      <button class="btn btn-default" type="submit" name="update"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Update</button>
    <?php } else { ?>
      <button class="btn btn-default" type="submit" name="create"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span>Create</button>
    <?php } ?>
    <button class="btn btn-default" type="reset">><span class="glyphicon glyphicon-erase" aria-hidden="true"></span> Clear</button>
  </div>
</div>
</form>
</div>
</div>

<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <div class="page-header">
      <h2>Products List</h2>
    </div>
    <table class="table table-striped table-bordered">

      <tr>
        <th>Product ID</th>
        <th>Name</th>
        <th>Brand</th>
        <th>Price</th>
        <th></th>
      </tr>
      <?php
      // Read
      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page=1;
      $start_from =($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a165936_pt2 LIMIT $start_from, $per_page");
        $stmt->execute();
        $result = $stmt->fetchAll();
      }
      catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }
      foreach($result as $readrow) {
        ?>   
        <tr>
          <td><?php echo $readrow['fld_product_num']; ?></td>
          <td><?php echo $readrow['fld_product_name']; ?></td>
          <td><?php echo $readrow['fld_product_brand']; ?></td>
          <td><?php echo $readrow['fld_product_price']; ?></td>
          
          <td>
             
                <a class="btn btn-warning btn-xs" onclick="return loading('products_details.php?pid=<?php echo $readrow['fld_product_num']; ?>')" data-target="#myModal" data-toggle="modal" role="button">Details</a>

                <div class="modal fade" id="myModal">
                  <div class="modal-dialog" >
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</span></button>
                        <h4 class="modal-title">Product Details</h4>
                      </div>
                      <div class="modal-body">
                       <script type="text/javascript">
                          function loading(link){
                            $(document).on("show.bs.modal",'#myModal',function(event){
                              $(this).find(".modal-body").load(link);
                            });
                          }
                        </script>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        
                      </div>
                    </div>
                  </div>
                </div>
                
            <a href="products.php?edit=<?php echo $readrow['fld_product_num']; ?>"class="btn btn-success btn-xs" role="button">Edit</a>
            <a href="products.php?delete=<?php echo $readrow['fld_product_num']; ?>" onclick="return confirm('Are you sure to delete?');"class="btn btn-danger btn-xs" role="button">Delete</a>
          </td>
        </tr>

        <?php
      }
      $conn = null;


      ?>
      
    </table>
  </div>
</div>
</div>
<div class="row">
  <div class="col-xs-12 col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">
    <nav>
      <ul class="pagination">
        <?php
        try {
         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         $stmt = $conn->prepare("SELECT * FROM tbl_products_a165936_pt2");
         $stmt->execute();
         $result = $stmt->fetchAll();
         $total_records = count($result);
       }
       catch(PDOException $e){
        echo "Error: " . $e->getMessage();
      }
      $total_pages = ceil($total_records / $per_page);
      ?>
      <?php if ($page==1) { ?>
        <li class="disabled"><span aria-hidden="true">«</span></li>
      <?php } else { ?>
        <li><a href="products.php?page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
        <?php
      }
      for ($i=1; $i<=$total_pages; $i++)
        if ($i == $page)
          echo "<li class=\"active\"><a href=\"products.php?page=$i\">$i</a></li>";
        else
          echo "<li><a href=\"products.php?page=$i\">$i</a></li>";
        ?>
        <?php if ($page==$total_pages) { ?>
          <li class="disabled"><span aria-hidden="true">»</span></li>
        <?php } else { ?>
          <li><a href="products.php?page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
        <?php } ?>
      </ul>
    </nav>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

</body>
</html>

