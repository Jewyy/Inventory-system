<?php
$page_title = "All Product";
require_once "includes/load.php";
$products = join_product_table();
?>
<?php include_once "layouts/header.php"; ?>

<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
  <div class="clearfix">
    <div class="pull-left">
      <div class="headertext">
        Manage Products
      </div>
    </div>
    <div class="pull-right">
      <a href="add_product.php" class="btn btn-success"> <img src="./asset/plus.svg">Add Product</a>
    </div>
  </div>
  <input style="width:100%; height:30px; margin-top: 25px; margin-bottom: 25px;" type="text" id="search" placeholder="Search...">
  <div class="col-md-12">
    <div style="background-color: white;">

      <table class="product-table">
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
  </div>
</div>
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