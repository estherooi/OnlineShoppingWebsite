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
 <title>My Bed Linen Ordering System : Search</title>
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
          <h2>Search Product</h2>
        </div>
        <form action="search.php" method="GET" class="form-horizontal">
          <div class="form-group">
           <label for="searchid" class="col-sm-2 control-label">Search</label>
           <div class="col-sm-7">
            <input name="searchproduct" type="text"  class="form-control " id="searchid" placeholder="Search" required>
            </div>
              <button class="btn btn-default col-sm-3" type="submit" name="search"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>Search</button>
          
          
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
        <th>Material</th>
        <th></th>
      </tr>
      <?php
      // Read
      if (isset($_GET['search'])||isset($_GET['page'])) {
       if(isset($_GET['search'])){
        $term=$_GET['searchproduct'];
      }else{
        $term=$_GET['psearch'];
      }

      $per_page = 5;
      if (isset($_GET["page"]))
        $page = $_GET["page"];
      else
        $page=1;
      $start_from =($page-1) * $per_page;
      try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM tbl_products_a165936_pt2 WHERE fld_product_brand LIKE '%".$term."%' OR fld_product_name LIKE '%".$term."%' OR fld_product_price LIKE '%".$term."%' OR fld_product_material LIKE '%".$term."%' LIMIT $start_from, $per_page");
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
          <td><?php echo $readrow['fld_product_material']; ?></td>
          
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
         $stmt = $conn->prepare("SELECT * FROM tbl_products_a165936_pt2 WHERE fld_product_brand LIKE '%".$term."%' OR fld_product_name LIKE '%".$term."%' OR fld_product_price LIKE '%".$term."%' OR fld_product_material LIKE '%".$term."%'");
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
        <li><a href="search.php?psearch=<?php echo $term?>&amp;page=<?php echo $page-1 ?>" aria-label="Previous"><span aria-hidden="true">«</span></a></li>
        <?php
      }
      for ($i=1; $i<=$total_pages; $i++)
        if ($i == $page)
          echo "<li class=\"active\"><a href=\"search.php?psearch=$term&amp;page=$i\">$i</a></li>";
        else
          echo "<li><a href=\"search.php?psearch=$term&amp;page=$i\">$i</a></li>";
        ?>
        <?php if ($page==$total_pages) { ?>
          <li class="disabled"><span aria-hidden="true">»</span></li>
        <?php } else { ?>
          <li><a href="search.php?psearch=<?php echo $term?>&amp;page=<?php echo $page+1 ?>" aria-label="Previous"><span aria-hidden="true">»</span></a></li>
        <?php } }?>
      </ul>
    </nav>
  </div>
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>

</body>
</html>

