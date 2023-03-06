<?php
  $page_title = 'All Product';
  require_once('includes/load.php');
  // Checkin What level user has permission to view this page
  //  page_require_level(2);
  $products = join_product_table();
?>
<?php include_once('layouts/header.php'); ?>
  <div class="row">
     <div class="col-md-12 newfont">
       <?php echo display_msg($msg); ?>
     </div>
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading clearfix">
         <div class="pull-right">
           <a href="add_product.php" class="btn btn-primary">+ Add New</a>
         </div>
         <div class="pull-left">
           <input type="text" id="search" placeholder="Search...">
         </div>
        </div>
  <div class="sidebar">
    <?php include_once "menu.php"; ?>
  </div>
  <div style="background-color: white; display: 100%;">
    <div class="clearfix" style="padding-bottom: 20px;">
      <div class="pull-right" style="padding-right: 20px; padding-top: 20px;">
        <a href="add_product.php" class="btn btn-success"> <img src="./asset/plus.svg">
          <span style="padding-bottom: 15px;">
            Add Product
          </span>
        <div class="panel-body">
          <!-- <table class="table table-bordered"> -->
          <table class="table">
            <thead>
              <tr>
                <th class="text-center table-header" style="width: 50px;">No.</th>
                <th class="table-header" > Photo</th>
                <th class="table-header" > Product Name </th>
                <!-- <th class="text-center" style="width: 10%; color:#78e6b8;"> Categories </th> -->
                <th class="text-center table-header" style="width: 10%; "> In-Stock </th>
                <th class="text-center table-header" style="width: 10%; "> Buying Price </th>
                <th class="text-center table-header" style="width: 10%; "> Selling Price </th>
                <th class="text-center table-header" style="width: 20%; "> Product Add </th>
                <th class="text-center table-header" style="width: 100px; "> Actions </th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($products as $product):?>
              <tr>
                <td class="text-center"><?php echo count_id();?></td>
                <td>
                  <?php if($product['media_id'] === '0'): ?>
                    <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
                  <?php else: ?>
                  <img class="img-avatar img-circle" src="uploads/products/<?php echo $product['image']; ?>" alt="">
                <?php endif; ?>
                </td>
                <td style="font-size:20px;"> <?php echo remove_junk($product['name']); echo "<br>";?> 
                  <div class="categories-tag"><?php echo "", remove_junk($product['categorie']); ?></div>
                </div>
                <!-- <td class="text-center" style="font-size:18px;"> <?php echo remove_junk($product['categorie']); ?></td> -->
                <td class="text-center table-list" style="font-size:18px; "> <?php echo remove_junk($product['quantity']); ?></td>
                <td class="text-center table-list" style="font-size:18px; "> <?php echo remove_junk($product['buy_price']); ?></td>
                <td class="text-center table-list" style="font-size:18px; "> <?php echo remove_junk($product['sale_price']); ?></td>
                <td class="text-center " style="font-size:18px;"> <?php echo read_date($product['date']); ?></td>
                <td class="text-center " style="font-size:18px;">
                  <div class="btn-group">
                    <a href="edit_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-info btn-s"  title="Edit" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-edit"></span>
                    </a>
                    <a href="delete_product.php?id=<?php echo (int)$product['id'];?>" class="btn btn-danger btn-s"  title="Delete" data-toggle="tooltip">
                      <span class="glyphicon glyphicon-trash"></span>
                    </a>
                  </div>
                </td>
              </tr>
             <?php endforeach; ?>
            </tbody>
          </tabel>
        </div>
      </div>
    </div>
    <table class=product-table">
      <thead>
        <tr style="height:60px; border-bottom:solid;  border-color:#D3D3D3; box-shadow:0px 3px 0px #E6E6E6">
          <th class="product-tab" style="width: 30px;">No.</th>
          <th class="product-tab" style="width: 50px;"> Photo</th>
          <th class="product-tab" style="width: 20px;"> Product Name </th>
          <th class="product-tab" style="width: 10%;"> In-stock </th>
          <th class="product-tab" style="width: 10%;"> Buying Price </th>
          <th class="product-tab" style="width: 10%;"> Selling Price </th>
          <th class="product-tab" style="width: 10%;"> Product Add </th>
          <th class="product-tab" style="width: 10%; text-align: center;"> Action </th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($products as $product) : ?>
          <tr class="product-row-style">
            <td><?php echo count_id(); ?></td>
            <td>
              <?php if ($product["media_id"] === "0") : ?>
                <img class="img-avatar img-circle" src="uploads/products/no_image.png" alt="">
              <?php else : ?>
                <img class="img-avatar img-circle" src="uploads/products/<?php echo $product["image"]; ?>" alt="">
              <?php endif; ?>
            </td>
            <div class="display-box">
              <td> <?php echo remove_junk($product["name"]); ?>
              <br>
                <span class="category-button">
                  <?php echo remove_junk($product["categorie"]); ?>
                </span>
              </td>
            </div>
            <td class="display-font-table"> <?php echo remove_junk($product["quantity"]); ?></td>
            <td class="display-font-table"> <?php echo remove_junk($product["buy_price"]); ?></td>
            <td class="display-font-table"> <?php echo remove_junk($product["sale_price"]); ?></td>
            <td style="font-weight:bold;"> <?php echo read_date($product["date"]); ?></td>
            <td>
              <div class="btn-group" style="padding-left: 15px;">
                <a href="edit_product.php?id=<?php echo (int) $product["id"]; ?>" class="btn btn-light" title="Edit" data-toggle="tooltip">
                  <img src="./asset/edit.svg">
                </a>
                <a href="delete_product.php?id=<?php echo (int) $product["id"]; ?>" class="btn btn-light" title="Delete" data-toggle="tooltip">
                  <img src="./asset/trash.svg">
                </a>
              </div>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
      </tabel>
  </div>
  <?php include_once('layouts/footer.php'); ?>
  
  <script>
  $(document).ready(function() {
    $("#search").on("keyup", function() {
      var value = $(this).val().toLowerCase();
      $("tbody tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
      });
    });
  });
</script>
